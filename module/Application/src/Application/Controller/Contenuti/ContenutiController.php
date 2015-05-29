<?php

namespace Application\Controller\Contenuti;

use Admin\Model\Contenuti\ContenutiControllerHelper;
use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;
use Admin\Model\Modules\ModulesContainer;
use Admin\Model\Sezioni\SottoSezioniGetter;
use Admin\Model\Sezioni\SottoSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

/**
 * @author Andrea Fiori
 * @since  15 April 2015
 */
class ContenutiController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $subsectionid = $this->params()->fromRoute('subsectionid');

        $lang = $this->params()->fromRoute('lang');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $ammTraspSezioneId      = $this->layout()->getVariable('amministrazione_trasparente_sezione_id');

        $helper = new ContenutiControllerHelper();
        $helper->setContenutiGetterWrapper( new ContenutiGetterWrapper(new ContenutiGetter($em)) );

        $wrapper = $helper->recoverWrapper(
            $helper->getContenutiGetterWrapper(),
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
                'moduleId'    => 2,
                'noscaduti'   => 1,
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
            'templatePartial'   => 'contenuti/node.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}