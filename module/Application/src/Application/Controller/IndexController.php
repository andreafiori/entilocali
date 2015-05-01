<?php

namespace Application\Controller;

use Admin\Model\AlboPretorio\AlboPretorioArticoliGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use Admin\Model\Posts\PostsGetter;
use Admin\Model\Posts\PostsGetterWrapper;
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

        $wrapper = new HomePageRecordsGetterWrapper( new HomePageRecordsGetter($em) );
        $wrapper->setInput( array(
            'onlyActiveModules' => 1,
            'orderBy'           => 'hb.position ASC'
        ));
        $wrapper->setupQueryBuilder();

        $homePageRecords = $wrapper->formatPerModuleCode( $wrapper->getRecords() );

        if (!empty($homePageRecords)) {

            /* Gather RefereceIds per module... */
            $referenceIdContainer = array();
            foreach($homePageRecords as $key => $values) {
                foreach($values as $value) {
                    if ( !empty($value['freeText']) ) {
                        $referenceIdContainer[$key]['freeText'][] = $value['freeText'];
                    }

                    $referenceIdContainer[$key]['referenceId'][] = $value['referenceId'];
                }
            }

            /* Fetch data from each modules using wrappers... */
            $homePageVar = array();
            foreach($referenceIdContainer as $key => $value) {

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
                            $homePageVar[$key][] = array('freeText' => $record[0]);
                        }
                        break;

                    case('blogs'):

                    break;

                    case('photo'):

                    break;

                    case('albo-pretorio'):
                        $wrapper = new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em));
                        $wrapper->setInput(array(
                            'id' => $value['referenceId'],
                        ));
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