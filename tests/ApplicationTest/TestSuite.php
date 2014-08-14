<?php

namespace ApplicationTest;

use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use ApplicationTest\ServiceManagerGrabber;
use Application\Model\NullException;

/**
 * Help other test on this centralized test suite to set all main objects and options
 * 
 * @author Andrea Fiori
 * @since  14 January 2014
 */
class TestSuite extends \PHPUnit_Framework_TestCase
{
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;
    protected $serviceManager;
    protected $entityManagerMock;
    
    protected function setUp()
    {
        $serviceManagerGrabber = new ServiceManagerGrabber();
        $this->serviceManager = $serviceManagerGrabber->getServiceManager();

        $this->request    = new Request();

        $config = $this->serviceManager->get('Config');
        $routerConfig = isset($config['router']) ? $config['router'] : array();

        $this->routeMatch = new RouteMatch(array('controller' => 'index'));
        
        $this->event = new MvcEvent();
        $this->event->setRouter( HttpRouter::factory($routerConfig) );
        $this->event->setRouteMatch($this->routeMatch);
    }

    protected function getDoctrineEntityManager()
    {
        if (! $this->getServiceManager() ) {
            throw new NullException('Service Manager is not set');
        }

        return $this->getServiceManager()->get('Doctrine\ORM\EntityManager');
    }

    protected function getServiceManager()
    {
        return $this->serviceManager;
    }
    
    protected function getEntityManagerMock()
    {
        if ( !$this->entityManagerMock ) {
            $this->entityManagerMock = $this->setEntityManagerMock();
        }

        return $this->entityManagerMock;
    }

    /**
     * Mock Entity Manager Repository main methods
     */
    protected function setEntityManagerMock()
    {
        $configuration = $this->getMockBuilder('\Doctrine\ORM\Configuration')->getMock();

        $connection = $this->getConnectionMock();

        $queryBuilder = $this->getQueryBuilderMock();

        $this->entityManagerMock = $this->getMock('\Doctrine\ORM\EntityManager', array('getRepository', 'getClassMetadata', 'persist', 'flush', 'create', 'createQuery', 'getConnection', 'getQuery', 'getQueryBuilder', 'getConfiguration'), array(), '', false);

        $this->entityManagerMock
                 ->expects($this->any())
                 ->method('getClassMetadata')
                 ->will($this->returnValue( (object)array('name' => 'aClass')) );

        $this->entityManagerMock
                ->expects($this->any())
                ->method('persist')
                ->will($this->returnValue(true));

        $this->entityManagerMock
                ->expects($this->any())
                ->method('flush')
                ->will($this->returnValue(true));

        $this->entityManagerMock
                 ->expects($this->any())
                 ->method('getConfiguration')
                 ->will($this->returnValue($configuration));

        $this->entityManagerMock
                 ->expects($this->any())
                 ->method('getConnection')
                 ->will($this->returnValue($connection));
        
        $this->entityManagerMock
                 ->expects($this->any())
                 ->method('getQuery')
                 ->will($this->returnValue($queryBuilder));
        
        $this->entityManagerMock
                 ->expects($this->any())
                 ->method('getQueryBuilder')
                 ->will($this->returnValue($queryBuilder));
        
        $this->entityManagerMock
                ->expects($this->any())
                ->method('createQuery')
                ->will( $this->returnValue( $this->getQueryBuilderMock()) );
        
        return $this->entityManagerMock;
    }
    
    public function getConnectionMock()
    {
        $mock = $this->getMockBuilder('Doctrine\DBAL\Connection')
            ->disableOriginalConstructor()
            ->setMethods(
                array(
                    'beginTransaction',
                    'commit',
                    'rollback',
                    'prepare',
                    'query',
                    'executeQuery',
                    'executeUpdate',
                    'getDatabasePlatform',
                )
            )
            ->getMock();
 
        $mock->expects($this->any())
            ->method('prepare')
            ->will($this->returnValue('A string'));
 
        $mock->expects($this->any())
            ->method('query')
            ->will($this->returnValue($this->getQueryBuilderMock()));

        return $mock;
    }
    
    public function getQueryBuilderMock()
    {
        $queryBuilderMock = $this->getMock('\Doctrine\ORM\QueryBuilder', 
                array('setFirstResult', 'setMaxResults', 'add', 'setParameter', 'setParameters', 'where', 'andWhere', 'getQuery', 'getResult', 'getScalarResult'),
                array(), '', false);
        
        $queryBuilderMock->expects($this->any())
                     ->method('setFirstResult')
                     ->will( $this->returnValue( $queryBuilderMock ) );
        
        $queryBuilderMock->expects($this->any())
                     ->method('setMaxResults')
                     ->will( $this->returnValue( $queryBuilderMock ) );
        
        $queryBuilderMock->expects($this->any())
                         ->method('add')
                         ->will( $this->returnValue( $queryBuilderMock ) );
        
        $queryBuilderMock->expects($this->any())
                         ->method('setParameter')
                         ->will( $this->returnValue( $queryBuilderMock ) );
        
        $queryBuilderMock->expects($this->any())
                         ->method('setParameters')
                         ->will( $this->returnValue( $queryBuilderMock ) );

        $queryBuilderMock->expects($this->any())
                         ->method('where')
                         ->will( $this->returnValue( $queryBuilderMock ) );
        
        $queryBuilderMock->expects($this->any())
                         ->method('andWhere')
                         ->will( $this->returnValue( $queryBuilderMock ) );

        $queryBuilderMock->expects($this->any())
                         ->method('getQuery')
                         ->will( $this->returnValue( $queryBuilderMock ) );
        
        $queryBuilderMock
                 ->expects($this->any())
                 ->method('getResult')
                 ->will($this->returnValue( array("id" => 1,"myResult" => 'MyResult')) );
        
        return $queryBuilderMock;
    }
    
    /**
     * Simulate a common request
     * 
     * @return array
     */
    public function getFrontendCommonInput()
    {
        return array(
            'serviceLocator'        => $this->getServiceManager(),
            'entityManager'         => $this->getEntityManagerMock(),
            'queryBuilder'          => $this->getQueryBuilderMock(),
            
            'languageId'            => 1,
            'languageAbbreviation'  => 'it',
            'channelId'             => 1,
            
            'title'                 => 'My Title',
            'category'              => 'My Category Name',
        );
    }
    
}