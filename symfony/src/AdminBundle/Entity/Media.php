<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Media
 *
 * @ORM\Table(name="file")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\MediaRepository")
 * @Vich\Uploadable
 */
class Media
{

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="original_name", type="string", length=100, nullable=true)
	 *
	 */
	private $originalName;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="size", type="integer", nullable=true)
	 *
	 */
	private $size;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="mime_type", type="string", length=100, nullable=true)
	 *
	 */
	private $mimeType;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="path", type="string", length=255, nullable=true)
	 *
	 */
	private $path;

	/**
	 * NOTE: This is not a mapped field of entity metadata, just a simple property.
	 *
	 * @Vich\UploadableField(mapping="media", fileNameProperty="imageName")
	 *
	 * @var File
	 */
	private $imageFile;

	/**
	 * @ORM\Column(type="string", length=255)
	 *
	 * @var string
	 */
	private $imageName;

	/**
	 * @ORM\Column(type="datetime")
	 *
	 * @var \DateTime
	 */
	private $updatedAt;

	/**
	 * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
	 * of 'UploadedFile' is injected into this setter to trigger the  update. If this
	 * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
	 * must be able to accept an instance of 'File' as the bundle will inject one here
	 * during Doctrine hydration.
	 *
	 * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
	 *
	 * @return Media
	 */
	public function setImageFile(File $image = null)
	{
		$this->imageFile = $image;

		if ($image)
		{
			// It is required that at least one field changes if you are using doctrine
			// otherwise the event listeners won't be called and the file is lost
			$this->updatedAt = new \DateTime('now');
		}

		return $this;
	}

	/**
	 * @return File|null
	 */
	public function getImageFile()
	{
		return $this->imageFile;
	}

	/**
	 * @param string $imageName
	 *
	 * @return Media
	 */
	public function setImageName($imageName)
	{
		$this->imageName = $imageName;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getImageName()
	{
		return $this->imageName;
	}



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
     * Set originalName
     *
     * @param string $originalName
     *
     * @return Media
     */
    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;

        return $this;
    }

    /**
     * Get originalName
     *
     * @return string
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }

    /**
     * Set size
     *
     * @param integer $size
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
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set mimeType
     *
     * @param string $mimeType
     *
     * @return Media
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get mimeType
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Media
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
