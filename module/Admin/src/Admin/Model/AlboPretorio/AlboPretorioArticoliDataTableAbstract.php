<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\DataTable\DataTableInterface;
use Admin\Model\DataTable\DataTableAbstract;
use Zend\Session\Container as SessionContainer;

/**
 * @author Andrea Fiori
 * @since  02 November 2014
 */
abstract class AlboPretorioArticoliDataTableAbstract extends DataTableAbstract implements DataTableInterface
{
    /**
     * Session Key where it stores post from form
     */
    const sessionPostKey = 'alboPretorioDataTable';
    
    protected $param;

    /**
     * @var AlboPretorioRecordsGetter
     */
    protected $recordsGetter;
    
    protected function setupArticoliInput()
    {
        $articoliInput = array('orderBy' => 'aa.id DESC');

        $sessionPost = new SessionContainer();

        if ( isset($this->param['post']['search']) or isset($this->param['post']['hidden-search-field']) ) {
            $sessionPost->offsetSet(self::sessionPostKey, array(
                'numeroAtto' => isset($this->param['post']['numero_atto'])  ? $this->param['post']['numero_atto'] : null,
                'sezioneId'  => isset($this->param['post']['sezione'])      ? $this->param['post']['sezione'] : null,
                'mese'       => isset($this->param['post']['mese'])         ? $this->param['post']['mese'] : null,
                'anno'       => isset($this->param['post']['anno'])         ? $this->param['post']['anno'] : null,
                'search'     => isset($this->param['post']['search'])       ? $this->param['post']['search'] : null,
                'orderBy'    => isset($this->param['post']['orderby'])      ? $this->param['post']['orderby'] : 'aa.id DESC'
            ));
        }
        
        $postFromSession = $sessionPost->offsetGet(self::sessionPostKey);
        if ($postFromSession) {
            $articoliInput = $postFromSession;
        }
        
        if (!isset($articoliInput['orderBy']) or $articoliInput['orderBy']=='') {
            $articoliInput['orderBy'] = 'aa.id DESC';
        }
        
        return $articoliInput;
    }

    /**
     * @param array $records
     * @return array|null
     */
    protected function getFormattedDataTableRecords($records, $modulePrefixLink = 'albo-pretorio')
    {
        $arrayToReturn = array();
        if ($records) {
            foreach($records as $key => $record) {

                $rowClass = '';
                if ($record['attivo']==0) {
                    $rowClass = 'rowHidden';
                }

                $arrayLine = array(
                    array(
                        'type'   => 'field',
                        'record' => $record['numeroAtto']." / ".$record['anno'],
                        'class'  => $rowClass,
                    ),
                    array(
                        'type'   => 'field',
                        'record' => $record['titolo'],
                        'class'  => $rowClass,
                    ),
                    array(
                        'type'   => 'field',
                        'record' => $record['nomeSezione'],
                        'class'  => $rowClass,
                    ),
                    array(
                        'type'   => 'field',
                        'record' => $record['dataScadenza'],
                        'class'  => $rowClass,
                    ),
                    array(
                        'type'   => 'field',
                        'record' => ($record['pubblicare']==1) ? $record['dataAttivazione'] : 'Non ancora pubblicato',
                        'class'  => $rowClass,
                    ),
                    array(
                        'type'   => 'field',
                        'record' => $record['userName'].' '.$record['userSurname'],
                        'class'  => $rowClass,
                    ),
                );

                $arrayLine[] = array(
                    'type'  => 'attachButton',
                    'href'  => $this->getInput('baseUrl',1).'formdata/attachments/'.$modulePrefixLink.'/'.$record['id'],
                    'class' => $rowClass,
                );

                if ($record['annullato']) {
                    $arrayLine[] = array(
                        'type'  => 'alboAnnulledButton',
                        'class' => $rowClass,
                    );
                } else {
                    if ($record['pubblicare']==1) {
                        $arrayLine[] = array(
                            'type'      => 'alboRettificaButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/'.$modulePrefixLink.'/'.$record['id'].'/?rettifica=1',
                            'title'     => 'Rettifica articolo',
                            'data-id'   => $record['id'],
                            'class'  => $rowClass,
                        );
                    } else {
                        // Note: quando l'articolo non è pubblicato, non è possibile modificarlo!?
                        /*
                        $activeDisableButtonValue = ($record['attivo']!=0) ? 'toDisable' : 'toActive';
                        $arrayLine[] = array(
                            'type'      => $record['attivo']!=0 ? 'activeButton' : 'disableButton',
                            'href'      => '?active='.$activeDisableButtonValue.'&amp;id='.$record['id'],
                            'value'     => $record['attivo'],
                            'title'     => 'Attiva \ Disattiva',
                            'class'     => $rowClass,
                        );
                        */
                        $arrayLine[] = array(
                            'type'      => 'alboPublishButton',
                            'href'      => '?publish='.$record['id'],
                            'data-id'   => $record['id'],
                            'title'     => 'Pubblica articolo',
                            'class'     => $rowClass,
                        );

                        $arrayLine[] = array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/'.$modulePrefixLink.'/'.$record['id'],
                            'title'     => 'Modifica articolo',
                            'class'     => $rowClass,
                        );
                    }

                    $arrayLine[] = array(
                        'type'   => 'relatapdfButton',
                        'href'   => $this->getInput('baseUrl',1).'pdf/albo-pretorio/'.$record['id'],
                        'class'  => $rowClass,
                    );

                    $arrayLine[] = array(
                        'type'   => 'enteterzoButton',
                        'href'   => $this->getInput('baseUrl',1).'invio-ente-terzo/'.$modulePrefixLink.'/'.$record['id'],
                        'class'  => $rowClass,
                    );

                    if ($record['pubblicare']==1) {
                        $arrayLine[] = array(
                            'type'      => 'alboAnnullButton',
                            'href'      => '#',
                            'data-id'   => $record['id'],
                            'title'     => 'Annulla articolo',
                            'class'     => $rowClass,
                        );
                    }
                }

                $arrayToReturn[] = $arrayLine;
            }
        }

