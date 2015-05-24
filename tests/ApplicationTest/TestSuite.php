<?php

namespace ApplicationTest;

use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Http\PhpEnvironment\Request as PhpEnviromentRequest;
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
    /**
     * @var PhpEnviromentRequest
     */
    protected $request;

    /**
     * @var \Zend\Http\Response
     */
    protected $response;

    protected $router;

    /**
     * @var RouteMatch
     */
    protected $routeMatch;

    /**
     * @var MvcEvent
     */
    protected $event;

    /**
     * @var ServiceManagerGrabber
     */
    protected $serviceManager;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManagerMock;

    protected function setUp()
    {
        $serviceManagerGrabber = new ServiceManagerGrabber();
        
        $this->serviceManager = $serviceManagerGrabber->getServiceManager();
        $this->serviceManager->setAllowOverride(true);
        $this->serviceManager->setService('doctrine.entitymanager.orm_default', $this->getEntityManagerMock());
        
        $config = $this->serviceManager->get('Config');

        $this->request = new PhpEnviromentRequest();

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
                                            'lastInsertId',
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

        $mock->expects($this->any())
            ->method('lastInsertId')
            ->will( $this->returnValue(1) );

        return $mock;
    }
    
    public function getQueryBuilderMock()
    {
        $mock = $this->getMock('\Doctrine\ORM\QueryBuilder',
                array('setFirstResult', 'setMaxResults', 'add', 'setParameter', 'setParameters', 'where', 'andWhere', 'getQuery', 'getResult', 'getScalarResult'),
                array(), '', false);

        $mock->expects($this->any())
                     ->method('setFirstResult')
                     ->will( $this->returnValue( $mock ) );

        $mock->expects($this->any())
                     ->method('setMaxResults')
                     ->will( $this->returnValue( $mock ) );

        $mock->expects($this->any())
                         ->method('add')
                         ->will( $this->returnValue( $mock ) );

        $mock->expects($this->any())
                         ->method('setParameter')
                         ->will( $this->returnValue( $mock ) );

        $mock->expects($this->any())
                         ->method('setParameters')
                         ->will( $this->returnValue( $mock ) );

        $mock->expects($this->any())
                         ->method('where')
                         ->will( $this->returnValue( $mock ) );

        $mock->expects($this->any())
                         ->method('andWhere')
                         ->will( $this->returnValue( $mock ) );

        $mock->expects($this->any())
                         ->method('getQuery')
                         ->will( $this->returnValue( $mock ) );

        $mock->expects($this->any())
                        ->method('getResult')
                        ->will($this->returnValue( array(
                            array(
                                "id" => 1,
                                'idSottoSezione' => 1,
                                'nomeSezione' => 'my section',
                                'nomeSottoSezione' => 'my sub-section',
                            ),
                            array(
                                'name'  => 'sitename',
                                'value' => 'My website',
                            ),
                            array(
                                'name' => 'project_frontend',
                                'value' => 'myProjectName'
                            ),
                            array(
                                'name'  => 'projectdir_frontend',
                                'value' => 'myProjectDirFrontend'
                            ),
                            array(
                                'name'  => 'template_frontend',
                                'value' => 'myTemplateNameFrontend'
                            ),
                        )
                        ));
        
        return $mock;
    }

    /**
     * S3 class mock
     */
    public function getAmazonS3Mock()
    {
        $mock = $this->getMock(
                    '\Admin\Model\Amazon\S3\S3',
                    array('inputFile'),
                    array(),
                    '',
                    false
                );

        $mock->expects($this->any())
             ->method('inputFile')
             ->will( $this->returnValue($mock) );

        return $mock;
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
