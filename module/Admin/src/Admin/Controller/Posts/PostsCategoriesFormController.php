<?php

namespace Admin\Controller\Posts;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Posts\PostsCategoriesForm;
use ModelModule\Model\Posts\PostsCategoriesGetter;
use ModelModule\Model\Posts\PostsCategoriesGetterWrapper;
use ModelModule\Model\Posts\PostsControllerHelper;

class PostsCategoriesFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');
        $lang = $this->params()->fromRoute('lang');
        $languageSelection = $this->params()->fromRoute('languageSelection');
        $formtype = $this->params()->fromRoute('formtype');

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new PostsControllerHelper();
        $recordFromDb = $helper->recoverWrapperRecordsById(
            new PostsCategoriesGetterWrapper(new PostsCategoriesGetter($em)),
            array('id' => $id, 'limit' => 1),
            $id
        );

        $form = new PostsCategoriesForm();

        if (!empty($recordFromDb)) {
            $form->setData($recordFromDb[0]);

            $submitButtonValue = 'Modifica';
            $formTitle = $recordFromDb[0]['name'];
            $formAction = $this->url()->fromRoute('admin/posts-categories-update', array(
                'lang'              => $lang,
                'languageSelection' => $languageSelection,
                'formtype'          => $formtype,
            ));
        } else {
            $form->setData(array(
                'posizione'         => 1,
                'lingua'            => 1,
                'isAmmTrasparente'  => ($formtype!='contenuti') ? 1 : 0,
            ));

            $formTitle = 'Nuova categoria';
            $submitButtonValue = 'Inserisci';
            $formAction = $this->url()->fromRoute('admin/posts-categories-insert', array(
                'lang'              => $lang,
                'languageSelection' => $languageSelection,
                'formtype'          => $formtype,
            ));
        }

        $this->layout()->setVariables(array(
            'form'                          => $form,
            'formAction'                    => $formAction,
            'formTitle'                     => $formTitle,
            'formDescription'               => 'Compila i dati relativi alla categoria',
            'submitButtonValue'             => $submitButtonValue,
            'formBreadCrumbCategory'        => array(
                array(
                    'href' => $this->url()->fromRoute('admin/posts-categories-summary', array(
                                    'lang'              => $lang,
                                    'moduleCode'        => 'blogs',
                                    'languageSelection' => $languageSelection
                                )
                            ),
                    'label' => ($formtype=='blogs') ? ucfirst($formtype) : 'Foto',
                    'title' => 'Elenco '.$formtype,
                ),
                array(
                    'href' => $this->url()->fromRoute('admin/posts-categories-summary', array(
                        'lang'              => $lang,
                        'languageSelection' => $languageSelection,
                        'moduleCode'        => $formtype,
                    )),
                    'label' => 'Categorie',
                    'title' => 'Categorie ',
                ),
            ),
            'templatePartial'               => self::formTemplate,
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}