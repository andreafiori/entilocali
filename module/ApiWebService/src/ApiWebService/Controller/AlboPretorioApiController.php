<?php

namespace ApiWebService\Controller;

use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * @author Andrea Fiori
 * @since  26 April 2014
 */
class AlboPretorioApiController extends AbstractActionController
{
    /**
     * Get Albo Pretorio Atti
     * 
     * @return array
     */
    public function indexAction()
    {
        $entityManager = $this->getServiceLocator()->get('\Doctrine\ORM\EntityManager');
        
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->add('select', "numero, anno, oggetto ")
                     ->add('from', 'Application\Entity\AlboAtti aa, Application\Entity\AlboSettori as, Application\Entity\AlboSezioni asz')
                     ->add('where', "aa.settore = as.id AND aa.sezione = asz.id ");
        
        return new JsonModel(
                array(
                        "status" => 200,
                        "data" => '',
                        "page" => 1,
                )			
        );
    }
}