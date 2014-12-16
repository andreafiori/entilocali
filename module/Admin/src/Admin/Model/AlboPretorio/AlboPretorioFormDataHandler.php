<?php

namespace Admin\Model\AlboPretorio;

use Admin\Model\FormData\FormDataAbstract;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  22 July 2014
 */
class AlboPretorioFormDataHandler extends FormDataAbstract
{
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $param = $this->getInput('param',1);
             
        $records = $this->getArticolo(
                new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($this->getInput('entityManager'))),
                isset($param['route']['option']) ? $param['route']['option'] : null
        );
        
        $form = new AlboPretorioArticoliForm();
        $form->addSezioni($this->getSezioni(new AlboPretorioSezioniGetterWrapper(new AlboPretorioSezioniGetter($this->getInput('entityManager')))));
        $form->addLastFields();
        $form->addScadenze();
        
        if (is_array($records) and count($records)==1) {
            $records[0]['userId'] = $this->getInput('userDetails',1)->id;
            $form->setData($records[0]);

            $formAction = 'albo-pretorio/update/'.$records[0]['id'];
            $formTitle = $records[0]['titolo'];
            
            if ($records[0]['annullato']==1) {
                $this->setTemplate('message.phtml');
                $this->setVariables(array(
                    'messageType'   => 'danger',
                    'messageTitle'  => 'Articolo annullato',
                    'messageText'   => "Articolo annullato. Impossibile modificare l'articolo."
                ));
                return false;
            }
            
            // TODO: check se articolo già revisionato
            
        } else {
            $form->setData(array('userId'=>$this->getInput('userDetails',1)->id));
            $formAction = 'albo-pretorio/insert/';
            $formTitle = 'Nuovo atto';
        }
        
        /* Get users list */
        $records = $this->getUsers(
            new UsersGetterWrapper(new UsersGetter($this->getInput('entityManager')))
        );
 
        $this->setVariables(array(
                'form' => $form,
                'formAction'        => $formAction,
                'formTitle'         => $formTitle,
                'rettificaWarning'  => '',
                'formDescription'   => "Compila i dati relativi all'atto da inserire sull'albo pretorio",
                'formBreadCrumbCategory'     => 'Albo pretorio',
                'formBreadCrumbCategoryLink' => $this->getInput('baseUrl', 1).'datatable/albo-pretorio/'
            )
        );
    }

    /**
     * @param AlboPretorioArticoliGetterWrapper $recodsGetter
     * @param int $id
     * @return array|null
     */
    public function getArticolo(AlboPretorioArticoliGetterWrapper $recodsGetter, $id)
    {
        if (is_numeric($id)) {
            $recodsGetter->setInput( array('id' => $id) );
            $recodsGetter->setupQueryBuilder();

            return $recodsGetter->getRecords();
        }
    }
    
    /**
     * @param UsersGetterWrapper $recodsGetter
     * @return type
     */
    public function getUsers(UsersGetterWrapper $recodsGetter)
    {
        $recodsGetter->setInput(array('fields'=>'u.id,u.name,u.surname'));
        $recodsGetter->setupQueryBuilder();

        return $recodsGetter->getRecords();
    }
    
    /**
     * @param \Admin\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper $recodsGetter
     * @return type
     */
    public function getSezioni(AlboPretorioSezioniGetterWrapper $recodsGetter)
    {
        $recodsGetter->setInput(array());
        $recodsGetter->setupQueryBuilder();

        return $recodsGetter->getRecords();
    }
}
