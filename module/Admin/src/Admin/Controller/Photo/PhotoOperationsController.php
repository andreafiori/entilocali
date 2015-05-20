<?php

namespace Admin\src\Admin\Controller\Photo;

use Admin\Model\Posts\PostsForm;
use Application\Controller\SetupAbstractController;

class PhotoOperationsController extends SetupAbstractController
{
    public function addAction()
    {
        $this->initializeAdminArea();

        /**
         * @var \Doctrine\ORM\EntityManager $em
         */
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $connection = $em->getConnection();

        $request = $this->getRequest();

        $post = array_merge_recursive( $request->getPost()->toArray(), $request->getFiles()->toArray() );

        /* AJAX or POST request */
        if ($request->isXmlHttpRequest() or $request->isPost()) {

            $form = new PostsForm();
            $form->addUploadImageRequired();
            $form->addMainFields();

            $form->setData($post);

            /* Check if the form is valid. Errors will be displayed on the view: message.phtml */
            if ( $form->isValid() ) {
                throw new \Exception("The submitted form is not valid! Check your data!");
            }

            /* Perform a database operation */
            try {
                $this->layout()->setVariables( array(
                        'messageType'                   => 'info',
                        'messageTitle'                  => 'prova',
                        'messageShowFormLink'           => 1,
                        'showLinkResetFormAndShowIt'    => 1,
                    )
                );

                $connection->update(DbTableContainer::contacts, array(
                    'nonField' => 'value!',
                ),
                    array('id' => 1)
                );

            } catch(\Exception $e) {

                $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');

            }

        } else {
            return $this->redirect()->toRoute('main');
        }

        $this->layout()->setVariables( array(
                'messageType'                   => 'info',
                'messageTitle'                  => 'prova',
                'messageShowFormLink'           => 1,
                'showLinkResetFormAndShowIt'    => 1,
            )
        );

        $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
    }

    public function editAction()
    {
        $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
    }

    public function deleteAction()
    {
        $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
    }
}