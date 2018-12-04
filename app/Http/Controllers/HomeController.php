<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\UserExpressionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected function getView()   {
        return view("pages/homepage", ['testimonials' => (new UserExpressionsController())->getAllTestimonials()]);
    }
}

