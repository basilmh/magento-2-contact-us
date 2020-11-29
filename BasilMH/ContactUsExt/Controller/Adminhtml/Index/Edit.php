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

class Edit extends ContactUsExt
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('ContactUsExt::contact_messages')
            ->addBreadcrumb(__('Messages'), __('Messages'))
            ->addBreadcrumb(__('Manage Messages'), __('Manage Messages'));

        $resultPage->addBreadcrumb(
            __('Message'),
            __(sprintf('Message: #%s', $this->getRequest()->getParam('message_id')))
        );
        $resultPage->getConfig()->getTitle()->prepend(
            __(sprintf('Message: #%s', $this->getRequest()->getParam('message_id')))
        );

        return $resultPage;
    }
}