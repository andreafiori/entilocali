<?php

namespace Admin\Model\Categorie;

use Admin\Model\FormData\CrudHandlerInterface;
use Admin\Model\FormData\CrudHandlerAbstract;
use Application\Model\Slugifier;

/**
 * TODO: 
 *      controllo id modulo, categoria last insert id
 * 
 * @author Andrea Fiori
 * @since  08 June 2013
 */
class CategoriesCrudHandler extends CrudHandlerAbstract implements CrudHandlerInterface
{
    public function performOperation()
    {
        $operation = $this->getOperation();
        if ($operation) {
            $this->$operation();
        }
    }

        private function insert()
        {
            try {
                $this->getConnection()->insert('categories', array(
                    'note'              => Slugifier::slugify($this->rawPost['name']),
                    'create_date'        => date("Y-m-d H:i:s"),
                    'last_update'        => date("Y-m-d H:i:s"),
                    'code'              => '',
                    'module_id'         => isset($this->rawPost['moduloId']) ? $this->rawPost['moduloId'] : 4,
                    'status'            => $this->rawPost['status'],
                ));
                $categoryId = $this->getConnection()->lastInsertId();
            } catch (\Exception $e) {
                return $this->setErrorMessage("Si &egrave; verificato un errore nell'aggiornamento dati in archivio. <h2>Messaggio:</h2> ".$error);
            }
            
            try {
                $this->getConnection()->insert('categorie_opzioni', array(
                    'name'              => $this->rawPost['name'],
                    'description'       => $this->rawPost['description'],
                    'seo_url'           => Slugifier::slugify($this->rawPost['nome']),
                    'seo_title'         => Slugifier::slugify($this->rawPost['nome']),
                    'seo_keywords'      => $this->rawPost['seoKeywords'],
                    'seo_description'   => $this->rawPost['seoDescription'],
                    'accesskey'         => $this->rawPost['accesskey'],
                    'template_file'     => $this->rawPost['templateFile'],
                    'position'          => $this->rawPost['position'],
                    'parent_id'         => $this->rawPost['parentId'],
                    'language_id'       => isset($this->rawPost['languageId']) ? $this->rawPost['languageId'] : 1,
                    'category_id'       => $categoryId,
                ));
            } catch (\Exception $e) {
                return $this->setErrorMessage("Si &egrave; verificato un errore nell'aggiornamento dati in archivio. <h2>Messaggio:</h2> ".$error);
            }
            
            $this->setVariable('messageType',   'success');
            $this->setVariable('messageTitle',  'Dati inseriti correttamente');
            $this->setVariable('messageText',   'Dati inseriti correttamente in archivio. Controllare la loro integrità');
        }
        
        private function update()
        {
            try {

                $this->setArrayRecordToHandle('name', 'name');
                
                $affectedRows = $this->getConnection()->update(
                            'categories_options',

                            $this->getArrayRecordToHandle(),
 
                            array('categoria_id' => $this->rawPost['id'])
                );
                
            } catch(\Exception $e) {
                $error = $e->getMessage();
            }

            if (!empty($error)) {
                return $this->setErrorMessage("Si &egrave; verificato un errore nell'aggiornamento dati in archivio. <h2>Messaggio:</h2> ".$error);
            } else {
                $messageType = 'success';
                $messageTitle = 'Dati aggiornati correttamente';
                $messageText = 'Dati in archivio aggiornati correttamente';
            }

            $this->setVariable('messageType', $messageType);
            $this->setVariable('messageTitle', $messageTitle);
            $this->setVariable('messageText', $messageText);
        }
    
}