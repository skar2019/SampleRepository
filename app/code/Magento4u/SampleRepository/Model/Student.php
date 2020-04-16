<?php

namespace Magento4u\SampleRepository\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Magento4u\SampleRepository\Api\Data\StudentExtensionInterface;
use Magento4u\SampleRepository\Api\Data\StudentInterface;

/**
 * Class Student
 * @author Suman Kar(suman.jis@gmail.com)
 */
class Student extends AbstractExtensibleModel implements StudentInterface
{

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return parent::getData(self::ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return parent::getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getRollNumber()
    {
        return parent::getData(self::ROLL_NUMBER);
    }

    /**
     * @inheritDoc
     */
    public function setRollNumber($rollNumber)
    {
        return $this->setData(self::ROLL_NUMBER, $rollNumber);
    }

    /**
     * @inheritDoc
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @inheritDoc
     */
    public function setExtensionAttributes(
        StudentExtensionInterface $extensionAttributes
    ) {
        $this->_setExtensionAttributes($extensionAttributes);
    }

    protected function _construct()
    {
        $this->_init(ResourceModel\Student::class);
    }
}
