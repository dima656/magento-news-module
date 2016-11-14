<?php


class DIM_New_Adminhtml_NewsController extends Mage_Adminhtml_Controller_Action {
    
    
    public function indexAction( ) {
     
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('new/adminhtml_news'));
        $this->renderLayout();
    }
    
    public function newAction () {
        $this->_forward('edit');
    }
    
    public function editAction () {
        $id=  $this->getRequest()->getParam('id');
        Mage::register('new_block', Mage::getModel('new/news')->load($id));
        $blockObject=(array)  Mage::getSingleton('adminhtml/session')->getBlockObject(true);
        if(count($blockObject)) {
            Mage::registry('new_block')->setData($blockObject);
        }
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('new/adminhtml_news_edit'));
        $this->renderLayout();
        
    }
    
     protected function _uploadFile($fieldName,$model)
    {

        if( ! isset($_FILES[$fieldName])) {
            return false;
        }
        $file = $_FILES[$fieldName];

        if(isset($file['name']) && (file_exists($file['tmp_name']))){
            if($model->getId()){
               // unlink(Mage::getBaseDir('media').DS.$model->getData($fieldName));
            }
            try
            {
                $path = Mage::getBaseDir('media') . DS . 'dimnew' . DS;
                $uploader = new Varien_File_Uploader($file);
                $uploader->setAllowedExtensions(array('jpg','png','gif','jpeg'));
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(false);

                $uploader->save($path, $file['name']);
                $model->setData($fieldName,$uploader->getUploadedFileName());
                return true;
            }
            catch(Exception $e)
            {
                return false;
            }
        }
    }

        public function saveAction () {
        try { 
            $id=  $this->getRequest()->getParam('id');
        $block=Mage::getModel('new/news')->load($id);
        $datecreated=$block->getDateCreated();
        $isimageexist=$block->getImage();
        if(is_null($datecreated)&&  is_null($isimageexist)) {
            $block
                ->setData($this->getRequest()->getParams());
            $this->_uploadFile('image',$block);
            $block
                ->setDateCreated(Mage::app()->getLocale()->date()) 
                ->setDateModified(Mage::app()->getLocale()->date())
                ->save();
        } elseif (!is_null($datecreated)&&  is_null($isimageexist)) {
         $block
                ->setData($this->getRequest()->getParams());
            $this->_uploadFile('image',$block);
            $block 
                ->setDateModified(Mage::app()->getLocale()->date())
                ->save();
    }
        
        else {
            $block
                ->setData($this->getRequest()->getParams());
            $block
                ->setDateModified(Mage::app()->getLocale()->date())
                ->save();
        }
        
        
        
       if(!$block->getId()) {
           Mage::getSingleton('adminhtml/session')->addError('can not save the block');
       }   
     } catch (Exception $e) {
         Mage::logException($e);
         Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
         Mage::getSingleton('adminhtml/session')->setBlockObject($block->getData());
     }
       Mage::getSingleton('adminhtml/session')->addSuccess('block was saved successfully');
       
       $this->_redirect('*/*/' . $this->getRequest()->getParam('back','index'), array('id'=>$block->getId()));
    }
    
    public function deleteAction () {
        $block=Mage::getModel('new/news')
                ->setId($this->getRequest()->getParam('id'))
                ->delete();
        if($block->getId()) {
             Mage::getSingleton('adminhtml/session')->addSuccess('block was deleted successfully');
        }
         $this->_redirect('*/*/' );    
    }
    
    public function massStatusAction () {
        $statuses=  $this->getRequest()->getParams();
        try {
             $blocks=Mage::getModel('new/news')
                ->getCollection()
                ->addFieldToFilter('id',array('in'=>$statuses['massaction']));
        foreach ($blocks as $block) {
            $block->setNewsStatus($statuses['news_status'])->save();
           } 
        } catch (Exception $e) {
             Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            
            $this->_redirect('*/*/' ); 
         }
         
         $this->_redirect('*/*/' ); 
       
        Mage::getSingleton('adminhtml/session')->addSuccess('block were updated');
    }
    
    public function massDeleteAction () {
        $blocks=  $this->getRequest()->getParams();
        try {
             $blocks=Mage::getModel('new/news')
                ->getCollection()
                ->addFieldToFilter('id',array('in'=>$blocks['massaction']));
        foreach ($blocks as $block) {
            $block->delete();
           } 
        } catch (Exception $e) {
             Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
             
            $this->_redirect('*/*/' ); 
         }
         
         $this->_redirect('*/*/' ); 
       
        Mage::getSingleton('adminhtml/session')->addSuccess('block were deleted');
    }
}
