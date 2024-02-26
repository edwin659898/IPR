<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/user/profile', 'user.profile')->name('user.profile')->middleware('auth');
Route::patch('/user/profile', 'UserController@updateProfile')->name('update.profile')->middleware('auth');
Route::middleware(['updateProfile'])->group(function () {
  //user
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/ipr/{id}/show', 'UserController@show')->name('user.show');
  Route::get('/ipr', 'TodoController@todos');
  Route::get('/ipr/create', 'UserController@create')->name('user.create');
  Route::post('/ipr/create', 'UserController@store')->name('user.store');
  Route::get('/ipr/{id}/edit', 'TodoController@edit')->name('todo.edit');
  Route::patch('/ipr/{id}/update', 'UserController@update')->name('user.update');
  Route::get('/ipr/{id}/destroy', 'UserController@destroy')->name('user.destroy');
  Route::get('/ipr/{id}/file', 'TodoController@file')->name('todo.file');
  Route::get('/ipr/{id}/RejectedItems', 'TodoController@rejected')->name('todo.rejected');

  //SLO
  Route::get('/ipr/site-review/kiambere', 'SiteController@kiambere')->name('site.kiambere');
  Route::get('/ipr/site-review/nyongoro', 'SiteController@nyongoro')->name('site.nyongoro');
  Route::get('/ipr/site-review/7Forks', 'SiteController@forks')->name('site.forks');

  //SLM
  Route::get('/ipr/site-review/sosoma', 'SiteController@sosoma')->name('site.sosoma');
  Route::get('/ipr/site-review/dokolo', 'SiteController@dokolo')->name('site.dokolo');
  Route::patch('/ipr/{id}/updateSLM', 'SiteController@updateSLM')->name('site.updateSLM');
  Route::get('/ipr/{id}/SiteReviewer', 'SiteController@showSLM')->name('site.showSLM');

  //HOD
  Route::get('/ipr/{id}/showHOD', 'DeptController@showHOD')->name('dept.showHOD');
  Route::get('/ipr/HOD/IT', 'DeptController@it')->name('dept.it');
  Route::get('/ipr/HOD/HR', 'DeptController@hr')->name('dept.hr');
  Route::get('/ipr/HOD/Forestry', 'DeptController@forestry')->name('dept.forestry');
  Route::get('/ipr/HOD/Operations', 'DeptController@operation')->name('dept.operation');
  Route::get('/ipr/HOD/Miti', 'DeptController@miti')->name('dept.miti');
  Route::get('/ipr/HOD/Communications', 'DeptController@communication')->name('dept.communication');
  Route::get('/ipr/HOD/Accounts', 'DeptController@account')->name('dept.account');
  Route::get('/ipr/HOD/M&E', 'DeptController@ME')->name('dept.ME');
  Route::patch('/ipr/{id}/updateHOD', 'DeptController@updateHOD')->name('dept.updateHOD');

  //OP
  Route::get('/ipr/operations', 'OperationController@op')->name('operation.op');
  Route::patch('/ipr/{id}/updateOP', 'OperationController@updateOP')->name('operation.updateOP');
  Route::patch('/ipr/{id}/approve', 'OperationController@approve')->name('operation.approve');
  Route::get('/ipr/{id}/showOperations', 'OperationController@showOperation')->name('operation.showOperation');
  Route::get('/ipr/{id}/File/Delete', 'TodoController@fileDestroy')->name('file.delete');


  //MD
  Route::get('/ipr/AuthorizationDFO', 'MDController@mdO')->name('md.mdOpex');
  Route::get('/ipr/AuthorizationMD', 'MDController@mdC')->name('md.mdCapex');
  Route::get('/ipr/Authorization-Construction', 'MDController@mdConstruction')->name('md.mdConstruction');
  Route::get('/ipr/Authorization-Softwares-and-Licenses', 'MDController@mdSoftware')->name('md.mdSoftware');
  Route::get('/ipr/{id}/showAuthorization', 'MDController@showMD')->name('md.showMD');
  Route::patch('/ipr/{id}/updateMD', 'MDController@updateMD')->name('md.updateMD');

  //APPROVED
  Route::get('/ipr/ApprovedIPRs', 'ApprovedController@final')->name('approved.final');
  Route::get('/ipr/{id}/PrintIPR', 'ApprovedController@showFinal')->name('approved.showFinal');
  Route::get('/ipr/{id}/Attachments', 'ApprovedController@attachment')->name('approved.attachment');
  Route::patch('/ipr/{id}/complete', 'ApprovedController@complete')->name('approved.complete');
  Route::patch('/ipr/{id}/incomplete', 'ApprovedController@incomplete')->name('approved.incomplete');

  //SUPPLIER
  Route::get('/ipr/NewSupplier', 'SupplierController@supplier')->name('sup.supplier');
  Route::get('/ipr/MySuppliers', 'SupplierController@Mysuppliers')->name('sup.mysuppliers');
  Route::get('/ipr/UnapprovedSuppliers', 'SupplierController@viewSupplier')->name('sup.viewSupplier');
  Route::post('/ipr/createSupplier', 'SupplierController@storeSupplier')->name('sup.storeSupplier');
  Route::get('/ipr/viewSupplier', 'SupplierController@viewSupplier')->name('sup.viewSupplier');
  Route::get('/ipr/ApprovedSuppliers', 'SupplierController@approvedSupplier')->name('sup.approvedSupplier');
  Route::patch('/ipr/{id}/AuthorizeSupplier', 'SupplierController@updateSupplier')->name('sup.updateSupplier');
  Route::patch('/ipr/{id}/RejectSupplier', 'SupplierController@rejectSupplier')->name('sup.rejectSupplier');
  Route::patch('/ipr/{id}/AmendSupplier', 'SupplierController@updateMySupplier')->name('sup.updateMySupplier');
  Route::get('/ipr/{id}/SupplierDetails', 'SupplierController@showSupplier')->name('sup.showSupplier');
  Route::get('/ipr/{id}/MySupplierDetails', 'SupplierController@showMySupplier')->name('sup.showMySupplier');
  Route::get('/ipr/{id}/PrintSupplier', 'SupplierController@printSupplier')->name('sup.printSupplier');
  Route::get('/ipr/{id}/SupplierDocuments', 'SupplierController@SupplierDoc')->name('sup.supplierdoc');

  //TRACE
  Route::get('/ipr/Trace', 'TodoController@trace')->name('todo.trace');
  Route::get('/ipr/{id}/Delete', 'TodoController@destroy')->name('ipr.delete');
});

Route::get('/', function () {
  return redirect()->route('login');
});

Auth::routes(['verify' => true]);
