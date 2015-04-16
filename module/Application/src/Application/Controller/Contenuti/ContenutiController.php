<?php

namespace Application\Controller\Contenuti;

use Admin\Model\Contenuti\ContenutiGetter;
use Admin\Model\Contenuti\ContenutiGetterWrapper;
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

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $wrapper = new ContenutiGetterWrapper( new ContenutiGetter($em) );
        $wrapper->setEntityManager($em);
        $wrapper->setInput(array(
                'noscaduti'     => 1,
                'attivo'        => 1,
                'modulo'        => 2,
                'sottosezione'  => $subsectionid,
            )
        );
        $wrapper->setupQueryBuilder();

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
                        'profonditaDa' => isset($record['sottosezione']) ? $record['sottosezione'] : null
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