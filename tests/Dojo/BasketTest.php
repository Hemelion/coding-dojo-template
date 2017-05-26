<?php

use Dojo;

class ExampleTest extends PHPUnit_Framework_TestCase
{
    private $_basket = null;
    // This method will be called *before* each test run.
    public function setUp() {
        $this->_basket = new Dojo\Basket();
    }
    
    // This method will be called *after* each test run.
    public function tearDown() 
    {
    }
    
    public function testZeroItemValue()
    {
        $this->assertEquals(0, $this->_basket->getCost());
    }
    
    public function testOneSeriesBookValue() 
    {
        $book1 = new Dojo\Book1();
        $this->_basket->add($book1);
        $this->assertEquals(8, $this->_basket->getCost());
    }
    
    public function testTwoDiffrentSeriesBookValue() 
    {
        $book1 = new Dojo\Book1();
        $book2 = new Dojo\Book2();
        $this->_basket->add($book1);
        $this->_basket->add($book2);
        $this->assertEquals(16 - (16*5/100), $this->_basket->getCost());
    }
    
    public function testTwoSameSeriesBookValue() 
    {
        $book1 = new Dojo\Book1();
        $book2 = new Dojo\Book1();
        $this->_basket->add($book1);
        $this->_basket->add($book2);
        $this->assertEquals(16, $this->_basket->getCost());
    }
    public function testFinalCostScore() 
    {    
        $book1 = new Dojo\Book1();
        $book2 = new Dojo\Book2();
        $book3 = new Dojo\Book3();
        $book4 = new Dojo\Book4();
        $book5 = new Dojo\Book5();
        $this->_basket->add($book1);
        $this->_basket->add($book1);
        $this->_basket->add($book2);
        $this->_basket->add($book2);
        $this->_basket->add($book3);
        $this->_basket->add($book3);
        $this->_basket->add($book4);
        $this->_basket->add($book5);
        // 8 ksiazek, kazda za 8 EUR, = 64 EUR za zestaw bez promocji
        // na 5 ksiazek otrzymujemy 25% znizki, czyli z 40 EUR = 10 EUR
        // na 3 ksiazki, otrzymujemy 10% znizki, czyli 2,4 EUR
        // 64 - (10 + 2,4 ) = 51.60 - BLAD W ZADANIU?
        $this->assertEquals(51.60, $this->_basket->getCost());
    }
}
