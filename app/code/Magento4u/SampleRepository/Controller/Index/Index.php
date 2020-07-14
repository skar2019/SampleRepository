<?php

namespace Magento4u\SampleRepository\Controller\Index;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder as ApiSearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento4u\SampleRepository\Model\ResourceModel\Student\CollectionFactory;
use Magento4u\SampleRepository\Model\StudentFactory;
use Magento4u\SampleRepository\Model\StudentRepository;

/**
 * Class Index
 * @author Suman Kar(suman.jis@gmail.com)
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @var StudentFactory
     */
    private $student;

    /**
     * @var CollectionFactory
     */
    private $studentCollection;

    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var StudentRepository
     */
    private $studentRepository;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param StudentFactory $student
     * @param CollectionFactory $studentCollection
     * @param StudentRepository $studentRepository
     * @param FilterBuilder $filterBuilder
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento4u\SampleRepository\Model\StudentFactory $student,
        \Magento4u\SampleRepository\Model\ResourceModel\Student\CollectionFactory $studentCollection,
        \Magento4u\SampleRepository\Model\StudentRepository $studentRepository,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Framework\Api\Search\SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->pageFactory = $pageFactory;
        $this->student = $student;
        $this->studentCollection = $studentCollection;
        $this->studentRepository = $studentRepository;
        $this->filterBuilder = $filterBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context);
    }

    /**
     * Used Magento\Framework\Api\SearchCriteriaBuilder
     * Used addFilter() function
     * Used for simple and condition
     *
     * SELECT `main_table`.* FROM `student` AS `main_table`
     * WHERE
     * ((`name` LIKE '%Student%'))
     * AND
     * ((`roll_number` = '123'))
     */
    private function searchExample1() {

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        /** @var \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder */
        $searchCriteriaBuilder = $objectManager->create(ApiSearchCriteriaBuilder::class);

        $searchCriteriaBuilder->addFilter('name', '%Student%', 'like');
        $searchCriteriaBuilder->addFilter('roll_number', '123', 'eq');

        $searchCriteria = $searchCriteriaBuilder->create();

        $searchResult = $this->studentRepository->getList($searchCriteria);
        $items = $searchResult->getItems();

        echo "<pre>";
        echo "Number of record == " . count($items);

        echo "</br>";

        foreach ($items as $item) {
            echo "</br>";
            echo "ID :" . $item->getId() . " ". "Name : ". $item->getName() . "  Roll No : " . $item->getRollNumber();
            echo "</br>";
        }
    }

    /**
     * Used Magento\Framework\Api\SearchCriteriaBuilder
     * Used Magento\Framework\Api\FilterBuilder
     * Used addFilters() function
     *
     * SELECT `main_table`.* FROM `student` AS `main_table`
     * WHERE
     * ((`name` LIKE '%Student 1%') OR (`name` LIKE '%Student 2%'))
     * AND
     * ((`roll_number` = '123'))
     */
    private function searchExample2() {

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        /** @var \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder */
        $searchCriteriaBuilder = $objectManager->create(ApiSearchCriteriaBuilder::class);

        /** @var \Magento\Framework\Api\FilterBuilder $filterBuilder */
        $filterBuilder = $objectManager->create(\Magento\Framework\Api\FilterBuilder::class);

        $filter1 = $filterBuilder->setField('name')
            ->setConditionType('like')
            ->setValue('%Student 1%')
            ->create();

        $filter2 = $filterBuilder->setField('name')
            ->setConditionType('like')
            ->setValue('%Student 2%')
            ->create();

        $filter3 = $filterBuilder->setField('roll_number')
            ->setConditionType('eq')
            ->setValue('123')
            ->create();


        $searchCriteriaBuilder->addFilters([$filter1, $filter2]);
        $searchCriteriaBuilder->addFilters([$filter3]);

        $searchCriteria = $searchCriteriaBuilder->create();

        $searchResult = $this->studentRepository->getList($searchCriteria);
        $items = $searchResult->getItems();

        echo "<pre>";
        echo "Number of record == " . count($items);

        echo "</br>";

        foreach ($items as $item) {
            echo "</br>";
            echo "ID :" . $item->getId() . " ". "Name : ". $item->getName() . "  Roll No : " . $item->getRollNumber();
            echo "</br>";
        }
    }

    /**
     * Used Magento\Framework\Api\SearchCriteriaBuilder
     * Used Magento\Framework\Api\FilterBuilder
     * Used setFilterGroups
     *
     * SELECT `main_table`.* FROM `student` AS `main_table`
     * WHERE ((`entity_id` = '3') OR (`name` LIKE '%Student 2%'))
     * AND ((`roll_number` = 1234))
     */
    private function searchExample3() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        /** @var \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder */
        $searchCriteriaBuilder = $objectManager->create(ApiSearchCriteriaBuilder::class);

        /** @var \Magento\Framework\Api\FilterBuilder $filterBuilder */
        $filterBuilder = $objectManager->create(\Magento\Framework\Api\FilterBuilder::class);

        /** @var \Magento\Framework\Api\Search\FilterGroup $filterGroup */
        $filterGroup = $objectManager->create(\Magento\Framework\Api\Search\FilterGroup::class);

        $filter1 = $filterBuilder
            ->setField('entity_id')
            ->setValue('3')
            ->setConditionType('eq')
            ->create();

        $filter2 = $filterBuilder
            ->setField('name')
            ->setValue('%Student 2%')
            ->setConditionType('like')
            ->create();

        $filter3 = $filterBuilder
            ->setField('roll_number')
            ->setValue(1234)
            ->setConditionType('eq')
            ->create();

        /** @var \Magento\Framework\Api\Search\FilterGroup $filterGroup */
        $filterGroup1 = $objectManager->create(\Magento\Framework\Api\Search\FilterGroup::class);
        $filterGroupObj1 = $filterGroup1->setFilters([$filter1, $filter2]);

        /** @var \Magento\Framework\Api\Search\FilterGroup $filterGroup */
        $filterGroup2 = $objectManager->create(\Magento\Framework\Api\Search\FilterGroup::class);
        $filterGroupObj2 = $filterGroup2->setFilters([$filter3]);

        $searchCriteriaBuilder->setFilterGroups([$filterGroupObj1, $filterGroupObj2]);

        $searchCriteria = $searchCriteriaBuilder->create();

        $searchResult = $this->studentRepository->getList($searchCriteria);
        $items = $searchResult->getItems();

        echo "<pre>";
        echo "Number of record == " . count($items);

        echo "</br>";

        foreach ($items as $item) {
            echo "</br>";
            echo "ID :" . $item->getId() . " ". "Name : ". $item->getName() . "  Roll No : " . $item->getRollNumber();
            echo "</br>";
        }
    }

    /**
     * Used \Magento\Framework\Api\SearchCriteriaInterface
     * Used Magento\Framework\Api\FilterBuilder
     * Used setFilterGroups
     *
     * SELECT `main_table`.* FROM `student` AS `main_table`
     * WHERE ((`entity_id` = '3') OR (`name` LIKE '%Student 2%'))
     * AND ((`roll_number` = 1234))
     */
    private function searchExample4() {

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        /** @var \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria */
        $searchCriteria = $objectManager->create(\Magento\Framework\Api\SearchCriteriaInterface::class);

        /** @var \Magento\Framework\Api\FilterBuilder $filterBuilder */
        $filterBuilder = $objectManager->create(\Magento\Framework\Api\FilterBuilder::class);

        $filter1 = $filterBuilder
            ->setField('entity_id')
            ->setValue('3')
            ->setConditionType('eq')
            ->create();

        $filter2 = $filterBuilder
            ->setField('name')
            ->setValue('%Student 2%')
            ->setConditionType('like')
            ->create();

        $filter3 = $filterBuilder
            ->setField('roll_number')
            ->setValue(1234)
            ->setConditionType('eq')
            ->create();

        /** @var \Magento\Framework\Api\Search\FilterGroup $filterGroup */
        $filterGroup1 = $objectManager->create(\Magento\Framework\Api\Search\FilterGroup::class);
        $filterGroupObj1 = $filterGroup1->setFilters([$filter1, $filter2]);

        /** @var \Magento\Framework\Api\Search\FilterGroup $filterGroup */
        $filterGroup2 = $objectManager->create(\Magento\Framework\Api\Search\FilterGroup::class);
        $filterGroupObj2 = $filterGroup2->setFilters([$filter3]);

        $searchCriteria->setFilterGroups([$filterGroupObj1, $filterGroupObj2]);

        $searchResult = $this->studentRepository->getList($searchCriteria);
        $items = $searchResult->getItems();

        echo "<pre>";
        echo "Number of record == " . count($items);

        echo "</br>";

        foreach ($items as $item) {
            echo "</br>";
            echo "ID :" . $item->getId() . " ". "Name : ". $item->getName() . "  Roll No : " . $item->getRollNumber();
            echo "</br>";
        }

        /** @var \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria */
        /* $searchCriteria = $objectManager->create(\Magento\Framework\Api\SearchCriteriaInterface::class);
         $searchCriteria->setFilterGroups([$filterGroupObj1, $filterGroupObj2]);
         $searchResult = $this->studentRepository->getList($searchCriteria);
         $items = $searchResult->getItems();*/
    }

    public function execute(){
        $this->searchExample1();
        echo "</br>";
        echo "------------------------------------------------";
        echo "</br>";
        $this->searchExample2();
        echo "</br>";
        echo "------------------------------------------------";
        echo "</br>";
        $this->searchExample3();
        echo "</br>";
        echo "------------------------------------------------";
        echo "</br>";
        $this->searchExample4();
    }

    public function executeTest()
    {
        /**
         * Save new entity
         */
        /*
        $student = $this->student->create();
        $student->setName('Student 1');
        $student->setRollNumber('435345431');
        $this->studentRepository->save($student);

        $student = $this->student->create();
        $student->setName('Student 21');
        $student->setRollNumber('435345421');
        $this->studentRepository->save($student);

        $student = $this->student->create();
        $student->setName('Student 3');
        $student->setRollNumber('43234542');
        $this->studentRepository->save($student);

        $student = $this->student->create();
        $student->setName('Student 4');
        $student->setRollNumber('43236542');
        $this->studentRepository->save($student);
        exit;

        /**
         *Load Example
         */

        /*
        $student = $this->studentRepository->getById(1);
        print_r($student->getData());
        exit;
        */

        /**
         * Update Example
         */

        /*
        $student = $this->studentRepository->getById(1);
        $student->setName('Student New Name');
        $student->setRollNumber('1111111111111');
        $this->studentRepository->save($student);
        exit;
        */

        /**
         * Delete Example
         */
        /*
        $student = $this->studentRepository->getById(1);
        $this->studentRepository->delete($student);
        exit;
        */

        /**
         * Search Example 1
         */

        /*
        $filter1 = $this->filterBuilder->setField('name')
            ->setConditionType('like')
            ->setValue('%Student%')
            ->create();
        $this->searchCriteriaBuilder->addFilter($filter1);
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchResult = $this->studentRepository->getList($searchCriteria);
        $items = $searchResult->getItems();

        echo "<pre>";
        echo "Number of record== " . count($items);

        echo "</br>";

        foreach ($items as $item) {
            echo "</br>";
            echo "ID :" . $item->getId() . " ". "Name : ". $item->getName() . "  Roll No : " . $item->getRollNumber();
            echo "</br>";
        }
        */

        /**
         * Search Example 2
         */
        /*
        $filter1 = $this->filterBuilder->setField('name')
            ->setConditionType('like')
            ->setValue('%Student%')
            ->create();
        $this->searchCriteriaBuilder->addFilter($filter1);
        $this->searchCriteriaBuilder->addSortOrder('entity_id', SortOrder::SORT_DESC);
        $this->searchCriteriaBuilder->setCurrentPage(1)->setPageSize(2);

        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchResult = $this->studentRepository->getList($searchCriteria);
        $items = $searchResult->getItems();

        echo "<pre>";
        echo "Number of record == " . count($items);
        echo "</br>";

        foreach ($items as $item) {
            echo "</br>";
            echo "ID :" . $item->getId() . " " . "Name : " . $item->getName() . "  Roll No : " . $item->getRollNumber();
            echo "</br>";
        }
        */
        exit;
        //return $this->pageFactory->create();
    }

}