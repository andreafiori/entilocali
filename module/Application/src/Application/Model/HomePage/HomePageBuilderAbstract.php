<?php

namespace Application\Controller\HomePage;

use \Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  16 April 2015
 */
abstract class HomePageBuilderAbstract
{
    const maximumElementOnList = 35;

    protected $objectWrapper;

    protected $entityManager;

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param RecordsGetterWrapperAbstract $wrapper
     */
    public function setObjectWrapper(RecordsGetterWrapperAbstract $wrapper)
    {
        $this->objectWrapper = $wrapper;
    }

    /**
     * @return RecordsGetterWrapperAbstract
     */
    public function getObjectWrapper()
    {
        return $this->objectWrapper;
    }
}