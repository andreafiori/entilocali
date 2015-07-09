<?php

namespace Admin\Controller\Photo;

use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Posts\PostsControllerHelper;
use ModelModule\Model\Posts\PostsForm;
use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\Posts\PostsCategoriesGetter;
use ModelModule\Model\Posts\PostsCategoriesGetterWrapper;

class PhotoFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id                 = $this->params()->fromRoute('id');
        $lang               = $this->params()->fromRoute('lang');
        $languageSelection  = $this->params()->fromRoute('languageSelection');

        $configurations = $this->layout()->getVariable('configurations');

        $helper = new PostsControllerHelper();
        //$helper->checkMediaDir($configurations);
        //$helper->checkMediaProject($configurations);
        //$helper->checkMediaSubDir($configurations);

        try{

            $categoriesRecords = $helper->recoverWrapperRecords(
                new PostsCategoriesGetterWrapper(new PostsCategoriesGetter($em)),
                array(
                    'fields'        => 'category.id, category.name',
                    'orderBy'       => 'category.name',
                    'moduleCode'    => 'photo',
                )
            );
            $helper->checkRecords($categoriesRecords, 'Nessuna categorie non presente. Inserire almeno una categoria');
            $categoriesRecordsForDropDown = $helper->formatForDropwdown($categoriesRecords ,'id', 'name');

            $recordFromDb = $helper->recoverWrapperRecordsById(
                new PostsGetterWrapper(new PostsGetter($em)),
                array('id' => $id, 'limit' => 1),
                $id
            );

            $form = new PostsForm();
            (!empty($recordFromDb)) ? $form->addUploadImage() : $form->addUploadImageRequired();
            $form->addTitle();
            $form->addMainFields();
            $form->addCategory($categoriesRecordsForDropDown);
            /* Additional fields: */
            /*
            $form->addSeo();
            $form->addHome();
            $form->addFacebook();
            */

            if (!empty($recordFromDb)) {

                $categoryIdForForm = $helper->gatherCategoriesId(
                    new PostsGetterWrapper(new PostsGetter($em)),
                    array(
                        'fields'     => 'c.id, c.name',
                        'id'         => $recordFromDb[0]['id'],
                        'orderBy'    => 'c.name',
                    )
                );

                $recordFromDb[0]['currentImage'] = isset($recordFromDb[0]['image']) ? $recordFromDb[0]['image'] : null;
                $recordFromDb[0]['categories'] = $categoryIdForForm;

                $form->setData($recordFromDb[0]);

                $submitButtonValue  = 'Modifica';
                $formTitle          = 'Modifica foto';
                $formAction         = $this->url()->fromRoute('admin/photo-update', array(
                    'lang'              => $lang,
                    'languageSelection' => $languageSelection,
                ));
            } else {
                $form->setData(array(
                    'status'        => 1,
                    'expireDate'    => '0000-00-00 00-00-00',
                ));

                $formTitle          = 'Nuova foto';
                $submitButtonValue  = 'Inserisci';
                $formAction         = $this->url()->fromRoute('admin/photo-insert', array(
                    'lang'              => $lang,
                    'languageSelection' => $languageSelection,
                ));
            }

            $this->layout()->setVariables(array(
                'formTitle'                     => $formTitle,
                'formDescription'               => 'Compila i dati relativi alla foto',
                'form'                          => $form,
                'formAction'                    => $formAction,
                'submitButtonValue'             => $submitButtonValue,
                'formBreadCrumbCategory'        => 'Galleria foto',
                'imageValidation'               => 1,
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/photo-summary', array(
                    'lang'              => $lang,
                    'languageSelection' => $languageSelection,
                )),
                'noCKEditor'                    => 1,
                'templatePartial'               => self::formTemplate,
            ));

        } catch(\Exception $e) {

            $this->layout()->setVariables(array(
                'messageType'   => 'warning',
                'messageTitle'  => 'Errore verificato',
                'messageText'   => $e->getMessage(),
                'templatePartial' => 'message.phtml',
            ));
        }

        $this->layout()->setTemplate($mainLayout);
    }
}