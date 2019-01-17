<?php

Route::get(config('swagger.routes.web').'/{version?}', [
    'as'         => 'swagger.index',
    'middleware' => config('swagger.routes.middleware.index', []),
    'uses'       => '\Enda\YamlSwaggerLaravel\Http\Controllers\SwaggerController@index',
]);
Route::any(config('swagger.routes.docs').'/{version?}.json', [
    'as'         => 'swagger.docs',
    'middleware' => config('swagger.routes.middleware.docs', []),
    'uses'       => '\Enda\YamlSwaggerLaravel\Http\Controllers\SwaggerController@docs',
]);
