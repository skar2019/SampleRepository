<?php

namespace Magento4u\SampleRepository\Controller\Index;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
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
        PageFactory $pageFactory,
        StudentFactory $student,
        CollectionFactory $studentCollection,
        StudentRepository $studentRepository,
        FilterBuilder $filterBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->pageFactory = $pageFactory;
        $this->student = $student;
        $this->studentCollection = $studentCollection;
        $this->studentRepository = $studentRepository;
        $this->filterBuilder = $filterBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context);
    }

    public function execute()
    {
        /**
         * Save new entity
         */
        /*
        $student = $this->student->create();
        $student->setName('Student 11');
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