<?php

namespace Admin\src\Admin\Controller\Blogs;

use Admin\Model\Posts\PostsForm;
use Admin\Model\Posts\PostsFormInputFilter;
use Application\Controller\SetupAbstractController;

class BlogsOperationsController extends SetupAbstractController
{
    /**
     * TODO:
        Image thumb if uploaded:
            check size, check file type,
            create thumb
        add into db
        log
        if error -> rollback and log error
     *
     */
    public function addAction()
    {
        $request = $this->getRequest();

        $post = array_merge_recursive(
            $request->getPost()->toArray(),
            $request->getFiles()->toArray()
        );
    }

    /**
     *
     */
    public function editAction()
    {
        $request = $this->getRequest();

        $post = array_merge_recursive(
            $request->getPost()->toArray(),
            $request->getFiles()->toArray()
        );
    }

    public function deleteAction()
    {
        $request = $this->getRequest();

        $post = array_merge_recursive($request->getPost()->toArray());

        $form = new PostsForm();
        $form->addUploadImage();
        // $form->addCategory( array() );

        if ($request->isPost()) {
            $formValidator = new PostsFormInputFilter();

            $form->setInputFilter($formValidator->getInputFilter());
            $form->setData($post);

            if ($form->isValid()) {
                $formValidator->exchangeArray($form->getData());


            }
        }
    }
}