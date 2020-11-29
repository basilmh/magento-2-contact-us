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

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\ValidatorException;
use Magento\Framework\Exception\NoSuchEntityException;
use BasilMH\ContactUsExt\Api\MessageRepositoryInterface;
use BasilMH\ContactUsExt\Api\Data\MessageInterface;
use BasilMH\ContactUsExt\Api\Data\MessageInterfaceFactory;
use BasilMH\ContactUsExt\Model\ResourceModel\Message as ResourceMessage;
use BasilMH\ContactUsExt\Model\ResourceModel\Message\CollectionFactory as MessageCollectionFactory;

class MessageRepository implements MessageRepositoryInterface
{
    /**
     * @var array
     */
    protected $instances = [];
    /**
     * @var ResourceMessage
     */
    protected $resource;

    /**
     * @var MessageCollectionFactory
     */
    protected $messageCollectionFactory;

    /**
     * @var MessageInterfaceFactory
     */
    protected $messageInterfaceFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    public function __construct(
        ResourceMessage $resource,
        MessageCollectionFactory $messageCollectionFactory,
        MessageInterfaceFactory $messageInterfaceFactory,
        DataObjectHelper $dataObjectHelper
    ) {
        $this->resource = $resource;
        $this->messageCollectionFactory = $messageCollectionFactory;
        $this->messageInterfaceFactory = $messageInterfaceFactory;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    /**
     * @param MessageInterface $message
     * @return MessageInterface
     * @throws CouldNotSaveException
     */
    public function save(MessageInterface $message)
    {
        try {
            $this->resource->save($message);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the message: %1',
                $exception->getMessage()
            ));
        }
        return $message;
    }

    /**
     * Get message record
     *
     * @param $messageId
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById($messageId)
    {
        if (!isset($this->instances[$messageId])) {
            $message = $this->messageInterfaceFactory->create();
            $this->resource->load($message, $messageId);
            if (!$message->getId()) {
                throw new NoSuchEntityException(__('Requested message doesn\'t exist'));
            }
            $this->instances[$messageId] = $message;
        }
        return $this->instances[$messageId];
    }

    /**
     * @param MessageInterface $message
     * @return bool
     * @throws CouldNotSaveException
     * @throws StateException
     */
    public function delete(MessageInterface $message)
    {
        $id = $message->getId();
        try {
            unset($this->instances[$id]);
            $this->resource->delete($message);
        } catch (ValidatorException $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        } catch (\Exception $e) {
            throw new StateException(
                __('Unable to remove message %1', $id)
            );
        }
        unset($this->instances[$id]);
        return true;
    }

    /**
     * @param $messageId
     * @return bool
     */
    public function deleteById($messageId)
    {
        $message = $this->getById($messageId);
        return $this->delete($message);
    }
}