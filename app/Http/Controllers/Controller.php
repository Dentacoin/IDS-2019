<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\MeetingsController;
use App\MeetingHour;
use App\MeetingParticipant;
use App\Page;
use App\PagesHtmlSection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\MenuElement;
use App\Menu;
use Illuminate\Support\Facades\Mail;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const POSTS_PER_PAGE = 8;

    public function __construct() {
        if(!empty(Route::getCurrentRoute()) && Route::getCurrentRoute()->getPrefix() == '/')    {
            View::share('mobile', $this->isMobile());
            View::share('meta_data', $this->getMetaData());
            View::share('sections', $this->getDbSections());
            View::share('socials', $this->getSocials());
        }
    }

    public static function instance() {
        return new Controller();
    }

    protected function getMetaData()    {
        return Page::where(array('slug' => Route::getCurrentRoute()->getName()))->get()->first();
    }

    public function getMenu($menu_slug) {
        return MenuElement::where(array('menu_id' => Menu::where(array('slug' => $menu_slug))->get()->first()->id))->get()->sortBy('order_id');
    }

    protected function getDbSections()    {
        $meta_data = $this->getMetaData();
        if(!empty($meta_data)) {
            return PagesHtmlSection::where(array('page_id' => $this->getMetaData()->id))->get()->all();
        }else {
            return null;
        }
    }

    protected function getSocials() {
        return DB::connection('mysql2')->table('socials')->leftJoin('media', 'socials.media_id', '=', 'media.id')->select('socials.*', 'media.name as media_name', 'media.alt as media_alt')->orderByRaw('socials.order_id ASC')->get();
    }

    protected function isMobile()   {
        return (new Agent())->isMobile();
    }

    protected function getSitemap() {
        $sitemap = App::make("sitemap");
        // set cache (key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean))
        // by default cache is disabled
        //$sitemap->setCache('laravel.sitemap', 3600);

        // check if there is cached sitemap and build new only if is not
        //if(!$sitemap->isCached())  {
        // add item to the sitemap (url, date, priority, freq)

        $sitemap->add(URL::to('/'), '2018-08-25T20:10:00+02:00', '1.0', 'daily');

        // get all posts from db
        //$posts = DB::table('posts')->orderBy('created_at', 'desc')->get();
        //
        //// add every post to the sitemap
        //foreach ($posts as $post)
        //{
        //   $sitemap->add($post->slug, $post->modified, $post->priority, $post->freq);
        //}
        //}
        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');
    }

    protected function transliterate($str) {
        return str_replace(['а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п', 'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ','_'], ['a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p', 'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya','-','-'], mb_strtolower($str));
    }

    public function minifyHtml($response)   {
        $buffer = $response->getContent();
        if(strpos($buffer,'<pre>') !== false) {
            $replace = array(
                '/<!--[^\[](.*?)[^\]]-->/s' => '',
                "/<\?php/"                  => '<?php ',
                "/\r/"                      => '',
                "/>\n</"                    => '><',
                "/>\s+\n</"                 => '><',
                "/>\n\s+</"                 => '><',
            );
        }
        else {
            $replace = array(
                '/<!--[^\[](.*?)[^\]]-->/s' => '',
                "/<\?php/"                  => '<?php ',
                "/\n([\S])/"                => '$1',
                "/\r/"                      => '',
                "/\n/"                      => '',
                "/\t/"                      => '',
                "/ +/"                      => ' ',
            );
        }
        $buffer = preg_replace(array_keys($replace), array_values($replace), $buffer);
        $response->setContent($buffer);
        ini_set('zlib.output_compression', 'On'); // If you like to enable GZip, too!
        return $response;
    }

    protected function refreshCaptcha() {
        return response()->json(['captcha' => captcha_img()]);
    }

    protected function getMeetingDay($id) {
        $view = view('partials/schedule-a-meeting', ['meeting_hours' => (new MeetingsController())->getMeetingHoursForDay($id), 'first_free_hour' => (new MeetingsController())->getFirstFreeMeetingForDay($id)]);
        $view = $view->render();
        return response()->json(['success' => $view]);
    }

    //handling scheduling meetings
    protected function handleSubmitScheduleAMeеting(Request $request) {
        $this->validate($request, [
            'title' => 'required|max:100',
            'fname' => 'required|max:100',
            'lname' => 'required|max:100',
            'email' => 'required|max:100',
            'country' => 'required|max:100',
            'company-or-practise' => 'required|max:255',
            'job' => 'required|max:255',
            'website' => 'required|max:255',
            'hour' => 'required|max:255',
            'captcha' => 'required|captcha|max:5'
        ], [
            'title.required' => 'Title is required.',
            'fname.required' => 'First name is required.',
            'lname.required' => 'Last name is required.',
            'email.required' => 'Email is required.',
            'country.required' => 'Country is required.',
            'company-or-practise.required' => 'Company or practise is required.',
            'job.required' => 'Job is required.',
            'website.required' => 'Website is required.',
            'hour.required' => 'Hour is required.',
            'captcha.required' => 'Captcha is required.',
            'captcha.captcha' => 'Please type the code from the captcha image.',
            'email.max' => 'Email must be with maximum length of 100 symbols.',
            'title.max' => 'Title must be with maximum length of 100 symbols.',
            'fname.max' => 'First name must be with maximum length of 100 symbols.',
            'lname.max' => 'Last name must be with maximum length of 100 symbols.',
            'hour.max' => 'Hour must be with maximum length of 255 symbols.',
            'company-or-practise.max' => 'Company or practise must be with maximum length of 255 symbols.',
            'job.max' => 'Job must be with maximum length of 255 symbols.',
            'website.max' => 'Website must be with maximum length of 255 symbols.',
        ]);

        //check email validation
        if(!filter_var($request->input('email'), FILTER_VALIDATE_EMAIL))   {
            return redirect()->route('home')->with(['error' => 'Please provide valid email address.']);
        }

        //check if this hour is not engaged yet
        if(MeetingParticipant::where(array('hour_id' => strip_tags(trim($request->input('hour'))), 'type' => 'approved'))->get()->first()) {
            return redirect()->route('home')->with(['error' => 'There is already registered meeting for this hour.']);
        }

        //check if this email is not registered already
        if(!MeetingParticipant::where(array('email' => $request->input('email')))->get()->first()) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $characters_length = strlen($characters);
            $random_string = '';
            for ($i = 0; $i < 50; $i++) {
                $random_string .= $characters[rand(0, $characters_length - 1)];
            }

            $participant = new MeetingParticipant();
            $participant->title = strip_tags(trim($request->input('title')));
            $participant->fname = strip_tags(trim($request->input('fname')));
            $participant->lname = strip_tags(trim($request->input('lname')));
            $participant->email = strip_tags(trim($request->input('email')));
            $participant->country = strip_tags(trim($request->input('country')));
            $participant->company_or_practise = strip_tags(trim($request->input('company-or-practise')));
            $participant->job = strip_tags(trim($request->input('job')));
            $participant->website = strip_tags(trim($request->input('website')));
            $participant->note = strip_tags(trim( $request->input('note')));
            $participant->type = 'pending';
            $participant->approval_link = $random_string;
            $participant->hour_id = strip_tags(trim($request->input('hour')));

            //saving to DB
            $participant->save();

            //=== submit email for approval to the user ===
            $body = 'Hello,<br>Thank you for your meeting request! Please, follow <a href="https://ids.dentacoin.com/meeting-confirmation/'.$random_string.'" style="text-decoration: underline;font-weight: bold;">this link</a> to confirm your booking.<br>Looking forward to seeing you at IDS!<br><br><br>Kind regards,<br>Dentacoin Team';
            $email = $request->input('email');

            Mail::send(array(), array(), function($message) use ($email, $body) {
                $message->to($email)->subject('IDS Meeting Confirmation');
                $message->from(EMAIL_SENDER, 'Dentacoin at IDS 2019')->replyTo(EMAIL_SENDER, 'Dentacoin at IDS 2019');
                $message->setBody($body, 'text/html');
            });
            //=== /submit email for approval to the user ===

            //=== submit notification email to ids.dentacoin.com administrator ===
            $body = 'New <b style="color: #ffa500;">PENDING</b> meeting for IDS: <br><br>Name: '.$participant->title.' '.$participant->fname.' '.$participant->lname.'<br>Email: '.$participant->email.'<br>Country: '.$participant->country.'<br>Company or practise: '.$participant->company_or_practise.'<br>Job title: '.$participant->job.'<br>Company Website/ Social Page: '.$participant->website.'<br>Note: '.$participant->note;

            Mail::send(array(), array(), function($message) use ($body) {
                $message->to(EMAIL_RECEIVERS)->subject('New PENDING IDS Meeting');
                $message->from(EMAIL_SENDER, 'Dentacoin at IDS 2019')->replyTo(EMAIL_SENDER, 'Dentacoin at IDS 2019');
                $message->setBody($body, 'text/html');
            });
            //=== /submit notification email to ids.dentacoin.com administrator ===

            return redirect()->route('home')->with(['success' => 'Thank you for scheduling a meeting with our delegates to IDS! Please, check your mailbox and follow the link in the email we have sent you to complete your request.']);
        }else {
            return redirect()->route('home')->with(['error' => 'This email is already registered.']);
        }
    }

    //method for approving request. link is sent to user on his request to register for meeting with the team, the link points to this method
    protected function meetingConfirmation($link) {
        $pending_participant = MeetingParticipant::where(array('approval_link' => $link))->get()->first();
        if($pending_participant) {
            $pending_participant->type = 'approved';
            $pending_participant->approval_link = NULL;

            //saving to DB
            $pending_participant->save();

            //set the hour for meeting to engaged true
            $desired_hour = MeetingHour::where(array('id' => $pending_participant->hour_id))->get()->first();
            $desired_hour->engaged = 1;

            //saving to DB
            $desired_hour->save();

            //=== submit notification email to ids.dentacoin.com administrator ===
            $body = 'New <b style="color: green;">CONFIRMED</b> meeting for IDS: <br><br>Name: '.$pending_participant->title.' '.$pending_participant->fname.' '.$pending_participant->lname.'<br>Email: '.$pending_participant->email.'<br>Country: '.$pending_participant->country.'<br>Company or practise: '.$pending_participant->company_or_practise.'<br>Job title: '.$pending_participant->job.'<br>Company Website/ Social Page: '.$pending_participant->website.'<br>Note: '.$pending_participant->note;

            Mail::send(array(), array(), function($message) use ($body) {
                $message->to(EMAIL_RECEIVERS)->subject('New CONFIRMED IDS Meeting');
                $message->from(EMAIL_SENDER, 'Dentacoin at IDS 2019')->replyTo(EMAIL_SENDER, 'Dentacoin at IDS 2019');
                $message->setBody($body, 'text/html');
            });
            //=== /submit notification email to ids.dentacoin.com administrator ===

            return redirect()->route('home')->with(['success' => 'Your meeting request has been confirmed! See you in March 2019 at Koelnmesse!']);
        } else {
            return abort(404);
        }
    }
}
