<?php

namespace Admin\Controller\AttiConcessione;

use Admin\Model\AttiConcessione\AttiConcessioneControllerHelper;
use Admin\Model\AttiConcessione\AttiConcessioneGetter;
use Admin\Model\AttiConcessione\AttiConcessioneGetterWrapper;
use Admin\Model\Users\Settori\UsersSettoriGetter;
use Admin\Model\Users\Settori\UsersSettoriGetterWrapper;
use Application\Controller\SetupAbstractController;
use Application\Model\AttiConcessione\AttiConcessioneFormSearch;

/**
 * @author Andrea Fiori
 * @since  28 April 2015
 */
class AttiConcessioneSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $page       = $this->params()->fromRoute('page');

        $em         = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');


        $helper = new AttiConcessioneControllerHelper();
        $helper->setAttiConcessioneGetterWrapper( new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($em)) );
        $helper->setupYearsRecords( array(
            'fields' => 'DISTINCT(atti.anno) AS year',
            'orderBy' => 'atti.id DESC'
        ),
            $page,
            null
        );
        $helper->setAttiConcessioneGetterWrapper( new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($em)) );
        $helper->setupAttiConcessioneGetterWrapperWithPaginator(
            array('orderBy' => 'atti.id DESC'),
            $page,
            null
        );
        $helper->setUsersSettoriGetterWrapper( new UsersSettoriGetterWrapper(new UsersSettoriGetter($em)) );
        $helper->setupSettoriRecords( array('orderBy' => 'settore.nome') );

        $settoriForDropDown = $helper->getUsersSettoriRecords();

        $yearsForDropdown = $helper->formatYears( $helper->getYearsRecords() );

        $wrapperArticoli = $helper->getAttiConcessioneGetterWrapperWithPaginator();

        $form = new AttiConcessioneFormSearch();
        $form->addAnno($yearsForDropdown);
        $form->addMainElements();
        $form->addUfficio($settoriForDropDown);
        $form->addSubmitSearchButton();
        $form->addResetButton();

        $paginator          = $wrapperArticoli->getPaginator();

        $paginatorItemCount = $wrapperArticoli->getPaginator()->getTotalItemCount();

        $paginatorRecords   = $this->formatArticoliRecords($wrapperArticoli->setupRecords());

        $formSearch = new AttiConcessioneFormSearch();
        $formSearch->addMainElements();
        $formSearch->addAnno($yearsForDropdown);
        $formSearch->addUfficio($settoriForDropDown);
        $formSearch->addSubmitSearchButton();

        if ( empty($paginatorRecords) ) {
            $this->layout()->setVariables(array(
                    'messageType'        => 'warning',
                    'messageTitle'       => 'Nessun atto di concessione presente',
                    'messageDescription' => 'Nessun atto di concessione presente in archivio',
                )
            );
            $this->layout()->setTemplate($mainLayout);
            return false;
        }

        $this->layout()->setVariables(array(
                'tableTitle'        => 'Atti di concessione',
                'tableDescription'  => $paginatorItemCount." atti in archivio",
                'tablesetter'       => 'atti-concessione',
                'formSearch'        => $formSearch,
                'columns'           => array(
                        "Ufficio-Responsabile del Servizio - Responsabile del Procedimento",
                        "Num / Anno",
                        "CF / P. IVA Beneficiario",
                        "Modalità Assegnazione",
                        "Importo",
                        "Norma o Titolo a base dell'attribuzione",
                        "",
                        "",
                        "",
                        "",
                ),
                'paginator'         => $paginator,
                'records'           => $paginatorRecords,
                'templatePartial'   => 'datatable/datatable_atti_concessione.phtml'
            )
        );

        $this->layout()->setTemplate($mainLayout);
    }

        /**
         * @param array $records
         * @return array
         */
        private function formatArticoliRecords($records)
        {
            $arrayToReturn = array();

            if ($records) {
                foreach($records as $key => $row) {

                    if(isset($row['responsabile'])) {
                        $responsabile = $row['responsabile'];
                    } elseif (isset($row['nomeResp'])) {
                        $responsabile = $row['nomeResp'];
                    }

                    if (!isset($responsabile)) {
                        $responsabile = null;
                    }

                    $arrayToReturn[] = array(

                        (isset($responsabile))  ?
                            utf8_encode($row['nomeSezione']).'. <br><br>'.$responsabile
                            :
                            utf8_encode($row['nomeSezione']),

                        $row['progressivo']." / ".$row['anno'],
                        utf8_encode($row['beneficiario']),
                        utf8_encode($row['nomemodAssegnazione']),
                        utf8_encode($row['importo']),
                        utf8_encode($row['titolo']),
                        '<strong>Data inserimento:</strong> '.$row['dataInserimento'].' <br><br><strong>Scadenza:</strong> '.$row['scadenza'].'<br><br> <strong>Inserito da:</strong> '.$row['name'].' '.$row['surname'],
                        array(
                            'type'      => ($row['attivo']!=0) ? 'toDisable' : 'toActive',
                            'href'      => '?active=&amp;id='.$row['id'],
                            'value'     => $row['attivo'],
                            'title'     => 'Attiva \ Disattiva'
                        ),
                        array(
                            'type'      => 'updateButton',
                            'href'      => $this->url()->fromRoute('admin/atti-concessione-form', array('lang' => 'it', 'id' => $row['id']) ),
                            'title'     => 'Modifica'
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => '#',
                            'title'     => 'Elimina',
                            'data-id'   => $row['id'],
                        ),
                        array(
                            'type'      => 'attachButton',
                            'href'      => $this->url()->fromRoute('admin/attachments-form', array(
                                'lang'      => 'it',
                                'module'    => 'atti-concessione',
                                'id'        => $row['id']
                            )),
                            'title'     => 'Gestione allegati',
                        ),
                    );
                }
            }

            return $arrayToReturn;
        }
}