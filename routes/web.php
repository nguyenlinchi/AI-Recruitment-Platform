<?php

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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\MbtiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EmployerProfileController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\ResumeController;




// Route::get('/', function () {
//     return view('career.index');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');

Route::get('/company/{id}', [CompanyController::class, 'show'])
    ->name('company');
Route::get('/career', [CareerController::class, 'index'])->name('career.index');
Route::get('/career/{id}', [CareerController::class, 'show'])->name('career.show');
Route::get('/career/search', [CareerController::class, 'search']);



// LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/candidate/home', [HomeController::class, 'index'])
    ->name('candidate.home');

// REGISTER
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// test role
Route::get('/admin', function () {
    return "Trang ADMIN";
});

Route::get('/employer', function () {
    return "Trang EMPLOYER";
});

Route::get('/candidate', function () {
    return "Trang CANDIDATE";
});
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/profile/apply/{id}', [ProfileController::class, 'apply'])
        ->name('profile.apply');
    Route::post('/profile/apply/{id}',[ProfileController::class, 'storeApply']
    )->name('profile.storeApply');
    Route::delete('/application/delete/{id}',[ProfileController::class, 'deleteApplication'])
    ->name('application.delete');





    Route::get('/resume/create', [ProfileController::class, 'createResume'])
        ->name('resume.create');

    Route::post('/resume/store', [ProfileController::class, 'storeResume'])
        ->name('resume.store');

});
Route::post(
    '/save-job/{id}',
    [SavedJobController::class, 'toggle']
)->name('save.job');

Route::get(
    '/saved-jobs',
    [SavedJobController::class, 'index']
)->name('saved.jobs');


Route::get('/mbti', [MbtiController::class, 'home'])->name('mbti.home');
Route::get('/mbti-test', [MbtiController::class, 'index'])->name('mbti.test');
Route::post('/mbti-submit', [MbtiController::class, 'submit'])->name('mbti.submit');
// Route hiển thị danh sách việc làm phù hợp sau khi test MBTI
// Route lọc việc làm theo ngành nghề từ MBTI
Route::get('/jobs/filter-by-career/{keyword}', [MbtiController::class, 'filterJobsByCareer'])->name('jobs.mbti.filter');

Route::view('/chatbot', 'chatbot');          // trang chat UI
// Route::post('/chat', [ChatController::class, 'chat']); // API POST
Route::post('/chat', [ChatController::class, 'chat'])->name('chat');

// trang cv 
Route::get('/cv', [CVController::class, 'index'])->name('cv.index');
// Đánh giá CV
// Route::get('/cv/evaluate', [CVController::class, 'evaluate'])
//      ->name('cv.evaluate');
// Chỉ ai đăng nhập rồi mới vào được route này, chưa đăng nhập tự động bay sang trang login
Route::get('/cv/evaluate', [CVController::class, 'evaluate'])
    ->name('cv.evaluate')
    ->middleware('auth');


Route::post('/cv/evaluate', [CVController::class, 'analyze'])
     ->name('cv.evaluate.analyze');

////----------------------EMPLOYER----------------------------------

Route::get('/employer/dashboard', [EmployerController::class, 'dashboard']);

Route::get('/employer/jobs', [JobPostingController::class, 'index']);
Route::get('/employer/jobs/create', [JobPostingController::class, 'create']);
Route::post('/employer/jobs/store', [JobPostingController::class, 'store']);
Route::get('/employer/jobs/edit/{id}', [JobPostingController::class, 'edit']);
Route::post('/employer/jobs/update/{id}', [JobPostingController::class, 'update']);
Route::delete('/employer/jobs/delete/{id}', [JobPostingController::class, 'destroy']);

Route::get('/employer/applications', [ApplicationController::class, 'index']);
Route::get('/employer/applications/{id}', [ApplicationController::class, 'show']);
Route::post('/employer/applications/{id}/status', [ApplicationController::class, 'updateStatus']);


Route::get('/employer/jobs', [JobPostingController::class, 'index']);
Route::get('/employer/jobs/edit/{id}', [JobPostingController::class, 'edit']);
Route::post('/employer/jobs/update/{id}', [JobPostingController::class, 'update']);


Route::get('/employer/profile', [EmployerProfileController::class, 'index']);
Route::get('/employer/profile/edit', [EmployerProfileController::class, 'edit']);
Route::post('/employer/profile/update', [EmployerProfileController::class, 'update']);


