<?php

namespace Admin\Controller\Sezioni;

use ModelModule\Model\Sezioni\SottoSezioniGetter;
use ModelModule\Model\Sezioni\SottoSezioniGetterWrapper;
use Application\Controller\SetupAbstractController;

class SottoSezioniPositionsController extends SetupAbstractController
{
    public function indexAction()
    {
        $mainLayout = $this->initializeAdminArea();

        $sezioneId          = $this->params()->fromRoute('sezioneId');
        $profonditaDa       = $this->params()->fromRoute('profonditaDa');
        $languageSelection  = $this->params()->fromRoute('languageSelection');

        $sottoSezioniRecords = $this->getSottoSezioniRecords(array(
            'sezioneId'             => $sezioneId,
            'profonditaDa'          => $profonditaDa,
            'languageAbbreviation'  => $languageSelection,
            'isSs'                  => 0,
            'orderBy'               => 'sottosezioni.posizione ASC'
        ));

        // 2nd level selection
        if (!empty($sottoSezioniRecords)) {
            foreach ($sottoSezioniRecords as &$sottoSezione) {

                $sottoSezioniRecords2ndLevel = $this->getSottoSezioniRecords(array(
                    'profonditaDa'          => $sottoSezione['idSottoSezione'],
                    'sezioneId'             => $sottoSezione['idSezione'],
                    'languageAbbreviation'  => $languageSelection,
                    'isSs'                  => 0,
                    'orderBy'               => 'sottosezioni.posizione ASC'
                ));

                if (!empty($sottoSezioniRecords2ndLevel)) {
                    $sottoSezione['secondo_livello'] = 1;
                } else {
                    $sottoSezione['secondo_livello'] = null;
                }

            }
        }

        $this->layout()->setVariables(array(
            'records'           => isset($sottoSezioniRecords) ? $sottoSezioniRecords : null,
            'templatePartial'   => 'sezioni/sottosezioni-posizioni.phtml',
        ));

        $this->layout()->setTemplate($mainLayout);
    }

        /**
         * @param array $input
         * @return \ModelModule\Model\QueryBuilderHelperAbstract
         */
        private function getSottoSezioniRecords($input = array())
        {
            $wrapper = new SottoSezioniGetterWrapper(
                new SottoSezioniGetter($this->getServiceLocator()->get('doctrine.entitymanager.orm_default'))
            );
            $wrapper->setInput($input);
            $wrapper->setupQueryBuilder();

            return $wrapper->getRecords();
        }
}