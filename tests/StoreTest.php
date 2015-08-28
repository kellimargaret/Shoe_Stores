<?php

    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */
    require_once "src/Store.php";
    //require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
        }
        
        function testGetStoreName()
        {
            //Arrange
            $store_name = "Nordstrom";
            $test_store = new Store($store_name);


            //Act
            $result = $test_store->getStoreName();

            //Assert
            $this->assertEquals($store_name, $result);
        }

        function testSave()
        {
            //Arrange
            $store_name = "Norstrom";
            $id = null;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store], $result);
        }
    }
?>