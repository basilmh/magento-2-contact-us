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

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Ui\Component\MassAction\Filter;
use BasilMH\ContactUsExt\Api\MessageRepositoryInterface;
use BasilMH\ContactUsExt\Controller\Adminhtml\ContactUsExt;
use BasilMH\ContactUsExt\Model\ResourceModel\Message\CollectionFactory;

class MassDelete extends ContactUsExt
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var string
     */
    protected $successMessage;

    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * MassDelete constructor.
     * @param Registry $registry
     * @param MessageRepositoryInterface $messageRepository
     * @param PageFactory $resultPageFactory
     * @param ForwardFactory $resultForwardFactory
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param $successMessage
     * @param $errorMessage
     */
    public function __construct(
        Registry $registry,
        MessageRepositoryInterface $messageRepository,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        $successMessage,
        $errorMessage
    ) {
        parent::__construct($registry, $messageRepository, $resultPageFactory, $resultForwardFactory, $context);
        $this->filter            = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->successMessage    = $successMessage;
        $this->errorMessage      = $errorMessage;
    }

    /**
     * execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $collection->getSize();
            foreach ($collection as $message) {
                $this->messageRepository->delete($message);
            }
            $this->messageManager->addSuccessMessage(__($this->successMessage, $collectionSize));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __($this->errorMessage));
        }
        $redirectResult = $this->resultRedirectFactory->create();
        $redirectResult->setPath('contactusext/index');
        return $redirectResult;
    }
}