////----------------------ADMIN----------------------------------
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminJobTypeController;
use App\Http\Controllers\Admin\AdminSalaryController;
use App\Http\Controllers\Admin\AdminSkillController;
use App\Http\Controllers\Admin\AdminLocationController;
use App\Http\Controllers\Admin\AdminCareerGuideController;
use App\Http\Controllers\Admin\AdminJobPostingController;

Route::prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard']);

    // USERS
    Route::get('/users', [AdminUserController::class, 'index']);
    Route::get('/users/delete/{id}', [AdminUserController::class, 'destroy']);

    // JOB TYPES
    Route::get('/job-types', [AdminJobTypeController::class, 'index']);
    Route::post('/job-types/store', [AdminJobTypeController::class, 'store']);
    Route::post('/job-types/update/{id}', [AdminJobTypeController::class, 'update']);
    Route::get('/job-types/delete/{id}', [AdminJobTypeController::class, 'destroy']);

    // SALARIES
    Route::get('/salaries', [AdminSalaryController::class, 'index']);
    Route::post('/salaries/store', [AdminSalaryController::class, 'store']);
    Route::post('/salaries/update/{id}', [AdminSalaryController::class, 'update']);
    Route::get('/salaries/delete/{id}', [AdminSalaryController::class, 'destroy']);

    // SKILLS
    Route::get('/skills', [AdminSkillController::class, 'index']);
    Route::post('/skills/store', [AdminSkillController::class, 'store']);
    Route::post('/skills/update/{id}', [AdminSkillController::class, 'update']);
    Route::get('/skills/delete/{id}', [AdminSkillController::class, 'destroy']);

    // LOCATIONS
    Route::get('/locations', [AdminLocationController::class, 'index']);
    Route::post('/locations/store', [AdminLocationController::class, 'store']);
    Route::post('/locations/update/{id}', [AdminLocationController::class, 'update']);
    Route::get('/locations/delete/{id}', [AdminLocationController::class, 'destroy']);

    // CAREER GUIDES
    Route::get('/careers', [AdminCareerGuideController::class, 'index']);
    Route::get('/careers/create', [AdminCareerGuideController::class, 'create']);
    Route::post('/careers/store', [AdminCareerGuideController::class, 'store']);
    Route::get('/careers/edit/{id}', [AdminCareerGuideController::class, 'edit']);
    Route::post('/careers/update/{id}', [AdminCareerGuideController::class, 'update']);
    Route::get('/careers/delete/{id}', [AdminCareerGuideController::class, 'destroy']);

    Route::get('/jobs', [AdminJobPostingController::class, 'index']);
    Route::post('/jobs/update-status/{id}',
        [AdminJobPostingController::class, 'updateStatus']);
    Route::get('/jobs/delete/{id}',
        [AdminJobPostingController::class, 'destroy']);

    Route::get('/jobs/show/{id}', [AdminJobPostingController::class, 'show']);
});


// Xem CV theo mẫu
Route::get('/preview-cv/{resume_id}/{template}', [App\Http\Controllers\ResumeController::class, 'preview'])
     ->name('cv.preview');

Route::get('/download-cv/{resume_id}/{template?}', [App\Http\Controllers\ResumeController::class, 'downloadPDF'])
     ->name('cv.download.pdf');

// Trang Gallery (Danh sách mẫu CV)
Route::get('/cv/templates', [CvController::class, 'templates'])->name('cv.templates');

// Trang Preview mẫu CV
Route::get('/cv/preview/{template}', [CvController::class, 'preview'])->name('cv.preview');

// Trang chỉnh sửa CV (sau này)
Route::get('/cv/edit', [CvController::class, 'edit'])->name('cv.edit');

Route::post('/cv/save-edited/{resume_id}', [App\Http\Controllers\ResumeController::class, 'saveEdited'])
     ->name('cv.save.edited');

// Route::middleware(['auth'])->group(function () {
//     // Các route cũ của bạn...
//     Route::get('/cv-templates', [CVController::class, 'templates'])->name('cv.templates');
// Route::post('/profile/cv-store', [ProfileController::class, 'storeCV'])->name('cv.store');});

Route::post('/cv/store', [ProfileController::class, 'storeResume'])->name('cv.store');
Route::get('/cv/templates', [CVController::class, 'templates'])->name('cv.templates');
// lưu link resume_link
Route::post('/job/apply', [ApplicationController::class, 'storeApply'])->name('job.apply');

Route::get('/resume/{id}/edit', [ResumeController::class, 'edit'])
    ->name('resume.edit');

Route::put('/resume/{id}', [ResumeController::class, 'update'])
    ->name('resume.update');

Route::get('/resume/{id}', [ResumeController::class, 'show'])
    ->name('resume.show');