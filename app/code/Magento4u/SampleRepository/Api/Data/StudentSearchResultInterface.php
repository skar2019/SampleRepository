<?php

namespace Magento4u\SampleRepository\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface StudentSearchResultInterface
 * @author Suman Kar(suman.jis@gmail.com)
 */
interface StudentSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Magento4u\SampleRepository\Api\Data\StudentInterface[]
     */
    public function getItems();

    /**
     * @param \Magento4u\SampleRepository\Api\Data\StudentInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}