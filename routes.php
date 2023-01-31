<?php

use Pecee\SimpleRouter\SimpleRouter as Router;
// use system\Controller\SiteController;
use system\Helpers\Helpers;

try {
    Router::setDefaultNamespace('\system\Controller');
    // 
    Router::get('/', 'SiteController@index');
    Router::get(URL_SITE, 'SiteController@index');
    Router::get(URL_SITE.'/sobre', 'SiteController@about');
    Router::get(URL_SITE.'/post/{id}', 'SiteController@post');
    Router::post(URL_SITE.'/search', 'SiteController@search');

    Router::group(['namespace' => 'Admin'], function () {
        Router::get(URL_ADMIN,'AdminDashboard@dashboard');
    });
    // Router::post('localhost/blog/search', 'SiteController@search');
    Router::get(URL_SITE.'/404', 'SiteController@error404');

    Router::start();

}catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $ex){
    if(Helpers::localhost()){
        echo $ex->getMessage();
    }else{
        Helpers::redirect('/404');
    }

}
