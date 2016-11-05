<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UserBundle\Entity\User;


/**
 * User controller.
 *
 */
class UserController extends Controller
{
	/**
	 * Lists all User entities.
	 *
	 * @throws \LogicException
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$users = $em->getRepository('UserBundle:User')->findAll();

		return $this->render('AdminBundle:user:index.html.twig', ['users' => $users]);
	}


}
