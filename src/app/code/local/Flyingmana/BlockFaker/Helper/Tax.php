<?php
/**
 * 
 * 
 * 
 * 
 * 
 */ 

class Flyingmana_BlockFaker_Helper_Tax extends Mage_Tax_Helper_Data
implements Flyingmana_BlockFaker_Interface_HelperMock
{
    use Flyingmana_BlockFaker_Trait_HelperMock;
    
    public function displayBothPrices(){
        return 
          isset($this->mockData['display_both_prices']) ?
            $this->mockData['display_both_prices'] : 
            parent::displayBothPrices()
          ;
    }
}

