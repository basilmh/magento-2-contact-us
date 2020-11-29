<?php
/*
 * BasilMH_ContactUsExt
 * @category   BasilMH
 * @package    BasilMH_ContactUsExt
 * @copyright  Copyright (c) 2020 BasilMH
 * @license    https://github.com/basilmh/magento-2-contact-us/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace BasilMH\ContactUsExt\Controller\Adminhtml\Index;

use BasilMH\ContactUsExt\Controller\Adminhtml\ContactUsExt;

class Index extends ContactUsExt
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('ContactUsExt::contact_messages');
        $resultPage->getConfig()->getTitle()->prepend(__('Contact Form Messages'));
        $resultPage->addBreadcrumb(__('Contact Form Messages'), __('Contact Form Messages'));
        return $resultPage;
    }
}