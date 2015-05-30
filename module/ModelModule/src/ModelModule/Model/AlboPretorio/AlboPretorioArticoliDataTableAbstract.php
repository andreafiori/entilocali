<?php

namespace ModelModule\Model\AlboPretorio;

use ModelModule\Model\DataTable\DataTableInterface;
use ModelModule\Model\DataTable\DataTableAbstract;
use ModelModule\Model\Logs\LogWriter;
use ModelModule\Model\Database\DbTableContainer;
use Zend\Session\Container as SessionContainer;

/**
 * TO DELETE!!! Move all this elements into its own controller and different models...
 *
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
        $articoliInput = array('orderBy' => 'alboArticoli.id DESC');

        $sessionPost = new SessionContainer();

        if ( isset($this->param['post']['search']) or isset($this->param['post']['hidden-search-field']) ) {
            $sessionPost->offsetSet(self::sessionPostKey, array(
                'numeroAtto' => isset($this->param['post']['numero_atto'])  ? $this->param['post']['numero_atto'] : null,
                'sezioneId'  => isset($this->param['post']['sezione'])      ? $this->param['post']['sezione'] : null,
                'mese'       => isset($this->param['post']['mese'])         ? $this->param['post']['mese'] : null,
                'anno'       => isset($this->param['post']['anno'])         ? $this->param['post']['anno'] : null,
                'search'     => isset($this->param['post']['search'])       ? $this->param['post']['search'] : null,
                'orderBy'    => isset($this->param['post']['orderby'])      ? $this->param['post']['orderby'] : 'alboArticoli.id DESC'
            ));
        }
        
        $postFromSession = $sessionPost->offsetGet(self::sessionPostKey);
        if ($postFromSession) {
            $articoliInput = $postFromSession;
        }
        
        if (!isset($articoliInput['orderBy']) or $articoliInput['orderBy']=='') {
            $articoliInput['orderBy'] = 'alboArticoli.id DESC';
        }
        
        return $articoliInput;
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
        $settoriRecords = $this->getSettori( array(
                'fields' => 'settore.id AS idSettore, settore.nome'
            )
        );

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

        return $this->recordsGetter->formatSezioniForFormSelect('id', 'nome');
    }

    protected function recoverSearchForms()
    {
        return array(
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
                $connection->update(DbTableContainer::alboArticoli, array(
                        'attivo' => $activeStatusValue
                    ),
                    array('id' => $this->param['get']['id'])
                );
                $connection->commit();

                /* Log */
                $log = new LogWriter($connection);
                $log->writeLog(array(

                ));

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

}
