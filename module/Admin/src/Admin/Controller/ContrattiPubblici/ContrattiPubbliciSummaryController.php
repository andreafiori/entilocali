<?php

namespace Admin\Controller\ContrattiPubblici;

use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciControllerHelper;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper;
use ModelModule\Model\Users\Settori\UsersSettoriGetter;
use ModelModule\Model\Users\Settori\UsersSettoriGetterWrapper;
use Application\Controller\SetupAbstractController;
use ModelModule\Model\ContrattiPubblici\ContrattiPubbliciFormSearch;

class ContrattiPubbliciSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $em         = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $page       = $this->params()->fromRoute('page');
        $perPage    = $this->params()->fromRoute('perpage');

        $helper = new ContrattiPubbliciControllerHelper();
        $wrapper = $helper->recoverWrapperRecordsPaginator(
            new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em)),
            array('orderBy' => 'cc.id DESC'),
            $page,
            $perPage
        );

        $wrapperYears = new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em));
        $wrapperYears->setInput(array(
            'fields'    => 'DISTINCT(cc.anno) AS anno',
            'orderBy'   => 'cc.anno'
        ));
        $wrapperYears->setupQueryBuilder();

        $years = $wrapperYears->getRecords();

        $yearsArray = array();
        foreach($years as $year) {
            if (isset($year['anno'])) {
                $yearsArray[] = $year['anno'];
            }
        }

        $wrapperSettori = new UsersSettoriGetterWrapper(new UsersSettoriGetter($em));
        $wrapperSettori->setInput(array());
        $wrapperSettori->setupQueryBuilder();

        $settoriRecords = $wrapperSettori->getRecords();

        $settori = array();
        foreach($settoriRecords as $settore) {
            if (isset($settore['id']) and isset($settore['nome']) and isset($settore['surname'])) {
                $settori[$settore['id']] = $settore['nome'].' '.$settore['name'].' '.$settore['surname'];
            }
        }

        $formSearch = new ContrattiPubbliciFormSearch();
        $formSearch->addMainFormElements();
        $formSearch->addYears($yearsArray);
        $formSearch->addSettori($settori);
        $formSearch->addSubmit();

        $paginator = $wrapper->getPaginator();

        $wrapper->setEntityManager($em);
        $wrapperRecords = $wrapper->addAttachmentsFromRecords($wrapper->setupRecords());

        $paginatorRecords = $this->formatArticoliRecords($wrapperRecords);

        $this->layout()->setVariables(array(
                'tableTitle'        => 'Contratti pubblici',
                'tableDescription'  => $paginator->getTotalItemCount()." contratti in archivio",
                'formSearch'        => $formSearch,
                'columns' =>array(
                    "Oggetto del bando",
                    "Struttura proponente \ responsabili",
                    "Aggiudicatario",
                    /*
                    "Scelta del Contraente",
                    "Elenco degli Operatori invitati a presentare offerte",
                    "Vedi elenco" (posizione precednete)
                    */
                    "Scelta del contraente",
                    "Importo somme liquidate Euro",
                    /*
                    "Inserito da",
                    "Operatori invitati a presentare le offerte",
                    */
                    "Tempi",
                    "&nbsp;",
                    "&nbsp;",
                    "&nbsp;",
                    "&nbsp;",
                    "&nbsp;",
                ),
                'paginator'         => $paginator,
                'records'           => $paginatorRecords,
                'templatePartial'   => 'datatable/datatable_contratti_pubblici.phtml'
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
            $lang = $this->params()->fromRoute('lang');

            $arrayToReturn = array();
            if ($records) {
                foreach($records as $key => $row) {
                    $arrayToReturn[] = array(
                        "<strong>CIG:</strong> ".$row['cig']."<br><br><strong>Oggetto del bando</strong>: ".$row['titolo']."<br><br><strong>Anno:</strong> ".$row['anno']."<br><br> <strong>Data contratto:</strong> ".$row['dataInserimento'],
                        "<strong>CF:</strong> <br><br><strong>Str. prop.:</strong> ".$row['nomeSettore']."<br><br> <strong>Resp. Proc.:</strong> ".$row['responsabileUsersName'],
                        "<br><strong>Data aggiudicazione:</strong> <br><br> <strong>Importo di aggiudicazione (Euro):</strong> ".$row['importoAggiudicazione'],
                        '<strong>Numero di offerte ammesse:</strong> '.$row['numeroOfferte']."<br><br><strong>Procedura di scelta del contraente:</strong> ".$row['nomeScelta'],
                        $row['importoLiquidato'].' &euro;',
                        "<strong>Inizio lavori:</strong> ".date_format(date_create($row['dataInizioLavori']), 'd-m-Y')."<br><br> <strong>Fine lavori:</strong> ".$row['dataFineLavori']."<br><br> <strong>Scadenza:</strong> ".$row['scadenza'],
                        array(
                            'type'      => 'multiuserButton',
                            'href'      =>  $this->url()->fromRoute('admin/contratti-pubblici-aggiudicatari', array(
                                'lang'  => $lang,
                                'id'    => $row['id'],
                            )),
                            'title'     => 'Elenco aggiudicatari \ partecipanti',
                        ),
                        array(
                            'type' => 'updateButton',
                            'href' => $this->url()->fromRoute('admin/contratti-pubblici-form', array(
                                    'lang'  => $lang,
                                    'id'    => $row['id']
                                )
                            ),
                            'title'     => 'Modifica'
                        ),
                        array(
                            'type'      => 'deleteButton',
                            'href'      => '#',
                            'title'     => 'Elimina',
                            'data-id'   => $row['id']
                        ),
                        array(
                            'type'      => 'homepageDelButton',
                            'href'      => '#',
                            'value'     => 'homepageDelButton',
                        ),
                        array(
                            'type' => 'attachButton',
                            'href' => $this->url()->fromRoute('admin/attachments-summary', array(
                                'lang'          => $lang,
                                'module'        => 'contratti-pubblici',
                                'referenceId'   => $row['id']
                            )),
                            'title' => 'Gestione allegati',
                            'attachmentsFilesCount' => isset($row['attachments']) ? count($row['attachments']) : 0,
                        ),
                    );
                }
            }

            return $arrayToReturn;
        }
}