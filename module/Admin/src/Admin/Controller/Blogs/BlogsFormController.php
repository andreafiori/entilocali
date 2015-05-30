<?php

namespace Admin\Controller\Blogs;

use ModelModule\Model\Modules\ModulesContainer;
use ModelModule\Model\Posts\PostsForm;
use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;
use ModelModule\Model\Posts\CategoriesGetter;
use ModelModule\Model\Posts\CategoriesGetterWrapper;
use Application\Controller\SetupAbstractController;

/**
 * @author Andrea Fiori
 * @since  12 April 2015
 */
class BlogsFormController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $id = $this->params()->fromRoute('id');
        if ($id) {
            $wrapper = new PostsGetterWrapper( new PostsGetter($entityManager) );
            $wrapper->setInput(array(
                'id'    => $id,
                'limit' => 1,
            ));
            $wrapper->setupQueryBuilder();
            $recordFromDb = $wrapper->getRecords();
        }

        $wrapper = new CategoriesGetterWrapper(new CategoriesGetter($entityManager));
        $wrapper->setInput(array(
            'fields'        => 'category.id, category.name',
            'orderBy'       => 'category.name',
            'moduleCode'    => 'blogs',
        ));
        $wrapper->setupQueryBuilder();
        $categoriesRecords = $wrapper->getRecords();

        $selectArray = array();
        foreach($categoriesRecords as $categoriesRecord) {
            $selectArray[$categoriesRecord['id']] = $categoriesRecord['name'];
        }

        $formBasicInput = array(
            'type' => 'blogs',
            'moduleId' => ModulesContainer::blogs,
        );

        $form = new PostsForm();
        $form->addUploadImage();
        $form->addMainFields();
        $form->addCategory($selectArray);

        if (!empty($recordFromDb)) {

            $wrapper = new PostsGetterWrapper( new PostsGetter($entityManager) );
            $wrapper->setInput( array(
                    'fields'     => 'c.id, c.name',
                    'id'         => $recordFromDb[0]['id'],
                    'orderBy'    => 'c.name',
                )
            );
            $wrapper->setupQueryBuilder();

            $categoryRecords = $wrapper->getRecords();

            $categoryIdForForm = array();
            foreach($categoryRecords as $categoryRecord) {
                $categoryIdForForm[] = $categoryRecord['id'];
            }

            $recordFromDb[0]['categories'] = $categoryIdForForm;

            $form->setData( array_merge($formBasicInput, $recordFromDb[0]) );

            $formTitle          = 'Modifica blog post';
            $formAction         = 'blogs/update/';
            $submitButtonValue  = 'Modifica';
        } else {
            $formTitle          = 'Nuovo blog post';
            $formAction         = 'blogs/insert/';
            $submitButtonValue  = 'Inserisci';

            $form->setData( array_merge($formBasicInput, array('expireDate' => date('Y-m-d H:i:s', strtotime('+5 years')) )));
        }

        $this->layout()->setVariables(array(
            'form'                          => $form,
            'formTitle'                     => $formTitle,
            'formDescription'               => 'Compila dati blog post',
            'formAction'                    => $formAction,
            'submitButtonValue'             => $submitButtonValue,
            'CKEditorField'                 => 'description',
            'formBreadCrumbCategory'        => 'Blogs',
            'formBreadCrumbCategoryLink'    => $this->url()->fromRoute('admin/blogs-summary', array('lang' => 'it')),
            'templatePartial'                => self::formTemplate,
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}