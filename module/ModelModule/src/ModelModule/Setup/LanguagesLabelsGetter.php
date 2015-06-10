<?php

namespace ModelModule\Setup;

use ModelModule\Model\QueryBuilderHelperAbstract;

class LanguagesLabelsGetter extends QueryBuilderHelperAbstract
{
    public function setLanguagesLabels()
    {
            $languageLabelsFromDb = $this->getQueryBuilder()->add('select', 'll.nome, ll.valore, ll.descrizione, ll.isbackend')
                                                            ->add('from', 'Application\Entity\LingueEtichette ll ')
                                                            ->add('where', 'll.linguaId = :language AND (ll.isbackend = 0 OR ll.isuniversal = 1) ')
                                                            ->getQuery()->getResult();

            return $this->formatLanguageLabelsFromDb($languageLabelsFromDb);
    }

    /**
     * @param array $languageLabelsFromDb
     * @return array $languageLabels
     */
    private function formatLanguageLabelsFromDb(array $languageLabelsFromDb)
    {
        $languageLabels = array();
        foreach($languageLabelsFromDb as $lLabels) {
            if (isset($lLabels['labelName']) and isset($lLabels['labelValue'])) {
                $languageLabels[$lLabels['labelName']] = $lLabels['labelValue'];
            }
        }

        return $languageLabels;
    }
}