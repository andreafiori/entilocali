<?php

namespace Admin\Controller\EntiTerzi;

use ModelModule\Model\EntiTerzi\EntiTerziGetter;
use ModelModule\Model\EntiTerzi\EntiTerziGetterWrapper;
use ModelModule\Model\EntiTerzi\InvioEnteTerzoForm;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use ModelModule\Model\StatoCivile\StatoCivileGetter;
use ModelModule\Model\StatoCivile\StatoCivileGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\NullException;

class InvioEnteTerzoController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em             = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id             = $this->params()->fromRoute('id');
        $lang           = $this->params()->fromRoute('lang');
        $moduleCode     = $this->params()->fromRoute('module');

        try {

            switch($moduleCode) {

                default:
                    throw new NullException("Codice modulo non valido");
                    break;

                case("albo-pretorio"):
                    $recordsGetter = new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em));
                    $recordsGetter->setInput( array('id' => $id, 'limit' => 1) );
                    $recordsGetter->setupQueryBuilder();

                    $moduleName = 'Albo pretorio';

                    $record = $recordsGetter->getRecords();

                    $titolo = $record[0]['titolo'];
                    break;

                case("stato-civile"):
                    $recordsGetter = new StatoCivileGetterWrapper( new StatoCivileGetter($em) );
                    $recordsGetter->setInput(array("id" => $id, 'limit' => 1));
                    $recordsGetter->setupQueryBuilder();

                    $moduleName = 'Stato civile';

                    $record = $recordsGetter->getRecords();

                    $titolo = $record[0]['titolo'];
                    break;
            }

            $wrapper = new EntiTerziGetterWrapper(new EntiTerziGetter($em));
            $wrapper->setupQueryBuilder();

            $entiTerziRecords = $wrapper->getRecords();

            $form = new InvioEnteTerzoForm();
            $form->addContatti($entiTerziRecords);

            $this->layout()->setVariables(array(
                'formDataCommonPath' => 'backend/templates/common/',
                'form'               => $form,
                'formAction'         => $this->url()->fromRoute('admin/invio-ente-terzo-inviomail', array(
                    'lang'           => $lang,
                    'modulename'     => $moduleCode,
                    'id'             => $record[0]['id'],
                )),
                'moduleName'         => $moduleName,
                'moduleCode'         => $moduleCode,
                'titolo'             => $titolo,
                'rubricaEntiTerzi'   => $entiTerziRecords,
                'templatePartial'    => 'invio-ente-terzo/invio-ente-terzo.phtml',
            ));

            $this->layout()->setTemplate($mainLayout);

        } catch(\Exception $e) {

        }
    }

    public function inviomailAction()
    {
        if ($this->getServiceLocator()->get('request')->isPost()) {

            $mainLayout = $this->initializeAdminArea();

            $emailEnte = $this->params()->fromPost('emailEnte');

            $entiTerxziList = $this->params()->fromPost('entiterzi');

            // Richiesta pubblicazione al Vostro Albo Pretorio -

            $this->layout()->setTemplate($mainLayout);
        }

        // return $this->redirect()->toRoute('admin/albo-pretorio-summary', array('lang' => 'it'));
    }
}
