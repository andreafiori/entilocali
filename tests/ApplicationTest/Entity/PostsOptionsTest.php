<?php

namespace ApplicationTest\Entity;

use Doctrine\Common\Persistence\ObjectManager;	

class PostsOptionRepository
{
	private $entityManager;
	private $repository = 'Application\Entity\PostsOptions';

    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function getPostsOptionById($id)
    {
    	$postsOptions = $this->entityManager->getRepository($this->repository);
        $record = $postsOptions->find($id);

        return $record->getId();
	}
}


class SalaryCalculatorTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		parent::setUp();
	}

	public function testCalculateTotalSalary()
	{
		// Mock to use on the test
		$postsOption = $this->getMock('\Application\Entity\PostsOptions');
		$postsOption->expects($this->once())
				 ->method('getId')
				 ->will($this->returnValue(11));
		
		/*
		$postsOption->expects($this->once())
					->method('getTitle')
				 	->will($this->returnValue("MyPostTitle"));
		*/

		// Repository mock get the mock of the repository Entity
		$postsOptionRepository = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
								   ->disableOriginalConstructor()
								   ->getMock();
		
		$postsOptionRepository->expects($this->once())
						   ->method('find')
						   ->will($this->returnValue($postsOption));

		// infine, serve il mock di EntityManager, per restituire il mock del repository
		// can use \Doctrine\ORM\EntityManager IS BETTER!
		$entityManager = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
							  ->disableOriginalConstructor()
							  ->getMock();
		
		$entityManager->expects($this->once())
					  ->method('getRepository')
					  ->will($this->returnValue($postsOptionRepository));

		$postsOptionRepository = new PostsOptionRepository($entityManager);
		
		$this->assertEquals(11, $postsOptionRepository->getPostsOptionById(140));
	}
}