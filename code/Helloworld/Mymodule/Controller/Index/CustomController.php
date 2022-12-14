<?php
namespace Helloworld\Mymodule\Controller\Index;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class CustomController extends  Action
{
    protected $urlRewriteFactory;
    public function __construct(
        Context $context,
        \Magento\UrlRewrite\Model\UrlRewriteFactory $urlRewriteFactory)
    {
        $this->urlRewriteFactory = $urlRewriteFactory;

        parent::__construct($context);
    }
    public function execute()
    {
        $urlRewrite = $this->urlRewriteFactory->create();

        /*if you want to rewrite url for “custom” set entity type*/
        $urlRewrite->setEntityType('custom');

        /*set current store ID */
        $urlRewrite->setStoreId(1);

        /*set 0 as this url is not created by system */
        $urlRewrite->setIsSystem(0);

        /* unique identifier - place random unique value to ID path */
        $urlRewrite->setIdPath(rand(1, 100000));

        /* set actual url path to target path field */

        $urlRewrite->setTargetPath("http://naveen.magento24.com/helloworld/index/customcontroller");

        /* set requested path which you want to create */
        $urlRewrite->setRequestPath("http://naveen.magento24.com/custom");

        /* set the type of Redirect */
        $urlRewrite->setRedirectType(301);

        /* save URL rewrite rule */
        $urlRewrite->save();
    }
}