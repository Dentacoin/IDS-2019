<?php

namespace App\Http\Controllers;

use App\HomepageGalleryPhoto;
use App\Http\Controllers\Admin\HighlightsController;
use App\Http\Controllers\Admin\HomepageGalleryPhotosController;
use App\Http\Controllers\Admin\HomepageSlidesController;
use App\Http\Controllers\Admin\TeamMembersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected function getView()   {
        setlocale (LC_ALL, 'de_DE');
        //$latest_blog_articles = DB::connection('mysql3')->select(DB::raw("SELECT `post_title`, `post_name` from dIf_posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY `post_date` DESC LIMIT 0, 5"));

        $testimonials = DB::connection('mysql2')->table('user_expressions')->leftJoin('media', 'user_expressions.media_id', '=', 'media.id')->select('user_expressions.*', 'media.name as media_name', 'media.alt as media_alt')->orderByRaw('user_expressions.order_id ASC')->get()->toArray();
        $applications = DB::connection('mysql2')->table('applications')->select('applications.*')->orderByRaw('applications.order_id ASC')->get()->toArray();
        foreach($applications as $application) {
            $application->logo_url = DB::connection('mysql2')->table('media')->where('id', $application->logo_id)->select('media.name')->get()->first()->name;
            if(!empty($application->media_id)) {
                $application->media_url = DB::connection('mysql2')->table('media')->where('id', $application->media_id)->select('media.name')->get()->first()->name;
                $application->media_created_at = DB::connection('mysql2')->table('media')->where('id', $application->media_id)->select('media.created_at')->get()->first()->created_at;
            }
            $application->popup_logo_url = DB::connection('mysql2')->table('media')->where('id', $application->popup_logo_id)->select('media.name')->get()->first()->name;
        }

        $params = ['testimonials' => $testimonials, 'team_members' => (new TeamMembersController())->getAllTeamMembers(), 'slider' => (new HomepageSlidesController())->getAllHomepageSlides(), 'highlights' => (new HighlightsController())->getAllHighlights(), 'gallery' => (new HomepageGalleryPhotosController())->getAllHomepageGalleryPhotos(), 'applications' => $applications];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://blog.dentacoin.com/dumb-latest-posts/',
            CURLOPT_SSL_VERIFYPEER => 0
        ));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $resp = json_decode(curl_exec($curl));
        curl_close($curl);

        if(!empty($resp))   {
            $params['latest_blog_articles'] = $resp;
        }

        return view('pages/homepage', $params);
    }
}

