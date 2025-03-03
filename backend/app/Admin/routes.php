<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
    'as' => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('qor-languages', QorLanguagesController::class);
    $router->resource('qor-categories', QorCategoriesController::class);
    $router->resource('qor-pstars', QorPstarsController::class);
    $router->resource('qor-sources', QorSourcesController::class);
    $router->resource('qor-videos', QorVideosController::class);
    $router->resource('qor-partners', QorPartnersController::class);
});
