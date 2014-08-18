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
        protected function insert()
        {
            $error = array();
            if (!$this->rawPost['category']) {
                $error[] = 'Selezionare almeno una categoria';
            }
            if (!$this->rawPost['moduloid']) {
                $error[] = "Identificativo modulo non presente: contattare l'amministrazione";
            }
            
            if (!empty($error)) {
                return $this->setErrorMessage($error);
            }
            
            $this->getConnection()->beginTransaction();
            try {
                $this->getConnection()->insert('zfcms_posts', array(
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
            $postsId = $this->getConnection()->lastInsertId();
            
            try {
                $this->getConnection()->insert('zfcms_posts_options', array(
                    'title'            => $this->rawPost['title'],
                    'subtitle'          => $this->rawPost['subtitle'],
                    'description'       => $this->rawPost['description'],
                    'status'            => empty($this->rawPost['status']) ? PostsUtils::STATE_ACTIVE : $this->rawPost['status'],
                    'seo_url'           => Slugifier::slugify($this->rawPost['titolo']),
                    'seo_title'         => $this->rawPost['title'],
                    'seo_description'   => $this->rawPost['seoDescription'],
                    'seo_keywords'      => $this->rawPost['seoKeywords'],
                    'posts_id'          => $postsId,
                    'language_id'       => 1,
                ));
            } catch (\Exception $e) {
                $this->getConnection()->rollBack();
                return $this->setErrorMessage($e->getMessage());
            }
            
            if (is_array($this->rawPost['category'])) {
                foreach($this->rawPost['category'] as $category) {
                    $this->getConnection()->insert('posts_relations', array(
                        'posts_id'          => $postsId, // last insert id
                        'category_id'       => $category,
                        'module_id'         => $this->rawPost['moduloid'],
                        'channel_id'        => 1,
                    ));
                }
            }
            
            $this->getConnection()->commit();

            $this->setVariable('messageType',   'success');
            $this->setVariable('messageTitle',  'Dati inseriti correttamente');
            $this->setVariable('messageText',   'Dati inseriti correttamente in archivio.');
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
                
                // TODO:
                // update last update date
                   //  update categories
                   // SELECT from posts_relations WHERE categoria_id IN  $this->rawPost['category']; IF id NOT FOUND -> add category
                   // DO NOT DELETE old category\ies to rewrite same record

            } catch(\Exception $e) {
                $this->getConnection()->rollBack();
                return $this->setErrorMessage("Si &egrave; verificato un errore nell'aggiornamento dati in archivio. <h2>Messaggio:</h2> ".$e->getMessage());
            }
            
            $this->getConnection()->commit();
            
            $this->setVariable('messageType', 'success');
            $this->setVariable('messageTitle', 'Dati aggiornati correttamente');
            $this->setVariable('messageText', 'Dati in archivio aggiornati correttamente');
        }
}