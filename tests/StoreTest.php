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
    }
?>
