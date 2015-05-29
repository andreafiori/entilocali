<?php

namespace Admin\Controller\Sezioni;

use Admin\Model\Languages\LanguagesFormSearch;
use Admin\Model\Languages\LanguagesGetter;
use Admin\Model\Languages\LanguagesGetterWrapper;
use Admin\Model\Sezioni\SezioniControllerHelper;
use Admin\Model\Sezioni\SezioniGetter;
use Admin\Model\Sezioni\SezioniGetterWrapper;
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

                $rowToAdd = array(
                    $row['nome'],
                    $row['colonna'],
                    (!empty($row['url'])) ? '<a href="'.$row['url'].'" target="_blank" title="'.$row['url'].'">Vai al link</a>' : null,
                    !empty($row['image']) ?
                        '<img src="'.$publicDirRelativePath.'/common/icons/'.$row['image'].'" alt="'.$row['image'].'">'
                        : '&nbsp;',
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