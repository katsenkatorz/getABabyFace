<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AdminBundle\Entity\Album;
use AdminBundle\Form\AlbumType;
use UserBundle\Entity\User;


/**
 * Album controller.
 *
 */
class AlbumController extends Controller
{
	/**
	 * Lists all Album entities.
	 *
	 * @throws \LogicException
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$albums = $em->getRepository('AdminBundle:Album')->findAll();

		return $this->render('AdminBundle:album:index.html.twig', ['albums' => $albums,]);
	}

	/**
	 * Creates a new Album entity.
	 *
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 * @throws \LogicException
	 */
	public function newAction(Request $request)
	{
		$album = new Album();
		$date = new \DateTime();
		$user = $this->getUser();

		$form  = $this->createForm('AdminBundle\Form\AlbumType', $album);
		$form->handleRequest($request);

		$album->setCreated($date);
		$album->setUser($user);

		if ($form->isSubmitted() && $form->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($album);
			$em->flush();

			return $this->redirectToRoute('album_show', ['id' => $album->getId()]);
		}

		return $this->render('AdminBundle:album:new.html.twig', ['album' => $album, 'form' => $form->createView(),]);
	}

	/**
	 * Finds and displays a Album entity.
	 *
	 * @param Album $album
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function showAction(Album $album)
	{
		$deleteForm = $this->createDeleteForm($album);

		return $this->render('AdminBundle:album:show.html.twig', ['album' => $album, 'delete_form' => $deleteForm->createView(),]);
	}

	/**
	 * Displays a form to edit an existing Album entity.
	 *
	 * @param Request $request
	 * @param Album $album
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 * @throws \LogicException
	 */
	public function editAction(Request $request, Album $album)
	{
		$deleteForm = $this->createDeleteForm($album);
		$editForm   = $this->createForm('AdminBundle\Form\AlbumType', $album);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($album);
			$em->flush();

			return $this->redirectToRoute('album_edit', ['id' => $album->getId()]);
		}

		return $this->render('AdminBundle:album:edit.html.twig', ['album' => $album, 'edit_form' => $editForm->createView(), 'delete_form' => $deleteForm->createView(),]);
	}

	/**
	 * Deletes a Album entity.
	 *
	 * @param Request $request
	 * @param Album $album
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, Album $album)
	{
		$form = $this->createDeleteForm($album);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->remove($album);
			$em->flush();
		}

		return $this->redirectToRoute('album_index');
	}

	/**
	 * Creates a form to delete a Album entity.
	 *
	 * @param Album $album The Album entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Album $album)
	{
		return $this->createFormBuilder()->setAction($this->generateUrl('album_delete', ['id' => $album->getId()]))->setMethod('DELETE')->getForm();
	}
}
