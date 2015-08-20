<?php

namespace eKreativeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 */
class Message
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $userFrom;

    /**
     * @var integer
     */
    private $userTo;
    /**
     * @var string
     */
    private $topic;

    /**
     * @var string
     */
    private $body;

    /**
     * @var boolean
     */
    private $sent = false;

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
     * Set topic
     *
     * @param string $topic
     * @return Message
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return string 
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Message
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
     * Set userTo
     *
     * @param \eKreativeBundle\Entity\User $userTo
     * @return Message
     */
    public function setUserTo(\eKreativeBundle\Entity\User $userTo = null)
    {
        $this->userTo = $userTo;

        return $this;
    }

    /**
     * Get userTo
     *
     * @return \eKreativeBundle\Entity\User 
     */
    public function getUserTo()
    {
        return $this->userTo;
    }

    /**
     * Set sent
     *
     * @param $sent
     * @return Message
     */
    public function setSent( $sent = null )
    {
        $this->sent = $sent != null ? false : true;

        return $this;
    }

    /**
     * Get sent
     *
     * @return \bool 
     */
    public function getSent()
    {
        return $this->sent;
    }
}
