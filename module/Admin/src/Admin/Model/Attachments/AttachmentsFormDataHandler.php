<?php

namespace Admin\Model\Attachments;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Modules\ModulesGetter;
use Admin\Model\Modules\ModulesGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  20 August 2014
 */
class AttachmentsFormDataHandler extends FormDataAbstract
{
    private $pages = array();
    
    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);

        $moduleWrapper = new ModulesGetterWrapper( new ModulesGetter($this->getInput("entityManager", 1)) );
        $moduleWrapper->setInput(array(
                'code'  => $param['route']['option'],
                'limit' => 1
            )
        );
        $moduleWrapper->setupQueryBuilder();
        $moduleRecords = $moduleWrapper->getRecords();

        if (empty($moduleRecords)) {
            $this->setTemplate('message.phtml');
            $this->setVariables(array(
                'messageType'   => 'warning',
                'messageTitle'  => 'Modulo non trovato',
                'messageText'   => "Il presente modulo non &egrave; stato trovato. Contattare l'amministrazione per un aggiornamento dei dati relativi al modulo",
            ));
            return false;
        }

        $moduleId = $moduleRecords[0]['id'];

        // Get Attachments Records
        $wrapper = new AttachmentsGetterWrapper(new AttachmentsGetter($this->getInput("entityManager",1)));
        $wrapper->setInput(array(
            'moduleId'      => $param['route']['option'],
            'status'        => 1,
            'referenceId'   => $param['route']['id'],
        ));
        $wrapper->setupQueryBuilder();
        $attachmentsRecords = $wrapper->getRecords();

        // Setup Attachment Form
        $form = new AttachmentsForm();
        $form->addInputFile();
        $form->addSecondaryFields();

        // TODO: DELETE records and file on S3
        if (isset($param['post']['deleteId'])) {

        }

        switch($param['route']['option']) {
            default:
                $this->setVariables(array(
                    'messageType'   => 'danger',
                    'messageTitle'  => 'Modulo non rilevato',
                    'messageText'   => 'Modulo non rilevato. Impossibile mostrare gli allegati ed il relativo form'
                ));

                $this->setTemplate('message.phtml');

                return false;
            break;

            case("albo-pretorio"):
                $wrapper = new \Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper(
                    new \Admin\Model\AlboPretorio\AlboPretorioArticoliGetter($this->getInput("entityManager",1))
                );
                $wrapper->setInput(array('id' => $param['route']['option'], 'fields' => 'alboArticoli.id, alboArticoli.titolo'));
                $wrapper->setupQueryBuilder();
                
                $relatedRecord = $wrapper->getRecords();

                $articleTitle = stripslashes($relatedRecord[0]['titolo']);

                $breadCrumbModule = 'Albo pretorio';
            break;

            case("stato-civile"):
                $wrapper = new \Admin\Model\StatoCivile\StatoCivileGetterWrapper(
                    new \Admin\Model\StatoCivile\StatoCivileGetter($this->getInput("entityManager",1))
                );
                $wrapper->setInput(array('id' => $param['route']['option']));
                $wrapper->setupQueryBuilder();
                
                $relatedRecord = $wrapper->getRecords();

                $articleTitle = stripslashes($relatedRecord[0]['titolo']);

                $breadCrumbModule = 'Stato civile';
            break;

            case("contratti-pubblici"):
                $wrapper = new \Admin\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper(
                    new \Admin\Model\ContrattiPubblici\ContrattiPubbliciGetter($this->getInput("entityManager",1))
                );
                $wrapper->setInput(array('id' => $param['route']['option']));
                $wrapper->setupQueryBuilder();

                $relatedRecord = $wrapper->getRecords();

                $articleTitle = stripslashes($relatedRecord[0]['titolo']);
                $breadCrumbModule = 'Contratti pubblici';
            break;

            case("atti-concessione"):
                $wrapper = new \Admin\Model\AttiConcessione\AttiConcessioneGetterWrapper(
                    new \Admin\Model\AttiConcessione\AttiConcessioneGetter($this->getInput("entityManager",1))
                );
                $wrapper->setInput(array('id' => $param['route']['option']));
                $wrapper->setupQueryBuilder();

                $relatedRecord = $wrapper->getRecords();

                $articleTitle = stripslashes($relatedRecord[0]['titolo']);
                $breadCrumbModule = 'Atti concessione';
            break;

            case("contenuti"): case("amministrazione-trasparente"):
                $wrapper = new \Admin\Model\Contenuti\ContenutiGetterWrapper(
                    new \Admin\Model\Contenuti\ContenutiGetter($this->getInput("entityManager",1))
                );
                $wrapper->setInput(array('id' => $param['route']['option']));
                $wrapper->setupQueryBuilder();

                $relatedRecord = $wrapper->getRecords();

                $articleTitle = stripslashes($relatedRecord[0]['titolo']);

                $breadCrumbModule = ($param['route']['option']=='contenuti') ? 'Contenuti' : 'Amministrazione Trasparente';
            break;
        }
        
        $form->setData( array(
                'userId'            => $this->getInput('userDetails',1)->id,
                'referenceId'       => $param['route']['id'],
                'moduleId'          => $moduleId,
                's3_directory'      => $param['route']['option']
            )
        );
        
        $this->setVariables(array(
                'form'                       => $form,
                'formTitle'                  => 'Nuovo allegato',
                'formDescription'            => "La dimensione del file non deve superare i <strong>10MB</strong>.",
                'formAction'                 => 'attachments/insert',
                'attachmentsList'            => $attachmentsRecords,
                'articleTitle'               => $articleTitle,
                'pages'                      => $this->pages,
                'hideBreadcrumb'             => 1,
                'formBreadCrumbCategory'     => $breadCrumbModule, $articleTitle,
                'formBreadCrumbCategoryLink' => $this->getInput('baseUrl',1).'datatable/'.$param['route']['option'],
                'attachmentType'             => $param['route']['option']
            )
        );
        
        $this->setTemplate('formdata/attachments.phtml');
    }
}
