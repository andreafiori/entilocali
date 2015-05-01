<?php

namespace Admin\Controller\AttiConcessione;

use Admin\Model\AttiConcessione\AttiConcessioneGetter;
use Admin\Model\AttiConcessione\AttiConcessioneGetterWrapper;
use Application\Controller\SetupAbstractController;

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

        $wrapper = new AttiConcessioneGetterWrapper( new AttiConcessioneGetter($em) );
        $wrapper->setInput(array('orderBy' => ''));
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($em) );
        $wrapper->setupPaginatorCurrentPage( isset($page) ? $page : null );

        $paginator          = $wrapper->getPaginator();
        $paginatorItemCount = $wrapper->getPaginator()->getTotalItemCount();
        $paginatorRecords   = $this->formatArticoliRecords($wrapper->setupRecords());

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