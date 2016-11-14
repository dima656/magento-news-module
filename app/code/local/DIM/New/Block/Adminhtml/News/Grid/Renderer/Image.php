<?php


class DIM_New_Block_Adminhtml_News_Grid_Renderer_Image
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(\Varien_Object $row) {
       
      if(!$row->getImage()) {
          return '';
      }
      
      $url=  Mage::getBaseUrl('media') . 'dimnew'.DS. $row->getImage();
      $html="<img src='$url' width='100' height='auto'>";
      return $html;
    
    }
}
