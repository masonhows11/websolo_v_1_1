<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerifyPromptController;

use App\Http\Controllers\UserDashboard\EditEmailController;
use App\Http\Controllers\UserDashboard\UserDashboardController;

use App\Http\Controllers\Auth\RemoveAccountController;
use App\Http\Controllers\Auth\ChangePasswordController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\Auth\AdminValidateController;
use App\Http\Controllers\Admin\AdminRoleAssignController;
use App\Http\Controllers\Admin\AdminPermAssignController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminSampleController;
use App\Http\Controllers\Admin\AdminTrainingController;

use App\Http\Livewire\Admin\AdminProfile;
use App\Http\Livewire\Admin\AdminMobile;
use App\Http\Livewire\Admin\AdminUsers;

use App\Http\Livewire\Admin\AdminRoles;
use App\Http\Livewire\Admin\ListUsersForRole;

use App\Http\Livewire\Admin\AdminPerms;
use App\Http\Livewire\Admin\ListUsersForPerm;
use App\Http\Livewire\Admin\AdminTag;
use App\Http\Livewire\Admin\AdminCategory;
use App\Http\Livewire\Admin\AdminBackEnd;
use App\Http\Livewire\Admin\AdminFrontEnd;

use App\Http\Livewire\Admin\AdminArticleComment;
use App\Http\Livewire\Admin\AdminSampleComment;
use App\Http\Livewire\Admin\AdminTrainingComment;

use App\Http\Livewire\Admin\ArticleListComment;
use App\Http\Livewire\Admin\SampleListComment;
use App\Http\Livewire\Admin\TrainingListComment;

use App\Http\Controllers\ArticleController;

use App\Http\Livewire\Front\Samples;
use App\Http\Controllers\SampleController;

use App\Http\Livewire\Front\Trainings;
use App\Http\Controllers\TrainingController;

use App\Http\Livewire\AboutUs;
use App\Http\Livewire\ContactUs;

use App\Http\Controllers\TagController;
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

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/storage-link',function(){
    symlink(storage_path('app/public'),$_SERVER['DOCUMENT_ROOT'].'/storage');
});

// authentication & authorize

Route::get('/login/form', [LoginController::class, 'loginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');//->middleware(['throttle:3,1']);
Route::get('/register/form', [RegisterController::class, 'registerForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/emailVerifyPrompt', [EmailVerifyPromptController::class, 'verifyEmailPrompt'])->name('email.verify.prompt');
Route::post('/resendVerifyEmail', [VerifyEmailController::class, 'resendEmailVerify'])->name('resend.verify.email');
Route::get('/emailVerify/{id}/{code}', [VerifyEmailController::class, 'verifyEmail'])->name('email.verify');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['web', 'auth', 'verifyUser'])->group(function () {

    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/edit/profile', [UserDashboardController::class, 'editProfile'])->name('edit.profile');
    Route::post('/update/profile', [UserDashboardController::class, 'updateProfile'])->name('update.profile');

    Route::get('/edit/email-form', [EditEmailController::class, 'editEmailForm'])->name('edit.email.form');
    Route::post('/edit/email', [EditEmailController::class, 'editEmail'])->name('edit.email');
    Route::get('/verify/edit-email/{$id}{$code}', [EditEmailController::class, 'verifyEditEmail'])->name('verify.edit.email');

    Route::get('/change/password/form',[ChangePasswordController::class,'create'])->name('change.password.form');
    Route::post('/change/password',[ChangePasswordController::class,'store'])->name('change.password');
    Route::get('/delete/account',[RemoveAccountController::class,'destroy'])->name('delete.account');
});
// article sample training
Route::get('/articles',[ArticleController::class,'index'])->name('article.index');
Route::get('/articles/{category}',[ArticleController::class,'articleCategory'])->name('article.category');
Route::get('/article/{article}',[ArticleController::class,'article'])->name('article');
Route::post('/article/add-comment',[ArticleController::class,'addComment'])->name('article.addComment');
Route::post('/article/add-like',[ArticleController::class,'addLike'])->name('article.add.like');

Route::get('/tag/{tag}',[TagController::class,'index'])->name('articles.by.tag');

Route::get('/samples',Samples::class)->name('sample.index');
Route::get('/sample/{sample}',[SampleController::class,'sample'])->name('sample');
Route::post('/sample/add-comment',[SampleController::class,'addComment'])->name('sample.addComment');
Route::post('/sample/add-like',[SampleController::class,'addLike'])->name('sample.add.like');

Route::get('/trainings',Trainings::class)->name('training.index');
Route::get('/training/{training}',[TrainingController::class,'training'])->name('training');
Route::post('/training/add-comment',[TrainingController::class,'addComment'])->name('training.addComment');
Route::post('/training/add-like',[TrainingController::class,'addLike'])->name('training.add.like');


// about us contact us
Route::get('/about-us',AboutUs::class)->name('aboutUs');
Route::get('/contact-us',ContactUs::class)->name('contactUs');

// admin
Route::prefix('admin')->group(function () {

    Route::get('/login/form', [AdminAuthController::class, 'loginAdminForm'])->name('admin.login.form');
    Route::post('/login', [AdminAuthController::class, 'loginAdmin'])->name('admin.login');
    Route::get('/validate/mobile/form', [AdminValidateController::class, 'validateMobileForm'])->name('admin.validate.mobile.form');
    Route::post('/validate/mobile', [AdminValidateController::class, 'validateMobile'])->name('admin.validate.mobile');
    Route::post('/resend/code', [AdminValidateController::class, 'resendCode'])->name('admin.resend.code');

});

Route::prefix('admin')->name('admin.')->middleware(['web','auth:admin','verify_admin','role:admin|admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/logOut', [AdminAuthController::class, 'logOut'])->name('logOut');

});
Route::prefix('admin')->name('admin.')->middleware(['web','auth:admin','verify_admin','role:admin|admin'])->group(function () {
    Route::get('/profile', AdminProfile::class)->name('profile');
    Route::get('/change/mobile', AdminMobile::class)->name('change.mobile');
});
// users
Route::prefix('admin')->name('admin.')->middleware(['web','auth:admin','verify_admin','role:admin|admin'])->group(function () {
    Route::get('/users', AdminUsers::class)->name('users');
});

