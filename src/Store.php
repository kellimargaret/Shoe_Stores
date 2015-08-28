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

    // Database storage methods
    function save()
    {
        $GLOBALS['DB']->exec(
            "INSERT INTO stores (store_name) VALUES (
                '{$this->getStoreName()}'
            );"
        );
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

}

?>
