<?php

namespace Admin\Controller\Log;

use Application\Controller\SetupAbstractController;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\Log\LogControllerHelper;

class LogOperationsController extends SetupAbstractController
{
    /**
     * Delete all logs and redirect to summary
     */
    public function deleteallAction()
    {
        if ($this->getRequest()->isPost()) {

            /**
             * @var \Doctrine\ORM\EntityManager $em
             */
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            /**
             * @var \Doctrine\DBAL\Connection $connection
             */
            $connection = $em->getConnection();

            $helper = new LogControllerHelper();
            $helper->setConnection($connection);

            try {
                $helper->getConnection()->beginTransaction();
                $helper->deleteAll();
                $helper->getConnection()->commit();

                if (is_object($this->getRequest()->getHeader('Referer'))) {
                    return $this->redirect()->toUrl( $this->getRequest()->getHeader('Referer')->getUri() );
                }

            } catch (\Exception $e) {
                try {
                    $helper->getConnection()->rollBack();
                } catch(\Doctrine\DBAL\ConnectionException $exDb) {

                }
            }
        }

        return $this->redirectForUnvalidAccess();
    }

    public function deletesingleAction()
    {
        $helper = new LogControllerHelper();

        if (is_object($this->getRequest()->getHeader('Referer'))) {
            return $this->redirect()->toUrl( $this->getRequest()->getHeader('Referer')->getUri() );
        }

        return $this->redirectForUnvalidAccess();
    }
}