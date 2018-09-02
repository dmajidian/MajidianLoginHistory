<?php

namespace Majidian\History\Model;

class History extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Majidian\History\Model\ResourceModel\History');
    }
}