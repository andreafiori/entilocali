<?php

namespace Admin\Model\Posts;

use Admin\Model\FormData\CrudHandlerAbstract;
use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\FormData\CrudHandlerInsertUpdateInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Application\Model\Database\DbTableContainer;
use Application\Model\Slugifier;

/**
 * @author Andrea Fiori
 * @since  01 June 2014
 */
class PostsCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface, CrudHandlerInsertUpdateInterface
{
    protected $validInputFilterObject;

    public function __construct()
    {
        $this->form = new PostsForm();

        $this->formInputFilter = new PostsFormInputFilter();
    }

    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return array
     */
    public function validateFormData(InputFilterAwareInterface $formData)
    {
        $error = array();

        $fields = array('title', 'description', 'categories');
        foreach($fields as $field) {
            if ( empty($formData->$field) ) {
                $error[] = 'Campo '.$field.' vuoto';
            }
        }

        return $error;
    }

    /**
     * @param PostsFormInputFilter $formData
     *
     * @return bool
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->asssertConnection();

        $userDetails = $this->getUserDetails();

        $this->getConnection()->insert(DbTableContainer::posts, array(
            'title'             => $formData->title,
            'subtitle'          => $formData->subtitle,
            'description'       => $formData->description,
            'status'            => empty($formData->status) ? 1 : $formData->status,
            'slug'              => Slugifier::slugify($formData->title),
            'seo_title'         => $formData->title,
            'seo_description'   => $formData->seoDescription,
            'seo_keywords'      => $formData->seoKeywords,
            'language_id'       => 1,
            'note'              => Slugifier::slugify($formData->title),
            'create_date'       => date("Y-m-d H:i:s"),
            'expire_date'       => isset($formData->expireDate) ? $formData->expireDate : date("2030-m-d H:i:s"),
            'last_update'       => date("Y-m-d H:i:s"),
            'user_id'           => $userDetails->id,
        ));

        $postsLastInsertId = $this->getConnection()->lastInsertId();

        if ( is_array($formData->categories) ) {
            foreach ($formData->categories as $category) {
                $this->getConnection()->insert(DbTableContainer::postsRelations, array(
                    'posts_id'      => $postsLastInsertId,
                    'category_id'   => $category,
                    'module_id'     => $formData->moduleId,
                    'channel_id'    => 1,
                ));
            }
        }

        return true;
    }

    /**
     * @param PostsFormInputFilter $formData
     * @return int
     * @throws \Application\Model\NullException
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->asssertConnection();

        return $this->getConnection()->update(DbTableContainer::posts, array(
                'title'         => $formData->title,
                'subtitle'      => $formData->subtitle,
                'description'   => $formData->description,
                'last_update'   => date("Y-m-d H:i:s"),
                'slug'          => Slugifier::slugify($formData->title),
            ),
            array('id' => $formData->postoptionid)
        );
    }

    /**
     * @param $id
     * @return int
     * @throws \Application\Model\NullException
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     */
    public function delete($id)
    {
        $this->asssertConnection();

        return $this->getConnection()->delete(DbTableContainer::posts,
            array('id' => $id),
            array('limit' => 1)
        );
    }

    /**
     * @return bool
     * @throws \Application\Model\NullException
     */
    public function logInsertOk()
    {
        $this->assertUserDetails();

        $this->assertLogWriter();

        $userDetails = $this->getUserDetails();

        $logsWriter = $this->getLogsWriter();

        $inputFilter = $this->getFormInputFilter();

        return $logsWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => 2,
            'message'   => "Inserito il post ".$inputFilter->title,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }

    /**
     * @param null $message
     * @return bool
     * @throws \Application\Model\NullException
     */
    public function logInsertKo($message = null)
    {
        $this->assertUserDetails();

        $this->assertLogWriter();

        $userDetails = $this->getUserDetails();

        $logsWriter = $this->getLogsWriter();

        $inputFilter = $this->getFormInputFilter();

        return $logsWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => 2,
            'message'   => "Errore nell'inserimento del post ".$inputFilter->title.' Messaggio: '.$message,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }

    /**
     * @return bool
     *
     * @throws \Application\Model\NullException
     */
    public function logUpdateOk()
    {
        $this->assertUserDetails();

        $this->assertLogWriter();

        $userDetails = $this->getUserDetails();

        $logsWriter = $this->getLogsWriter();

        $inputFilter = $this->getFormInputFilter();

        return $logsWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => 2,
            'message'   => "Ha aggiornato il post ".$inputFilter->title,
            'type'      => 'info',
            'backend'   => 1,
        ));
    }

    /**
     * @param null $message
     * @return bool
     * @throws \Application\Model\NullException
     */
    public function logUpdateKo($message = null)
    {
        $this->assertUserDetails();

        $this->assertLogWriter();

        $userDetails = $this->getUserDetails();

        $logsWriter = $this->getLogsWriter();

        $inputFilter = $this->getFormInputFilter();

        return $logsWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => 2,
            'message'   => "Errore nell'aggiornamento del post ".$inputFilter->title.' Messaggio: '.$message,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }

    /**
     * @param array $record
     *
     * @return bool
     */
    public function logDelete(array $record)
    {
        $this->assertUserDetails();

        $this->assertLogWriter();

        $userDetails = $this->getUserDetails();

        $logsWriter = $this->getLogsWriter();

        return $logsWriter->writeLog(array(
            'user_id'   => $userDetails->id,
            'module_id' => 2,
            'message'   => "Eliminato post record ".$record->title,
            'type'      => 'error',
            'backend'   => 1,
        ));
    }
}