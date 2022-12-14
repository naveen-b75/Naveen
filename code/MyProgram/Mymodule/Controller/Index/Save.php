<?php
namespace MyProgram\Mymodule\Controller\Index;
use MyProgram\Mymodule\Model\View as View;
use MyProgram\Mymodule\Model\ResourceModel\View as ResourceView;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Cache\TypeListInterface;
use \Magento\Framework\App\Cache\Frontend\Pool;
use Magento\Framework\App\PageCache\Version;

class Save extends Action{
    private $view;
    private $resourceView;
    protected $cacheTypelist;
    protected $cacheFrontendTool;

    public function  __construct(Context $context,
        View $view,ResourceView $resourceView,TypeListInterface $cacheTypelist, Pool $cacheFrontendTool )
    {
        $this->cacheTypelist=$cacheTypelist;
        $this->cacheFrontendTool=$cacheFrontendTool;
        $this->view=$view;
        $this->resourceView=$resourceView;
        parent::__construct($context);
    }
    public  function  execute()
    {
        $params=$this->getRequest()->getParams();
        $view=$this->view->setData($params);

        try{
            $this->resourceView->save($view);
            $this->messageManager->addSuccessMessage(__("Successfully created"));
        }catch (\Exception $e){
            $this->messageManager->addErrorMessage(__("Failed"));
        }

        $redirect=$this->resultRedirectFactory->create();
        $redirect->setPath('mymodel/index/index');
        return $redirect;
    }
    public  function  cacheFunction(Version $subject){
        $types = array('config','layout','block_html','collections','reflection','db_ddl','eav','config_integration','config_integration_api','full_page','translate','config_webservice');
        foreach ($types as $key){
            $this->cacheTypelist->cleanType($key);
        }
        foreach ($this->cacheFrontendTool as $cacheFrontend){
            $cacheFrontend->getBackend()->clean();
        }
    }
}



