<?php


/**
 * Used in creating options for Yes|No config value selection
 *
 */
class DIM_New_Model_Source_Status
{

    
    const ENABLED='1';
    const DISABLED='0';
    

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => self::ENABLED, 'label'=>Mage::helper('new')->__('ENABLED')),
            array('value' => self::DISABLED, 'label'=>Mage::helper('new')->__('DISABLED')),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
        self::DISABLED => Mage::helper('new')->__('DISABLED'),
        self::ENABLED => Mage::helper('new')->__('ENABLED'),
        );
    }

}
