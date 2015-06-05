<?php

namespace Admin\Controller\Sezioni;

use ModelModule\Model\Languages\LanguagesGetter;
use ModelModule\Model\Languages\LanguagesGetterWrapper;
use ModelModule\Model\Sezioni\SezioniControllerHelper;
use ModelModule\Model\Sezioni\SezioniForm;
use ModelModule\Model\Sezioni\SezioniGetter;
use ModelModule\Model\Sezioni\SezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class SezioniFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');
        $lang = $this->params()->fromRoute('lang');
        $languageSelection = $this->params()->fromRoute('languageSelection');
        $modulename = $this->params()->fromRoute('modulename');
        $modulenameLabel = str_replace('-', ' ', $modulename);

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new SezioniControllerHelper();
        $recordFromDb = $helper->recoverWrapperRecordsById(
            new SezioniGetterWrapper(new SezioniGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );
        $helper->setLanguagesGetterWrapper(new LanguagesGetterWrapper(new LanguagesGetter($em)));
        $languagesRecordsForDropdown = $helper->formatForDropwdown(
            $helper->recoverWrapperRecords(
                $helper->getLanguagesGetterWrapper(),
                array('status' => 1)
            ),
            'id',
            'name'
        );

        $form = new SezioniForm();
        $form->addIconImage();
        $form->addLingue($languagesRecordsForDropdown);
        $form->addOptions();

        if (!empty($recordFromDb)) {
            $form->setData($recordFromDb[0]);

            $submitButtonValue = 'Modifica';
            $formTitle = $recordFromDb[0]['nome'];
            $formAction = $this->url()->fromRoute('admin/sezioni-update', array(
                'lang'              => $lang,
                'languageSelection' => $languageSelection,
                'modulename'        => $modulename,
            ));
        } else {
            $form->setData(array(
                'posizione'         => 1,
                'lingua'            => 1,
                'isAmmTrasparente'  => ($modulename!='contenuti') ? 1 : 0,
            ));

            $formTitle = 'Nuova sezione';
            $submitButtonValue = 'Inserisci';
            $formAction = $this->url()->fromRoute('admin/sezioni-insert', array(
                'lang'              => $lang,
                'languageSelection' => $languageSelection,
                'modulename'        => $modulename,
            ));
        }

        $this->layout()->setVariables(array(
            'form'                          => $form,
            'formAction'                    => $formAction,
            'formTitle'                     => $formTitle,
            'formDescription'               => 'Le sezioni rappresentano i blocchi principali sui quali costruire le basi dei contenuti',
            'submitButtonValue'             => $submitButtonValue,
            'noFormActionPrefix'            => 1,
            'formBreadCrumbCategory'        => array(
                array(
                    'href' => '#',
                    'label' => ucfirst($modulenameLabel),
                    'title' => 'Elenco '.$modulename,
                ),
                array(
                    'href' => $this->url()->fromRoute('admin/sezioni-summary', array(
                        'lang'              => $lang,
                        'languageSelection' => $languageSelection,
                        'modulename'        => $modulename,
                    )),
                    'label' => 'Sezioni',
                    'title' => 'Sezioni '.$modulenameLabel,
                ),
            ),
            'templatePartial' => self::formTemplate,
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}