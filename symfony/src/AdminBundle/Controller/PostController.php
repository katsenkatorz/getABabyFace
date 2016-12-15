<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Media;
use AdminBundle\Form\PostType;
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
	 * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
	 * @throws \LogicException
	 */
	public function newAction(Request $request)
	{
		$post = new Post();


		$form  = $this->createForm(PostType::class, $post);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid())
		{
			$date = new \DateTime();
			$user = $this->getUser();
			//TODO : Mettre dans un service
			//$media = new Media();
			/** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file */
			//$file = $post->getMedia()->getName();

			//$fileName =  md5(uniqid('', true)).'.'.$file->guessExtension();

			//$media->setMimeType($file->getMimeType());
			//$media->setName($fileName);
			//$media->setOriginalName($file->getClientOriginalName());
			//$media->setPath($file->getPath());
			//$media->setSize($file->getSize());

			// Move the file to the directory where brochures are stored
			//$file->move($this->getParameter('media_directory'),$fileName);

			$post->setCreated($date);
			$post->setUser($user);
			//$post->setMedia($media);

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
		$editForm   = $this->createForm(PostType::class, $post);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($post);
			$em->flush();

			return $this->redirectToRoute('post_edit', ['id' => $post->getId()]);
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
