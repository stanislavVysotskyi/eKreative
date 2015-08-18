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
     * Set userFrom
     *
     * @param \eKreativeBundle\Entity\User $userFrom
     * @return Message
     */
    public function setUserFrom(\eKreativeBundle\Entity\User $userFrom = null)
    {
        $this->userFrom = $userFrom;

        return $this;
    }

    /**
     * Get userFrom
     *
     * @return \eKreativeBundle\Entity\User 
     */
    public function getUserFrom()
    {
        return $this->userFrom;
    }
}
