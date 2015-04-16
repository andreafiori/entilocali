<?php

namespace Application\Controller\AlboPretorio;

use Application\Controller\SetupAbstractController;
use Application\Model\AlboPretorio\AlboPretorioFormSearch;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetter;
use Admin\Model\AlboPretorio\AlboPretorioSezioniGetterWrapper;
use Admin\Model\Users\Settori\UsersSettoriGetter;
use Admin\Model\Users\Settori\UsersSettoriGetterWrapper;

class AlboPretorioController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeFrontendWebsite();

        $page = $this->params()->fromRoute('page');
        $em   = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $wrapper = new AlboPretorioArticoliGetterWrapper( new AlboPretorioArticoliGetter($em) );
        $wrapper->setInput(array(
            'annullato'  => 0,
            'pubblicare' => 1,
            'attivo'     => 1,
        ));
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage(isset($page) ? $page : null);

        $sezioniWrapper = new AlboPretorioSezioniGetterWrapper( new AlboPretorioSezioniGetter($em) );
        $sezioniWrapper->setInput(array());
        $sezioniWrapper->setupQueryBuilder();

        $usersSettoriWrapper = new UsersSettoriGetterWrapper( new UsersSettoriGetter($em) );
        $usersSettoriWrapper->setInput(array('orderBy' => 'settore.nome ASC'));
        $usersSettoriWrapper->setupQueryBuilder();

        $formSearch = new AlboPretorioFormSearch();
        $formSearch->addSezioni( $this->formatForDropwdown(
            $sezioniWrapper->getRecords(),
            'id',
            'nome'
        ));
        $formSearch->addSettori( $this->formatForDropwdown(
            $usersSettoriWrapper->getRecords(),
            'id',
            'nome'
        ));
        $formSearch->addCheckExpired();
        $formSearch->addCsrf();
        $formSearch->addFrontendSubmitButton();

        $this->layout()->setVariables(array(
            'templatePartial'   => 'albo-pretorio/albo-pretorio.phtml',
            'form'              => $formSearch,
            'paginator'         => $wrapper->getPaginator(),
            'records'           => $wrapper->setupRecords(),
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * @param array $recordset
     * @param $idFieldName
     * @param $valueFieldName
     * @return array|bool
     */
    private function formatForDropwdown(array $recordset, $idFieldName, $valueFieldName)
    {
        if ($recordset) {
            $arrayToReturn = array();
            foreach($recordset as $record) {

                if (!isset($record[$idFieldName])) {
                    break;
                }

                $arrayToReturn[$record[$idFieldName]] = isset($record[$valueFieldName]) ? $record[$valueFieldName] : null;
            }
            return $arrayToReturn;
        }

        return false;
    }
}