<?php

namespace Admin\Controller;

use Application\Controller\SetupAbstractController;
use Application\Model\Contacts\ContactsForm;
use Application\Model\Database\DbTableContainer;

class FormAjaxTrialController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $form = new ContactsForm();

        $this->layout()->setVariables(array(
            'form' => $form,
            'formAction'            => $this->url()->fromRoute('admin/ajax-pform-trial', array('lang' => 'it', 'action' => 'add')),
            'formTitle'             => 'Ajax form trial',
            'formDescription'       => 'PROVA di utilizzo form per post verso un altra action di un controller',
            'noFormActionPrefix'    => 1,
            'templatePartial'       => self::formTemplate,
        ));

        $this->layout()->setTemplate($mainLayout);
    }

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

            $form = new ContactsForm();
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

        $this->layout()->setTemplate($this->layout()->getVariable('templateDir').'message.phtml');
    }
}