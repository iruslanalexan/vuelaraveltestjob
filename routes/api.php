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
    return \App\Car::with('colors')->orderBy('id')->get();
});

Route::get('/cars/{id}', function (Request $request,$id) {
    $car = \App\Car::find($id);
    $colors = $car->colors()->get();

    $car = $car->toArray();
    $car['colors'] = [];

    foreach($colors as $color){
        $car['colors'][] = $color->id;
    }

    return $car;
});

Route::post('/cars/edit/{id}', function (Request $request,$id) {

    // dd($request->all());
    $car = \App\Car::find($id);
    $car->name = $request->name;
    $car->pub_year = $request->pub_year;
    $car->engine_volume = $request->engine_volume;
    $car->engine_number = $request->engine_number;

    $car->description = $request->description;

    $file = $request->file('image');
    if(!empty($file)){
        $path = $file->path();
        $imagePath = $file->store('images');
        $car->image = $imagePath;
    }

    $car->save();

    $colors = explode(",",$request->colors);
    $car->colors()->sync($colors);

    return ['success' => true];
});

Route::post('/cars/create', function (Request $request) {

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



