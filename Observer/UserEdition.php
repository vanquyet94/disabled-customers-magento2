<?php
namespace VoolaTech\CustomerBlock\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Customer\Api\CustomerRepositoryInterface;

class UserEdition implements ObserverInterface
{
	
	const CUSTOMER_ACCOUNT_BLOCK = 'account_is_block';
	
    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * UserEdition constructor.
     * @param \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\State\InputMismatchException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \RuntimeException
     */
    public function execute(EventObserver $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
    }
}
