<?php

namespace Lepermessiah\TwitterBundle\Service\Posts;

use Symfony\Component\DependencyInjection\ContainerAware;

class PostsManager extends ContainerAware {
	
	public function listAllPosts(){
		$repository = $this->getRepository('LepermessiahTwitterBundle:Posts');

		return $repository->findAll();	
	}

	public function savePost($post){
		$entity_manager=$this->getEntityManager();
		$entity_manager->persist($post);
		$entity_manager->flush();
	}

	public function findPost($post_id){
		$repository = $this->getRepository('LepermessiahTwitterBundle:Posts');
		return $repository->find($post_id);
	}

	public function deletePost($post_id){
		$entity_manager=$this->getEntityManager();
		$post = $entity_manager->getReference('LepermessiahTwitterBundle:Posts',$post_id);
		$entity_manager->remove($post);
		$entity_manager->flush();
	}

	public function listPosts($user_id){
		$entity_manager=$this->getEntityManager();
		$repository=$this->getRepository('LepermessiahTwitterBundle:Posts', $user_id);
	
		return	$repository->findBy(array('user'=>$user_id));
	}

	protected function getEntityManager(){
		return $this->container->get('doctrine')->getEntityManager();
	}

	protected function getRepository($entity){
		$entity_manager = $this->getEntityManager();
		return $entity_manager->getRepository($entity);
	}
}