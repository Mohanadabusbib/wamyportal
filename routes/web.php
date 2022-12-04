<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
/* Route::get('/', function () {
    return view('Maintenance.index');
}); */

Auth::routes(['verify' => true]);
Route::get('quran','quran\quranController@index')->name('quran');


Route::put('changePassword','UserController@changePassword')->name('changePassword');

Route::group(['middleware' => ['Lang', 'auth']], function () {

    Route::get('lang/{lang}', 'AdminController@changeLang')->name('changeLang');
    

    Route::get('/', function () {
        return view('auth.login');
    });
    
    Route::get('/MMA', function () {
        return view('index');
    });

    Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

    Route::get('profile', 'AdminController@profile')->name('showprofile');

    Route::post('profile', 'AdminController@updprofile')->name('profile');

    Route::get('disclosure/display', 'CoronaController@display')->name('disclosure.display');

    Route::get('disclosure/data', 'CoronaController@allData')->name('disclosure.allData');

    Route::resource('disclosure', 'CoronaController');

    Route::get('visitors/approvals', 'VisitorController@approval')->name('visitors.approvals');

    Route::get('security/{id}', 'VisitorController@display')->name('security');

    Route::resource('visitors', 'VisitorController');

    Route::resource('Inventory', 'Inventory\InventoryController');

    Route::get('Inventory-search/{typ}/{val}','Inventory\InventoryController@search') /* ->name('Inventory-search') */;

    Route::get('truncateData','Inventory\InventoryController@truncateData')->name('truncateData');

    Route::post('Inventory-newsearch/{id}','Inventory\InventoryController@newSearch')->name('Inventory-newsearch');

    Route::get('Inventory-printEmp/{id}','Inventory\InventoryController@printEmp')->name('Inventory-printEmp');
    Route::get('Inventory-printAllEmp','Inventory\InventoryController@printAllEmp')->name('Inventory-printAllEmp');
    

    Route::resource('Stocks', 'Inventory\InvtyStockController');

    Route::get('stocks-search/{id}', 'Inventory\InvtyStockController@search');

    Route::resource('Hardware', 'Inventory\InvtyHardwareController');

    Route::resource('Manufacturers', 'Inventory\InvtyManufacturersController');

    /* Route::get('registrAuction', 'Auction\AuctionController@registr')->name('registrAuction');
    Route::post('registrAuction', 'Auction\AuctionController@registrStore')->name('registrAuction');
    Route::get('registrApproval', 'Auction\AuctionController@registrApproval')->name('registrApproval');
    Route::post('updateApproval', 'Auction\AuctionController@updateApproval')->name('updateApproval'); */
    
    Route::resource('registrAuction', 'Auction\RegistrController');    
    Route::resource('auctions', 'Auction\AuctionController');
    Route::get('fReport','Auction\AuctionController@fReport')->name('fReport');
    
    

    Route::resource('Inventory', 'Inventory\InventoryController');

    Route::group(['namespace' => 'Saving'],function(){
    
        Route::resource('savings', 'SavingsController');
        Route::get('showAll', 'SavingsController@showAll')->name('contractAll');
        Route::resource('boxOrders', 'BoxordersController');
        Route::get('errorpage/{er}','BoxordersController@errorpage')->name('errorpage');
        /* Route::post('boxOrders-store', 'BoxordersController@store')->name('boxOrders-store'); */
        
        Route::resource('sponsor', 'BoxordersponsorsController');

        Route::resource('financial', 'BoxordersanalysisController');
        /* Route::group(['middleware' => 'registry'],function(){}); */
        
    
    

    Route::get('orders/{id}','BoxordersanalysisController@getData')->name('getOrderData');
    
    Route::get('orders','BoxordersanalysisController@showReport')->name('showReport');

    Route::get('printcontractOrder/{id}','BoxordersanalysisController@printcontractOrder')->name('printcontractOrder');   

    Route::get('contractOrder/{id}','BoxordersanalysisController@contractOrder')->name('contractOrder');

    Route::post('updatecontractOrder','BoxordersanalysisController@updatecontractOrder')->name('updatecontractOrder');

    Route::post('refusal-order','BoxordersanalysisController@refusalOrder');
    

    Route::get('savings-nomination','SavingsController@nomination')->name('savings.nomination');

    Route::post('storenomination','SavingsController@storenomination')->name('storenomination');

    Route::get('displaynomination','SavingsController@displaynomination')->name('displaynomination');

    Route::get('vote','SavingsController@vote')->name('vote');

    Route::get('resualt','SavingsController@resualt')->name('voteresualt');

    Route::get('vote-report','SavingsController@resualtAllData')->name('resualtAllData');

        Route::post('approvalvote','SavingsController@approvalvote')->name('approvalvote');
        Route::post('approvalvote2','SavingsController@approvalvote2')->name('approvalvote2');

        Route::post('savevote','SavingsController@savevote')->name('savevote');

        Route::get('savings-reports','SavingsController@openreports')->name('openreports');

        Route::get('savings/download/{filename}', 'SavingsController@getDownload')->name('getDownload');

        Route::get('savings/view_file/{filename}', 'SavingsController@open_file')->name('getfile');

        Route::get('nomination/view_file/{filename}', 'SavingsController@open_cv')->name('getcvfile');
    });
    Route::group(['namespace' => 'TransferData'],function(){        
        Route::get('transfer-data','TransferDataController@index')->name('transfer-data');

        Route::get('transfer-data/data','TransferDataController@storeEmpDate')->name('storeEmp');

        Route::get('transfer-data/box','TransferDataController@storeBox')->name('storeBox');        
    });   

    Route::resource('employees', 'EmployeesController');

    Route::resource('TB', 'TelephoneBookController');

    Route::post('TelephoneBook-se', 'TelephoneBookController@searchEmp')->name('search');

    Route::resource('callcenter', 'TicketcallcenterController');

    Route::get('alltickets','TicketcallcenterController@alltickets')->name('alltickets');

    Route::post('callcenter/updateticket/{id}','TicketcallcenterController@updateticket')->name('updateticket');

    Route::get('ticketdetails/{id}','TicketcallcenterController@showdetails')->name('ticketdetails');

    Route::get('benefactor','TicketcallcenterController@search')->name('callcenterSearch');

    Route::get('benefactor/{tel}/{tel2?}','TicketcallcenterController@getBenefactor')->name('getBenefactor');

    Route::post('benefactor-search','TicketcallcenterController@searchphone')->name('benefactor.search');

    Route::get('callerInfo/{dnr_no}/{dnrName?}/{agnt_name?}/{bgn_crspnd_lnm?}','TicketcallcenterController@getCallerInfo')->name('callerInfo');

    Route::get('incomingticket/{empName}','TicketcallcenterController@incomingticket')->name('incomingticket');

    Route::get('proceticket/{id}','TicketcallcenterController@procticket')->name('procticket');

    Route::get('benefactor-receipts/{dnr_no}','TicketcallcenterController@getReceipts')->name('benefactoreceipts');
    

    Route::get('status/ajax/{id}','TicketcallcenterController@statusAjax');

    Route::resource('permissions', 'PermissionsController');

    Route::post('permissionrole', 'RoleController@store')->name('permissionrole');

    Route::post('permission/byRole', 'RoleController@getByRole')->name('permission_byRole');

    Route::resource('users', 'UserController');

    

    Route::resource('evaluation', 'Evaluation\EvaluationController');

    Route::resource('Ipconfig', 'Evaluation\IpconfigController');

    
    Route::get('/markAsRead', function(){

        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->back();

    })->name('mark');

    Route::resource('properties', 'PropertyController');

    Route::post('updateVisitor/{id}', 'VisitorController@updateVisitor')->name('updateVisitor');

    Route::get('myform/ajax/{id}', array('as' => 'myform.ajax', 'uses' => 'VisitorController@myformAjax'));

    Route::get('TB/myform/ajax/{id}', array('as' => 'myform.ajax', 'uses' => 'VisitorController@myformAjax'));

    Route::get('/{id}', 'AdminController@index');

    
    
});

Route::get('/{page}', 'AdminController@index');
