<?php

namespace Application\Controller;

use Admin\Model\AlboPretorio\AlboPretorioArticoliGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use Application\Model\HomePage\HomePageHelper;
use Application\Model\HomePage\HomePageRecordsGetter;
use Application\Model\HomePage\HomePageRecordsGetterWrapper;
use Application\Model\NullException;

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

        try {
            $helper = new HomePageHelper();
            $helper->setHomePageRecordsGetterWrapper( new HomePageRecordsGetterWrapper(new HomePageRecordsGetter($em)) );
            $helper->setupHomePageRecords( array(
                'onlyActiveModules' => 1,
                'orderBy'           => 'hb.position ASC',
            ));
            $helper->gatherReferenceIds();
            $helper->checkHomePageRecords();

            $homePageRecords = $helper->getHomePageRecords();

            $sortedHomePageRecords = array();
            foreach($homePageRecords as $key => $values) {
                foreach($values as $value) {
                    if (isset($value['position'])) {
                        $sortedHomePageRecords[$key][$value['position']] = $value;
                    }
                }

                $sortedHomePageRecords[$key]['referenceIds'] = $values['referenceIds'];
            }

            $homePageVar = array();
            foreach($sortedHomePageRecords as $key => $value) {

                switch($key) {

                    case('contenuti'):
                        $wrapper = new PostsGetterWrapper( new PostsGetter($em) );
                        $wrapper->setInput( array('id' => $value['referenceId']) );
                        $wrapper->setupQueryBuilder();
                        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
                        $wrapper->setupPaginatorCurrentPage(1);
                        $wrapper->setupPaginatorItemsPerPage(35);

                        $homePageVar[$key] = $wrapper->setupRecords();
                        break;

                    case('freeText'):
                        foreach($value as $record) {
                            if (!empty($record['freeText'])) {
                                $homePageVar[$key][] = array('freeText' => $record['freeText']);
                            }
                        }
                        break;

                    case('blogs'):
                        $wrapper = new PostsGetterWrapper( new PostsGetter($em) );
                    break;

                    case('photo'):

                        break;

                    case('albo-pretorio'):
                        $wrapper = new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em));
                        $wrapper->setInput( array('id' => $value['referenceIds'], 'orderBy' => 'alboArticoli.id') );
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

        } catch(NullException $e) {

        }

        $this->layout()->setVariables(array(
            'homepage'          => !empty($homePageVar) ? $homePageVar : null,
            'templatePartial'   => 'homepage/homepage.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }
}