<?php

namespace Admin\Model\Sezioni;

/**
 * @author Andrea Fiori
 * @since  15 February 2015
 */
class SottosezioniAmmTrasparenteDataTable extends SottoSezioniDataTableAbstract
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $input)
    {
        parent::__construct($input);

        $param = $this->getParam();

        $configurations = $this->getInput('configurations', 1);

        if (empty($configurations['amministrazione_trasparente_sezione_id'])) {
            $this->setTemplate('message.phtml');
            $this->setVariables(array(
                'messageType'   => 'danger',
                'messageTitle'  => 'Sezione Amm. Trasparente non rilevata!',
                'messageText'   => "Errore: non &egrave; stata rilevata la sezione Amm. Trasparente principale"
            ));

            return false;
        }

        $paginatorRecords = $this->setupPaginatorRecords(array(
            'sezioneId' => $configurations['amministrazione_trasparente_sezione_id']
        ));

        $this->setRecords( $this->formatRecordsToShowOnTable($paginatorRecords) );

        $this->setVariables(array(
            'tablesetter' => $param['route']['tablesetter'],
            'paginator'   => $paginatorRecords,
            'columns'     => $this->getHeaderColumns()
        ));

        $this->setTitle('Sotto sezioni');

        $this->setDescription('Gestione sotto sezioni amministrazione trasparente');

        return true;
    }
}