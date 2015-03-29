<?php

namespace Admin\Model\AttiConcessione;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Users\RespProc\UsersRespProcGetter;
use Admin\Model\Users\RespProc\UsersRespProcGetterWrapper;
use Admin\Model\Users\Settori\UsersSettoriGetter;
use Admin\Model\Users\Settori\UsersSettoriGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  16 December 2013
 */
class AttiConcessioneFormDataHandler extends FormDataAbstract
{
    /**
     * @inheritdoc
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param', 1);

        $responsabiliProcedimento = $this->getResposabiliProcedimento(array());

        $sezioniRecords = $this->getUsersSettori();

        if (empty($sezioniRecords)) {
            $this->setTemplate('message.phtml');
            $this->setVariables(array(
                'messageType'   => 'warning',
                'messageTitle'  => 'Nessuna sezione',
                'messageText'   => "Non &egrave; possibile inserire un nuovo atto. Inserire almeno una sezione."
            ));

            return false;
        }

        if (empty($responsabiliProcedimento)) {
            $this->setTemplate('message.phtml');
            $this->setVariables(array(
                'messageType'   => 'warning',
                'messageTitle'  => 'Nessun responsabile procedimento',
                'messageText'   => "Non &egrave; possibile inserire un nuovo atto. Inserire almeno un responsabile procedimento"
            ));

            return false;
        }

        $form = new AttiConcessioneForm();
        $form->addUfficioResponsabile($sezioniRecords);
        $form->addResponsabileProcedimento($responsabiliProcedimento);
        $form->addModalitaAssegnazione();

        $routeOptionId = isset($param['route']['option']) ? $param['route']['option'] : null;
        if ($routeOptionId) {
            $records = $this->getAttiRecords($routeOptionId);
        }

        if (!empty($records)) {
            $formAction         = 'atti-concessione/update';
            $formTitle          = 'Modifica atto di concessione';
            $formDescription    = 'Modifica nuovo atto di concessione';

            $records[0]['importo'] = utf8_encode($records[0]['importo']);
            $form->setData($records[0]);
        } else {
            $form->setData(array(
                'anno' => date('Y')+5,
            ));

            $formAction      = 'atti-concessione/insert';
            $formTitle       = 'Nuovo atto di concessione';
            $formDescription = 'Inserisci nuovo atto di concessione';
        }

        $baseUrl = $this->getInput('baseUrl', 1);

        $this->setVariables(array(
                'form'                       => $form,
                'formAction'                 => $formAction,
                'formTitle'                  => $formTitle,
                'formDescription'            => $formDescription,
                'formBreadCrumbCategory'     => 'Atti di concessione',
                'formBreadCrumbCategoryLink' => $baseUrl.'datatable/atti-concessione/',
                'CKEditorField'              => array('sottotitolo', 'testo')
            )
        );
    }
    
        /**
         * @param int $id
         * @return array
         */
        private function getAttiRecords($id)
        {
            $wrapper = new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($this->getInput('entityManager',1)));
            $wrapper->setInput( array('aa.id' => $id, 'limit' => 1) );
            $wrapper->setupQueryBuilder();
            
            return $wrapper->getRecords();
        }

        /**
         * @return array
         */
        private function getUsersSettori($input = array())
        {
            $wrapper = new UsersSettoriGetterWrapper(
                new UsersSettoriGetter($this->getInput('entityManager',1))
            );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();
            
            $records = $wrapper->getRecords();
            
            $recordForSelectArea = array();
            foreach($records as $record) {
                $recordForSelectArea[$record['id']] = $record['nome'];
            }
            
            return $recordForSelectArea;
        }

        private function getResposabiliProcedimento($input = array())
        {
            $wrapper = new UsersRespProcGetterWrapper(
                new UsersRespProcGetter($this->getInput('entityManager',1))
            );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();

            $records = $wrapper->getRecords();

            $recordForSelectArea = array();
            foreach($records as $record) {
                $recordForSelectArea[$record['id']] = $record['name'].' '.$record['surname'];
            }

            return $recordForSelectArea;
        }
}
