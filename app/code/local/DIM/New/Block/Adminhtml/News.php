<?php



class DIM_New_Block_Adminhtml_News extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_news';
        $this->_blockGroup='new';
        $this->_headerText = Mage::helper('new')->__('News');
        $this->_addButtonLabel = Mage::helper('new')->__('Add News');
        parent::__construct();
    }

}
