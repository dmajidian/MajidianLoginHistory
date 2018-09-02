<?php

namespace Majidian\History\Model\ResourceModel\History;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Majidian\History\Model\History', 'Majidian\History\Model\ResourceModel\History');
    }
}
