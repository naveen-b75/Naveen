<?php
namespace Custom\Udemy\Cron;
use Custom\Udemy\Model\ViewFactory;
use Custom\Udemy\Model\Config;
class Cronitem {
    private $viewFactory;
    private $config;

    public function __construct(ViewFactory $viewFactory , Config $config)
    {
        $this->config=$config;
        $this->viewFactory=$viewFactory;
    }
    public function execute(){
        if($this->config->isEnabled()) {
            $this->viewFactory->create()
                ->setTitle('Cron Data')
                ->setContent('Scheduled at' . time())
                ->save();
        }

    }
}