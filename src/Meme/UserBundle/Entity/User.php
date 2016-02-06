<?php

namespace Meme\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Meme\MemeBundle\Entity\Meme
     */
    private $memes;

    /**
     * @var \Meme\MemeBundle\Entity\Tag
     */
    private $tags;
    
    /**
     * @var \DateTime
     */
    private $insertedAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;
    
    
    public function __construct()
    {
        parent::__construct();
        $this->memes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set memes
     *
     * @param \Meme\MemeBundle\Entity\Meme $memes
     * @return User
     */
    public function setMemes(\Meme\MemeBundle\Entity\Meme $memes = null)
    {
        $this->memes = $memes;

        return $this;
    }

    /**
     * Get memes
     *
     * @return \Meme\MemeBundle\Entity\Meme
     */
    public function getMemes()
    {
        return $this->memes;
    }

    /**
     * Set tags
     *
     * @param \Meme\MemeBundle\Entity\Tag $tags
     * @return User
     */
    public function setTags(\Meme\MemeBundle\Entity\Tag $tags = null)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return \Meme\MemeBundle\Entity\Tag
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set insertedAt
     *
     * @param \DateTime $insertedAt
     * @return User
     */
    public function setInsertedAt($insertedAt)
    {
        $this->insertedAt = $insertedAt;

        return $this;
    }

    /**
     * Get insertedAt
     *
     * @return \DateTime 
     */
    public function getInsertedAt()
    {
        return $this->insertedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return User
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
