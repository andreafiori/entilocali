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
    /** session key where it stores post from form **/
    const sessionPostKey = 'alboPretorioDataTable';
    
    protected $param;
    
    protected $recordsGetter;
    
    /**
     * @return array
     */
    protected function setupArticoliInput($attiUfficiali=0)
    {
        $articoliInput = array();

        $sessionPost = new SessionContainer();

        if ( isset($this->param['post']) ) {
            $articoliInput = array(
                'anno'      => isset($this->param['post']['anno']) ? $this->param['post']['anno'] : null,
                'search'    => isset($this->param['post']['search']) ? $this->param['post']['search'] : null,
                'orderBy'   => isset($this->param['post']['orderby']) ? $this->param['post']['orderby'] : null
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
     * 
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
    protected function getFormattedDataTableRecords($records)
    {
        $arrayToReturn = array();
        if ($records) {
            foreach($records as $key => $row) {
                $arrayToReturn[] = array(
                    $row['numeroAtto']." / ".$row['anno'],
                    $row['titolo'],
                    $row['nome'],
                    $row['dataScadenza'],
                    $row['dataAttivazione'],
                    $row['userName'].' '.$row['userSurname'],
                    array(
                        'type'      => 'updateButton',
                        'href'      => $this->getInput('baseUrl',1).'formdata/albo-pretorio/'.$row['id'],
                        'title'     => 'Modifica articolo'
                    ),
                    array(
                        'type'      => 'relatapdfButton',
                        'href'      => '#',
                    ),
                    array(
                        'type'      => 'attachButton',
                        'href'      => $this->getInput('baseUrl',1).'formdata/attachments/albo-pretorio/'.$row['id'],
                    ),
                    array(
                        'type'      => 'enteterzoButton',
                        'href'      => $this->getInput('baseUrl',1).'invio-ente-terzo/albo-pretorio/'.$row['id'],
                    ),
                );
            }
        }

        return $arrayToReturn;
    }
}
