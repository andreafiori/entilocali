<?php

namespace Admin\Controller\Attachments;

use ModelModule\Model\Attachments\AttachmentsControllerHelper;
use ModelModule\Model\Database\DbTableContainer;
use Application\Controller\SetupAbstractController;

class AttachmentsPositionsUpdateController extends SetupAbstractController
{
    public function indexAction()
    {
        $appServiceLoader = $this->recoverAppServiceLoader();

        $items = $this->params()->fromQuery('oggettoItem');

        /**
         * @var \Doctrine\DBAL\Connection
         */
        $connection = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->getConnection();

        $this->initializeAdminArea();

        $helper = new AttachmentsControllerHelper();
        $helper->setConnection($connection);
        $helper->getConnection()->beginTransaction();

        try {

            if (!empty($items)):
                foreach ($items as $position => $item):
                    $helper->updatePosition($item, $position);
                endforeach;
            endif;

            $helper->getConnection()->commit();

            $this->layout()->setTerminal(true);

            $backendTemplate = $appServiceLoader->recoverServiceKey('configurations', 'template_backend');

            $this->layout('backend/templates/'.$backendTemplate.'sezioni/positions_message.phtml');

        } catch(\Exception $e) {

            try {
                $helper->getConnection()->rollBack();
            } catch(\Doctrine\DBAL\ConnectionException $dbEx) {

            }

            echo $e->getMessage(); exit;
        }

    }
}