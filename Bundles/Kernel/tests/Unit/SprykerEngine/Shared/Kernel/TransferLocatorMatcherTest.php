<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Unit\SprykerEngine\Shared\Kernel;

use SprykerEngine\Shared\Kernel\TransferLocatorMatcher;
use SprykerEngine\Zed\Kernel\Locator;

/**
 * @group Kernel
 * @group Locator
 * @group Matcher
 * @group TransferLocatorMatcher
 */
class TransferLocatorMatcherTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testMatchShouldReturnTrueIfMethodStartsWithTransfer()
    {
        $this->assertTrue((new TransferLocatorMatcher())->match('transferFoo'));
    }

    /**
     * @return void
     */
    public function testMatchShouldReturnFalseIfMethodNotStartsWithTransfer()
    {
        $this->assertFalse((new TransferLocatorMatcher())->match('locatorFoo'));
    }

    /**
     * @return void
     */
    public function testMatchShouldReturnFalseIfMethodNotStartsWithTransferButTransferInString()
    {
        $this->assertFalse((new TransferLocatorMatcher())->match('locatorTransfer'));
    }

    /**
     * @return void
     */
    public function testFilterShouldReturnClassName()
    {
        $this->assertSame('Foo', (new TransferLocatorMatcher())->filter('transferFoo'));
    }

}
