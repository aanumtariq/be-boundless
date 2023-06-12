<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\productsController;
use App\Http\Controllers\productCardController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\user_wish_list_controller;
use App\Http\Controllers\admin\Auth\ForgotPasswordController;
use App\Http\Controllers\admin\Auth\LoginController;
use App\Http\Controllers\Auth\LoginController as userLoginController;
use App\Http\Controllers\UserDashController;
use App\Http\Controllers\admin\Auth\ResetPasswordController;
use App\Http\Controllers\admin\manageEcomerce\blogsController;
use App\Http\Controllers\admin\manageEcomerce\homeCMSController;
use App\Http\Controllers\admin\manageEcomerce\faqsController;
use App\Http\Controllers\admin\manageEcomerce\studioController;
use App\Http\Controllers\admin\manageEcomerce\categoryController;
use App\Http\Controllers\admin\manageEcomerce\couponsController;
use App\Http\Controllers\admin\manageEcomerce\reservationsController;
use App\Http\Controllers\admin\manageEcomerce\productsController as AdminProductsController;
use App\Http\Controllers\admin\manageEcomerce\packageController as AdminPackagesController;
use App\Http\Controllers\Auth\ForgotPasswordController as UserForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController as UserResetPasswordController;
use App\Http\Controllers\addressBookController;
use App\Http\Controllers\admin\configController;
use App\Http\Controllers\checkoutController;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

Route::get('/adminpan', [LoginController::class, 'index']);

Route::name('front.')->group(function() {
    Route::get('/', [IndexController::class, 'home']);    
    Route::get('/index', [IndexController::class, 'home']);
});

Route::get('/packages', [IndexController::class, 'packages']);
Route::get('/articals', [IndexController::class, 'articals']);
Route::get('/about', [IndexController::class, 'about']);
Route::get('/studio', [IndexController::class, 'studio']);
Route::get('/contactUs', [IndexController::class, 'contactUs']);

Route::get('/reservation/{slug}', [ReservationController::class, 'reservation'])->name('reservation');
Route::POST('/reservation_submit', [ReservationController::class, 'reservation_submit'])->name('reservation_submit');
Route::post('/contact-form', [App\Http\Controllers\contactController::class, 'storeContactForm'])->name('contact-form.store');

Auth::routes();

Route::get('/userDash', [UserDashController::class, 'index'])->name('userDash');
Route::get('/user_profile', [UserDashController::class, 'profile'])->name('user.profile');
Route::get('/user_orders', [UserDashController::class, 'orders'])->name('user.orders');
Route::get('order_details/{id}', [UserDashController::class, 'order_details'])->name('user.order_details');
Route::get('/user_wishlist', [UserDashController::class, 'wishlist'])->name('user.wishlist');

Route::get('/user_address', [addressBookController::class, 'address'])->name('user.address');
Route::get('/user_addressBook', [addressBookController::class, 'addressBook'])->name('user.addressBook');
Route::get('/addAddress', [addressBookController::class, 'addAddress'])->name('user.addAddress');
Route::post('/cRUDAddress', [addressBookController::class, 'cRUDAddress'])->name('user.cRUDAddress');
Route::get('editAddress/{id}', [addressBookController::class, 'editAddress'])->name('user.editAddress');
Route::post('/addressDel', [addressBookController::class, 'delAddress'])->name('user.delAddress');
Route::post('/addDefault', [addressBookController::class, 'addDefault'])->name('user.addDefault');

Route::post('/prevUrl', [userLoginController::class, 'redirectTo']);

Route::get('/backoffice', function () {
    return redirect('admin.login.login');
})->name('admin.backoffice');
Route::get('/adminoffice', function () {
    return redirect('admin');
})->name('admin.adminoffice');
Route::get('/admin', function () {
    return redirect('admin');
})->name('admin.admin');


