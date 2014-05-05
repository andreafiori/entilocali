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
        $onfigurationsFromDb = $this->getQueryBuilder()->add('select', 'c.nome, c.valore')
                                                        ->add('from', 'Application\Entity\Config c ')
                                                        ->add('where', 'c.canaleId IN ( :canale , 0 ) AND c.linguaId IN ( :lingua , 0 )')
                                                        ->setParameter('canale', $channel)
                                                        ->setParameter('lingua', $languageId)
                                                        ->getQuery()->getResult();

        if ($onfigurationsFromDb) {
            $configurations = array();
            foreach($onfigurationsFromDb as $config) {
                if ( isset($config['nome']) and isset($config['valore']) ) {
                    $configurations[$config['nome']] = $config['valore'];
                }
            }
            $this->configurations = $configurations;
        }
        
        return $this->configurations;
    }
    
    public function getConfigurations()
    {
        return $this->configurations;
    }
    
}