// crud roles
Route::prefix('admin')->name('admin.')->middleware(['web','auth:admin','verify_admin','role:admin|admin'])->group(function () {
    Route::get('/roles', AdminRoles::class)->name('roles');
});
// assign roles
Route::prefix('admin')->name('admin.')->middleware(['web','auth:admin','verify_admin','role:admin|admin'])->group(function () {
    Route::get('/roles/list/users', ListUsersForRole::class)->name('role.list.users');
    Route::get('/roles/assign/form', [AdminRoleAssignController::class, 'create'])->name('roles.assign.form');
    Route::post('/roles/assign', [AdminRoleAssignController::class, 'store'])->name('roles.assign');
});
// crud perms
Route::prefix('admin')->name('admin.')->middleware(['web','auth:admin','verify_admin','role:admin|admin'])->group(function () {
    Route::get('/perms', AdminPerms::class)->name('perms');
});
// assign perms
Route::prefix('admin')->name('admin.')->middleware(['web','auth:admin','verify_admin','role:admin|admin'])->group(function () {
    Route::get('/perms/list/users', ListUsersForPerm::class)->name('perm.list.users');
    Route::get('/perms/assign/form', [AdminPermAssignController::class, 'create'])->name('perms.assign.form');
    Route::post('/perms/assign', [AdminPermAssignController::class, 'store'])->name('perms.assign');
});
// categories
Route::prefix('admin')->name('admin.')->middleware(['web','auth:admin','verify_admin','role:admin|admin'])->group(function () {
    Route::get('/category/index', AdminCategory::class)->name('category.list');
});
// tags
Route::prefix('admin')->name('admin.')->middleware(['web','auth:admin','verify_admin','role:admin|admin'])->group(function () {
    Route::get('/tags', AdminTag::class)->name('tags');
});
// backEnd
Route::prefix('admin')->name('admin.')->middleware(['web','auth:admin','verify_admin','role:admin|admin'])->group(function () {
    Route::get('/back-end/index', AdminBackEnd::class)->name('back-ends');
});
// frontEnd
Route::prefix('admin')->name('admin.')->middleware(['web','auth:admin','verify_admin','role:admin|admin'])->group(function () {
    Route::get('/front-end/index', AdminFrontEnd::class)->name('front-ends');
});
// articles
Route::prefix('admin')->name('admin.')->middleware(['web','auth:admin','verify_admin','role:admin|admin'])->group(function () {
    Route::get('/article/index', [AdminArticleController::class, 'index'])->name('article.index');
    Route::get('/article/create', [AdminArticleController::class, 'create'])->name('article.create');
    Route::post('/article/store', [AdminArticleController::class, 'store'])->name('article.store');
    Route::get('/article/edit/{article}', [AdminArticleController::class, 'edit'])->name('article.edit');
    Route::post('/article/update', [AdminArticleController::class, 'update'])->name('article.update');
});
// samples
Route::prefix('admin')->name('admin.')->middleware(['web','auth:admin','verify_admin','role:admin|admin'])->group(function () {
    Route::get('/sample/index', [AdminSampleController::class, 'index'])->name('sample.index');
    Route::get('/sample/create', [AdminSampleController::class, 'create'])->name('sample.create');
    Route::post('/sample/store', [AdminSampleController::class, 'store'])->name('sample.store');
    Route::get('/sample/edit/{id}', [AdminSampleController::class, 'edit'])->name('sample.edit');
    Route::post('/sample/update', [AdminSampleController::class, 'update'])->name('sample.update');
});
// training
Route::prefix('admin')->name('admin.')->middleware(['web','auth:admin','verify_admin','role:admin|admin'])->group(function () {
    Route::get('/training/index', [AdminTrainingController::class, 'index'])->name('training.index');
    Route::get('/training/create', [AdminTrainingController::class, 'create'])->name('training.create');
    Route::post('/training/store', [AdminTrainingController::class, 'store'])->name('training.store');
    Route::get('/training/edit/{training}', [AdminTrainingController::class, 'edit'])->name('training.edit');
    Route::post('/training/update', [AdminTrainingController::class, 'update'])->name('training.update');
});
// comments
Route::prefix('admin')->name('admin.')->middleware(['web','auth:admin','verify_admin','role:admin|admin'])->group(function () {

    Route::get('/comment/articles/index', AdminArticleComment::class)->name('comment.articles.index');
    Route::get('/comments/article', ArticleListComment::class)->name('article.comments');
    Route::get('/comment/samples/index', AdminSampleComment::class)->name('comment.samples.index');
    Route::get('/comments/sample', SampleListComment::class)->name('sample.comments');
    Route::get('/comment/trainings/index', AdminTrainingComment::class)->name('comment.trainings.index');
    Route::get('/comments/training', TrainingListComment::class)->name('training.comments');
});
