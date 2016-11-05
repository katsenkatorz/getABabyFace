<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;


/**
 * Album
 *
 * @ORM\Table(name="album")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\AlbumRepository")
 */
class Album
{
	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $user;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=100)
	 */
	private $name;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="created", type="datetime")
	 */
	private $created;


	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return Album
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set created
	 *
	 * @param \DateTime $created
	 *
	 * @return Album
	 */
	public function setCreated($created)
	{
		$this->created = $created;

		return $this;
	}

	/**
	 * Get created
	 *
	 * @return \DateTime
	 */
	public function getCreated()
	{
		return $this->created;
	}

	/**
	 * Set user
	 *
	 * @param User $user
	 *
	 * @return Album
	 */
	public function setUser(User $user)
	{
		$this->user = $user;

		return $this;
	}

	/**
	 * Get user
	 *
	 * @return User
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->getName();
	}
}
