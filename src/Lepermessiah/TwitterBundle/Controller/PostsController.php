<?php

namespace Lepermessiah\TwitterBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Lepermessiah\TwitterBundle\Entity\Posts;
use Lepermessiah\TwitterBundle\Form\PostsType;

/**
 * Posts controller.
 *
 * @Route("/posts")
 */
class PostsController extends Controller
{

    /**
     * Lists all Posts entities.
     *
     * @Route("/", name="posts")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $entities = $this->get('posts_manager')->listAllPosts();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Posts entity.
     *
     * @Route("/", name="posts_create")
     * @Method("POST")
     * @Template("LepermessiahTwitterBundle:Posts:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $post  = new Posts();
        $form = $this->createForm(new PostsType(), $post);
        $form->bind($request);

        if ($form->isValid()) {
            $this->get('posts_manager')->savePost($post);

            return $this->redirect($this->generateUrl('posts_show', array('id' => $post->getId())));
        }

        return array(
            'entity' => $post,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Posts entity.
     *
     * @Route("/new", name="posts_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Posts();
        $form   = $this->createForm(new PostsType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Posts entity.
     *
     * @Route("/{id}", name="posts_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $post = $this->get('posts_manager')->findPost($id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Posts entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $post,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Posts entity.
     *
     * @Route("/{id}/edit", name="posts_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $post = $this->get('posts_manager')->findPost($id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Posts entity.');
        }

        $editForm = $this->createForm(new PostsType(), $post);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $post,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Posts entity.
     *
     * @Route("/{id}", name="posts_update")
     * @Method("PUT")
     * @Template("LepermessiahTwitterBundle:Posts:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $post = $this->get('posts_manager')->findPost($id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Posts entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PostsType(), $post);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $this->get('posts_manager')->savePost($post);

            return $this->redirect($this->generateUrl('posts_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Posts entity.
     *
     * @Route("/{id}", name="posts_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $this->get('posts_manager')->deletePost($id);            
        }

        return $this->redirect($this->generateUrl('posts'));
    }

    /**
     * Creates a form to delete a Posts entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
