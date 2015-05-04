<?php

namespace Admin\Controller\EntiTerzi;

use Admin\Model\EntiTerzi\EntiTerziGetter;
use Admin\Model\EntiTerzi\EntiTerziGetterWrapper;
use Admin\Model\EntiTerzi\InvioEnteTerzoForm;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use Admin\Model\StatoCivile\StatoCivileGetter;
use Admin\Model\StatoCivile\StatoCivileGetterWrapper;
use Application\Controller\SetupAbstractController;
use Application\Model\NullException;

class InvioEnteTerzoController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id             = $this->params()->fromRoute('id');
        $moduleCode     = $this->params()->fromRoute('module');
        $em             = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

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
                'lang'           => 'it',
                'modulename'     => $moduleCode,
                'id'             => $record[0]['id'],
            )),
            'moduleName'         => $moduleName,
            'titolo'             => $titolo,
            'rubricaEntiTerzi'   => $entiTerziRecords,
            'templatePartial'    => 'invio-ente-terzo/invio-ente-terzo.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
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
