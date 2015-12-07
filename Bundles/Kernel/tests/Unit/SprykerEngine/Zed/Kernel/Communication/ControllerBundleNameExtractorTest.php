<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Unit\SprykerEngine\Zed\Kernel\Communication;

use SprykerEngine\Zed\Kernel\Communication\ControllerBundleNameExtractor;

/**
 * @group Kernel
 */
class ControllerBundleNameExtractorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testGetBundleNameShouldReturnBundleNameFromGivenString()
    {
        $extractor = new ControllerBundleNameExtractor();
        $this->assertSame('Bundle', $extractor->getBundleName('Namespace\\Kernel\\Bundle\\Layer\\ClassName'));
    }

    /**
     * @return void
     */
    public function testGetBundleNameShouldReturnBundleNameFromGivenClassInstance()
    {
        $extractor = new ControllerBundleNameExtractor();
        $this->assertSame('Kernel', $extractor->getBundleName($extractor));
    }

}
