<?php

namespace ModelModule\Model\Posts;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\NullException;
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

    public function deleteRelation($id, $moduleId)
    {
        $this->assertConnection();
        $this->getConnection()->query('SET FOREIGN_KEY_CHECKS=0');
        $this->getConnection()->delete(
            DbTableContainer::postsRelations,
            array('posts_id' => $id, 'module_id' => $moduleId),
            array('limit' => 1)
        );
        $this->getConnection()->query('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Update post on database using Doctrine connection
     *
     * @param InputFilterAwareInterface $formData
     * @return int
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        $arrayUpdate = array(
            'title'         => $formData->title,
            'subtitle'      => $formData->subtitle,
            'description'   => $formData->description,
            'slug'          => Slugifier::slugify($formData->title),
            'seo_title'     => $formData->title,
            'last_update'   => date("Y-m-d H:i:s"),
        );

        if (!empty($formData->image)) {
            $arrayUpdate['image'] = $formData->image;
        }

        return $this->getConnection()->update(
            DbTableContainer::posts,
            $arrayUpdate,
            array('id' => $formData->id)
        );
    }

    public function updateImage($id, $imagFileName)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::posts,
            array(
                'image' => $imagFileName,
            ),
            array(
                'id' => $id
            )
        );
    }

    /**
     * Delete post from database
     *
     * @param int $id
     * @param int $moduleId
     *
     * @return bool
     */
    public function delete($id, $moduleId)
    {
        $this->assertConnection();

        $this->getConnection()->query('SET FOREIGN_KEY_CHECKS=0');
        $this->getConnection()->delete(
            DbTableContainer::posts,
            array('id' => $id),
            array('limit' => 1)
        );
        $this->getConnection()->delete(
            DbTableContainer::postsRelations,
            array('posts_id' => $id, 'module_id' => $moduleId),
            array('limit' => 1)
        );
        $this->getConnection()->query('SET FOREIGN_KEY_CHECKS=1');

        return true;
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

    /**
     * @param array $configurations
     * @throws NullException
     */
    public function checkMediaDir(array $configurations)
    {
        if (!isset($configurations['media_dir'])) {
            throw new NullException("La cartella di destinazione delle immagini non esiste o non &egrave; stata configurata");
        }

        if (!file_exists($configurations['media_dir'])) {
            mkdir($configurations['media_dir']);
        }

        return $configurations['media_dir'];
    }

    /**
     * @param array $configurations
     * @return mixed
     * @throws NullException
     */
    public function checkMediaProject(array $configurations)
    {
        $this->checkMediaDir($configurations);

        if (!isset($configurations['media_project'])) {
            throw new NullException("La cartella di destinazione del progetto corrente non esiste o non &egrave; stata configurata");
        }

        if (!file_exists($configurations['media_dir'].$configurations['media_project'])) {
            mkdir($configurations['media_dir'].$configurations['media_project']);
        }

        return $configurations['media_project'];
    }

    /**
     * @param array $configurations
     * @return bool
     */
    public function checkMediaSubDir(array $configurations)
    {
        $this->checkMediaDir($configurations);
        $this->checkMediaProject($configurations);

        $prefixDir = $configurations['media_dir'].$configurations['media_project'];

        $dirToCheck = array(
            $prefixDir.'\blogs\thumbs',
            $prefixDir.'\blogs\big',
            $prefixDir.'\photo\thumbs',
            $prefixDir.'\photo\big'
        );

        foreach($dirToCheck as $directory) {
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
        }

        return true;
    }
}