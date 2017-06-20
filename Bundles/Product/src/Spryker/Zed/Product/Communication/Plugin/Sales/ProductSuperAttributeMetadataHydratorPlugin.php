<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Product\Communication\Plugin\Sales;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Product\Dependency\Plugin\ProductMetadataHydratorInterface;

/**
 * @method \Spryker\Zed\Product\Communication\ProductCommunicationFactory getFactory()
 * @method \Spryker\Zed\Product\Business\ProductFacade getFacade()
 */
class ProductSuperAttributeMetadataHydratorPlugin extends AbstractPlugin implements ProductMetadataHydratorInterface
{

    /**
     * Specification:
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function hydrateProductMetadata(OrderTransfer $orderTransfer)
    {
        return $this->getFacade()->hydrateSuperAttributeMetadata($orderTransfer);
    }

}
