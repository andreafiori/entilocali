<?php

namespace Application\Model\Posts;

use Application\Model\RouterManagers\RouterManagerInterface;
use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\HomePage\HomePageRecordsGetter;
use Application\Model\HomePage\HomePageRecordsGetterWrapper;
use Admin\Model\Posts\PostsGetterWrapper;
use Admin\Model\Posts\PostsGetter;
use Application\Model\Slugifier;

/**
 * TODO: refactor for this home page setup:
         map array object will have: array( moduleId => object to get keyRecord => ArrayRecords )

 * @author Andrea Fiori
 * @since  05 May 2014
 */
class PostsFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    /** @var \Admin\Model\Posts\PostsGetterWrapper **/
    private $postsGetterWrapper;
    
    /** @var \Application\Model\Posts\PostsFrontendHelper **/
    private $postsFrontendHelper;

    /**
     * @return array
     * @throws \Application\Model\NullException
     */
    public function setupRecord()
    {
        $category = $this->getInput('category', 1);
        $title = $this->getInput('title', 1);
        
        if ( !$category and !$title ) {
            return $this->setupHomePage();
        }
        
        $param = $this->getInput('param', 1);
        
        $postsGetterWrapper = new PostsGetterWrapper(new PostsGetter($this->getInput('entityManager', 1)));
        $postsGetterWrapper->setInput($this->getInput());
        $postsGetterWrapper->setupQueryBuilder(); 
        $postsGetterWrapper->setupPaginator( $postsGetterWrapper->setupQuery() );
        $postsGetterWrapper->setupPaginatorCurrentPage( isset($param['route']['page']) ? $param['route']['page'] : null );
        
        $records = $postsGetterWrapper->setupRecords();
        
        $this->setVariable('paginator', $records);
        $this->setVariable('category', $postsGetterWrapper->getCategory() );
        $this->setVariable('category_seo', Slugifier::slugify($postsGetterWrapper->getCategory()) );
        $this->setVariable('title', $postsGetterWrapper->getTitle() );
        $this->setVariable('title_seo', Slugifier::slugify($postsGetterWrapper->getTitle()) );
        
        $this->setRecords($records);
        $this->setTemplate($postsGetterWrapper->getTemplate());

        return $this->getOutput();
    }
        /**
         * @return type
         */
        private function setupHomePage()
        {
            $this->setTemplate(self::defaultFrontendTemplate);

            $homePageRecordsGetterWrapper = new HomePageRecordsGetterWrapper(new HomePageRecordsGetter($this->getInput('entityManager',1)));
            $homePageRecordsGetterWrapper->setInput( array('orderBy' => 'hb.position, h.position') );
            $homePageRecordsGetterWrapper->setupQueryBuilder();
            
            $homePageRecords = $homePageRecordsGetterWrapper->getRecords();
            
            if ($homePageRecords) {
                $homePageVar = array();
                foreach($homePageRecords as $key => $value) {
                    switch($key) {
                        case(1):
                            $postsGetterWrapper = new \Admin\Model\Posts\PostsGetterWrapper( new \Admin\Model\Posts\PostsGetter($this->getInput('entityManager',1)) );
                            $postsGetterWrapper->setInput( array('id' => $this->gatherReferenceIDs($value)) );
                            $postsGetterWrapper->setupQueryBuilder();
                            
                            $homePageVar['blogs'][] = $postsGetterWrapper->getRecords();
                        break;

                        case(4):
                            $postsGetterWrapper = new \Admin\Model\Posts\PostsGetterWrapper( new \Admin\Model\Posts\PostsGetter($this->getInput('entityManager',1)) );
                            $postsGetterWrapper->setInput( array('id' => $this->gatherReferenceIDs($value)) );
                            $postsGetterWrapper->setupQueryBuilder();
                            
                            $homePageVar['contents'][] = $postsGetterWrapper->getRecords();
                        break;

                        case(6):
                            // photo
                        break;
                        
                        case(2):
                            $homePageVar['freetext'][] = array( 'freeText' => $value[0]['freeText'] );
                        break;
                    }
                    $this->setVariable('homepage', $homePageVar);
                }
            }
            
            return $this->getOutput();
        }
        
        /**
         * @param array $records
         */
        private function gatherReferenceIDs(array $records)
        {
            $ids = array();
            foreach($records as $record) {
                $ids[] = $record['referenceId'];
            }
            
            return $ids;
        }
}
