<?php

namespace Lepermessiah\TwitterBundle\Service\Posts;

use Symfony\Component\DependencyInjection\ContainerAware;

class PostsManager extends ContainerAware {
	
	public function listAllPosts(){
		$entity_manager = $this->container->get('doctrine')->getEntityManager();
		$repository = $entity_manager->getRepository('LepermessiahTwitterBundle:Posts');

		return $repository->findAll();	
	}

}