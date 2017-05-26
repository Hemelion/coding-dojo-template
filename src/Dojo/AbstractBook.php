<?php

namespace Dojo;

abstract class AbstractBook {
    private $_price = 8;
    
    /**
     * @return string
     */
    public function getName() {
        return static::class;
    }
    /**
     * @return int
     */
    public function getPrice() {
        return $this->_price;
    }
}
