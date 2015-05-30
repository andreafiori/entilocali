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

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new SezioniControllerHelper();
        $helper->setSezioniGetterWrapper(new SezioniGetterWrapper(new SezioniGetter($em)));
        $recordFromDb = $helper->recoverWrapperRecordsById(
            $helper->getSezioniGetterWrapper(),
            array('id' => $id, 'limit' => 1),
            $id
        );
        $helper->setLanguagesGetterWrapper(new LanguagesGetterWrapper(new LanguagesGetter($em)));

        $form = new SezioniForm();
        $form->addIconImage();
        $form->addLingue(array(
            1 => 'Italiano',
            2 => 'Inglese',
        ));
        $form->addOptions();

        if (!empty($recordFromDb)) {
            $form->setData($recordFromDb[0]);

            $submitButtonValue = 'Modifica';
            $formTitle = $recordFromDb[0]['nome'];
            $formAction = $this->url()->fromRoute('admin/sezioni-update', array(
                'lang'              => $this->params()->fromRoute('lang'),
                'languageSelection' => $this->params()->fromRoute('languageSelection'),
            ));
        } else {
            $form->setData( array('posizione' => 1) );

            $formTitle = 'Nuova sezione';
            $submitButtonValue = 'Inserisci';
            $formAction = $this->url()->fromRoute('admin/sezioni-insert', array(
                'lang'              => $this->params()->fromRoute('lang'),
                'languageSelection' => $this->params()->fromRoute('languageSelection'),
            ));
        }

        $this->layout()->setVariables(array(
            'form'                          => $form,
            'formAction'                    => $formAction,
            'formTitle'                     => $formTitle,
            'formDescription'               => 'Le sezioni rappresentano i blocchi principali sui quali costruire le basi dei contenuti',
            'submitButtonValue'             => $submitButtonValue,
            'noFormActionPrefix'            => 1,
            'formBreadCrumbCategory'        => 'Sezioni',
            'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/sezioni-summary', array(
                'lang' => $this->params()->fromRoute('lang'),
                'languageSelection' => $this->params()->fromRoute('languageSelection'),
            )),
            'templatePartial' => self::formTemplate,
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}