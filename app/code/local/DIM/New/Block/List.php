<?php


class DIM_New_Block_List extends Mage_Core_Block_Template {
   
     public function __construct()
    {
        parent::__construct();
        $news = Mage::getResourceModel('new/news_collection')
            ->addFieldToFilter('news_status',array('eq'=>  DIM_New_Model_Source_Status::ENABLED))
                ->setOrder('date_created','DESC');
        $this->setNews($news);
    }
    
    
   
    
     protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock('page/html_pager', 'dim_new.news.html.pager');
        $pager->setAvailableLimit(array(10=>10));
        $pager->setCollection($this->getNews()); 
        $this->setChild('pager', $pager);
        $this->getNews()->setPageSize(Mage::getStoreConfig('new/global/news_count'))->load();
        return $this;
    }
    
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
    


}

