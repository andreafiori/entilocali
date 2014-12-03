<?php

namespace Admin\Model\Attachments;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Attachments\AttachmentsGetter;
use Admin\Model\Attachments\AttachmentsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  20 August 2014
 */
class AttachmentsFormDataHandler extends FormDataAbstract
{
    private $pages = array();
    
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);

        if (!isset($param['get']['module'])) {
            $this->setVariables(array(
                'messageType'   => 'danger',
                'messageTitle'  => 'Modulo non rilevato',
                'messageText'   => 'Modulo non rilevato. Impossibile mostrare gli allegati ed il relativo form'
            ));
            
            $this->setTemplate('message.phtml');
            
            return;
        }
        
        $attachmentsRecords = $this->getAttachmentsRecords(new AttachmentsGetterWrapper(new AttachmentsGetter($this->getInput("entityManager",1))), array(
                'moduleId'      => $param['get']['module'],
                'referenceId'   => $param['route']['id'],
            )
        );
        
        $form = new AttachmentsForm();
        
        /**
         * TODO:
         *      set $param['route']['option']
         *      set module ID (must be a number...)
         *      check if $param['route']['option'] is on a class map
         *      check if $param['route']['option'] on the class map is an existent class name...
         *      ...
         *      NOW the class on $param['route']['option']:
         *          set records: count(records) must be == 1 or error...
         *          set articolo records
         *     REMOVE THIS HORRIBLE COMMENT!
         */
        switch($param['route']['option']) {
            default:
                // error...
            break;

            case("albo-pretorio"):
                $wrapper = new \Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper(new \Admin\Model\AlboPretorio\AlboPretorioArticoliGetter($this->getInput("entityManager",1)));
                $wrapper->setInput(array('id' => $param['get']['module'], 'fields' => 'aa.titolo'));
                $wrapper->setupQueryBuilder();
                
                $relatedRecord = $wrapper->getRecords();
                
                if (count($relatedRecord)!=1) {
                    // error...
                }

                $articleTitle = stripslashes($relatedRecord[0]['titolo']);
            break;
        
            case("stato-civile"):
                $wrapper = new \Admin\Model\StatoCivile\StatoCivileGetterWrapper(new \Admin\Model\StatoCivile\StatoCivileGetter($this->getInput("entityManager",1)));
                $wrapper->setInput();
                $wrapper->setupQueryBuilder();
                
                $relatedRecord = $wrapper->getRecords();
            break;
        }
        
        $this->setVariables(array(
                'form'                      => $form,
                'formTitle'                 => 'Nuovo allegato',
                'formDescription'           => "Inserisci un nuovo allegato per l'articolo corrente",
                'formAction'                => '',
                'attachmentsList'           => $attachmentsRecords,
                'articleTitle'              => $articleTitle,
                'pages'                     => $this->pages,

                'hideBreadcrumb'            => 1,
                'formBreadCrumbCategory'    => '[modulo]', '[articolo]',
            )
        );
        
        $this->setTemplate('formdata/attachments.phtml');
    }
    
        /**
         * @param AttachmentsGetterWrapper $wrapper
         * @param array $input
         * @return array
         */
        private function getAttachmentsRecords(AttachmentsGetterWrapper $wrapper, array $input)
        {
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();

            return $wrapper->getRecords();
        }
}
