<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MessageTranslation.
 *
 * @ORM\Table(name="message_translation", uniqueConstraints={@ORM\UniqueConstraint(name="uk_unq_key", columns={"message_domain_id", "message_language_id", "message_key_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MessageTranslationRepository")
 */
class MessageTranslation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="message_domain_id", type="integer", nullable=false)
     */
    private $messageDomainId;

    /**
     * @var int
     *
     * @ORM\Column(name="message_language_id", type="integer", nullable=false)
     */
    private $messageLanguageId;

    /**
     * @var int
     *
     * @ORM\Column(name="message_key_id", type="integer", nullable=false)
     */
    private $messageKeyId;

    /**
     * @var string
     *
     * @ORM\Column(name="message_text", type="text", nullable=false)
     */
    private $messageText;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set messageDomainId.
     *
     * @param int $messageDomainId
     *
     * @return MessageTranslation
     */
    public function setMessageDomainId($messageDomainId)
    {
        $this->messageDomainId = $messageDomainId;

        return $this;
    }

    /**
     * Get messageDomainId.
     *
     * @return int
     */
    public function getMessageDomainId()
    {
        return $this->messageDomainId;
    }

    /**
     * Set messageLanguageId.
     *
     * @param int $messageLanguageId
     *
     * @return MessageTranslation
     */
    public function setMessageLanguageId($messageLanguageId)
    {
        $this->messageLanguageId = $messageLanguageId;

        return $this;
    }

    /**
     * Get messageLanguageId.
     *
     * @return int
     */
    public function getMessageLanguageId()
    {
        return $this->messageLanguageId;
    }

    /**
     * Set messageKeyId.
     *
     * @param int $messageKeyId
     *
     * @return MessageTranslation
     */
    public function setMessageKeyId($messageKeyId)
    {
        $this->messageKeyId = $messageKeyId;

        return $this;
    }

    /**
     * Get messageKeyId.
     *
     * @return int
     */
    public function getMessageKeyId()
    {
        return $this->messageKeyId;
    }

    /**
     * Set messageText.
     *
     * @param string $messageText
     *
     * @return MessageTranslation
     */
    public function setMessageText($messageText)
    {
        $this->messageText = $messageText;

        return $this;
    }

    /**
     * Get messageText.
     *
     * @return string
     */
    public function getMessageText()
    {
        return $this->messageText;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return MessageTranslation
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
