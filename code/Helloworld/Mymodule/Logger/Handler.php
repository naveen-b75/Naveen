<?php
namespace Helloworld\Mymodule\Logger;

use Magento\Framework\Logger\Handler\Base;
use Monolog\Logger;

class Handler extends Base{

    protected $loggerType =Logger::INFO;
    protected $fileName ='/var/log/debug_custom.log';
}