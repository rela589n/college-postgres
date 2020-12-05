<?php


namespace App\Http\Controllers\Customer\Dashboard;


use App\Http\Controllers\Controller;
use Illuminate\View\View;

final class CustomerHomeController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('pages.client.dashboard.index');
    }
}
