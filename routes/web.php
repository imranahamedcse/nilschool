<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // Set a warning toast, with no title
    toastr()->warning('Are you sure you want to proceed ?');

    // Set a success toast, with a title
    toastr()->success('Data has been saved successfully!', 'Congrats');

    // Set an error toast, with a title
    toastr()->error('Oops! Something went wrong!', 'Oops!');

    // Override global config options from 'config/toastr.php'
    toastr()->success('Data has been saved successfully!', 'Congrats', ['timeOut' => 5000]);
    
    return view('empty');
});
Route::get('/admin', function () {
    return view('backend.admin.dashboard');
});
Route::get('/datatable', function () {
    return view('backend.admin.datatable');
});