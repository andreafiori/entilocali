<?php

namespace Admin\Controller\Blogs;

use Admin\Model\Posts\PostsForm;
use Admin\Model\Posts\PostsGetter;
use Admin\Model\Posts\PostsGetterWrapper;
use Admin\Model\Posts\CategoriesGetter;
use Admin\Model\Posts\CategoriesGetterWrapper;
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

        $form = new PostsForm();
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
            $form->setData($recordFromDb[0]);

            $formTitle          = 'Modifica blog post';
            $formAction         = 'blogs/update/';
            $submitButtonValue  = 'Modifica';
        } else {
            $formTitle          = 'Nuovo blog post';
            $formAction         = 'blogs/insert/';
            $submitButtonValue  = 'Inserisci';
        }

        $this->layout()->setVariables(array(
            'formTitle'                     => $formTitle,
            'formDescription'               => 'Compila dati post',
            'form'                          => $form,
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