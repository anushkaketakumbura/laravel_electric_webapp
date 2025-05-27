<?php

use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\PostsController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\TimeRestrictedAccess;
use App\Models\Posts;
use App\Models\Slider;
use App\Models\Testimonial;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    $sliders = Slider::all();
    $testimonials = Testimonial::all();
    return view('frontend.home',compact('sliders','testimonials'));
});

Route::get('/about',function(){
    return view('frontend.about');
});

Route::get('/service',function(){
    return view('frontend.service');
})->middleware([TimeRestrictedAccess::class]);

Route::get('/blog',function(){
    $posts = Posts::orderBy('created_at','desc')->paginate(6);
    return view('frontend.blog',compact('posts'));
});

Route::get('/blog/{slug}',function ($slug){
    $post = Posts::where('slug', $slug)->first();
    return view('frontend.post-single',compact('post'));
});


Route::get('/dashboard', function () {
       return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(SliderController::class)->middleware(['auth','verified'])->group(function(){
    Route::get('/SliderIndex','Index')->name('slider.index');
    Route::post('/saveSlider','storeslider')->name('slider.store');
    Route::post('/sliderUpdate','updateslider')->name('slider.update');
    Route::get('/deleteSlider/{id}','deleteslider')->name('slider.delete');
});

Route::controller(TestimonialController::class)->middleware(['auth','verified'])->group(function(){
    Route::get('/TestimonialIndex','Index')->name('Tesimonial.index');
    Route::post('/saveTestimonial','storeTestimonial')->name('Testimonial.store');
    Route::post('/TestimonialUpdate','updateTestimonial')->name('Testimonial.update');
    Route::get('/deleteTestimonial/{id}','deleteTestimonial')->name('Testimonial.delete');
});


Route::controller(SettingsController::class)->middleware(['auth','verified'])->group(function(){
    Route::get('/Settings','Index')->name('Settings.index');
    Route::post('/SettingsUpdate','updateSettings')->name('Settings.update');
});


Route::controller(PostsController::class)->middleware(['auth','verified'])->group(function(){
    Route::get('/PostslIndex','Index')->name('Posts.index');
    Route::post('/savePosts','storePosts')->name('Posts.store');
    Route::post('/PostsUpdate','updatePosts')->name('Posts.update');
    Route::get('/deletePosts/{id}','deletePosts')->name('Posts.delete');
});


Route::controller(PermissionController::class)->middleware(['auth','verified'])->group(function(){
    Route::get('/PermissionIndex','Index')->name('Permission.index');
    Route::post('/savePermission','storePermission')->name('Permission.store');
    Route::post('/PermissionUpdate','updatePermission')->name('Permission.update');
    Route::get('/deletePermission/{id}','deletePermission')->name('Permission.delete');
});

Route::controller(RoleController::class)->middleware(['auth','verified'])->group(function(){
    Route::get('/RoleIndex','Index')->name('Role.index');
    Route::post('/saveRole','storeRole')->name('Role.store');
    Route::post('/RoleUpdate','updateRole')->name('Role.update');
    Route::get('/deleteRole/{id}','deleteRole')->name('Role.delete');

    Route::get('/PermissionToRole/{id}','permissionToRole')->name('Role.permissionToRole');
    Route::put('/givePermissionToRole/{id}','givePermissionToRole')->name('Role.givePermissionToRole');
    Route::put('/removePermissionToRole/{id}','removePermissionToRole')->name('Role.removePermissionToRole');
});

Route::controller(UserController::class)->middleware(['auth','verified'])->group(function(){
    Route::get('/UserIndex','Index')->name('User.index');
    Route::post('/saveUser','storeUser')->name('User.store');
    Route::post('/UserUpdate','updateUser')->name('User.update');
    Route::get('/deleteUser/{id}','deleteUser')->name('User.delete');
});


require __DIR__.'/auth.php';
