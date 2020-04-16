<?php

namespace Magento4u\SampleRepository\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Student
 * @author Suman Kar(suman.jis@gmail.com)
 */
class Student extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('student', 'entity_id');
    }
}