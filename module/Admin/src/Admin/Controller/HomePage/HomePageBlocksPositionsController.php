<?php

namespace Admin\Controller\HomePage;

use Admin\Model\HomePage\HomePageBlocksGetter;
use Admin\Model\HomePage\HomePageBlocksGetterWrapper;
use Admin\Model\HomePage\HomePageControllerHelper;
use Application\Controller\SetupAbstractController;
use Application\Model\Database\DbTableContainer;

class HomePageBlocksPositionsController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new HomePageControllerHelper();
        $helper->setHomePageBlocksGetterWrapper(new HomePageBlocksGetterWrapper(new HomePageBlocksGetter($em)));
        $helper->setupHomePageBlocksRecords(array(
            'orderBy' => 'homePageBlocks.position',
            'fields'  => ''
        ));

        $this->layout()->setVariables(array(
            'records'           => $helper->getHomePageBlocksRecords(),
            'templatePartial'   => 'homepage/homepage-blocks-positions.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    public function updateAction()
    {

        $appServiceLoader = $this->recoverAppServiceLoader();

        $items = $this->params()->fromQuery('oggettoItem');

        $connection = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->getConnection();

        if (!empty($items)):
            foreach ($items as $position => $item):
//echo "$item => $position <br>";
                $connection->update(
                    DbTableContainer::homepageBlocks,
                    array('position' => $position),
                    array('id' => $item)
                );

            endforeach;
        endif;


        $this->layout()->setTerminal(true);

        $this->layout('backend/templates/'.$appServiceLoader->recoverServiceKey('configurations', 'template_backend').'sezioni/positions_message.phtml');
    }
}