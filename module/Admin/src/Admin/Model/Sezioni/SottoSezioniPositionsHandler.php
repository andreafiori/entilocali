<?php

namespace Admin\Model\Sezioni;

use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;

/**
 * @author Andrea Fiori
 * @since  27 March 2015
 */
class SottoSezioniPositionsHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    public function setupRecord()
    {
        $param = $this->getInput('param', 1);

        if (!isset($param['route']['sezioneId'])) {

            $errorTitle     = 'Sezione non rilevata';
            $errorMessage   = 'Impossibile rilevare i dati relativi alla sezione';

            $this->setVariables(array(
                    'errorTitle'    => $errorTitle,
                    'errorMessage'  => $errorMessage,
                )
            );

            return false;

        }

        $sottoSezioniRecords = $this->getSottoSezioniRecords(array(
            'sezioneId'         => $param['route']['sezioneId'],
            'profonditaDa'      => isset($param['route']['profonditaDa']) ? $param['route']['profonditaDa'] : 0,
            'orderBy'           => 'sottosezioni.posizione ASC'
        ));

        // 2nd level
        if (!empty($sottoSezioniRecords)) {

            foreach ($sottoSezioniRecords as &$sottoSezione) {

                $sottoSezioniRecords2ndLevel = $this->getSottoSezioniRecords(array(
                    'profonditaDa'      => $sottoSezione['idSottoSezione'],
                    'sezioneId'         => $sottoSezione['idSezione'],
                    'orderBy'           => 'sottosezioni.posizione ASC'
                ));

                if (!empty($sottoSezioniRecords2ndLevel)) {
                    $sottoSezione['secondo_livello'] = 1;
                } else {
                    $sottoSezione['secondo_livello'] = null;
                }

            }

        }

        $this->setVariables(array(
            'records' => isset($sottoSezioniRecords) ? $sottoSezioniRecords : null,
        ));

        $this->setTemplate('sezioni/sottosezioni/positions.phtml');
    }

    /**
     * @param array $input
     * @return \Application\Model\QueryBuilderHelperAbstract
     */
    private function getSottoSezioniRecords($input = array())
    {
        $wrapper = new SottoSezioniGetterWrapper(new SottoSezioniGetter($this->getInput('entityManager',1)));
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();

        return $wrapper->getRecords();
    }
}