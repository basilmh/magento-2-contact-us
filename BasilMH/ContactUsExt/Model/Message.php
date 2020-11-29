<?php
/*
 * BasilMH_ContactUsExt
 * @category   BasilMH
 * @package    BasilMH_ContactUsExt
 * @copyright  Copyright (c) 2020 BasilMH
 * @license    https://github.com/basilmh/magento-2-contact-us/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace BasilMH\ContactUsExt\Model;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use BasilMH\ContactUsExt\Api\Data\MessageInterface;

class Message extends AbstractModel implements MessageInterface
{
    /**
     * Cache tag
     */
    const CACHE_TAG = 'basilmh_contactusext_messages';

    /**
     * Sliders constructor.
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Initialise resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init('BasilMH\ContactUsExt\Model\ResourceModel\Message');
    }

    /**
     * Get cache identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(MessageInterface::NAME);
    }

    /**
     * Set name
     *
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(MessageInterface::NAME, $name);
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(MessageInterface::EMAIL);
    }

    /**
     * Set email
     *
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        return $this->setData(MessageInterface::EMAIL, $email);
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->getData(MessageInterface::TELEPHONE);
    }

    /**
     * Set telephone
     *
     * @param $telephone
     * @return $this
     */
    public function setTelephone($telephone)
    {
        return $this->setData(MessageInterface::TELEPHONE, $telephone);
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->getData(MessageInterface::COMMENT);
    }

    /**
     * Set comment
     *
     * @param $comment
     * @return $this
     */
    public function setComment($comment)
    {
        return $this->setData(MessageInterface::COMMENT, $comment);
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->getData(MessageInterface::STATUS);
    }

    /**
     * Set status
     *
     * @param $status
     * @return $this
     */
    public function setStatus($status)
    {
        return $this->setData(MessageInterface::STATUS, $status);
    }
}