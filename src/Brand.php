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
    function getStoreName()
    {
        return $this->brand_name;
    }

    function getId()
    {
        return $this->id;
    }

    //Setters
    function setStoreName($new_brand_name)
    {
        $this->brand_name = $new_brand_name;
    }

    // Save function
    function save()
    {
        $GLOBALS['DB']->exec(
            "INSERT INTO brands (brand_name) VALUES (
                ('{$this->getStoreName()}')
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
        $this->setStoreName($new_brand_name);
    }

    //Static functions
    static function getAll()
    {
        $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
        $all_brands = array();
        foreach ($returned_brands as $brand) {
            $brand_name = $brand['brand_name'];
            $id = $brand['id'];
            $new_brand = new Store($brand_name, $id);
            array_push($all_brands, $new_brand);
        }
        return $all_brands;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM brands;");
    }


}

?>
