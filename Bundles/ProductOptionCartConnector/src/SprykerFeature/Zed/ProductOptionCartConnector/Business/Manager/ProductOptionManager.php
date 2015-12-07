<?php
/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace SprykerFeature\Zed\ProductOptionCartConnector\Business\Manager;

use Generated\Shared\Transfer\ChangeTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use SprykerFeature\Zed\ProductOptionCartConnector\Dependency\Facade\ProductOptionCartConnectorToProductOptionInterface;

class ProductOptionManager implements ProductOptionManagerInterface
{

    /**
     * @var ProductOptionCartConnectorToProductOptionInterface
     */
    private $productOptionFacade;

    /**
     * @param ProductOptionCartConnectorToProductOptionInterface
     */
    public function __construct(ProductOptionCartConnectorToProductOptionInterface $productOptionFacade)
    {
        $this->productOptionFacade = $productOptionFacade;
    }

    /**
     * @param ChangeTransfer $change
     *
     * @return ChangeTransfer
     */
    public function expandProductOptions(ChangeTransfer $change)
    {
        foreach ($change->getItems() as $cartItem) {
            $this->expandProductOptionTransfers($cartItem);
        }

        return $change;
    }

    /**
     * @param ItemTransfer $cartItem
     *
     * @return void
     */
    public function expandProductOptionTransfers(ItemTransfer $cartItem)
    {
        foreach ($cartItem->getProductOptions() as &$productOptionTransfer) {
            if ($productOptionTransfer->getIdOptionValueUsage() === null || $productOptionTransfer->getLocaleCode() === null) {
                throw new \RuntimeException('Unable to expand product option. Missing required values: idOptionValueUsage, localeCode');
            }

            $productOptionTransfer = $this->productOptionFacade->getProductOption(
                $productOptionTransfer->getIdOptionValueUsage(),
                $productOptionTransfer->getLocaleCode()
            );
            $productOptionTransfer->setQuantity($cartItem->getQuantity());
        }
    }

}
