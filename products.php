<?php
    //DEFINE OS HEADERS PARA NAO RETORNAR ERRO AO APP
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type,x-prototype-version,x-requested-with');

    $urlWS  = $_GET['WS_URL'].'/api/soap/?wsdl';
    $userWS = $_GET['WS_USER'];
    $passwordWS = $_GET['WS_PASSWORD'];
    $stockPorc  = $_GET['PORC_STOCK'];

    $proxy = new SoapClient($urlWS);
    $sessionId = $proxy->login($userWS, $passwordWS);

    $products = $proxy->call($sessionId, 'catalog_product.list');
    $arrayProducts = array();
    
    foreach ($products as $product) {
        array_push( $arrayProducts, $product );
    }
    
    echo( json_encode( $arrayProducts ) );
?>