        return $arrayToReturn;
    }

    /**
     * @param AlboPretorioArticoliFormAbstract $form
     * @param string $labelName
     * @param string $labelValue
     *
     * @return \Zend\Form\Form
     */
    protected function setupFormSearchAndExport(AlboPretorioArticoliFormAbstract $form, $labelName = null, $labelValue = null)
    {
        $sezioniRecords = $this->getSezioni( array('orderBy' => 'aps.nome') );
        $settoriRecords = $this->getSettori( array('fields' => 'DISTINCT(u.settore) AS settore, u.id', 'groupBy'=>'settore') );

        $form->addMonths();
        $form->addYears( $this->recordsGetter->getYears() );
        $form->addSezioni( (!empty($sezioniRecords)) ? $sezioniRecords : array() );
        $form->addSettori( (!empty($settoriRecords)) ? $settoriRecords : array() );
        $form->addOrderBy();
        $form->addSubmitButton($labelName, $labelValue);

        $paramPost = $this->getParam('post');
        if ( isset($paramPost) ) {
            $form->setData($paramPost);
        }

        return $form;
    }

    /**
     * @param array $input
     * @return mixed
     */
    protected function getSezioni(array $input)
    {
        $this->recordsGetter->setSezioni($input);

        return $this->recordsGetter->formatSezioniForFormSelect('id', 'nome');
    }

    /**
     * @param array $input
     * @return mixed
     */
    protected function getSettori(array $input)
    {
        $this->recordsGetter->setSettori($input);

        return $this->recordsGetter->formatSezioniForFormSelect('id', 'settore');
    }
    
    /**
     * @param mixed $paginatorRecords
     * @param string $title
     * @return array
     */
    protected function recoverCommonColumnsAndProperties($paginatorRecords, $title = 'Albo pretorio')
    {
        return array(
            'tableTitle'        => $title,
            'tableDescription'  => "Elenco atti albo. <strong>Attenzione:</strong> se viene effettuata una ricerca sui dati, gli stessi vengono memorizzati in sessione. Occorre resettare i dati dal form di ricerca se si vuole tornare alla visualizzazione predefinita.",
            'tablesetter'       => 'albo-pretorio',
            'columns' => array(
                array('label' => 'Num \ Anno', 'width' => '10%'),
                array('label' => 'Titolo', 'width' => '20%'),
                'Settore',
                'Scadenza',
                'Data attivazione',
                'Inserito da',
                '&nbsp;',
                '&nbsp;',
                '&nbsp;',
                '&nbsp;',
                '&nbsp;',
            ),
            'paginator'   => $paginatorRecords,
            'formSearch'  => $this->setupFormSearchAndExport(new AlboPretorioArticoliSearchFilterForm()),
            'formExport'  => $this->setupFormSearchAndExport(new AlboPretorioArticoliSearchFilterForm(), 'export', 'Esporta'),
        );
    }
    
    /**
     * Check if the user has requested to enable or disable the article
     */
    protected function checkActiveDisable()
    {
        if (isset($this->param['get']['active']) and isset($this->param['get']['id'])) {
 
            if ($this->param['get']['active']=='toActive') {
                $activeStatusValue = 1;
            } elseif ($this->param['get']['active']=='toDisable') {
                $activeStatusValue = 0;
            }
            
            try {
                $connection = $this->getInput('entityManager',1)->getConnection();
                $connection->beginTransaction();
                $connection->update('zfcms_comuni_albo_articoli', array(
                        'attivo' => $activeStatusValue
                    ),
                    array('id' => $this->param['get']['id'])
                );
                $connection->commit();
            } catch (\Exception $e) {
                $this->getConnection()->rollBack();
                return $this->setErrorMessage($e->getMessage());
            }
        }
    }
    
    public function checkPublish()
    {
        if ( isset($this->param['post']['publishId']) ) {
            
            $connection = $this->getInput('entityManager',1)->getConnection();
            $connection->beginTransaction();
            try {
                $connection->update('zfcms_comuni_albo_articoli', array(
                        'pubblicare' => 1,
                        'attivo'     => 1,
                        'annullato'  => 0,
                    ),
                    array('id' => $this->param['post']['publishId'])
                );
                $connection->commit();
            } catch (\Exception $e) {
                $connection->rollBack();
                return $this->setErrorMessage($e->getMessage());
            }
            
        }
    }
    
    public function checkRevision()
    {
        if ( isset($this->param['post']['revisionId']) ) {
            $redirect = $this->getInput('redirect', 1);
            $redirect->toUrl( $this->getInput('baseUrl',1).'formdata/albo-pretorio/'.$this->param['post']['revisionId'].'/?revision=1');
        }
    }
    
    public function checkAnnull()
    {
        $id = isset($this->param['post']['annullId']) ? $this->param['post']['annullId'] : null;
        if ($id) {
            $connection = $this->getInput('entityManager',1)->getConnection();
            $connection->beginTransaction();
            try {
                $connection->update('zfcms_comuni_albo_articoli', array(
                        'annullato' => 1
                    ),
                    array('id' => $id)
                );
                $connection->commit();
            } catch (\Exception $e) {
                $connection->rollBack();
                return $this->setErrorMessage($e->getMessage());
            }
        }
    }
}
