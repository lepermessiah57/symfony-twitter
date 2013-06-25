<?php

namespace Lepermessiah\TwitterBundle\Service\Posts;

use Symfony\Component\DependencyInjection\ContainerAware;

class PostsManager extends ContainerAware {
	
	public function listAllPosts(){
		$entity_manager = $this->getEntityManager();
		$repository = $entity_manager->getRepository('LepermessiahTwitterBundle:Posts');

		return $repository->findAll();	
	}

	public function savePost($post){
		$entity_manager=$this->getEntityManager();
		$entity_manager->persist($post);
		$entity_manager->flush();
	}

	protected function getEntityManager(){
		return $this->container->get('doctrine')->getEntityManager();
	}
}