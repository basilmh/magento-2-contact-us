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

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use BasilMH\ContactUsExt\Controller\Adminhtml\ContactUsExt;

class Delete extends ContactUsExt
{
    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $message_id = $this->getRequest()->getParam('message_id');
        if ($message_id) {
            try {
                $this->messageRepository->deleteById($message_id);
                $this->messageManager->addSuccessMessage(__('The message has been deleted.'));
                $resultRedirect->setPath('contactcsext/index');
                return $resultRedirect;
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('The message is no longer exists.'));
                return $resultRedirect->setPath('contactcsext/index');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('contactcsext/index', ['message_id' => $message_id]);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('There was a problem during deleting the message'));
                return $resultRedirect->setPath('contactcsext/index', ['message_id' => $message_id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find the message to delete.'));
        $resultRedirect->setPath('contactcsext/index');
        return $resultRedirect;
    }
}