<?php

namespace Admin\Controller\AlboPretorio;

use Admin\Model\AlboPretorio\AlboPretorioSezioniForm;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetter;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class AlboPretorioSezioniFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();
        $id = $this->params()->fromRoute('id');
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        if (is_numeric($id)) {
            $wrapper = new AlboPretorioSezioniGetterWrapper(  new AlboPretorioSezioniGetter($em) );
            $wrapper->setInput( array("id" => $id, 'limit' => 1));
            $wrapper->setupQueryBuilder();

            $sezioneRecord = $wrapper->getRecords();
        }

        $form = new AlboPretorioSezioniForm();

        if (!empty($sezioneRecord)) {
            $form->setData($sezioneRecord[0]);

            $formTitle = $sezioneRecord[0]['nome'];

            $formAction = 'albo-pretorio-sezioni/update/'.$sezioneRecord[0]['id'];
        } else {
            $formTitle = 'Nuova sezione albo pretorio';

            $formAction = 'albo-pretorio-sezioni/insert/';
        }

        $this->layout()->setVariables(array(
            'formTitle'                     => $formTitle,
            'formDescription'               => 'Inserisci dati nuova sezione albo pretorio',
            'form'                          => $form,
            'formAction'                    => $formAction,
            'formBreadCrumbCategory'        => 'Sezioni albo pretorio',
            'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/albo-pretorio-sezioni-summary', array(
                'lang' => 'it',
            )),
            'templatePartial'               => self::formTemplate,
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}