<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Picture
 *
 * @ORM\Table(name="pictures")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PictureRepository")
 */
class Picture
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=255)
     */
    private $file;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="views", type="integer")
     */
    private $views;

    /**
     * @return int
     */
    public function getViews(){
        return $this->views;
    }

    /**
     * @return Picture
     */
    public function setViews(){
        $this->views++;
        return $this;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="uploaderId", type="integer")
     */
    private $uploaderId;

    /**
     * @param integer $uploaderId
     *
     * @return Picture
     */
    public function setUploaderId($uploaderId)
    {
        $this->uploaderId = $uploaderId;
        return $this;
    }

    /**
     * @return int
     */
    public function getUploaderId()
    {
        return $this->uploaderId;
    }

    /**
     * @param integer $uploaderId
     *
     * @return Picture
     */
    public function setPicture($uploaderId)
    {
        $this->uploaderId = $uploaderId;
        return $this;
    }

    /**
     * @return int
     */
    public function getPicture()
    {
        return $this->uploaderId;
    }

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="pictures")
     * @ORM\JoinColumn(name="uploaderId", referencedColumnName="id")
     */
    private $uploader;

    /**
     * @param \AppBundle\Entity\User $uploader
     *
     * @return Picture
     */
    public function setUploader(User $uploader = null)
    {
        $this->uploader = $uploader;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\User
     */
    public function getUploader()
    {
        return $this->uploader;
    }

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
     * Set title
     *
     * @param string $title
     *
     * @return Picture
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set file
     *
     * @param string $file
     *
     * @return Picture
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Picture
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    public function __construct()
    {
        $this->date = new \DateTime('now');
    }


    /**
     * @var int
     * @ORM\Column(name="category_id", type="integer")
     */
    private $categoryId;

    /**
     * @return int
     */
    public function getCategoryId(){
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     */
    public function setCategoryId(int $categoryId){
        $this->categoryId = $categoryId;
    }

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", inversedBy="pictures")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @return Category
     */
    public function getCategory(){
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public  function setCategory(Category $category = null){
        $this->category = $category;
    }
}

