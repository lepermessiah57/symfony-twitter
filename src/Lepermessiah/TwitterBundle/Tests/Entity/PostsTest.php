<?php

namespace Lepermessiah\TwitterBundle\Tests\Entity;

use Lepermessiah\TwitterBundle\Entity\Posts;

class PostsTest extends \PHPUnit_Framework_TestCase {

	private $post;

	public function setUp(){
		$this->post = new Posts();
	}

	public function testSetCreateDateToNowWillSetTheCreateDate(){
		//setup
		$date = new \DateTime();
		$expected_date = $date->format('m/d/y');

		//action
		$this->post->setCreateDateToNow();

		//assertion
		$actual = $this->post->getCreateDate()->format('m/d/y');
		$this->assertEquals($expected_date, $actual);
	}

}