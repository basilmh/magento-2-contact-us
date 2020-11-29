<?php
/*
 * BasilMH_ContactUsExt
 * @category   BasilMH
 * @package    BasilMH_ContactUsExt
 * @copyright  Copyright (c) 2020 BasilMH
 * @license    https://github.com/basilmh/magento-2-contact-us/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace BasilMH\ContactUsExt\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Store\Model\StoreManagerInterface;

class Message extends AbstractDb
{
    /**
     * @var DateTime
     */
    protected $date;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManagerInterface;

    /**
     * Message constructor.
     * @param Context $context
     * @param DateTime $dateTime
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        DateTime $dateTime,
        StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->date = $dateTime;
        $this->storeManagerInterface = $storeManager;
    }

    /**
     * Resource initialisation
     */
    protected function _construct()
    {
        $this->_init('basilmh_contactusext_messages', 'message_id');
    }

    /**
     * @param AbstractModel $object
     * @return $this
     */
    protected function _beforeSave(AbstractModel $object)
    {
        $object->setStoreId($this->storeManagerInterface->getStore()->getId());
        if ($object->isObjectNew()) {
            $object->setCreatedAt($this->date->gmtDate());
            $object->setUpdatedAt($this->date->gmtDate());
        } else {
            $object->setUpdatedAt($this->date->gmtDate());
        }
        return parent::_beforeSave($object);
    }
}