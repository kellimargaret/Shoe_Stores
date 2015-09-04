<?php

        require_once __DIR__."/../vendor/autoload.php";
        require_once __DIR__."/../src/Brand.php";
        require_once __DIR__."/../src/Store.php";

        $app = new Silex\Application();
        //$app [debug] = true;

        $server = 'mysql:host=localhost:8889;dbname=shoes';
        $username = 'root';
        $password = 'root';
        $DB = new PDO($server, $username, $password);


        $app->register(new Silex\Provider\TwigServiceProvider(), array(
            'twig.path' => __DIR__."/../views"
        ));

        use Symfony\Component\HttpFoundation\Request;
        Request::enableHttpMethodParameterOverride();

        //Get Calls
            $app->get("/", function() use ($app) {

                return $app['twig']->render('index.html.twig');
            });

        //Get Stores
            $app->get("/stores", function() use ($app) {
                return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
            });

            $app->get("/store/{id}", function($id) use ($app) {
                $store = Store::find($id);

                return $app['twig']->render('store.html.twig', array('store' => $store, 'brand_stores' => $store->getBrands(), 'all_brands' => Brand::getAll()));
            });

            $app->get("/stores/{id}/edit", function($id) use ($app) {
            $store = Store::find($id);

                return $app['twig']->render('store_edit.html.twig', array('store' => $store));
            });

        //Get Brands
            $app->get("/brands", function() use ($app) {
                return $app['twig']->render('brands.html.twig', array('all_brands' => Brand::getAll()));
            });

            $app->get("/brands/{id}", function($id) use ($app) {
            $brand = Brand::find($id);
                return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'brand_stores' => $brand->getStores(), 'stores' => Store::getAll()));
            });


        //Post Calls
        //Post Stores
            $app->post("/stores", function() use ($app){
            $store_name = $_POST['store_name'];
            $store = new Store($id = null, $store_name);
            $store->save();

                return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
            });

            $app->post("/stores/{id}", function($id) use ($app) {
            $store = Store::find($id);
            $brand = Brand::find($_POST['brand_id']);
            $store->addBrand($brand);

                return $app['twig']->render('store.html.twig', array('store' => $store, 'brand_stores' => $store->getBrands(), 'all_brands' => Brand::getAll()));
            });

        //Post Brands
            $app->post("/brands", function() use ($app){
            $brand_name = $_POST['brand_name'];
            $brand = new Brand($id = null, $brand_name);
            $brand->save();

                return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
            });

            $app->post("/brands/{id}", function($id) use ($app) {
            $brand = Brand::find($id);
            $store = Store::find($_POST['store_id']);
            $brand->addStore($store);

                return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'brand_stores' => $brand->getStores(), 'stores' => Store::getAll()));
            });


        //Delete all stores
            $app->post("/delete_stores", function() use ($app){
            Store::deleteAll();

                return $app['twig']->render('delete_stores.html.twig');
            });

            $app->delete("/stores/{id}", function($id) use ($app) {
            $store = Store::find($id);
            $store->delete();

                return $app['twig']->render('index.html.twig', array('stores' => Store::getAll()));
            });

            $app->patch("/store/{id}", function($id) use ($app) {
            $store_name = $_POST['store_name'];
            $store = Store::find($id);
            $store->update($store_name);

                return $app['twig']->render('store.html.twig', array('store' => $store, 'brand_stores' => $store->getBrands(), 'all_brands' => Brand::getAll()));
            });

        return $app;

?>
