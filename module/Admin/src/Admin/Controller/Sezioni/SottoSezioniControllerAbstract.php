<?php

namespace Admin\Controller\Sezioni;

use Application\Controller\SetupAbstractController;

class SottoSezioniControllerAbstract extends SetupAbstractController
{
    /**
     * Format common columns values for the summary
     *
     * @param $records
     * @return array
     */
    protected function formatRecordsToShowOnTable($records)
    {
        $arrayToReturn = array();
        if ($records) {
            foreach($records as $key => $row) {
                $rowToAdd = array(
                    $row['nomeSottoSezione'],
                    $row['nomeSezione'],
                    array(
                        'type'      => 'updateButton',
                        'href'      => 'formdata/sottosezioni-contenuti/'.$row['idSottoSezione'],
                        'title'     => 'Modifica'
                    ),
                );

                //if ($this->getAcl()->hasResource('amministrazione_trsparente_sottosezioni_delete')) {
                    $rowToAdd[] = array(
                        'type'      => 'deleteButton',
                        'href'      => '#',
                        'data-id'   => $row['idSottoSezione'],
                        'title'     => 'Elimina'
                    );
                //}

                //if ($this->getAcl()->hasResource('amministrazione_trsparente_sottosezioni_update')) {
                    $rowToAdd[] = array(
                        'type' => 'positionButton',
                        'href' => $this->url()->fromRoute('admin/posizioni-sottosezioni', array(
                                'lang'              => $this->params()->fromRoute('lang'),
                                'languageSelection' => $this->params()->fromRoute('languageSelection'),
                                'sezioneId'         => $row['idSezione'],
                            )
                        ),
                        'title' => 'Gestione posizioni'
                    );
                //}

                $arrayToReturn[] = $rowToAdd;
            }
        }

        return $arrayToReturn;
    }
}