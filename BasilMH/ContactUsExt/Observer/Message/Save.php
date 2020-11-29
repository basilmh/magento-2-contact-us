<?php
/*
 * BasilMH_ContactUsExt
 * @category   BasilMH
 * @package    BasilMH_ContactUsExt
 * @copyright  Copyright (c) 2020 BasilMH
 * @license    https://github.com/basilmh/magento-2-contact-us/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace BasilMH\ContactUsExt\Observer\Message;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use BasilMH\ContactUsExt\Api\MessageRepositoryInterface;
use BasilMH\ContactUsExt\Api\Data\MessageInterface;
use BasilMH\ContactUsExt\Model\MessageFactory;

class Save implements ObserverInterface
{
    const XML_PATH_CONTACTS_ENABLED     = 'contact/contact/enabled';
    const XML_PATH_CONTACTUSEXT_ENABLED = 'contact/contact/enable_contactusext';

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var MessageRepositoryInterface
     */
    protected $messageRepository;

    /**
     * @var MessageFactory
     */
    protected $messageFactory;

    /**
     * Save constructor.
     * @param RequestInterface $request
     * @param DataObjectHelper $dataObjectHelper
     * @param ScopeConfigInterface $scopeConfig
     * @param MessageRepositoryInterface $messageRepositoryInterface
     * @param MessageFactory $messageFactory
     */
    public function __construct(
        RequestInterface $request,
        DataObjectHelper $dataObjectHelper,
        ScopeConfigInterface $scopeConfig,
        MessageRepositoryInterface $messageRepositoryInterface,
        MessageFactory $messageFactory
    ) {
        $this->request = $request;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->scopeConfig = $scopeConfig;
        $this->messageRepository = $messageRepositoryInterface;
        $this->messageFactory = $messageFactory;
    }

    /**
     * Save the message
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        if ($this->canSaveContactMessages()) {
            $post = $this->request->getParams();
            if (isset($post['hideit']) && \Zend_Validate::is(trim($post['hideit']), 'NotEmpty')) {
                return;
            }
            $model = $this->messageFactory->create();
            $this->dataObjectHelper->populateWithArray($model, $post, MessageInterface::class);
            $this->messageRepository->save($model);
        }
    }

    /**
     * Check if messages can be saved
     * @return bool
     */
    public function canSaveContactMessages()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_CONTACTS_ENABLED, ScopeInterface::SCOPE_STORE)
            && $this->scopeConfig->getValue(self::XML_PATH_CONTACTUSEXT_ENABLED, ScopeInterface::SCOPE_STORE);
    }
}