<?php

Route::group(['middleware' => ['web']], function () {
    $middleware = [Enda\YamlSwaggerLaravel\Http\Middleware\Authenticate::class];
    Route::get(config('swagger.routes.web').'/auth/login', [
        'as'         => 'swagger.login',
        'uses'       => '\Enda\YamlSwaggerLaravel\Http\Controllers\SwaggerController@showLoginForm',
    ]);
    Route::get(config('swagger.routes.web').'/auth/logout', [
        'as'         => 'swagger.logout',
        'uses'       => '\Enda\YamlSwaggerLaravel\Http\Controllers\SwaggerController@logout',
    ]);
    Route::post(config('swagger.routes.web').'/auth/login', [
        'as'         => 'swagger.login.post',
        'uses'       => '\Enda\YamlSwaggerLaravel\Http\Controllers\SwaggerController@login',
    ]);

    Route::get(config('swagger.routes.web').'/{version?}', [
        'as'         => 'swagger.index',
        'middleware' => array_merge(config('swagger.routes.middleware.index', []), $middleware),
        'uses'       => '\Enda\YamlSwaggerLaravel\Http\Controllers\SwaggerController@index',
    ]);
    Route::any(config('swagger.routes.docs').'/{version?}.json', [
        'as'         => 'swagger.docs',
        'middleware' => array_merge(config('swagger.routes.middleware.docs', []), $middleware),
        'uses'       => '\Enda\YamlSwaggerLaravel\Http\Controllers\SwaggerController@docs',
    ]);
});