Route::group(['middleware' => ['guest'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {

    //Login Routes
    Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('/performLogin', [LoginController::class, 'performLogin'])->name('admin.performLogin')->middleware('throttle:4,1');
});


Route::group(['middleware' => ['admin'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('/manage-about', [homeCMSController::class, 'getAbout']);
    Route::post('/upAbout', [homeCMSController::class, 'upAbout'])->name('admin.upAbout');
    Route::post('/about_cms', [homeCMSController::class, 'upAbout'])->name('admin.about_cms');

    Route::get('/FAQs', [faqsController::class, 'getFAQs']);
    Route::post('/addFAQ', [faqsController::class, 'addFAQ']);
    Route::post('/faqGetEdit', [faqsController::class, 'getFAQs']);
    Route::post('/faqDel', [faqsController::class, 'delFAQ']);
    Route::post('/editFAQ', [faqsController::class, 'addFAQ']);
    Route::post('/faqActive', [faqsController::class, 'faqActive']);
    Route::post('/faqVSave', [faqsController::class, 'faqVSave'])->name('admin.faqVSave');

    Route::get('/packages', [AdminPackagesController::class, 'getPackage']);
    Route::post('/addPackages', [AdminPackagesController::class, 'addPackage'])->name('addPackage');
    Route::post('/packageActive', [AdminPackagesController::class, 'packageActive']);
    Route::post('/packageFeatured', [AdminPackagesController::class, 'packageFeatured']);
    Route::post('/packageDel', [AdminPackagesController::class, 'packageDel']);
    Route::post('/imgDel', [AdminPackagesController::class, 'imgDel']);
    Route::post('/packageGetEdit', [AdminPackagesController::class, 'getPackage']);
    Route::post('/getPackageView', [AdminPackagesController::class, 'getPackage']);
    Route::post('/editPackage', [AdminPackagesController::class, 'editPackage']);
    Route::post('/delMPackage', [AdminPackagesController::class, 'delMPackage'])->name('delMPackage');

    Route::get('/panel', [App\Http\Controllers\admin\IndexController::class, 'panel'])->name('admin.index');
    Route::get('/sales_chart', [App\Http\Controllers\admin\IndexController::class, 'incomeChart'])->name('admin.sales_chart');

    Route::get('/CRUDStudio', [studioController::class, 'CRUDStudio'])->name('CRUDStudio');
    Route::get('CRUDstudGetEdit/{id}', [studioController::class, 'CRUDstudGetEdit'])->name('CRUDstudGetEdit');
    Route::get('/studio', [studioController::class, 'getStudio']);
    Route::post('/addStudio', [studioController::class, 'addStudio'])->name('addStudio');
    Route::post('/storeStudImgaes', [studioController::class, 'storeStudImgaes']);
    Route::post('/studActive', [studioController::class, 'studActive']);
    Route::post('/studFeatured', [studioController::class, 'studFeatured']);
    Route::post('/studDel', [studioController::class, 'studDel']);
    Route::post('/imgDelStud', [studioController::class, 'imgDelStud']);
    Route::post('/studGetEdit', [studioController::class, 'getStudio']);
    Route::post('/getStudView', [studioController::class, 'getStudio']);
    Route::post('/editStud', [studioController::class, 'editStud']);
    Route::post('/delMStud', [studioController::class, 'delMStud'])->name('delMStud');
        
    // Route::get('/addUsers', [couponsController::class, 'getUsers']);
    // Route::post('/usersActive', [couponsController::class, 'usersActive']);

    Route::get('/Reservations', [reservationsController::class, 'getReservations']);
    Route::post('/getViewRes', [reservationsController::class, 'getViewReservations']);
    Route::post('/resGetEdit', [reservationsController::class, 'getReservations']);
    Route::post('/editReservation', [reservationsController::class, 'editReservation']);
    Route::post('/reservationDel', [reservationsController::class, 'delReservation']);

    Route::get('/blogs', [blogsController::class, 'getBlogs']);
    Route::post('/getViewBlog', [blogsController::class, 'getViewBlogs']);
    Route::post('/blogGetEdit', [blogsController::class, 'getBlogs']);
    Route::post('/blogFeatured', [blogsController::class, 'blogFeatured']);
    Route::post('/addBlog', [blogsController::class, 'addBlog']);
    Route::post('/blogDel', [blogsController::class, 'blogDel']);

    Route::get('/quries', [configController::class, 'quries'])->name('admin.quries');
    Route::post('/quriesDel', [configController::class, 'delQuries']);

    Route::get('/config', [configController::class, 'config'])->name('admin.config');
    Route::post('/configSave', [configController::class, 'configSave'])->name('admin.configSave');
    Route::post('/themeSave', [configController::class, 'themeSave'])->name('admin.themeSave');

    //Logout Routes    
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    //Forgot Password Routes
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');

    //Reset Password Routes
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('admin.password.update');

    Route::post('/change-password', function () {
        if ($_POST['change_password'] == $_POST['change_confirm_password']) {
            $admin = Admin::find(admin()->id);
            $admin->password = Hash::make($_POST['change_password']);
            $admin->save();
            return back()->with('notify_success', 'Password Updated');
        }
        return back()->with('notify_error', 'Password does not match');
    })->name('admin.changepassword');

    //All the admin routes will be defined here...
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
});

Route::post('/add-card', [SquareController::class, 'addCard'])->name('add-card');
