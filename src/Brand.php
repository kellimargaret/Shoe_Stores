<?php

    class Brand
{
    private $brand_name;
    private $id;

    //Constructors
    function __construct($brand_name, $id = null)
    {
        $this->brand_name = $brand_name;
        $this->id = $id;
    }

    // Getters
    function getBrandName()
    {
        return $this->brand_name;
    }

    function getId()
    {
        return $this->id;
    }

    //Setters
    function setBrandName($new_brand_name)
    {
        $this->brand_name = $new_brand_name;
    }

    // Save function
    function save()
    {
        $GLOBALS['DB']->exec(
            "INSERT INTO brands (brand_name) VALUES (
                ('{$this->getBrandName()}')
                );"
        );
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    //Delete single brand function
    function delete()
    {
        $GLOBALS['DB']->exec(
        "DELETE FROM brands WHERE id = {$this->getId()};"
        );
    }

    //Update single brand function
    function update($new_brand_name)
    {
        $GLOBALS['DB']->exec(
        "UPDATE brands SET brand_name = '{$new_brand_name}' WHERE id = {$this->getId()};"
        );
        $this->setBrandName($new_brand_name);
    }

    //Static functions
    static function getAll()
    {
        $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
        $all_brands = array();
        foreach ($returned_brands as $brand) {
            $brand_name = $brand['brand_name'];
            $id = $brand['id'];
            $new_brand = new Brand($brand_name, $id);
            array_push($all_brands, $new_brand);
        }
        return $all_brands;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM brands;");
    }

    static function find($search_id)
    {
        $found_brand = null;
        $brands = Store::getAll();
        foreach ($brands as $brand) {
            $brand_id = $brand->getId();
            if ($brand_id == $search_id) {
                $found_brand = $brand;
            }
        }
        return $found_brand;
    }
    
    //Methods involving Store class
    function addStore($new_store)
    {
        $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES (
        {$new_store->getId()},
        {$this->getId()});"
        );
    }

    function getStores()
        {
            $query = $GLOBALS['DB']->query(
                "SELECT stores.* FROM brands
                    JOIN stores_brands ON (brands.id = stores_brands.brand_id)
                    JOIN stores ON (stores_brands.store_id = stores.id)
                    WHERE brands.id = {$this->getId()};
                ");

            $matching_stores = array();
            foreach ($query as $store) {
                $store_name = $store['store_name'];
                $id = $store['id'];
                $new_store = new Store($store_name, $id);
                array_push($matching_stores, $new_store);
            }
            return $matching_stores;
        }

}

?>
