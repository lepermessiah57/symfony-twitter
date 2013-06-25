<?php

namespace Lepermessiah\TwitterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Posts
 *
 * @ORM\Table(name="posts")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Posts
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="create_date", type="datetime")
     */
    private $createDate;

    /**
     * @ORM\Column(name="post", type="string", length=140)
     */
    private $post;

    /**
     *@ORM\ManyToOne(targetEntity="Users")
     */
    private $user;

    public function getId()
    {
        return $this->id;
    }

    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    
        return $this;
    }

    public function getCreateDate()
    {
        return $this->createDate;
    }

    public function setPost($post)
    {
        $this->post = $post;
    
        return $this;
    }

    public function getPost()
    {
        return $this->post;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreateDateToNow(){
        $this->setCreateDate(new \DateTime());
    }
}

