<?php

namespace ModelModule\Model\Posts;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\NullException;
use ModelModule\Model\Slugifier;
use Zend\InputFilter\InputFilterAwareInterface;

class PostsCategoriesControllerHelper extends ControllerHelperAbstract
{
    /**
     * @param InputFilterAwareInterface $formData
     * @return int
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        $slug = Slugifier::slugify($formData->name);

        return $this->getConnection()->insert(
            DbTableContainer::postsCategories,
            array(
                'name'              => $formData->name,
                'description'       => $formData->description,
                'create_date'       => date("Y-m-d H:i:s"),
                'expire_date'       => date("Y-m-d H:i:s"),
                'parent_id'         => 0,
                'module_id'         => $formData->moduleId,
                'language_id'       => $formData->languageId,
                'slug'              => $slug,
                'seo_url'           => $slug,
                'seo_title'         => $formData->name,
                // 'seo_keywords'      => $formData->seoKeywords,
                // 'seo_description'   => $formData->seoDescription,
                'accesskey'         => '',
                'template_file'     => '',
                'position'          => isset($formData->position) ? $formData->position : 1,
            )
        );
    }

    /**
     * @param InputFilterAwareInterface $formData
     * @return int
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::postsCategories,
            array(
                'name'          => $formData->name,
                'description'   => $formData->description,
            ),
            array('id' => $formData->id)
        );
    }

    /**
     * @param InputFilterAwareInterface $formData
     */
    public function delete(InputFilterAwareInterface $formData)
    {
        // TODO: delete category, delete association, delete posts, delete attachment files and images...
    }

    /**
     * @param string $moduleCode
     * @return string
     * @throws NullException
     */
    public function recoverLabelByModuleCode($moduleCode)
    {
        switch($moduleCode) {
            case("blogs"): return "Blogs";
            case("photo"): return "Foto";
            case("contents"): return "Contenuti";
            case("videos"): return "Videos";
        }

        throw new NullException('The modulecode submitted does not match with a valid module label');
    }

    /**
     * @param string $moduleCode
     * @return string
     */
    public function recoverRouteByModuleCode($moduleCode)
    {
        switch($moduleCode) {
            case("blogs"): return "admin/blogs-summary";
            case("photo"): return "admin/photo-summary";
            case("contents"): return "admin/contents-summary";
            case("videos"): return "admin/videos-summary";
        }

        throw new NullException('The modulecode submitted does not match with a valid route name');
    }
}