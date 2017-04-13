<?php
/**
 * SolideWebservices/GroupedProductTaxFix
 *
 * @category Magento2_Module
 * @package  GroupedProductTaxFix
 * @author   Solide Webservices <contact@solidewebservices.com>
 * @license  https://opensource.org/licenses/OSL-3.0 Open Software License 3.0
 * @version  1.0.0
 * @link     https://solidewebservices.com
 */

namespace SolideWebservices\GroupedProductTaxFix\Model\Product\Type;

use Magento\Catalog\Api\ProductRepositoryInterface;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Grouped extends \Magento\GroupedProduct\Model\Product\Type\Grouped
{
    /**
     * Retrieve array of associated products.
     *
     * @param \Magento\Catalog\Model\Product $product Product.
     *
     * @return array Array.
     */
    public function getAssociatedProducts($product)
    {
        if (!$product->hasData($this->_keyAssociatedProducts)) {
            $associatedProducts = [];

            $this->setSaleableStatus($product);

            $collection = $this->getAssociatedProductCollection(
                $product
            )->addAttributeToSelect(
                ['name', 'price',  'special_price', 'special_from_date', 'special_to_date', 'tax_class_id']
            )->addFilterByRequiredOptions()->setPositionOrder()->addStoreFilter(
                $this->getStoreFilter($product)
            )->addAttributeToFilter(
                'status',
                ['in' => $this->getStatusFilters($product)]
            );

            foreach ($collection as $item) {
                $associatedProducts[] = $item;
            }

            $product->setData($this->_keyAssociatedProducts, $associatedProducts);
        }
        return $product->getData($this->_keyAssociatedProducts);
    }

}
