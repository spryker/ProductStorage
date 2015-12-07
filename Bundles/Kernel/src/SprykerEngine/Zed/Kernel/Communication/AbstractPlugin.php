<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace SprykerEngine\Zed\Kernel\Communication;

use Psr\Log\AbstractLogger;
use SprykerEngine\Shared\Kernel\Messenger\MessengerInterface;
use SprykerEngine\Zed\Kernel\Business\AbstractFacade;
use SprykerEngine\Zed\Kernel\Container;
use SprykerEngine\Zed\Kernel\Locator;
use SprykerEngine\Zed\Kernel\Persistence\AbstractQueryContainer;

abstract class AbstractPlugin extends AbstractLogger implements MessengerInterface
{

    const DEPENDENCY_CONTAINER = 'DependencyContainer';

    /**
     * @var MessengerInterface
     */
    protected $messenger;

    /**
     * @var AbstractFacade
     */
    private $facade;

    /**
     * @var AbstractCommunicationDependencyContainer
     */
    private $dependencyContainer;

    /**
     * @var AbstractQueryContainer
     */
    private $queryContainer;

    /**
     * @param Factory $factory
     * @param Locator $locator
     */
    public function __construct(Factory $factory, Locator $locator)
    {
        if ($factory->exists(self::DEPENDENCY_CONTAINER)) {
            $this->dependencyContainer = $factory->create(self::DEPENDENCY_CONTAINER, $factory, $locator);
        }
    }

    /**
     * @param MessengerInterface $messenger
     *
     * @return self
     */
    public function setMessenger(MessengerInterface $messenger)
    {
        $this->messenger = $messenger;

        return $this;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return self
     */
    public function log($level, $message, array $context = [])
    {
        if ($this->messenger) {
            $this->messenger->log($level, $message, $context);
        }

        return $this;
    }

    /**
     * @param Container $container
     *
     * @return void
     */
    public function setExternalDependencies(Container $container)
    {
        $dependencyContainer = $this->getDependencyContainer();
        if (isset($dependencyContainer)) {
            $this->getDependencyContainer()->setContainer($container);
        }
    }

    /**
     * TODO move to constructor
     *
     * @param AbstractFacade $facade
     *
     * @return void
     */
    public function setOwnFacade(AbstractFacade $facade)
    {
        $this->facade = $facade;
    }

    /**
     * For autocompletion use typehint in class docblock like this: "@method MyFacade getFacade()"
     *
     * @return AbstractFacade
     */
    protected function getFacade()
    {
        return $this->facade;
    }

    /**
     * @param AbstractCommunicationDependencyContainer $dependencyContainer
     *
     * @return self
     */
    public function setDependencyContainer(AbstractCommunicationDependencyContainer $dependencyContainer)
    {
        $this->dependencyContainer = $dependencyContainer;

        return $this;
    }

    /**
     * @return AbstractCommunicationDependencyContainer
     */
    protected function getDependencyContainer()
    {
        return $this->dependencyContainer;
    }

    /**
     * @param AbstractQueryContainer $queryContainer
     *
     * @return self
     */
    public function setQueryContainer(AbstractQueryContainer $queryContainer)
    {
        $this->queryContainer = $queryContainer;

        return $this;
    }

    /**
     * @return AbstractQueryContainer
     */
    protected function getQueryContainer()
    {
        return $this->queryContainer;
    }

}
