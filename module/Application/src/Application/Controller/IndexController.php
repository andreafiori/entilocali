<?php

namespace Application\Controller;

use Admin\Model\AlboPretorio\AlboPretorioArticoliGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use Application\Model\HomePage\HomePageHelper;
use Application\Model\HomePage\HomePageRecordsGetter;
use Application\Model\HomePage\HomePageRecordsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  16 April 2015
 */
class IndexController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $helper = new HomePageHelper();
        $helper->setHomePageRecordsGetterWrapper(
            new HomePageRecordsGetterWrapper(new HomePageRecordsGetter($em))
        );
        $helper->setupHomePageRecords( array('onlyActiveModules' => 1, 'orderBy' => 'hb.position ASC') );
        $helper->gatherReferenceIds();

        $homePageRecords = $helper->getHomePageRecords();
        if (!empty($homePageRecords)) {

            $homePageVar = array();
            foreach($homePageRecords as $key => $value) {

                switch($key) {

                    case('contenuti'):
                        /*
                        $wrapper = new PostsGetterWrapper( new PostsGetter($em) );
                        $wrapper->setInput( array('id' => $value['referenceId']) );
                        $wrapper->setupQueryBuilder();
                        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
                        $wrapper->setupPaginatorCurrentPage(1);
                        $wrapper->setupPaginatorItemsPerPage(35);

                        $homePageVar[$key] = $wrapper->setupRecords();
                        */
                    break;

                    case('freeText'):
                        foreach($value as $record) {
                            if (!empty($record['freeText'])) {
                                $homePageVar[$key][] = array('freeText' => $record['freeText']);
                            }
                        }
                    break;

                    case('blogs'):
                        // $wrapper = new PostsGetterWrapper( new PostsGetter($em) );
                    break;

                    case('photo'):

                    break;

                    case('albo-pretorio'):
                        $wrapper = new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em));
                        $wrapper->setInput( array('id' => $value['referenceIds']) );
                        $wrapper->setupQueryBuilder();
                        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
                        $wrapper->setupPaginatorCurrentPage(1);
                        $wrapper->setupPaginatorItemsPerPage(35);

                        $homePageVar[$key] = $wrapper->setupRecords();
                    break;

                    case('stato-civile'):

                    break;

                    case('amministrazione-trasparente'):

                    break;
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