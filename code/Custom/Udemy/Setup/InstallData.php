<?php

namespace Custom\Udemy\Setup;

use Magento\Cms\Model\PageFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $pageFactory;
    private $blockFactory;

    public function __construct(PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $cmsPageData = [
            'title' => 'Custom cms page',
            'page_layout' => '1column',
            'meta_keywords' => 'Page keywords',
            'meta_description' => 'Page description',
            'identifier' => 'custom-page',
            'content_heading' => 'Custom cms page',
            'content' => "<h1>Welcome to the cms page</h1>",
            'is_active' => 1,
            'stores' => [0],
            'sort_order' =>10
        ];
        $this->pageFactory->create()->setData($cmsPageData)->save();
    }
}