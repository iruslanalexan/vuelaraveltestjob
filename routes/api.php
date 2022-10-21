<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cars/get_image', function (Request $request) {
    $car = \App\Car::findOrFail($request->id);
    return response()->file(storage_path('app/'.$car->image));
    
});

Route::get('/colors', function (Request $request) {
    return \App\CarColor::all();
});

Route::get('/cars/delete', function (Request $request) {
    \App\Car::destroy($request->id);
    return ["status" => $request->id];
});

Route::get('/cars', function (Request $request) {
    $d = \App\Car::with('colors')->get();
    // dd($d);
    return $d;
});

Route::post('/cars/create', function (Request $request) {
    // $request->validate([
        // 'user_name'  => 'required',
        // 'user_image' => 'required|image|max:2048'
    // ]);    
    $file = $request->file('image');
    $path = $file->path();
    $imagePath = $file->store('images');
    
    $car = new \App\Car;
    $car->name = $request->name;
    $car->pub_year = $request->pub_year;
    $car->engine_volume = $request->engine_volume;
    $car->engine_number = $request->engine_number;

    $car->description = $request->description;

    $car->image = $imagePath;
    $car->save();

    $colors = explode(",",$request->colors);
    $car->colors()->sync($colors);

    return ['success' => true];
});



