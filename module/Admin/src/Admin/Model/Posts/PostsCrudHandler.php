<?php

namespace Admin\Model\Posts;

use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\FormData\CrudHandlerAbstract;
use Application\Model\Slugifier;

/**
 * @author Andrea Fiori
 * @since  01 June 2014
 */
class PostsCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface
{
    private $postsTableName = 'zfcms_posts';
    
        protected function insert()
        {
            /* Validate input data */
            $error = array();
            if (!isset($this->rawPost['category'])) {
                $error[] = 'Selezionare almeno una categoria';
            }
            if (!isset($this->rawPost['moduloid'])) {
                $error[] = "Identificativo modulo non presente: contattare l'amministrazione";
            }
            
            if (!empty($error)) {
                return $this->setErrorMessage($error);
            }
            
            /* Write on db checking error */
            $this->getConnection()->beginTransaction();
            try {
                $this->getConnection()->insert($this->postsTableName, array(
                    'note'                 => Slugifier::slugify($this->rawPost['title']),
                    'insert_date'          => date("Y-m-d H:i:s"),
                    'expire_date'          => isset($this->rawPost['expireDate']) ? $this->rawPost['expireDate'] : date("2030-m-d H:i:s"),
                    'last_update'          => date("Y-m-d H:i:s"),
                    'parent_id'            => 0,
                    'type'                 => $this->rawPost['type'],
                ));
            } catch (\Exception $e) {
                $this->getConnection()->rollBack();
                return $this->setErrorMessage($e->getMessage());
            }
            $postsLastInsertId = $this->getConnection()->lastInsertId();
            
            try {
                $this->getConnection()->insert('zfcms_posts_options', array(
                    'title'             => $this->rawPost['title'],
                    'subtitle'          => $this->rawPost['subtitle'],
                    'description'       => $this->rawPost['description'],
                    'status'            => empty($this->rawPost['status']) ? PostsUtils::STATE_ACTIVE : $this->rawPost['status'],
                    'seo_url'           => Slugifier::slugify($this->rawPost['titolo']),
                    'seo_title'         => $this->rawPost['title'],
                    'seo_description'   => $this->rawPost['seoDescription'],
                    'seo_keywords'      => $this->rawPost['seoKeywords'],
                    'posts_id'          => $postsLastInsertId,
                    'language_id'       => 1,
                ));
            } catch (\Exception $e) {
                $this->getConnection()->rollBack();
                return $this->setErrorMessage($e->getMessage());
            }
            
            if (is_array($this->rawPost['category'])) {
                foreach($this->rawPost['category'] as $category) {
                    $this->getConnection()->insert('zfcms_posts_relations', array(
                        'posts_id'          => $postsLastInsertId, // last insert id
                        'category_id'       => $category,
                        'module_id'         => $this->rawPost['moduloid'],
                        'channel_id'        => 1,
                    ));
                }
            }
            $this->getConnection()->commit();
            
            /* TODO: log event Insert post (type?) */
            
            /* Show success message */
            $this->setVariables(array(
                'messageType'   => 'success',
                'messageTitle'  => 'Dati inseriti correttamente',
                'messageText'   => 'Dati inseriti correttamente in archivio.'
            ));
        }
        
        protected function update()
        {
            $this->getConnection()->beginTransaction();
            try {
                $this->setArrayRecordToHandle('title',           'title');
                $this->setArrayRecordToHandle('subtitle',        'subtitle');
                $this->setArrayRecordToHandle('description',     'description');
                $this->setArrayRecordToHandle('seo_description', 'seoDescription');
                $this->setArrayRecordToHandle('seo_keywords',    'seoKeywords');
   
                $affectedRows = $this->getConnection()->update(
                            'zfcms_posts_options',
                            array_merge($this->getArrayRecordToHandle(), array('description' => $this->rawPost['description']) ),
                            array('posts_id' => $this->rawPost['postoptionid'])
                );
                
            } catch(\Exception $e) {
                $this->getConnection()->rollBack();
                return $this->setErrorMessage("Si &egrave; verificato un errore nell'aggiornamento dati in archivio. <h2>Messaggio:</h2> ".$e->getMessage());
            }
            $this->getConnection()->commit();
            
            /* TODO: log event Insert post (type?) */
            
            /* Show success message */
            $this->setVariables(array(
                'messageType'   => 'success',
                'messageTitle'  => 'Dati aggiornati correttamente',
                'messageText'   => 'Dati aggiornati correttamente in archivio.'
            ));
        }
}