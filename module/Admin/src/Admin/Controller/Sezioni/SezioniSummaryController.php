<?php

namespace Admin\Controller\Sezioni;

use ModelModule\Model\Languages\LanguagesFormSearch;
use ModelModule\Model\Languages\LanguagesGetter;
use ModelModule\Model\Languages\LanguagesGetterWrapper;
use ModelModule\Model\Sezioni\SezioniControllerHelper;
use ModelModule\Model\Sezioni\SezioniGetter;
use ModelModule\Model\Sezioni\SezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class SezioniSummaryController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout         = $this->initializeAdminArea();
        $em                 = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $languageSelection  = $this->params()->fromRoute('languageSelection');
        $page = $this->params()->fromRoute('page');

        $helper = new SezioniControllerHelper();
        $helper->setSezioniGetterWrapper(new SezioniGetterWrapper(new SezioniGetter($em)));
        $helper->setLanguagesGetterWrapper(new LanguagesGetterWrapper(new LanguagesGetter($em)));

        $formLanguage = $helper->setupLanguageFormSearch( new LanguagesFormSearch(), array('status'=>1), $languageSelection );

        $wrapper = $helper->recoverWrapperRecordsPaginator(
            $helper->getSezioniGetterWrapper(),
            array(
                'orderBy' => 'sezioni.id',
                'languageAbbreviation' => $languageSelection,
            ),
            $page,
            null
        );

        $paginator = $wrapper->getPaginator();

        $columns = array(
            "Nome",
            "Colonna",
            "URL",
            "Immagine",
            "&nbsp;",
            "&nbsp;",
        );

        if ( $this->layout()->getVariable('userDetails')->acl->hasResource('contenuti_sezioni_delete') ) {
            $columns[] = "&nbsp;";
        }

        $this->layout()->setVariables(array(
            'tableTitle'        => 'Sezioni',
            'tableDescription'  => $paginator->getTotalItemCount().' sezioni presenti',
            'columns'           => $columns,
            'paginator'         => $paginator,
            'records'           => $this->formatRecordsToShowOnTable( $wrapper->setupRecords() ),
            'templatePartial'   => 'datatable/datatable_sezioni.phtml',
            'formLanguage'      => !empty($formLanguage) ? $formLanguage : null,
        ));

        $this->layout()->setTemplate($mainLayout);
    }

    /**
     * @param array $records
     * @return array
     */
    private function formatRecordsToShowOnTable($records)
    {
        $arrayToReturn = array();
        if ($records) {
            $acl = $this->layout()->getVariable('userDetails');
            $publicDirRelativePath = $this->layout()->getVariable('publicDirRelativePath');
            foreach($records as $key => $row) {

                if ($row['attivo']==1) {
                    $enableDisableLink = '#';
                } else {
                    $enableDisableLink = '#';
                }

                $rowToAdd = array(
                    $row['nome'],
                    $row['colonna'],

                    (!empty($row['url'])) ? '<a href="'.$row['url'].'" target="_blank" title="'.$row['url'].' [apre in un\'altra pagina]">Vai al link</a>' : null,

                    !empty($row['image']) ?
                        '<img src="'.$publicDirRelativePath.'/common/icons/'.$row['image'].'" alt="'.$row['image'].'">'
                        : '&nbsp;',

                    array(
                        'type'      => $row['attivo']==1 ? 'activeButton' : 'disableButton',
                        'href'      => $enableDisableLink,
                        'value'     => $row['attivo'],
                        'title'     => $row['attivo']==1 ? 'Nascondi sezione sul sito' : 'Mostra sezione sul sito',
                    ),
                    array(
                        'type' => 'updateButton',
                        'href' => $this->url()->fromRoute('admin/sezioni-form', array(
                            'lang'              => $this->params()->fromRoute('lang'),
                            'id'                => $row['id'],
                            'languageSelection' => $this->params()->fromRoute('languageSelection'),
                            'previouspage'      => $this->params()->fromRoute('page'),
                        )),
                        'title' => 'Modifica sezione'
                    ),
                );

                if ( $acl->acl->hasResource('contenuti_sezioni_delete') ) {
                    $rowToAdd[] = array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'data-id'   => $row['id'],
                        'title'     => 'Elimina sezione'
                    );
                }

                $arrayToReturn[] = $rowToAdd;
            }
        }

        return $arrayToReturn;
    }
}