<?php

namespace GBE\PresentationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Email
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GBE\PresentationBundle\Entity\EmailRepository")
 */
class Email
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="object", type="string", length=255, nullable=true)
     */
    private $object;

    /**
     * @var array
     *
     * @ORM\Column(name="recipients", type="array", nullable=true)
     */
    private $recipients;                                            /* !!!!! */

    /**
     * @ORM\ManyToOne(targetEntity="GBE\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)                               
     */
    private $sender;                                                /* !!!!! */

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sentAt", type="datetime")
     */
    private $sentAt;

    /*   *********      construct  *************  */

    public function __construct()
    {
        $this->sentAt         = new \Datetime;
    }


    /*   *********     Setter and getter Functions  *************  */


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
     * Set object
     *
     * @param string $object
     * @return Email
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return string 
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set recipients
     *
     * @param array $recipients
     * @return Email
     */
    public function setRecipients($recipients)
    {
        $this->recipients = $recipients;

        return $this;
    }

    /**
     * Get recipients
     *
     * @return array 
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * Set sender
     *
     * @param array $sender
     * @return Email
     */
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return array 
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Email
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set sentAt
     *
     * @param \DateTime $sentAt
     * @return Email
     */
    public function setSentAt($sentAt)
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    /**
     * Get sentAt
     *
     * @return \DateTime 
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }
}
