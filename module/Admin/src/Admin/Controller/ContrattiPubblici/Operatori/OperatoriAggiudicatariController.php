<?php

namespace Admin\Controller\ContrattiPubblici\Operatori;

use Application\Controller\SetupAbstractController;

class OperatoriAggiudicatariController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $id = $this->params()->fromRoute('id');

        $lang = $this->params()->fromRoute('lang');

        if (!$id) {
            /*
            $this->setVariables(array(
                'error'         => 'Errore selezione dati',
                'errorMesssage' => 'Impossibile selezionare i dati del bando di gara o contratto'
            ));
            */
        }

            $this->checkAddAggiudicatari();
            $this->checkRemoveAggiudicatario();
            $this->checkAddOperatore();
            $this->checkRemovePartecipante();

            $wrapper = new OperatoriAggiudicatariGetterWrapper( new OperatoriAggiudicatariGetter($this->getInput('entityManager', 1)) );
            $wrapper->setInput(array('contrattoId' => $id));
            $wrapper->setupQueryBuilder();

            $partecipantiRecords = $wrapper->getRecords();

            $partecipanti = $this->getOperatoriAggiudicatari($partecipantiRecords, 1);

            $aggiudicatari = $this->getOperatoriAggiudicatari($partecipantiRecords);

            $wrapper = new ContrattiPubbliciGetterWrapper( new ContrattiPubbliciGetter($this->getInput('entityManager', 1)) );
            $wrapper->setInput(array('id'=>$id, 'limit' => 1));
            $wrapper->setupQueryBuilder();

            $contrattoRecord = $wrapper->getRecords();

            $wrapper = new OperatoriGetterWrapper(new OperatoriGetter($this->getInput('entityManager', 1)) );
            $wrapper->setInput(array());
            $wrapper->setupQueryBuilder();

            $operatori = $wrapper->getRecords();

            $this->setVariables(array(
                'contratto'                 => $contrattoRecord,
                'operatori'                 => $operatori,
                'operatoriPartecipanti'     => $partecipanti,
                'operatoriAggiudicatari'    => $aggiudicatari,
            ));



        $this->setTemplate('contratti-pubblici/contratti-pubblici-aggiudicatari.phtml');

        return $this->getOutput();
    }

    /**
     * @param array $records
     */
    private function getOperatoriAggiudicatari(array $records, $excludeAggiudicatari = 0)
    {
        $aggiudicatari = array();

        foreach($records as $record) {
            if ($excludeAggiudicatari) {
                if ($record['aggiudicatario']!=1) {
                    $aggiudicatari[] = $record;
                }
            } else {
                if ($record['aggiudicatario']==1) {
                    $aggiudicatari[] = $record;
                }
            }
        }

        return $aggiudicatari;
    }

    private function checkAddAggiudicatari()
    {
        $param = $this->getInput('param', 1);

        if ( isset($param['post']['addAggiudicatario']) ) {
            $this->updateAggiudicatario();
        }
    }

    private function checkRemoveAggiudicatario()
    {
        $param = $this->getInput('param', 1);

        if ( isset($param['post']['removeAggiudicatario']) ) {
            $this->updateAggiudicatario(0);
        }
    }

    /**
     * @param int $aggiudicatarioValue
     * @return mixed
     */
    private function updateAggiudicatario($aggiudicatarioValue = 1)
    {
        $param = $this->getInput('param', 1);

        $connection = $this->getInput('entityManager',1)->getConnection();
        $connection->beginTransaction();
        try {
            $connection->update('zfcms_comuni_contratti_relations', array(
                'aggiudicatario' => $aggiudicatarioValue,
            ),
                array(
                    'id'            => $param['post']['idRelation'],
                    'contratto_id'  => $param['post']['idContratto']
                )
            );
            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollBack();
            return $e->getMessage();
        }
    }

    private function checkAddOperatore()
    {
        $param = $this->getInput('param', 1);

        if ( isset($param['post']['operatorerubrica']) ) {
            $connection = $this->getInput('entityManager',1)->getConnection();
            foreach($param['post']['operatorerubrica'] as $partecipante) {
                $connection->beginTransaction();
                try {
                    $connection = $this->getInput('entityManager',1)->getConnection();
                    $connection->insert('zfcms_comuni_contratti_relations', array(
                            'stato'             => 0,
                            'gruppo'            => 0,
                            'aggiudicatario'    => 0,
                            'membro'            => 0,
                            'partecipante_id'   => $partecipante,
                            'contratto_id'      => $param['route']['id'],
                        )
                    );
                    $connection->commit();
                } catch (\Exception $e) {
                    $connection->rollBack();
                    return $e->getMessage();
                }
            }
        }
    }

    private function checkRemovePartecipante()
    {
        $param = $this->getInput('param', 1);

        if ( isset($param['post']['removePartecipante']) ) {
            $connection = $this->getInput('entityManager',1)->getConnection();
            $connection->beginTransaction();
            try {
                $connection->delete('zfcms_comuni_contratti_relations', array(
                    'id' => $param['post']['idRelation'],
                ));
                $connection->commit();
            } catch (\Exception $e) {
                $connection->rollBack();
                return $e->getMessage();
            }
        }
    }
}