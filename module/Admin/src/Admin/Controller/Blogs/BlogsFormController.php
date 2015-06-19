<?php

namespace Admin\Controller\Blogs;

use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Posts\PostsControllerHelper;
use ModelModule\Model\Posts\PostsForm;
use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;
use ModelModule\Model\Posts\PostsCategoriesGetter;
use ModelModule\Model\Posts\PostsCategoriesGetterWrapper;
use Application\Controller\SetupAbstractController;

class BlogsFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $lang               = $this->params()->fromRoute('lang');
        $languageSelection  = $this->params()->fromRoute('languageSelection');
        $id                 = $this->params()->fromRoute('id');

        $configurations = $this->layout()->getVariable('configurations');

        try {

            $helper = new PostsControllerHelper();
            $helper->checkMediaDir($configurations);
            $helper->checkMediaProject($configurations);
            $helper->checkMediaSubDir($configurations);

            $categoriesRecords = $helper->recoverWrapperRecords(
                new PostsCategoriesGetterWrapper(new PostsCategoriesGetter($entityManager)),
                array(
                    'fields'        => 'category.id, category.name',
                    'orderBy'       => 'category.name',
                    'moduleCode'    => 'blogs',
                )
            );
            $helper->checkRecords($categoriesRecords, 'Nessuna categorie non presente. Inserire almeno una categoria');
            $categoriesRecordsForDropDown = $helper->formatForDropwdown($categoriesRecords ,'id', 'name');
            $postsRecords = $helper->recoverWrapperRecordsById(
                $wrapper = new PostsGetterWrapper(new PostsGetter($entityManager)),
                array(
                    'id'    => $id,
                    'limit' => 1,
                ),
                $id
            );

            $form = new PostsForm();
            $form->addUploadImage();
            $form->addTitle();
            $form->addSubtitle();
            $form->addMainFields();
            $form->addCategory($categoriesRecordsForDropDown);
            /* Additional fields:
            $form->addSeo();
            $form->addHome();
            $form->addFacebook();
            */

            if (!empty($postsRecords)) {

                $categoryIdForForm = $helper->gatherCategoriesId(
                    new PostsGetterWrapper(new PostsGetter($entityManager)),
                    array(
                        'fields'     => 'c.id, c.name',
                        'id'         => $postsRecords[0]['id'],
                        'orderBy'    => 'c.name',
                    )
                );

                $postsRecords[0]['currentImage'] = isset($postsRecords[0]['image']) ? $postsRecords[0]['image'] : null;
                $postsRecords[0]['categories'] = $categoryIdForForm;

                $form->setData($postsRecords[0]);

                $formTitle          = 'Modifica blog post';
                $formAction         = $this->url()->fromRoute('admin/blogs-update', array(
                    'lang'              => $lang,
                    'languageSelection' => $languageSelection,
                ));
                $submitButtonValue  = 'Modifica';
            } else {
                $formTitle          = 'Nuovo blog post';
                $formAction         = $this->url()->fromRoute('admin/blogs-insert', array(
                    'lang'              => $lang,
                    'languageSelection' => $languageSelection,
                ));
                $submitButtonValue  = 'Inserisci';

                $form->setData(array(
                    'expireDate'    => date('Y-m-d H:i:s', strtotime('+5 years')),
                    'status'        => 1,
                ));
            }

            $this->layout()->setVariables(array(
                'form'                          => $form,
                'formTitle'                     => $formTitle,
                'formDescription'               => 'Compila dati blog post',
                'formAction'                    => $formAction,
                'submitButtonValue'             => $submitButtonValue,
                'CKEditorField'                 => 'description',
                'formBreadCrumbCategory'        => 'Blogs',
                'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/blogs-summary', array(
                    'lang'              => $this->params()->fromRoute('lang'),
                    'languageSelection' => $this->params()->fromRoute('languageSelection'),
                )),
                'templatePartial'                => self::formTemplate,
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