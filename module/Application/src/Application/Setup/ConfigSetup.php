<?php

namespace Application\Setup;

use Application\Model\QueryBuilderSetterAbstract;

/**
 * Get formatted Config records from db
 * 
 * @author Andrea Fiori
 * @since  02 April 2014
 */
class ConfigSetup extends QueryBuilderSetterAbstract
{
    private $configurations;

    public function setConfigurations($channel = 1, $languageId = 1)
    {
        $this->configurations = $this->getQueryBuilder()->add('select', 'c.nome, c.valore')
                                                        ->add('from', 'Application\Entity\Config c ')
                                                        ->add('where', 'c.canaleId IN ( :canale , 0 ) AND c.linguaId IN ( :lingua , 0 )')
                                                        ->setParameter('canale', $channel)
                                                        ->setParameter('lingua', $languageId)
                                                        ->getQuery()->getResult();

        if ($this->configurations) {
            $configurations = array();
            foreach($this->configurations as $config) {
                    $configurations[$config['nome']] = $config['valore'];
            }
        }

        return $configurations;
    }
}
