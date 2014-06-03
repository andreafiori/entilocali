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
    public function performOperation()
    {
        $operation = $this->getOperation();
        if ($operation) {
            $this->$operation();
        }
    }

        /**
         *  TODO:
                upload and create thumb for photo gallery and blogs
        
                hide form after post (UI)... show link to re-show form if there's an error
                check at least 1 category is checked (javascript FrontEnd)
                
        */
        private function insert()
        {
            $error = array();
            if (!$this->rawPost['category']) {
                $error[] = 'Selezionare almeno una categoria';
            }
            if (!$this->rawPost['moduloid']) {
                $error[] = "Identificativo modulo non: contattare l'aministrazione";
            }
            
            if ($error) {
                return $this->setErrorMessage($error);
            }
            
            $this->getConnection()->insert('posts', array(
                'note'                      => Slugifier::slugify($this->rawPost['titolo']),
                'data_inserimento'          => date("Y-m-d H:i:s"),
                'data_scadenza'             => isset($this->rawPost['dataScadenza']) ? $this->rawPost['dataScadenza'] : date("2030-m-d H:i:s"),
                'data_ultimo_aggiornamento' => date("Y-m-d H:i:s"),
                'parent_id'                 => 0,
                'tipo'                      => $this->rawPost['tipo'],
            ));
            $postsId = $this->getConnection()->lastInsertId();
            
            
            $this->getConnection()->insert('posts_opzioni', array(
                'titolo'            => $this->rawPost['titolo'],
                'sottotitolo'       => $this->rawPost['sottotitolo'],
                'descrizione'       => $this->rawPost['descrizione'],
                'stato'             => empty($this->rawPost['stato']) ? PostsUtils::STATE_ACTIVE : $this->rawPost['stato'],
                'seo_url'           => Slugifier::slugify($this->rawPost['titolo']),
                'seo_title'         => $this->rawPost['titolo'],
                'seo_description'   => $this->rawPost['seoDescription'],
                'seo_keywords'      => $this->rawPost['seoKeywords'],
                'posts_id'          => $postsId,
                'lingua_id'         => 1,
            ));
            
            if (is_array($this->rawPost['category'])) {
                foreach($this->rawPost['category'] as $category) {
                    $this->getConnection()->insert('posts_relazioni', array(
                        'posts_id'          => $postsId, // last insert id
                        'categoria_id'      => $category,
                        'modulo_id'         => $this->rawPost['moduloid'],
                        'canale_id'         => 1,
                    ));
                }    
            }

            
            $this->setVariable('messageType', 'success');
            $this->setVariable('messageTitle', 'Dati inseriti correttamente');
            $this->setVariable('messageText', 'Dati inseriti correttamente in archivio. Controllare la loro integrità');
        }
        
        /**
         * TODO: validate post before update, use an InputFilter class...
         *      updoad \ update image if foto or blog
         */
        private function update()
        {
            try {
                $this->setArrayRecordToHandle('titolo', 'titolo');
                $this->setArrayRecordToHandle('sottotitolo', 'sottotitolo');
                $this->setArrayRecordToHandle('descrizione', 'descrizione');
                $this->setArrayRecordToHandle('seo_description', 'seoDescription');
                $this->setArrayRecordToHandle('seo_keywords', 'seoKeywords');

                $affectedRows = $this->getConnection()->update(
                            'posts_opzioni', // table
                            $this->getArrayRecordToHandle(), // records to update
                            array('posts_id' => $this->rawPost['postoptionid']) // where condition
                );
                
                // TODO: 
                // update last update date
                    //  update categories
                   // SELECT from posts_relations WHERE categoria_id IN  $this->rawPost['category']; IF id NOT FOUND -> add category
                   // DO NOT DELETE old category\ies to rewrite same record

            } catch(\Exception $e) {
                $error = $e->getMessage();
            }

            if ($error) {
                return setErrorMessage("Si &egrave; verificato un errore nell'aggiornamento dati in archivio. <h2>Messaggio:</h2> ".$error);
            } else {
                $messageType = 'success';
                $messageTitle = 'Dati aggiornati correttamente';
                $messageText = 'Dati in archivio aggiornati correttamente';
            }

            $this->setVariable('messageType', $messageType);
            $this->setVariable('messageTitle', $messageTitle);
            $this->setVariable('messageText', $messageText);
        }
        
        private function setErrorMessage($errorMessage, $title = null)
        {
            if (!$title) {
                $title = 'Errore aggiornamento dati';
            }

            $this->setVariable('messageType', 'danger');
            $this->setVariable('messageTitle', $title);
            
            if (is_array($errorMessage)) {
                $errorMessageFinal = '';
                foreach ($errorMessage as $error) {
                    $errorMessageFinal .= '<p>'.$error.'</p>';
                }
                
                $errorMessage = $errorMessageFinal;
            }
            
            $this->setVariable('messageText', $errorMessage);
        } 
}