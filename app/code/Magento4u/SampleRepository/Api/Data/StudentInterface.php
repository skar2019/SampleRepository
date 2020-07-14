<?php

namespace Magento4u\SampleRepository\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

use Magento\Framework\Api\CustomAttributesDataInterface;

/**
 * Interface StudentInterface
 * @author Suman Kar(suman.jis@gmail.com)
 */
interface StudentInterface extends ExtensibleDataInterface
{
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const ROLL_NUMBER = 'roll_number';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param $id
     * @return int
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param $name
     * @return string
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getRollNumber();

    /**
     * @param $rollNumber
     * @return string
     */
    public function setRollNumber($rollNumber);

    /**
     * @return \Magento4u\SampleRepository\Api\Data\StudentExtensionInterface
     */
    public function getExtensionAttributes();

    /**
     * @param \Magento4u\SampleRepository\Api\Data\StudentExtensionInterface $extensionAttributes
     * @return mixed
     */
    public function setExtensionAttributes(StudentExtensionInterface $extensionAttributes);
}