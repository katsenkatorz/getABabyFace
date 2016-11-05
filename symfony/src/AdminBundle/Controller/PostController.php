<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Entity\Post;

/**
 * Media controller.
 *
 */
class PostController extends Controller
{
	/**
	 * Lists all Post entities.
	 *
	 * @throws \LogicException
	 */
	public function indexAction()
	{

		$em = $this->getDoctrine()->getManager();

		$posts = $em->getRepository('AdminBundle:Post')->findAll();

		return $this->render('AdminBundle:post:index.html.twig', ['posts' => $posts]);
	}

	/**
	 * Creates a new Post entity.
	 *
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 * @throws \LogicException
	 */
	public function newAction(Request $request)
	{
		$post = new Post();
		$date = new \DateTime();
		$user = $this->getUser();

		$form  = $this->createForm('AdminBundle\Form\PostType', $post);
		$form->handleRequest($request);

		$post->setCreated($date);
		$post->setUser($user);

		if ($form->isSubmitted() && $form->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($post);
			$em->flush();

			return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
		}

		return $this->render('AdminBundle:post:new.html.twig', ['post' => $post, 'form' => $form->createView(),]);
	}

	/**
	 * Finds and displays a Post entity.
	 *
	 * @param Post $post
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function showAction(Post $post)
	{
		$deleteForm = $this->createDeleteForm($post);

		return $this->render('AdminBundle:post:show.html.twig', ['post' => $post, 'delete_form' => $deleteForm->createView(),]);
	}

	/**
	 * Displays a form to edit an existing Post entity.
	 *
	 * @param Request $request
	 * @param Post $post
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 * @throws \LogicException
	 */
	public function editAction(Request $request, Post $post)
	{
		$deleteForm = $this->createDeleteForm($post);
		$editForm   = $this->createForm('AdminBundle\Form\PostType', $post);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($post);
			$em->flush();

			return $this->redirectToRoute('album_edit', ['id' => $post->getId()]);
		}

		return $this->render('AdminBundle:post:edit.html.twig', ['post' => $post, 'edit_form' => $editForm->createView(), 'delete_form' => $deleteForm->createView(),]);
	}

	/**
	 * Deletes a Album entity.
	 *
	 * @param Request $request
	 * @param Post $post
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 * @throws \LogicException
	 */
	public function deleteAction(Request $request, Post $post)
	{
		$form = $this->createDeleteForm($post);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->remove($post);
			$em->flush();
		}

		return $this->redirectToRoute('post_index');
	}

	/**
	 * Creates a form to delete a Post entity.
	 *
	 * @param Post $post The Post entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Post $post)
	{
		return $this->createFormBuilder()->setAction($this->generateUrl('post_delete', ['id' => $post->getId()]))->setMethod('DELETE')->getForm();
	}

}
