<?php

class DIM_New_Block_Adminhtml_News_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Init form
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('block_form');
        $this->setTitle(Mage::helper('new')->__('Block Information'));
    }
    
    
/**
     * Load Wysiwyg on demand and Prepare layout
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }
   

    protected function _prepareForm()
    {
        $model = Mage::registry('new_block');

        $form = new Varien_Data_Form(
            array('id' => 'edit_form', 
                'action' => $this->getUrl('*/*/save',array('id'=>  $this->getRequest()->getParam('id'))), 
                'method' => 'post',
                'enctype'=>'multipart/form-data')
        );

        $form->setHtmlIdPrefix('block_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('new')->__('General Information'), 'class' => 'fieldset-wide'));

        if ($model->getBlockId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('new')->__('Block Title'),
            'title'     => Mage::helper('new')->__('Block Title'),
            'required'  => true,
        ));
        
        $fieldset->addType('myimage', 'DIM_New_Block_Adminhtml_News_Edit_Renderer_Myimage');
        
        $fieldset->addField('image', 'myimage', array(
            'name'      => 'image',
            'label'     => Mage::helper('new')->__('Image'),
            'title'     => Mage::helper('new')->__('Image'),
            
        ));
        
        $fieldset->addField('content', 'editor', array(
            'label' => Mage::helper('new')->__('Content'),
            'title' => Mage::helper('new')->__('Content'),
            'required' => true,
            'name' => 'content',
            'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig()
        ));
        
        $fieldset->addField('news_status', 'select', array(
            'label'     => Mage::helper('new')->__('Status'),
            'title'     => Mage::helper('new')->__('Status'),
            'name'      => 'status',
            'required'  => true,
            'options'   => Mage::getModel('new/source_status')->toArray(),
        ));
        
        


      
     
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
