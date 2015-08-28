<?php

    class Store
{
    private $store_name;
    private $id;

    //Constructors
    function __construct($store_name, $id = null)
    {
        $this->store_name = $store_name;
        $this->id = $id;
    }

    // Getters
    function getStoreName()
    {
        return $this->store_name;
    }

    function getId()
    {
        return $this->id;
    }

    //Setters
    function setStoreName($new_store_name)
    {
        $this->store_name = $new_store_name;
    }

    // Save function
    function save()
    {
        $GLOBALS['DB']->exec(
            "INSERT INTO stores (store_name) VALUES (
                ('{$this->getStoreName()}')
                );"
        );
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    //Delete single store function
    function delete()
    {
        $GLOBALS['DB']->exec(
        "DELETE FROM stores WHERE id = {$this->getId()};"
        );
    }

    //Update single store function
    function update($new_store_name)
    {
        $GLOBALS['DB']->exec(
        "UPDATE stores SET store_name = '{$new_store_name}' WHERE id = {$this->getId()};"
        );
        $this->setStoreName($new_store_name);
    }

    //Static functions
    static function getAll()
    {
        $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
        $all_stores = array();
        foreach ($returned_stores as $store) {
            $store_name = $store['store_name'];
            $id = $store['id'];
            $new_store = new Store($store_name, $id);
            array_push($all_stores, $new_store);
        }
        return $all_stores;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM stores;");
    }

    static function find($search_id)
    {
        $found_store = null;
        $stores = Store::getAll();
        foreach ($stores as $store) {
            $store_id = $store->getId();
            if ($store_id == $search_id) {
                $found_store = $store;
            }
        }
        return $found_store;
    }

    //Methods involving Brand class
    function addBrand($new_brand)
    {
        $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES (
        {$this->getId()},
        {$new_brand->getId()});
        );");
    }

    function getBrands()
    {
        $brands_query = $GLOBALS['DB']->query(
            "SELECT brands.* FROM stores
            JOIN stores_brands ON (stores.id = stores_brands.store_id)
            JOIN brands ON (stores_brands.brand_id = brands.id)
            WHERE stores.id = {$this->getId()};"
        );

        $matching_brands = array();
        foreach ($brands_query as $brand) {
            $brand_name = $brand['brand_name'];
            $id = $brand['id'];
            $new_brand = new Brand($brand_name, $id);
            array_push($matching_brands, $new_brand);
        }
        return $matching_brands;
    }


}

?>
