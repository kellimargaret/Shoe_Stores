<?php

    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */
    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
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

        function testGetAll()
        {
            //Arrange
            $store_name = "Norstrom";
            $test_store = new Store($store_name);
            $test_store->save();

            $another_store = "Madewell";
            $test_store2 = new Store($another_store);
            $test_store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $store_name = "Norstrom";
            $id = null;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            $another_store = "Madewell";
            $test_store2 = new Store($another_store, $id);
            $test_store2->save();

            //Act
            Store::deleteAll();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function testDeleteStore()
        {
            //Arrange
            $store_name = "Norstrom";
            $id = null;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            $another_store = "Madewell";
            $test_store2 = new Store($another_store, $id);
            $test_store2->save();

            //Act
            $test_store->delete();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store2], $result);
        }

        function testUpdate()
        {
            //Arrange
            $store_name = "Norstrom";
            $id = null;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            $new_name = "Ikea";

            //Act
            $test_store->update($new_name);

            //Assert
            $this->assertEquals($new_name, $test_store->getStoreName());
        }

        function testAddBrand()
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
            $test_store->addBrand($test_brand);
            $result = $test_store->getBrands();

            //Assert
            $this->assertEquals([$test_brand], $result);
        }

        function testGetBrands()
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
