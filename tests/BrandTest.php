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
            $brand_name = "Sketchers";
            $test_brand = new Brand($brand_name);


            //Act
            $result = $test_brand->getBrandName();

            //Assert
            $this->assertEquals($brand_name, $result);
        }

        function testSave()
        {
            //Arrange
            $brand_name = "Sketchers";
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
            $brand_name = "Sketchers";
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

        function testDeleteAll()
        {
            //Arrange
            $brand_name = "Sketchers";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $another_brand = "Doc Martin";
            $test_brand2 = new Brand($another_brand);
            $test_brand2->save();

            //Act
            Brand::deleteAll();
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function testDeleteBrand()
        {
            //Arrange
            $brand_name = "Sketchers";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $another_brand = "Doc Martin";
            $test_brand2 = new Brand($another_brand);
            $test_brand2->save();

            //Act
            $test_brand->delete();
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand2], $result);
        }

        function testUpdate()
        {
            //Arrange
            $brand_name = "Sketchers";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $new_name = "Vans";

            //Act
            $test_brand->update($new_name);

            //Assert
            $this->assertEquals($new_name, $test_brand->getBrandName());
        }

        function testAddStore()
        {
            //Arrange
            $brand_name = "Sketchers";
            $id = null;
            $test_brand = new Brand($brand_name, $id);
            $test_brand->save();

            $store_name = "Norstrom";
            $test_store = new Store($store_name, $id);
            $test_store->save();

            //Act
            $test_brand->addStore($test_store);
            $result = $test_brand->getStores();

            //Assert
            $this->assertEquals([$test_store], $result);
        }

        function testGetStores()
        {
            //Arrange
            $brand_name = "Sketchers";
            $id = null;
            $test_brand = new Brand($brand_name, $id);
            $test_brand->save();

            $another_brand = "Doc Martin";
            $test_brand2 = new Brand($another_brand, $id);
            $test_brand2->save();

            $store_name = "Norstrom";
            $test_store = new Store($store_name, $id);
            $test_store->save();

            //Act
            $test_store->addBrand($test_brand);
            $test_store->addBrand($test_brand2);
            $result = $test_store->getBrands();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);

        }


    }


?>
