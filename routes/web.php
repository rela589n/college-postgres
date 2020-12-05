<?php

use App\Http\Controllers\Customer\Auth\LoginCustomerController;
use App\Http\Controllers\Customer\Auth\RegisterCustomerController;
use App\Http\Controllers\Customer\Dashboard\CustomerHomeController;
use App\Http\Controllers\Customer\Dashboard\Explore\OffersExploreController;
use App\Http\Controllers\Customer\Dashboard\Proposals\OffersController;
use App\Http\Controllers\Freelancer\Auth\LoginFreelancerController;
use App\Http\Controllers\Freelancer\Auth\RegisterFreelancerController;
use App\Http\Controllers\Freelancer\Dashboard\FreelancerHomeController;
use App\Http\Controllers\Freelancer\Dashboard\FreelancerProposalsController;
use App\Http\Controllers\Freelancer\Dashboard\Jobs\JobsController;
use App\Http\Middleware\Guards\CustomerWebMiddleware;
use App\Http\Middleware\Guards\FreelancerWebMiddleware;
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

//Route::get(
//    '/',
//    function () {
//        return view('welcome');
//    }
//);

Route::redirect('/', '/freelancer/login');

Route::name('customer.')
    ->group(
        function () {
            Route::name('auth.')
                ->group(
                    function () {
                        Route::get('/login', [LoginCustomerController::class, 'showLoginForm'])
                            ->middleware(CustomerWebMiddleware::guest())
                            ->name('login');

                        Route::post('/login', [LoginCustomerController::class, 'login'])
                            ->name('login.perform');

                        Route::get('/register', [RegisterCustomerController::class, 'showRegistrationForm'])
                            ->middleware(CustomerWebMiddleware::guest())
                            ->name('register');

                        Route::post('/register', [RegisterCustomerController::class, 'register'])
                            ->name('register.perform');

                        Route::post('/logout', [LoginCustomerController::class, 'logout'])
                            ->name('logout.perform');
                    }
                );

            Route::prefix('/dashboard')
                ->name('dashboard.')
                ->middleware(CustomerWebMiddleware::auth())
                ->group(
                    function () {
                        Route::get('offers/in-work', [OffersController::class, 'inWork'])
                            ->name('offers.in-work');

                        Route::get('offers/finished', [OffersController::class, 'finished'])
                            ->name('offers.finished');

                        Route::post('offers/{offer}/accept', [OffersController::class, 'accept'])
                            ->name('offers.accept');

                        Route::resource(
                            'offers',
                            OffersController::class
                        );

                        Route::resource(
                            'explore',
                            OffersExploreController::class
                        );

                        Route::get('/', [CustomerHomeController::class, 'index'])->name('home');
                    }
                );
        }
    );

Route::name('freelancer.')
    ->prefix('freelancer')
    ->group(
        function () {
            Route::name('auth.')
                ->group(
                    function () {
                        Route::get('/login', [LoginFreelancerController::class, 'showLoginForm'])
                            ->middleware(FreelancerWebMiddleware::guest())
                            ->name('login');

                        Route::post('/login', [LoginFreelancerController::class, 'login'])
                            ->name('login.perform');

                        Route::get('/register', [RegisterFreelancerController::class, 'showRegistrationForm'])
                            ->middleware(FreelancerWebMiddleware::guest())
                            ->name('register');

                        Route::post('/register', [RegisterFreelancerController::class, 'register'])
                            ->name('register.perform');

                        Route::post('/logout', [LoginFreelancerController::class, 'logout'])
                            ->name('logout.perform');
                    }
                );

            Route::prefix('/dashboard')
                ->name('dashboard.')
                ->middleware(FreelancerWebMiddleware::auth())
                ->group(
                    function () {
                        Route::get('/', [FreelancerHomeController::class, 'index'])->name('home');

                        Route::get('offers/applied-on', [JobsController::class, 'appliedOn'])
                            ->name('offers.applied-on');

                        Route::get('offers/finished', [JobsController::class, 'finished'])
                            ->name('offers.finished');

                        Route::get('offers/in-work', [JobsController::class, 'inWork'])
                            ->name('offers.in-work');

                        Route::post('offers/finish', [JobsController::class, 'finish'])
                            ->name('offers.finish');

                        Route::resource(
                            'offers',
                            JobsController::class
                        );

                        Route::prefix('offers/{offer}')
                            ->group(
                                function () {
                                    Route::resource('proposals', FreelancerProposalsController::class);
                                }
                            );
                    }
                );
        }
    );
