<?php

namespace Dojo;

class Basket
{
    private static $DISCOUNT_TABLE = array(2 => 5, 3 => 10, 4 => 20, 5 => 25);
    private $_collection           = array();

    /**
     * @param \Dojo\Book $item
     */
    public function add(AbstractBook $item) {
        if(isset($this->_collection[$item->getName()])) {
            $this->_collection[$item->getName()]['value']++;
        } else {
            $this->_collection[$item->getName()] = array('value' => 1, 'item' => $item);
        }
    }
    
    /**
     * @return float
     */
    public function getCost() {
        $cost = 0;
        if(empty($this->_collection)){
            return $cost;
        }
        foreach ($this->_collection as $item) {
            if($item['item'] instanceof AbstractBook) {
                $cost += $item['value'] * $item['item']->getPrice();
            }
        }
        return $cost - $this->getDiscount();
    }
    
    /**
     * @return float
     */
    private function getDiscount() {
        $temp = $this->_collection;
        return $this->countCollectionDiscount($temp);
    }
    
    /**
     * @param array $collection
     * @return float
     */
    private function countCollectionDiscount(array $collection) {
        $cost = 0;
        if(!empty($collection)) {
            $count = count($collection);
            foreach ($collection as $key => $item) {
                $cost += $item['item']->getPrice();
                --$collection[$key]['value'];
                if($collection[$key]['value'] == 0) {
                    unset($collection[$key]);
                }
            }
            return round ( $cost * ( self::$DISCOUNT_TABLE[$count] ) / 100 , 2) + $this->countCollectionDiscount($collection);
        }
        return $cost;
    }
}
