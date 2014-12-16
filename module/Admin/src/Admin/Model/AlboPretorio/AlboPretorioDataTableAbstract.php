<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\DataTable\DataTableInterface;
use Admin\Model\DataTable\DataTableAbstract;
use Zend\Session\Container as SessionContainer;

/**
 * @author Andrea Fiori
 * @since  02 November 2014
 */
abstract class AlboPretorioDataTableAbstract extends DataTableAbstract implements DataTableInterface
{
    /**
     * Session Key where it stores post from form
     */
    const sessionPostKey = 'alboPretorioDataTable';
    
    protected $param;
    
    protected $recordsGetter;
    
    /**
     * @return array
     */
    protected function setupArticoliInput($attiUfficiali = 0)
    {
        $articoliInput = array('orderBy' => 'aa.id DESC');

        $sessionPost = new SessionContainer();

        if ( isset($this->param['post']) ) {
            $articoliInput = array(
                'anno'      => isset($this->param['post']['anno']) ? $this->param['post']['anno'] : null,
                'search'    => isset($this->param['post']['search']) ? $this->param['post']['search'] : null,
                'orderBy'   => isset($this->param['post']['orderby']) ? $this->param['post']['orderby'] : 'aa.id DESC'
            );
            $sessionPost->offsetSet(self::sessionPostKey, $articoliInput);
        } else {
            $postFromSession = $sessionPost->offsetGet(self::sessionPostKey);
            if ($postFromSession) {
                $articoliInput = $postFromSession;
            }
        }

        return $articoliInput;
    }

    /**
     * @param \AlboPretorioFormAbstract $form
     * @param string $labelName
     * @param string $labelValue
     * @return \Zend\Form\Form
     */
    protected function setupFormSearchAndExport(AlboPretorioFormAbstract $form, $labelName = null, $labelValue = null)
    {
        $form->addMonths();
        $form->addYears( $this->recordsGetter->getYears() );
        $form->addSezioni( $this->getSezioni( array('orderBy' => 'aps.nome') ) );
        $form->addSettori( $this->getSettori( array('fields' => 'DISTINCT(u.settore) AS settore, u.id', 'groupBy'=>'settore') ));
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
     * @return type
     */
    protected function getSezioni(array $input)
    {
        $this->recordsGetter->setSezioni($input);

        return $this->recordsGetter->formatSezioniForFormSelect('id','nome');
    }

    /**
     * @param array $input
     * @return type
     */
    protected function getSettori(array $input)
    {
        $this->recordsGetter->setSettori($input);

        return $this->recordsGetter->formatSezioniForFormSelect('id','settore');
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
                
                $arrayLine = array(
                    $record['numeroAtto']." / ".$record['anno'],
                    $record['titolo'],
                    $record['nome'],
                    $record['dataScadenza'],
                    ($record['pubblicare']==1) ? $record['dataAttivazione'] : 'Non ancora pubblicato',
                    $record['userName'].' '.$record['userSurname'],
                );
                
                $arrayLine[] = array(
                    'type'      => 'attachButton',
                    'href'      => $this->getInput('baseUrl',1).'formdata/attachments/'.$modulePrefixLink.'/'.$record['id'],
                );
                
                if ($record['annullato']) {
                    $arrayLine[] = array(
                        'type' => 'alboAnnulledButton',
                    );
                } else {
                    if ($record['pubblicare']==1) {                        
                        $arrayLine[] = array(
                            'type'      => 'alboRettificaButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/'.$modulePrefixLink.'/'.$record['id'].'/?rettifica=1',
                            'title'     => 'Rettifica articolo',
                            'data-id'   => $record['id']
                        );
                    } else {
                        // Note: quando l'articolo non è pubblicato, non è possibile modificarlo!?
                        /*
                        $activeDisableButtonValue = ($record['attivo']!=0) ? 'toDisable' : 'toActive';
                        $arrayLine[] = array(
                            'type'      => $record['attivo']!=0 ? 'activeButton' : 'disableButton',
                            'href'      => '?active='.$activeDisableButtonValue.'&amp;id='.$record['id'],
                            'value'     => $record['attivo'],
                            'title'     => 'Attiva \ Disattiva'
                        );
                        */
                        $arrayLine[] = array(
                            'type'      => 'alboPublishButton',
                            'href'      => '?publish='.$record['id'],
                            'data-id'   => $record['id'],
                            'title'     => 'Pubblica articolo'
                        );
                        
                        $arrayLine[] = array(
                            'type'      => 'updateButton',
                            'href'      => $this->getInput('baseUrl',1).'formdata/'.$modulePrefixLink.'/'.$record['id'],
                            'title'     => 'Modifica articolo'
                        );
                    }

                    $arrayLine[] = array(
                        'type'      => 'relatapdfButton',
                        'href'      => '#',
                    );

                    $arrayLine[] = array(
                        'type'      => 'enteterzoButton',
                        'href'      => $this->getInput('baseUrl',1).'invio-ente-terzo/'.$modulePrefixLink.'/'.$record['id'],
                    );

                    if ($record['pubblicare']==1) {
                        $arrayLine[] = array(
                            'type'      => 'alboAnnullButton',
                            'href'      => '#',
                            'data-id'   => $record['id'],
                            'title'     => 'Annulla articolo'
                        );
                    }
                }
                
                $arrayToReturn[] = $arrayLine;
            }
        }

        return $arrayToReturn;
    }
    
    /**
     * 
     * @param type $paginatorRecords
     * @param type $title
     * @return type
     */
    protected function recoverCommonColumnsAndProperties($paginatorRecords, $title = 'Albo pretorio')
    {
        return array(
            'tableTitle'        => $title,
            'tableDescription'  => 'Elenco atti.',
            'tablesetter'       => 'albo-pretorio',
            'columns' => array(
                array('label' => 'Num \ Anno', 'width' => '10%'),
                array('label' => 'Titolo', 'width' => '33%'),
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
            
            try {
                $connection = $this->getInput('entityManager',1)->getConnection();
                $connection->beginTransaction();
                $connection->update('zfcms_comuni_albo_articoli', array(
                        'pubblicare' => 1
                    ),
                    array('id' => $this->param['post']['publishId'])
                );
                $connection->commit();
            } catch (\Exception $e) {
                $this->getConnection()->rollBack();
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
        $id = isset($this->param['post']['revisionId']) ? $this->param['post']['revisionId'] : null;
        if ($id) {
            try {
                $connection = $this->getInput('entityManager',1)->getConnection();
                $connection->beginTransaction();
                $connection->update('zfcms_comuni_albo_articoli', array(
                        'annullato' => 1
                    ),
                    array('id' => $id)
                );
                $connection->commit();
            } catch (\Exception $e) {
                $this->getConnection()->rollBack();
                return $this->setErrorMessage($e->getMessage());
            }
        }
    }
}
