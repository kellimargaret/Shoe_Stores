<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    $app = New Silex\Application();

    $server = 'mysql:host=localhost;dbname=shoes';
    $username = 'root';
    $password = 'root';

    $DB = new PDO($server, $username, $password);

    //Twig Path
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path'=>__DIR__."/../views"
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    //Get Calls
    $app->get("/", function() use($app) {
        return $app['twig']->render("index.html.twig", array(
            'brands' => Brand::getAll(), 'stores' => Store::getAll()));
    });

    $app->get("/stores", function($id) use ($app) {
       $store= Store::find($id);
       return $app['twig']->render("stores.html.twig", array('store' => $store));
   });

   //Post Calls
   //View all stores
   $app->post("/stores", function() use ($app) {
       $store_name = $_POST['store_name'];
       $store = new Store($store_name);
       $store->save();
       return $app['twig']->render("stores.html.twig", array('stores' => Store::getAll()));
   });

   //View the brands a store has
    $app->get('/stores/{id}', function($id) use ($app) {
        $store = Store::find($id);
        $brands = $store->getBrands();
        $all_brands = Brand::getAll();
        return $app['twig']->render('brands.html.twig', array('store' => $store, 'brands' => $brands, 'all_brands' => $all_brands));
    });

   //Delete all stores
   $app->post('/delete_stores', function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    //Add a brand to one store
        $app->post('/store/brands/{id}', function() use ($app) {
            $store = Store::find($_POST['store_id']);
            $brand = Brand::find($_POST['brand_id']);
            $store->addBrand($brand);
            $brands = $store->getBrands();
            $all_brands = Brand::getAll();
            return $app['twig']->render('stores.html.twig', array('store' => $store, 'brands' => $brands, 'all_brands' => $all_brands));
        });

    return $app;
?>
