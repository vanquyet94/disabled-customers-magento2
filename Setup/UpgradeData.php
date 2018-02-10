<?php
namespace VoolaTech\CustomerBlock\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\Customer;

class UpgradeData implements UpgradeDataInterface
{
	const CUSTOMER_ACCOUNT_BLOCK = 'account_is_block';
	
    /**
     * @var CustomerSetupFactory
     */
    protected $customerSetupFactory;

    /**
     * @var AttributeSetFactory
     */
    protected $attributeSetFactory;

    /**
     * InstallData constructor.
     * @param \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
     * @param \Magento\Eav\Model\Entity\Attribute\SetFactory $attributeSetFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
    }

    /**
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.1.1') < 0) {
            $this->upgradeToOneOneZero($setup);
        }
        $setup->endSetup();
    }

    /**
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     */
    protected function upgradeToOneOneZero($setup)
    {
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
        $newAttribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, self::CUSTOMER_ACCOUNT_BLOCK);
        $newAttribute->setData('is_user_defined', 0);
		$newAttribute->setData('is_used_in_grid', 1);
        $newAttribute->setData('is_visible_in_grid', 1);
        $newAttribute->setData('is_filterable_in_grid', 1);
        $newAttribute->save();
    }
}
