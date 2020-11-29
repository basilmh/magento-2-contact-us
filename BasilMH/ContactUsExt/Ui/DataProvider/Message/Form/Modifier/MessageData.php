<?php
/*
 * BasilMH_ContactUsExt
 * @category   BasilMH
 * @package    BasilMH_ContactUsExt
 * @copyright  Copyright (c) 2020 BasilMH
 * @license    https://github.com/basilmh/magento-2-contact-us/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace BasilMH\ContactUsExt\Ui\DataProvider\Message\Form\Modifier;

use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use BasilMH\ContactUsExt\Model\ResourceModel\Message\CollectionFactory;

class MessageData implements ModifierInterface
{
    /**
     * @var \BasilMH\ContactUsExt\Model\ResourceModel\Message\Collection
     */
    protected $collection;

    /**
     * @param CollectionFactory $messageCollectionFactory
     */
    public function __construct(
        CollectionFactory $messageCollectionFactory
    ) {
        $this->collection = $messageCollectionFactory->create();
    }

    /**
     * @param array $meta
     * @return array
     */
    public function modifyMeta(array $meta)
    {
        return $meta;
    }

    /**
     * @param array $data
     * @return array|mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function modifyData(array $data)
    {
        $items = $this->collection->getItems();
        foreach ($items as $message) {
            $_data = $message->getData();
            $message->setData($_data);
            $data[$message->getId()] = $_data;
        }
        return $data;
    }
}