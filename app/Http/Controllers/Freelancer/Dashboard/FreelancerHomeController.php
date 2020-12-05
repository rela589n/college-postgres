<?php


namespace App\Http\Controllers\Freelancer\Dashboard;


use App\Http\Controllers\Controller;
use Illuminate\View\View;

final class FreelancerHomeController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('pages.freelancer.dashboard.index');
    }
}
