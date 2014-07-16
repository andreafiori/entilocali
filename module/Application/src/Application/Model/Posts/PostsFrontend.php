<?php

namespace Application\Model\Posts;

use Application\Model\RouterManagers\RouterManagerInterface;
use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\Posts\PostsFrontendHelper;
use Application\Model\HomePage\HomePageRecordsGetter;
use Application\Model\HomePage\HomePageRecordsGetterWrapper;

/**
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
        $this->postsFrontendHelper = new PostsFrontendHelper($this->getInput());

        if ( $this->postsFrontendHelper->isHomePage() ) {
            return $this->setupHomePage();
        }
        
        $this->setRecords($this->postsFrontendHelper->setRecords());
        $this->setTemplate($this->postsFrontendHelper->getTemplate());

        $setup = $this->getOutput();

        return $setup;
    }
    
        /**
         * TODO: refactor for this home page setup:
         *      map array object will have: array( moduleId => object to get keyRecord => ArrayRecords )
         * 
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
