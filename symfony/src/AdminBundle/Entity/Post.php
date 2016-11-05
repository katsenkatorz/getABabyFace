<?php

namespace AdminBundle\Entity;

use AdminBundle\Entity\Album;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;


/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\PostRepository")
 */
class Post
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
	 * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", cascade={"persist"})
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $User;

	/**
	 * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Album", cascade={"persist","remove"})
	 * @ORM\JoinColumn(name="id", referencedColumnName="id", onDelete="CASCADE")
	 */
	private $Album;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=80)
	 */
	private $name;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="description", type="text", nullable=true)
	 */
	private $description;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="created", type="datetime")
	 */
	private $created;


    /**
     * Get id
     *
     * @return integer
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
     * @return Post
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
     * Set description
     *
     * @param string $description
     *
     * @return Post
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Post
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
     * @param \UserBundle\Entity\User $user
     *
     * @return Post
     */
    public function setUser(\UserBundle\Entity\User $user)
    {
        $this->User = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * Set Album
     *
     * @param \AdminBundle\Entity\Album $album
     *
     * @return Post
     */
    public function setAlbum(\AdminBundle\Entity\Album $album)
    {
        $this->Album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return \AdminBundle\Entity\Album
     */
    public function getAlbum()
    {
        return $this->Album;
    }
}
