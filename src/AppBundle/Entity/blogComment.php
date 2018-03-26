<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * blogComment
 *
 * @ORM\Table(name="blog_comment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\blogCommentRepository")
 */
class blogComment
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
     * @var int
     *
     * @ORM\Column(name="postID", type="bigint")
     */
    private $postID;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

    /**
     * @var int
     *
     * @ORM\Column(name="submitter", type="integer")
     */
    private $submitter;

    /**
     * @var int
     *
     * @ORM\Column(name="dateSubmit", type="bigint")
     */
    private $dateSubmit;


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
     * Set postID
     *
     * @param integer $postID
     *
     * @return blogComment
     */
    public function setPostID($postID)
    {
        $this->postID = $postID;

        return $this;
    }

    /**
     * Get postID
     *
     * @return int
     */
    public function getPostID()
    {
        return $this->postID;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return blogComment
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set submitter
     *
     * @param integer $submitter
     *
     * @return blogComment
     */
    public function setSubmitter($submitter)
    {
        $this->submitter = $submitter;

        return $this;
    }

    /**
     * Get submitter
     *
     * @return int
     */
    public function getSubmitter()
    {
        return $this->submitter;
    }

    /**
     * Set dateSubmit
     *
     * @param integer $dateSubmit
     *
     * @return blogComment
     */
    public function setDateSubmit($dateSubmit)
    {
        $this->dateSubmit = $dateSubmit;

        return $this;
    }

    /**
     * Get dateSubmit
     *
     * @return int
     */
    public function getDateSubmit()
    {
        return $this->dateSubmit;
    }
}

