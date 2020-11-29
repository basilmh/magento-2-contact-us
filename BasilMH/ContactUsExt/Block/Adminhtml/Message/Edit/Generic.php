<?php
/*
 * BasilMH_ContactUsExt
 * @category   BasilMH
 * @package    BasilMH_ContactUsExt
 * @copyright  Copyright (c) 2020 BasilMH
 * @license    https://github.com/basilmh/magento-2-contact-us/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace BasilMH\ContactUsExt\Block\Adminhtml\Message\Edit\Buttons;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use BasilMH\ContactUsExt\Api\MessageRepositoryInterface;

class Generic
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var MessageRepositoryInterface
     */
    protected $messageRepository;

    /**
     * @param Context $context
     * @param MessageRepositoryInterface $messageRepository
     */
    public function __construct(
        Context $context,
        MessageRepositoryInterface $messageRepository
    ) {
        $this->context = $context;
        $this->messageRepository = $messageRepository;
    }

    /**
     * Return Message ID
     *
     * @return int|null
     */
    public function getMessageId()
    {
        try {
            return $this->messageRepository->getById(
                $this->context->getRequest()->getParam('message_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}