<?php


class DIM_New_Block_Adminhtml_News_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_news';
        $this->_blockGroup='new';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('new')->__('Save News'));
        $this->_updateButton('delete', 'label', Mage::helper('new')->__('Delete News'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
           

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Get edit form container header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('new_block')->getId()) {
            return Mage::helper('new')->__("Edit News '%s'", $this->escapeHtml(Mage::registry('new_block')->getTitle()));
        }
        else {
            return Mage::helper('new')->__('New News');
        }
    }

}
