<?php

namespace ModelModule\Model\Posts;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\Slugifier;
use Zend\InputFilter\InputFilterAwareInterface;

class PostsControllerHelper extends ControllerHelperAbstract
{
    /**
     * @param InputFilterAwareInterface $formData
     * @param $languageId
     * @return int
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();
        $this->assertLoggedUser();

        $userDetails = $this->getLoggedUser();

        return $this->getConnection()->insert(
            DbTableContainer::posts,
            array(
                'title'             => $formData->title,
                'subtitle'          => $formData->subtitle,
                'description'       => $formData->description,
                'status'            => empty($formData->status) ? 1 : $formData->status,
                'slug'              => Slugifier::slugify($formData->title),
                'seo_title'         => $formData->title,
                'seo_description'   => $formData->seoDescription,
                'seo_keywords'      => $formData->seoKeywords,
                'language_id'       => $formData->languageId,
                'note'              => null,
                'create_date'       => date("Y-m-d H:i:s"),
                'expire_date'       => isset($formData->expireDate) ? $formData->expireDate : date("2030-m-d H:i:s"),
                'last_update'       => date("Y-m-d H:i:s"),
                'user_id'           => $userDetails->id,
            )
        );
    }

    /**
     * @param InputFilterAwareInterface $formData
     * @param $lastInserId
     * @param $categoryId
     */
    public function insertRelation(InputFilterAwareInterface $formData, $lastInserId, $categoryId)
    {
        $this->assertConnection();

        $this->getConnection()->insert(DbTableContainer::postsRelations, array(
            'posts_id'      => $lastInserId,
            'category_id'   => $categoryId,
            'module_id'     => $formData->moduleId,
            'channel_id'    => 1,
        ));
    }

    /**
     * @param InputFilterAwareInterface $formData
     * @return int
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::posts,
            array(
                'title'         => $formData->title,
                'subtitle'      => $formData->subtitle,
                'description'   => $formData->description,
                'slug'          => Slugifier::slugify($formData->title),
                'last_update'   => date("Y-m-d H:i:s"),
            ),
            array(
                'id' => $formData->id
            )
        );
    }

    public function delete($id)
    {
        // TODO: delete image if uploaded, delete post, delete relation
    }


    public function deleteRelation($postsId)
    {
        
    }

    /**
     * @param PostsGetterWrapper $wrapper
     * @param $input
     * @return array
     */
    public function gatherCategoriesId(PostsGetterWrapper $wrapper, $input)
    {
        $categoriesRecords = $this->recoverWrapperRecords($wrapper, $input);

        $categoryIds = array();
        foreach($categoriesRecords as $categoryRecord) {
            $categoryIds[] = $categoryRecord['id'];
        }

        return $categoryIds;
    }
}