<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(
    ['prefix' => 'user'],
    function () {
        Route::post('register', 'UserLoginController@userRegistration');
        Route::post('login', 'UserLoginController@userLogin');
    }
);


Route::middleware('auth:api')->group( function () {
    
    // Route::group(
    //     ['prefix' => 'voucher'],
    //     function () {
    //         Route::post('generate','VoucherController@generateVoucher');
    //         Route::post('show', 'VoucherController@showVoucher');
    //         Route::post('delete','VoucherController@deleteVoucher');
    //     }
    // );

    Route::group(
        ['prefix' => 'regular-user'],
        function () {
            Route::post('generate','RegularUserController@generateVoucher');
            Route::post('show', 'RegularUserController@showVouchers');
            Route::post('delete', 'RegularUserController@deleteVoucher');
        }
    );

    Route::group(
        ['prefix' => 'group-admin'],
        function () {
            Route::post('assign-user-group','AdminGroupController@assignUserGroup'); //assigns user to a group
            Route::post('show-user-group', 'AdminGroupController@showUserGroup'); //show users assign to him and their voucher code
            Route::post('remove-user-group','AdminGroupController@removeUserGroup'); //removes a user from a group
            Route::post('show-unallocated-user','AdminGroupController@showUnallocatedUser'); //show users that has no group or remove from a group
            Route::post('show-groups', 'AdminGroupController@showGroups');
        }
    );

    Route::group(
        ['prefix' => 'super-admin'],
        function () {
            Route::post('view-users','SuperAdminController@viewUsers');
            Route::post('view-group-admin', 'SuperAdminController@viewGroupAdmin');
            Route::post('view-admins', 'SuperAdminController@viewAdmins');
            Route::post('assign-group-admin', 'SuperAdminController@assignGroupAdmin'); //assign user to a group
            Route::post('assign-admin-group', 'SuperAdminController@assignAdminGroup'); //assign admin to a group
            Route::post('view-groups','GroupController@viewGroups');
            Route::post('create-group','GroupController@createGroup');
            Route::post('update-group','GroupController@updateGroup');
            Route::post('delete-group','GroupController@deleteGroup');
        }
    );


});

