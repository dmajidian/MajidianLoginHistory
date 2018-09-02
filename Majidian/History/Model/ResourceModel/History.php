<?php

namespace Majidian\History\Model\ResourceModel;

class History extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('majidian_history', 'history_id');
    }
}