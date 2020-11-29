<?php
/*
 * BasilMH_ContactUsExt
 * @category   BasilMH
 * @package    BasilMH_ContactUsExt
 * @copyright  Copyright (c) 2020 BasilMH
 * @license    https://github.com/basilmh/magento-2-contact-us/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace BasilMH\ContactUsExt\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\View\Result\ForwardFactory;
use BasilMH\ContactUsExt\Api\MessageRepositoryInterface;

abstract class ContactUsExt extends Action
{
    /**
     * @var string
     */
    const ACTION_RESOURCE = 'BasilMH_ContactUsExt::contact_messages';

    /**
     * Message repository
     *
     * @var MessageRepositoryInterface
     */
    protected $messageRepository;

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * Result Page Factory
     *
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Result Forward Factory
     *
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * ContactUsExt constructor.
     *
     * @param Registry $registry
     * @param MessageRepositoryInterface $messageRepository
     * @param PageFactory $resultPageFactory
     * @param ForwardFactory $resultForwardFactory
     * @param Context $context
     */
    public function __construct(
        Registry $registry,
        MessageRepositoryInterface $messageRepository,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        Context $context
    ) {
        parent::__construct($context);
        $this->coreRegistry         = $registry;
        $this->messageRepository    = $messageRepository;
        $this->resultPageFactory    = $resultPageFactory;
        $this->resultForwardFactory = $resultForwardFactory;
    }
}