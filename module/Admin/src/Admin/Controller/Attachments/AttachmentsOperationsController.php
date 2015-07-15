<?php

namespace Admin\Controller\Attachments;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Attachments\AttachmentsControllerHelper;
use ModelModule\Model\AttiConcessione\AttiConcessioneColumnDisplayForm;
use ModelModule\Model\AttiConcessione\AttiConcessioneColumnDisplayFormInputFilter;

/**
 * Attachments Operations Controller
 */
class AttachmentsOperationsController extends SetupAbstractController
{
    public function updatecolumnattachmentAction()
    {
        $request = $this->getRequest();

        $post = array_merge_recursive( $request->getPost()->toArray(), $request->getFiles()->toArray() );

        if ( $request->isPost() ) {

            /**
             * @var \Doctrine\ORM\EntityManager $em
             */
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            /**
             * @var \Doctrine\DBAL\Connection $connection
             */
            $connection = $em->getConnection();

            $inputFilter = new AttiConcessioneColumnDisplayFormInputFilter();

            $form = new AttiConcessioneColumnDisplayForm();
            $form->addSubmitButton();
            $form->setInputFilter( $inputFilter->getInputFilter() );
            $form->setData($post);

            if ($form->isValid()) {
                $inputFilter->exchangeArray( $form->getData() );

                $helper = new AttachmentsControllerHelper();
                $helper->setConnection($connection);
                $helper->getConnection()->beginTransaction();
                $helper->updateAttiConcessioneColonna($post['id'], $post['attiConcessioneColonna']);
                $helper->getConnection()->commit();
            }

            if (is_object($this->getRequest()->getHeader('Referer'))) {
                return $this->redirect()->toUrl( $this->getRequest()->getHeader('Referer')->getUri() );
            }

            return $this->redirectForUnvalidAccess();
        }
    }
}
