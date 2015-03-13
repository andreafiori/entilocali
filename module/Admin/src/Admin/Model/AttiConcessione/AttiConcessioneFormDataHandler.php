<?php

namespace Admin\Model\AttiConcessione;

use Admin\Model\FormData\FormDataAbstract;

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

        $form = new AttiConcessioneForm();
        $form->addUfficioResponsabile($this->getSezioni());
        $form->addResponsabileProcedimento($this->getResposabiliProcedimento(array()));
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
                'formBreadCrumbCategoryLink' => $baseUrl.'datatable/contenuti/',
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
        private function getSezioni($input = array())
        {
            $wrapper = new AttiConcessioneSettoriGetterWrapper(
                new AttiConcessioneSettoriGetter($this->getInput('entityManager',1))
            );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();
            
            $records = $wrapper->getRecords();
            
            $recordForSelectArea = array();
            foreach($records as $record) {
                $valueToPush = $record['nome'];
                if (isset($record['responsabile'])) {
                    $valueToPush .= ' - Responsabile: '.$record['responsabile'];
                }
                $recordForSelectArea[$record['id']] = $valueToPush;
            }
            
            return $recordForSelectArea;
        }

        private function getResposabiliProcedimento($input = array())
        {
            $wrapper = new AttiConcessioneRespProcGetterWrapper(
                new AttiConcessioneRespProcGetter($this->getInput('entityManager',1))
            );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();

            $records = $wrapper->getRecords();

            $recordForSelectArea = array();
            foreach($records as $record) {
                $recordForSelectArea[$record['id']] = $record['nomeResp'];
            }

            return $recordForSelectArea;
        }
}
