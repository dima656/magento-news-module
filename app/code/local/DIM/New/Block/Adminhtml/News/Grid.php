<?php

class DIM_New_Block_Adminhtml_News_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('cmsBlockGrid');
        $this->setDefaultSort('date_created');
        $this->setDefaultDir('DESC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('new/news')->getCollection();
        /* @var $collection Mage_Cms_Model_Mysql4_Block_Collection */
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        

        $this->addColumn('title', array(
            'header'    => Mage::helper('new')->__('Title'),
            'align'     => 'left',
            'index'     => 'title',
        ));
        
         $this->addColumn('image', array(
            'header'    => Mage::helper('new')->__('Image'),
            'align'     => 'left',
            'index'     => 'image',
             'filter'   =>  FALSE,
             'sortavle' =>  FALSE,
             'renderer' =>'DIM_New_Block_Adminhtml_News_Grid_Renderer_Image'
        ));

        $this->addColumn('news_status', array(
            'header'    => Mage::helper('new')->__('Status'),
            'align'     => 'left',
            'type'      =>'options',
            'options'   => Mage::getModel('new/source_status')->toArray(),
            'index'     => 'news_status'
        ));


        $this->addColumn('date_created', array(
            'header'    => Mage::helper('new')->__('Date Created'),
            'index'     => 'date_created',
            'type'      => 'datetime',
        ));

        $this->addColumn('date_modified', array(
            'header'    => Mage::helper('new')->__('Last Modified'),
            'index'     => 'date_modified',
            'type'      => 'datetime',
        ));

        return parent::_prepareColumns();
    }

  
   protected function _prepareMassaction() {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setIdFieldName('id');
        $this->getMassactionBlock()
                ->addItem('delete',
                        array(
                            'label'=>Mage::helper('new')->__('Delete'),
                            'url'=>  $this->getUrl('*/*/massDelete'),
                            'confirm'=>Mage::helper('new')->__('are you sure?')
                        )
                        )
                 
        
             ->addItem('status',
                array(
                    'label' => Mage::helper('new')->__('Update status'),
                    'url' => $this->getUrl('*/*/massStatus'),
                    'additional'=>array(
                        'news_status'=>array(
                        'name'=>'news_status',
                            'type'=>'select',
                            'class'=>'requied-entry',
                            'label' => Mage::helper('new')->__('Status'),
                            'values'=>Mage::getModel('new/source_status')->toOptionArray()
                    ))
                )
            );
        
        
                        return $this;
    }

    

    /**
     * Row click url
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
