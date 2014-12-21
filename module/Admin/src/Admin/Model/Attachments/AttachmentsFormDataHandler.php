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
        
        // get attachments records
        $wrapper = new AttachmentsGetterWrapper(new AttachmentsGetter($this->getInput("entityManager",1)));
        $wrapper->setInput(array(
            'moduleId'      => $param['route']['option'], // TODO: passe the module via GET $param['get']['module']
            'referenceId'   => $param['route']['id'],
        ));
        $wrapper->setupQueryBuilder();
        $attachmentsRecords = $wrapper->getRecords();
        
        // setup attachment form
        $form = new AttachmentsForm();
        $form->addInputFile();
        $form->addSecondaryFields();

        switch($param['route']['option']) {
            default:
                $this->setVariables(array(
                    'messageType'   => 'danger',
                    'messageTitle'  => 'Modulo non rilevato',
                    'messageText'   => 'Modulo non rilevato. Impossibile mostrare gli allegati ed il relativo form'
                ));

                $this->setTemplate('message.phtml');

                return;
            break;

            case("albo-pretorio"):
                $wrapper = new \Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper(new \Admin\Model\AlboPretorio\AlboPretorioArticoliGetter($this->getInput("entityManager",1)));
                $wrapper->setInput(array('id' => $param['route']['option'], 'fields' => 'aa.id, aa.titolo'));
                $wrapper->setupQueryBuilder();
                
                $relatedRecord = $wrapper->getRecords();
                
                if (count($relatedRecord)!=1) {
                    // no attachments
                }

                $articleTitle = stripslashes($relatedRecord[0]['titolo']);
                $breadCrumbModule = 'Albo pretorio';
                $moduleId = 13;
                $s3_directory = 'albo-pretorio';
            break;

            case("stato-civile"):
                $wrapper = new \Admin\Model\StatoCivile\StatoCivileGetterWrapper(new \Admin\Model\StatoCivile\StatoCivileGetter($this->getInput("entityManager",1)));
                $wrapper->setInput(array('id' => $param['route']['option']));
                $wrapper->setupQueryBuilder();
                
                $relatedRecord = $wrapper->getRecords();
                
                $articleTitle = stripslashes($relatedRecord[0]['titolo']);
                $breadCrumbModule = 'Stato civile';
                $moduleId = 12;
                $s3_directory = 'stato-civile';
            break;
        
            case("contratti-pubblici"):
                $s3_directory = 'contratti-pubblici';
            break;
        
            case("amministrazione-trasparente"):
                $s3_directory = 'amministrazione-trasparente';
            break;
        }
        
        $form->setData( array(
                'userId'                => $this->getInput('userDetails',1)->id,
                'referenceId'           => $param['route']['id'],
                'moduleId'              => $moduleId,
                's3_directory'          => $s3_directory
            )
        );
        
        $this->setVariables(array(
                'form'                      => $form,
                'formTitle'                 => 'Nuovo allegato',
                'formDescription'           => "Inserisci un nuovo allegato per l'articolo corrente",
                'formAction'                => 'attachments/insert',
                'attachmentsList'           => $attachmentsRecords,
                'articleTitle'              => $articleTitle,
                'pages'                     => $this->pages,
                'hideBreadcrumb'            => 1,
                'formBreadCrumbCategory'    => $breadCrumbModule, $articleTitle,
            )
        );
        
        $this->setTemplate('formdata/attachments.phtml');
    }
}
