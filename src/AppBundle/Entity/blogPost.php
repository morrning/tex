<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * blogPost
 *
 * @ORM\Table(name="blog_post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\blogPostRepository")
 */
class blogPost
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
     * @ORM\Column(name="SID", type="string", length=255)
     */
    private $SID;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

    /**
     * @var int
     *
     * @ORM\Column(name="dateSubmit", type="bigint")
     */
    private $dateSubmit;

    /**
     * @var int
     *
     * @ORM\Column(name="submitter", type="integer")
     */
    private $submitter;

    /**
     * @var int
     *
     * @ORM\Column(name="canComment", type="string", length=10)
     */
    private $canComment;


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
     * @return blogPost
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
     * Set body
     *
     * @param string $body
     *
     * @return blogPost
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
     * Set dateSubmit
     *
     * @param integer $dateSubmit
     *
     * @return blogPost
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

    /**
     * Set submitter
     *
     * @param integer $submitter
     *
     * @return blogPost
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
     * Set canComment
     *
     * @param integer $canComment
     *
     * @return blogPost
     */
    public function setCanComment($canComment)
    {
        $this->canComment = $canComment;

        return $this;
    }

    /**
     * Get canComment
     *
     * @return int
     */
    public function getCanComment()
    {
        return $this->canComment;
    }

    /**
     * @return string
     */
    public function getSID()
    {
        return $this->SID;
    }

    /**
     * @param string $SID
     */
    public function setSID($SID)
    {
        $this->SID = $SID;
    }


}

