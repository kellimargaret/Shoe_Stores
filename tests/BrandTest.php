<?php

    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */
    //require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
           Brand::deleteAll();
        }

        function testGetBrandName()
        {
            //Arrange
            $brand_name = "Nike";
            $test_brand = new Brand($brand_name);


            //Act
            $result = $test_brand->getBrandName();

            //Assert
            $this->assertEquals($brand_name, $result);
        }

        function testSave()
        {
            //Arrange
            $brand_name = "Nike";
            $id = null;
            $test_brand = new Brand($brand_name, $id);
            $test_brand->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand], $result);
        }
        
        function testGetAll()
        {
            //Arrange
            $brand_name = "Nike";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $another_brand = "Doc Martin";
            $test_brand2 = new Brand($another_brand);
            $test_brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }


    }


?>
