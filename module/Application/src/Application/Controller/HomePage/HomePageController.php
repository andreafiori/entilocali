<?php

namespace Application\Controller\HomePage;

use Admin\Model\Posts\PostsGetter;
use Admin\Model\Posts\PostsGetterWrapper;
use Application\Controller\SetupAbstractController;
use Application\Model\HomePage\HomePageRecordsGetter;
use Application\Model\HomePage\HomePageRecordsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  16 April 2015
 */
class HomePageController extends SetupAbstractController
{
    const maximumElementOnList = 35;

    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $homePageRecordsGetterWrapper = new HomePageRecordsGetterWrapper( new HomePageRecordsGetter($em) );
        $homePageRecordsGetterWrapper->setInput( array('orderBy' => 'hb.position, h.position') );
        $homePageRecordsGetterWrapper->setupQueryBuilder();

        $homePageRecords = $homePageRecordsGetterWrapper->getRecords();

        if ($homePageRecords) {

            $homePageVar = array();
            foreach($homePageRecords as $key => $value) {
                switch($key) {
                    case(1):
                        $postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($this->getInput('entityManager',1)) );
                        $postsGetterWrapper->setInput( array('id' => $this->gatherReferenceIDs($value)) );
                        $postsGetterWrapper->setupQueryBuilder();
                        $postsGetterWrapper->setupPaginator( $postsGetterWrapper->setupQuery( $this->getInput('entityManager', 1) ) );
                        $postsGetterWrapper->setupPaginatorCurrentPage(1);
                        $postsGetterWrapper->setupPaginatorItemsPerPage(self::maximumElementOnList);

                        $homePageVar['blogs'][] = $postsGetterWrapper->setupRecords();
                    break;

                    case(4): //
                        $postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($this->getInput('entityManager',1)) );
                        $postsGetterWrapper->setInput( array('id' => $this->gatherReferenceIDs($value)) );
                        $postsGetterWrapper->setupQueryBuilder();
                        $postsGetterWrapper->setupPaginator( $postsGetterWrapper->setupQuery( $this->getInput('entityManager', 1) ) );
                        $postsGetterWrapper->setupPaginatorCurrentPage(1);
                        $postsGetterWrapper->setupPaginatorItemsPerPage(self::maximumElementOnList);

                        $homePageVar['contents'][] = $postsGetterWrapper->setupRecords();
                    break;

                    case(6): // Photo


                    break;

                    case(2):
                        $homePageVar['freetext'][] = array('freeText' => $value[0]['freeText']);

                    break;

                    // Albo pretorio

                    // Stato civile

                    // Amministrazione trasparente

                }
            }
        }
        
        $this->layout()->setVariables(array(
            'homepage'          => !empty($homePageVar) ? $homePageVar : null,
            'templatePartial'   => 'homepage/homepage.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}