<?php
namespace Helloworld\Checkout\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Helloworld\Checkout\Model\Config;

class DeliveryDateConfigProvider implements ConfigProviderInterface
{
    /**
     * @var \Helloworld\Checkout\Model\Config
     */
    protected $config;

    /**
     * DeliveryDateConfigProvider constructor.
     *
     * @param Config $config
     */
    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        return $this->config->getConfig();
    }
}