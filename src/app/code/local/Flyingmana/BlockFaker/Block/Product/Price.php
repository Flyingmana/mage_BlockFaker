<?php
/**
 * 
 * 
 * 
 * 
 * 
 */ 


class Flyingmana_BlockFaker_Block_Product_Price extends Mage_Core_Block_Template
{
    protected $helperMock = array();
    
    public function setHelperMock($helperName, $mockData){
        $this->helperMock[ $helperName ] = $mockData;
    }

    public function getProductAttribute($attribute){
        
        switch($attribute){
            case 'special_price':
                return $this->getProduct()->getResource()->getAttribute($attribute);
                break;
            default:
                throw new InvalidArgumentException("attribute '$attribute' not implemented in mock");
        }
    }
    
    public function helper($name){
        switch($name){
            case 'tax':
                $helper = Mage::getModel('Flyingmana_BlockFaker_Helper_Tax');
                break;
            case 'weee':
                $helper = Mage::getModel('Flyingmana_BlockFaker_Helper_Weee');
                break;
            default:
                $helper = parent::helper($name);
        }
        
        if( 
          isset($this->helperMock[$name]) 
          && $helper instanceof Flyingmana_BlockFaker_Interface_HelperMock 
        ){
            $helper->setMockData( $this->helperMock[$name] );
        }
        
        return $helper;
    }
}
