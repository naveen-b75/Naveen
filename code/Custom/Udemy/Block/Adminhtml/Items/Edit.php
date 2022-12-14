<?php
/**
 * Created by PhpStorm.
 * User: naveeni
 * Date: 14/9/22
 * Time: 4:07 PM
 */

namespace Custom\Udemy\Block\Adminhtml\Items;



use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;

class Edit extends Container
{
    protected $_coreRegistry=null;

    public function __construct(Context $context, \Magento\Framework\Registry $registry,array $data = [])
    {
        $this->_coreRegistry=$registry;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
       $this->_objectId='article_id';
       $this->_blockGroup='Custom_Udemy';
       $this->_controller='adminhtml_items';

       parent::_construct();
           $this->buttonList->update('save','label',__('Save Item'));
           $this->buttonList->add(
             'saveandcontinue',
             [
                 'label'=>__('Save and Continue'),
                 'class'=>'save',
                 'data_attribute'=>['mage-init'=>['button'=>['event'=>'saveAndContinueEdit','target'=>'#edit_form'],],]
             ],-100

           );

    }

    public function getHeaderText()
    {

        return __('Edit');
    }

    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('udemy/items/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }


}