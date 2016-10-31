<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\MediaRepository")
 */
class Media
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
	 * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Album")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $album;

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
	 * @var string
	 *
	 * @ORM\Column(name="description", type="text")
	 */
	private $description;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="size", type="decimal", precision=10, scale=0)
	 */
	private $size;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="extension", type="string", length=10)
	 */
	private $extension;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="path", type="string", length=255)
	 */
	private $path;


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
	 * @return Media
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
	 * @return Media
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
	 * Set description
	 *
	 * @param string $description
	 *
	 * @return Media
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
	 * Set size
	 *
	 * @param string $size
	 *
	 * @return Media
	 */
	public function setSize($size)
	{
		$this->size = $size;

		return $this;
	}

	/**
	 * Get size
	 *
	 * @return string
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * Set extension
	 *
	 * @param string $extension
	 *
	 * @return Media
	 */
	public function setExtension($extension)
	{
		$this->extension = $extension;

		return $this;
	}

	/**
	 * Get extension
	 *
	 * @return string
	 */
	public function getExtension()
	{
		return $this->extension;
	}

	/**
	 * Set path
	 *
	 * @param string $path
	 *
	 * @return Media
	 */
	public function setPath($path)
	{
		$this->path = $path;

		return $this;
	}

	/**
	 * Get path
	 *
	 * @return string
	 */
	public function getPath()
	{
		return $this->path;
	}

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Media
     */
    public function setUser(\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set album
     *
     * @param \AdminBundle\Entity\Album $album
     *
     * @return Media
     */
    public function setAlbum(\AdminBundle\Entity\Album $album)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return \AdminBundle\Entity\Album
     */
    public function getAlbum()
    {
        return $this->album;
    }
}
