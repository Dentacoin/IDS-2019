<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\MeetingsController;
use App\Http\Controllers\Admin\TeamMembersController;
use App\Http\Controllers\Admin\UserExpressionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected function getView()   {
        $testimonials = DB::connection('mysql2')->table('user_expressions')->leftJoin('media', 'user_expressions.media_id', '=', 'media.id')->select('user_expressions.*', 'media.name as media_name', 'media.alt as media_alt')->orderByRaw('user_expressions.order_id ASC')->get()->toArray();
        return view("pages/homepage", ['testimonials' => $testimonials, 'team_members' => (new TeamMembersController())->getAllTeamMembers(), 'meeting_days' => (new MeetingsController())->getMeetingDays(), 'meeting_hours' => (new MeetingsController())->getMeetingHoursForDay(), 'first_free_hour' => (new MeetingsController())->getFirstFreeMeetingForDay()]);
    }
}

