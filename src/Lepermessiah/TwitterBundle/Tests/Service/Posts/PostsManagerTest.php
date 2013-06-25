<?php

namespace Lepermessiah\TwitterBundle\Tests\Service\Posts;

use Lepermessiah\TwitterBundle\Service\Posts\PostsManager;
use Symfony\Component\DependencyInjection\Container;
use Phake;


class PostsManagerTest extends \PHPUnit_Framework_TestCase {

	private $posts_manager;
	private $container;
	private $entity_manager;
	private $doctrine;
	private $repository;

	public function setUp(){
		$this->container = new Container();
		$this->posts_manager = new PostsManager();
		$this->posts_manager->setContainer($this->container);

		$this->doctrine = Phake::mock('Doctrine\Bundle\DoctrineBundle\Registry');
		$this->entity_manager = Phake::mock('Doctrine\ORM\EntityManager');
		Phake::when($this->doctrine)->getEntityManager()->thenReturn($this->entity_manager);
		$this->container->set('doctrine', $this->doctrine);
		$this->repository = Phake::mock('Doctrine\ORM\EntityRepository');
		Phake::when($this->entity_manager)->getRepository('LepermessiahTwitterBundle:Posts')->thenReturn($this->repository);
	}

	public function testManagerIsContainerAware(){
		$this->assertInstanceOf('Symfony\Component\DependencyInjection\ContainerAware',$this->posts_manager);
	}

	public function testListAllPostsLooksUpAllPostsFromTheEntityRepository(){
		$this->posts_manager->listAllPosts();

		Phake::verify($this->repository)->findAll();
	}

	public function testListAllPostsWillReturnTheData(){
		$expected = array('here','is','my','data');
		Phake::when($this->repository)->findAll()->thenReturn($expected);	
		
		$actual = $this->posts_manager->listAllPosts();

		$this->assertEquals($expected, $actual);
	}

}