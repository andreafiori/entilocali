<?php

namespace Admin\Controller\AlboPretorio;

use ModelModule\Model\AlboPretorio\AlboPretorioSezioniForm;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class AlboPretorioSezioniFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');
        $lang = $this->params()->fromRoute('lang');
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
            $formTitle = 'Nuova sezione';
            $formAction = 'albo-pretorio-sezioni/insert/';
        }

        $this->layout()->setVariables(array(
            'formTitle'                     => $formTitle,
            'formDescription'               => 'Inserisci dati nuova sezione albo pretorio',
            'form'                          => $form,
            'formAction'                    => $formAction,
            'formBreadCrumbTitle'           => 'Modifica',
            'formBreadCrumbCategory' => array(
                array(
                    'label' => 'Albo pretorio',
                    'href'  =>  $this->url()->fromRoute('admin/albo-pretorio-summary',
                        array('lang' => $lang)
                    ),
                    'title' => 'Albo pretorio',
                ),
                array(
                    'label' => 'Sezioni',
                    'href'  =>  $this->url()->fromRoute('admin/albo-pretorio-sezioni-summary', array(
                        'lang' => $lang,
                    )),
                    'title' => 'Elenco sezioni albo pretorio',
                ),
            ),
            'templatePartial'               => self::formTemplate,
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}