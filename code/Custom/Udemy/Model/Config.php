<?php
/**
 * Created by PhpStorm.
 * User: naveeni
 * Date: 9/9/22
 * Time: 4:37 PM
 */

namespace Custom\Udemy\Model;
use  Magento\Framework\App\Config\ScopeConfigInterface;

use Magento\Framework\Config\Scope;

class Config
{
    const XML_PATH_ENABLED='udemy/general/enabled';

    private $config;

    public function __construct(ScopeConfigInterface $config)
    {
        $this->config=$config;
    }
    public function isEnabled(){
        return $this->config->getValue(self::XML_PATH_ENABLED);
    }
}