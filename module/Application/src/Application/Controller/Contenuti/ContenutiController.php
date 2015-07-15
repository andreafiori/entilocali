<?php

namespace Application\Controller\Contenuti;

use ModelModule\Model\Contenuti\ContenutiControllerHelper;
use ModelModule\Model\Contenuti\ContenutiGetter;
use ModelModule\Model\Contenuti\ContenutiGetterWrapper;
use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Sezioni\SottoSezioniGetter;
use ModelModule\Model\Sezioni\SottoSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

/**
 * Contenuti Controller for the public website
 */
class ContenutiController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $subsectionid = $this->params()->fromRoute('subsectionid');

        $lang = $this->params()->fromRoute('lang');

        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $ammTraspSezioneId = $this->layout()->getVariable('amministrazione_trasparente_sezione_id');

        $helper = new ContenutiControllerHelper();
        $wrapper = $helper->recoverWrapper(
            new ContenutiGetterWrapper(new ContenutiGetter($em)),
            array(
                'noscaduti'     => 1,
                'attivo'        => 1,
                'modulo'        => ModulesContainer::contenuti_id,
                'sottosezione' => $subsectionid,
                'languageAbbreviation' => $lang,
            )
        );
        $wrapper->setEntityManager($em);

        $records = $wrapper->addAttachmentsFromRecords(
            $wrapper->getRecords(),
            array(
                'moduleId'              => ModulesContainer::contenuti_id,
                'noscaduti'             => 1,
                'status'                => 1,
                'languageAbbreviation'  => $lang,
                'orderBy'               => 'a.position'
            )
        );

        if (!empty($records)) {
            foreach($records as &$record) {

                $wrapper = new SottoSezioniGetterWrapper( new SottoSezioniGetter($em) );
                $wrapper->setInput( array(
                        'profonditaDa'      => isset($record['sottosezione']) ? $record['sottosezione'] : null,
                        'excludeSezioneId'  => isset($ammTraspSezioneId) ? $ammTraspSezioneId : null,
                    )
                );
                $wrapper->setupQueryBuilder();

                $subSections = $wrapper->getRecords();
                if (!empty($subSections)) {
                    foreach($subSections as $subSection) {
                        $record['sotto_sezioni'][] = $subSection;
                    }
                }
            }
        }

        $this->layout()->setVariables(array(
            'records'           => isset($records) ? $records : null,
            'recordsCount'      => count($records),
            'templatePartial'   => 'contenuti/contenuti-list.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}