<?php

use App\Infrastructure\Middleware\ValidateAdmin;
use App\Ports\API\Controllers\Auth\AuthController;
use App\Ports\API\Controllers\Buildings\Admin\AddressController;
use App\Ports\API\Controllers\Buildings\Admin\BuildingController as AdminBuilding;
use App\Ports\API\Controllers\Buildings\Admin\AdvantageController as AdminAdvantage;
use App\Ports\API\Controllers\Buildings\Admin\LayoutController;
use App\Ports\API\Controllers\Buildings\Admin\LocationController;
use App\Ports\API\Controllers\Buildings\Admin\PriceController;
use App\Ports\API\Controllers\Buildings\Admin\TechnologyController as AdminTechnology;
use App\Ports\API\Controllers\Buildings\Admin\LandscapingController as AdminLandscaping;
use App\Ports\API\Controllers\Buildings\Admin\HouseClassController as AdminHouseClass;
use App\Ports\API\Controllers\Buildings\BuildingController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1/auth',
    'as'    => 'v1.auth.'
], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

/**
 * Buildings.
 */
Route::group([
    'prefix' => 'v1/building',
], function () {
    Route::get('/{id}/find', [BuildingController::class, 'find']);
    Route::get('/all', [BuildingController::class, 'all']);
});

Route::resource('v1/advantage', AdminAdvantage::class)
    ->middleware(['auth:sanctum', ValidateAdmin::class])->except(['create', 'edit']);

Route::resource('v1/technology', AdminTechnology::class)
    ->middleware(['auth:sanctum', ValidateAdmin::class])->except(['create', 'edit']);

Route::resource('v1/landscaping', AdminLandscaping::class)
    ->middleware(['auth:sanctum', ValidateAdmin::class])->except(['create', 'edit']);

Route::resource('v1/house-class', AdminHouseClass::class)
    ->middleware(['auth:sanctum', ValidateAdmin::class])->except(['create', 'edit']);

Route::resource('v1/admin/building', AdminBuilding::class)
    ->middleware(['auth:sanctum', ValidateAdmin::class])->only(['store', 'update', 'destroy']);


Route::group([
    'prefix' => 'v1/admin/address',
    'middleware' => ['auth:sanctum', ValidateAdmin::class],
], function () {
    Route::get('/all', [AddressController::class, 'all']);
    Route::get('/{buildingId}', [AddressController::class, 'findByBuilding']);

    Route::put('/{buildingId}/update', [AddressController::class, 'updateByBuilding']);
    Route::delete('/{buildingId}/delete', [AddressController::class, 'deleteByBuilding']);
});

Route::group([
    'prefix' => 'v1/admin/location',
    'middleware' => ['auth:sanctum', ValidateAdmin::class],
], function () {
    Route::get('/all', [LocationController::class, 'all']);
    Route::get('/{buildingId}', [LocationController::class, 'findByBuilding']);

    Route::put('/{id}/update', [LocationController::class, 'updateByBuilding']);
    Route::delete('/{id}/delete', [LocationController::class, 'deleteByBuilding']);
});

Route::group([
    'prefix' => 'v1/admin/price',
    'middleware' => ['auth:sanctum', ValidateAdmin::class],
], function () {
    Route::get('/all', [PriceController::class, 'all']);
    Route::get('/{buildingId}', [PriceController::class, 'findByBuilding']);

    Route::put('/{buildingId}/update', [PriceController::class, 'updateByBuilding']);
    Route::delete('/{buildingId}/delete', [PriceController::class, 'deleteByBuilding']);
});

Route::group([
    'prefix' => 'v1/admin/layout',
    'middleware' => ['auth:sanctum', ValidateAdmin::class],
], function () {
    Route::get('/all', [LayoutController::class, 'all']);
    Route::get('/{buildingId}', [LayoutController::class, 'findByBuilding']);

    Route::put('/{id}/update', [LayoutController::class, 'updateByBuilding']);
    Route::delete('/{id}/delete', [LayoutController::class, 'deleteByBuilding']);
});
