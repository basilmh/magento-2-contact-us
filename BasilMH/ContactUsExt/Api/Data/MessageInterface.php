<?php
/*
 * BasilMH_ContactUsExt
 * @category   BasilMH
 * @package    BasilMH_ContactUsExt
 * @copyright  Copyright (c) 2020 BasilMH
 * @license    https://github.com/basilmh/magento-2-contact-us/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace BasilMH\ContactUsExt\Api\Data;

/**
 * @api
 */
interface MessageInterface
{
    const MESSAGE_ID    = 'message_id';
    const NAME          = 'name';
    const EMAIL         = 'email';
    const TELEPHONE     = 'telephone';
    const COMMENT       = 'comment';
    const STATUS       = 'status';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone();

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment();

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus();

    /**
     * Set ID
     *
     * @param $id
     * @return MessageInterface
     */
    public function setId($id);

    /**
     * Set name
     *
     * @param $name
     * @return MessageInterface
     */
    public function setName($name);

    /**
     * Set email
     *
     * @param $email
     * @return MessageInterface
     */
    public function setEmail($email);

    /**
     * Set telephone
     *
     * @param $telephone
     * @return MessageInterface
     */
    public function setTelephone($telephone);

    /**
     * Set comment
     *
     * @param $comment
     * @return MessageInterface
     */
    public function setComment($comment);

    /**
     * Set status
     *
     * @param $status
     * @return MessageInterface
     */
    public function setStatus($status);
}