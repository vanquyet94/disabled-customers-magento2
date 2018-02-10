<?php
namespace VoolaTech\CustomerBlock\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class Activation extends Column
{
    /**
     * {@inheritdoc}
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
				if(isset($item['account_is_block'])){
					$item['account_is_block'] = $item['account_is_block'] === '1' ? __('Enable') : __('Disble');
				}else{
					$item['account_is_block'] = __('Enable');
				}
            }
        }
        return $dataSource;
    }

}
