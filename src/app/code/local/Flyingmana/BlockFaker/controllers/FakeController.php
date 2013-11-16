<?php
/**
 * 
 * 
 * 
 * 
 * 
 */

class Flyingmana_BlockFaker_FakeController extends Mage_Core_Controller_Front_Action
{

    /**
     * returns an array of possible products
     */
    private function createProductMocks(){
        
        $mocks = array();


        foreach( array(
                     Mage_Catalog_Model_Product_Type::TYPE_SIMPLE,
                     Mage_Catalog_Model_Product_Type::TYPE_CONFIGURABLE,
                     Mage_Catalog_Model_Product_Type::TYPE_GROUPED,
                     Mage_Catalog_Model_Product_Type::TYPE_BUNDLE,
                     Mage_Catalog_Model_Product_Type::TYPE_VIRTUAL,
                 ) as $type ){

            foreach( array(false,12.21) as $finalPrice ){

                $productMock = Mage::getModel('catalog/product');
                $productMock->setData('type_id', $type);
                $productMock->setPrice('42.23');
                if( $finalPrice !== false ){
                    $productMock->setFinalPrice($finalPrice);
                }

                $mocks[] = $productMock;
            }
        }
        
        
        
        return $mocks;
    }
    
    public function priceAction(){
        
        $this->loadLayout();
        $helperMocks = array(
            array(
                'tax' => array(
                    'display_both_prices' => false,
                ),
                'weee' => array(
                    'type_of_display' => 0,
                ),
            ),
            array(
                'tax' => array(
                    'display_both_prices' => false,
                ),
                'weee' => array(
                    'type_of_display' => 1,
                ),
            ),
            array(
                'tax' => array(
                    'display_both_prices' => false,
                ),
                'weee' => array(
                    'type_of_display' => 2,
                ),
            ),
            array(
                'tax' => array(
                    'display_both_prices' => false,
                ),
                'weee' => array(
                    'type_of_display' => 3,
                ),
            ),
            array(
                'tax' => array(
                    'display_both_prices' => true,
                ),
                'weee' => array(
                    'type_of_display' => 4,
                ),
            ),
        );
        
        foreach( $helperMocks as $helperMock ){

            foreach( $this->createProductMocks() as $productMock ){
                $priceBlock = $this->getLayout()->createBlock('flyingmana_blockfaker/product_price');
                $priceBlock->setTemplate('catalog/product/price.phtml');
                $priceBlock->setData('product', $productMock );
                $priceBlock->setHelperMock('tax',  $helperMock['tax']);
                $priceBlock->setHelperMock('weee', $helperMock['weee']);
                $this->getLayout()->getBlock('content')->append($priceBlock);
                $this->getLayout()->getBlock('content')->append(
                    $this->getLayout()->createBlock('core/text',null,array(
                            'text'=>
                              '########<br/>'.
                              'ProductType: '.$productMock->getTypeId().
                              ' <br/>'.
                              var_export($helperMock,true).
                              '<br/>########<hr/>'
                        ))
                );
            }
        }
        
        $this->renderLayout();
    }
    
} 