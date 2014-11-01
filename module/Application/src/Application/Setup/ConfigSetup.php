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

    /**
     * 
     * 
     * @param type $channel
     * @param type $languageId
     * @return type
     */
    public function setConfigurations($channel = 1, $languageId = 1)
    {
        $onfigurationsFromDb = $this->getQueryBuilder()->add('select', 'c.name, c.value')
                                                        ->add('from', 'Application\Entity\ZfcmsConfig c ')
                                                        ->add('where', 'c.channelId IN ( :channelId , 0 ) AND c.languageId IN ( :languageId , 0 )')
                                                        ->setParameter('channelId', $channel)
                                                        ->setParameter('languageId', $languageId)
                                                        ->getQuery()->getResult();

        if ($onfigurationsFromDb) {
            $configurations = array();
            foreach($onfigurationsFromDb as $config) {
                if ( isset($config['name']) and isset($config['value']) ) {
                    $configurations[$config['name']] = $config['value'];
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
