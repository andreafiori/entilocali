<?php

namespace ApplicationTest;

use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use Application\Model\NullException;

/**
 * Help other test on this centralized test suite to set all main objects and options
 * 
 * @author Andrea Fiori
 * @since  14 January 2014
 */
abstract class TestSuite extends \PHPUnit_Framework_TestCase
{
    protected $request;
    protected $response;
    protected $router;
    protected $routeMatch;
    protected $event;
    protected $serviceManager;
    protected $entityManagerMock;
    
    protected function setUp()
    {
        $serviceManagerGrabber = new ServiceManagerGrabber();
        
        $this->serviceManager = $serviceManagerGrabber->getServiceManager();
        
        $config = $this->serviceManager->get('Config');
        
        $this->request = new Request();
        
        $this->router = HttpRouter::factory(isset($config['router']) ? $config['router'] : array());
        $this->routeMatch = new RouteMatch(array('controller' => 'index'));
        
        $this->event = new MvcEvent();
        $this->event->setRouter($this->router);
        $this->event->setRouteMatch($this->routeMatch);
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     * @throws NullException
     */
    public function getDoctrineEntityManager()
    {
        if (! $this->getServiceManager() ) {
            throw new NullException('Service Manager is not set');
        }

        return $this->getServiceManager()->get('Doctrine\ORM\EntityManager');
    }

    /**
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }
    
    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManagerMock()
    {
        if ( !$this->entityManagerMock ) {
            $this->entityManagerMock = $this->setEntityManagerMock();
        }

        return $this->entityManagerMock;
    }

    /**
     * Mock Entity Manager Repository main methods
     */
    public function setEntityManagerMock()
    {
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
                 ->will($this->returnValue( $this->getMockBuilder('\Doctrine\ORM\Configuration')->getMock() ));

        $this->entityManagerMock
                 ->expects($this->any())
                 ->method('getConnection')
                 ->will($this->returnValue($this->getConnectionMock()));
        
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
                                            'insert',
                                            'update',
                                            'delete',
                                        )
                                    )
                                    ->getMock();
 
        $mock->expects($this->any())
             ->method('prepare')
             ->will($this->returnValue('A string'));
 
        $mock->expects($this->any())
             ->method('query')
             ->will($this->returnValue($this->getQueryBuilderMock()));

        $mock->expects($this->any())
            ->method('insert')
            ->will( $this->returnValue(true) );

        $mock->expects($this->any())
            ->method('update')
            ->will( $this->returnValue(true) );

        $mock->expects($this->any())
            ->method('delete')
            ->will( $this->returnValue(true) );

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
