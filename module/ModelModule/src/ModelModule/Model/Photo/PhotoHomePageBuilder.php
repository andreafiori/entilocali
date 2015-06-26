<?php

namespace ModelModule\Model\Photo;

use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;
use ModelModule\Model\HomePage\HomePageBuilderAbstract;

class PhotoHomePageBuilder extends HomePageBuilderAbstract
{
    public function recoverHomePageElements()
    {
        $this->assertEntityManager();
        $this->assertModuleRelatedRecords();

        $em = $this->getEntityManager();

        $value = $this->getModuleRelatedRecords();

        /**
         * @var PostsGetterWrapper $wrapper
         */
        $wrapper = $this->recoverWrapper(
            new PostsGetterWrapper(new PostsGetter($em)),
            array(
                'id'     => $value['referenceIds'],
                'fields' => 'DISTINCT(p.id) AS id, p.image, p.title, p.description '
            ),
            $this->currentPaginatorPage,
            $this->maxPaginatorItemsPerPage
        );
        $recordsWithAttachments = $wrapper->getRecords();

        if (!empty($recordsWithAttachments)) {
            foreach($recordsWithAttachments as &$postsRecord) {
                $wrapper = new PostsGetterWrapper(new PostsGetter($em));
                $wrapper->setInput(array(
                    'fields'     => 'c.id, c.name',
                    'id'         => $postsRecord['id'],
                    'orderBy'    => 'c.name',
                ));
                $wrapper->setupQueryBuilder();

                $postsRecord['categories'] = $wrapper->getRecords();
            }
        }

        return $recordsWithAttachments;
    }
}