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


}

?>
