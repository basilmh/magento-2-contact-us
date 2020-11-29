<?php
/*
 * BasilMH_ContactUsExt
 * @category   BasilMH
 * @package    BasilMH_ContactUsExt
 * @copyright  Copyright (c) 2020 BasilMH
 * @license    https://github.com/basilmh/magento-2-contact-us/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace BasilMH\ContactUsExt\Api;

use BasilMH\ContactUsExt\Api\Data\MessageInterface;

/**
 * @api
 */
interface MessageRepositoryInterface
{
    /**
     * Save message.
     *
     * @param MessageInterface $message
     * @return MessageInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(MessageInterface $message);

    /**
     * Retrieve message.
     *
     * @param int $messageId
     * @return MessageInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($messageId);

    /**
     * Delete message.
     *
     * @param MessageInterface $message
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(MessageInterface $message);

    /**
     * Delete message by ID.
     *
     * @param int $messageId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($messageId);
}
