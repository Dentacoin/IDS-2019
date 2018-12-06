Skip to content

Search or jump to…

Pull requests
Issues
Marketplace
Explore
@miroslavnedelchev Sign out
6
3 3 Dentacoin/review-platform
Code  Issues 6  Pull requests 0  Projects 1  Wiki  Insights  Settings
review-platform/app/Http/Controllers/Vox/ProfileController.php
ef398b2  20 days ago
@YouPlusWe YouPlusWe lots of small improvements + new dentist approval

675 lines (563 sloc)  22.9 KB
<?php
namespace App\Http\Controllers\Vox;
use App\Http\Controllers\FrontController;
use Validator;
use Response;
use Request;
use Route;
use Hash;
use Mail;
use Auth;
use Image;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\UserInvite;
use App\Models\VoxCashout;
use App\Models\Dcn;
use App\Models\Civic;
use Carbon\Carbon;
class ProfileController extends FrontController
{
    public function __construct(\Illuminate\Http\Request $request, Route $route, $locale=null) {
        parent::__construct($request, $route, $locale);
        $this->menu = [
            'home' => trans('vox.page.profile.menu.wallet'),
            'info' => trans('vox.page.profile.menu.info'),
            'privacy' => trans('vox.page.profile.menu.privacy'),
            'invite' => trans('vox.page.profile.menu.invite-patient'),
            'vox' => trans('vox.page.profile.menu.vox'),
        ];
        $this->profile_fields = [
            'name' => [
                'type' => 'text',
                'required' => true,
                'min' => 3,
            ],
            'email' => [
                'type' => 'text',
                'required' => true,
                'is_email' => true,
            ],
            'country_id' => [
                'type' => 'country',
                'required' => true,
            ],
            'city_id' => [
                'type' => 'city',
                'required' => true,
            ],
            'birthyear' => [
                'type' => 'select',
                'required' => true,
                'values' => array_combine( range( date('Y'), date('Y')-90 ), range( date('Y'), date('Y')-90 ) )
            ],
            'gender' => [
                'type' => 'select',
                'required' => true,
                'values' => [
                    'm' => trans('vox.common.gender.m'),
                    'f' => trans('vox.common.gender.f'),
                ]
            ],
        ];
        $this->genders = [
            '' => null,
            'm' => trans('admin.common.gender.m'),
            'f' => trans('admin.common.gender.f'),
        ];
    }
    public function handleMenu() {
        if($this->user->is_dentist) {
            $this->menu['invite'] = trans('vox.page.profile.menu.invite-dentist');
        }
    }
    public function setGrace($locale=null) {
        if(empty($this->user->grace_end)) {
            $this->user->grace_end = Carbon::now();
            $this->user->save();
        }
        session(['new_auth' => null]);
    }
    //
    //Home
    //
    public function home($locale=null) {
        if($this->user->is_dentist && !$this->user->is_approved) {
            return redirect(getLangUrl('welcome-to-dentavox'));
        }
        if($this->user->isBanned('vox')) {
            return redirect(getLangUrl('profile/vox'));
        }
        $this->handleMenu();
        if(Request::isMethod('post')) {
            $va = trim(Request::input('vox-address'));
            if(empty($va) || mb_strlen($va)!=42) {
                Request::session()->flash('error-message', trans('vox.page.profile.home.address-invalid'));
            } else if(!$this->user->canIuseAddress($va)) {
                Request::session()->flash('error-message', trans('vox.page.profile.home.address-used'));
            } else {
                $this->user->dcn_address = Request::input('vox-address');
                $this->user->save();
                Request::session()->flash('success-message', trans('vox.page.profile.home.address-saved'));
            }

            return redirect( getLangUrl('profile'));
        }
        return $this->ShowVoxView('profile', [
            'menu' => $this->menu,
            'currencies' => file_get_contents('/tmp/dcn_currncies'),
            'history' => $this->user->history->where('type', '=', 'vox-cashout'),
            'js' => [
                'wallet.js',
                'profile.js',
            ],
            'jscdn' => [
                'https://hosted-sip.civic.com/js/civic.sip.min.js',
            ],
            'csscdn' => [
                'https://hosted-sip.civic.com/css/civic-modal.min.css',
            ],
        ]);
    }
    public function withdraw($locale=null) {
        if($this->user->isBanned('vox') || !$this->user->canWithdraw('vox') ) {
            return;
        }
        $va = trim(Request::input('vox-address'));
        if(empty($va) || mb_strlen($va)!=42) {
            $ret = [
                'success' => false,
                'message' => trans('vox.page.profile.home.address-invalid')
            ];
            return Response::json( $ret );
        } else if(!$this->user->canIuseAddress($va)) {
            $ret = [
                'success' => false,
                'message' => trans('vox.page.profile.home.address-used')
            ];
            return Response::json( $ret );
        } else {
            $this->user->dcn_address = Request::input('vox-address');
            $this->user->save();
        }

        $amount = intval(Request::input('wallet-amount'));
        if($amount > $this->user->getVoxBalance()) {
            $ret = [
                'success' => false,
                'message' => trans('vox.page.profile.home.amount-too-high')
            ];
        } else if($amount<env('VOX_MIN_WITHDRAW')) {
            $ret = [
                'success' => false,
                'message' => trans('vox.page.profile.home.amount-too-low', [
                    'minimum' => '<b>'.env('VOX_MIN_WITHDRAW').'</b>'
                ])
            ];
        } else {
            $cashout = new VoxCashout;
            $cashout->user_id = $this->user->id;
            $cashout->reward = $amount;
            $cashout->address = $this->user->dcn_address;
            $cashout->save();
            $ret = Dcn::send($this->user, $this->user->dcn_address, $amount, 'vox-cashout', $cashout->id);
            $ret['balance'] = $this->user->getVoxBalance();

            if($ret['success']) {
                $cashout->tx_hash = $ret['message'];
                $cashout->save();
            } else if (!empty($ret['valid_input'])) {
                $ret['success'] = true;
            }
            if( empty($ret['success']) ) {
                $cashout->delete();
            }
        }
        return Response::json( $ret );
    }
    //
    //Vox
    //
    public function vox($locale=null) {
        if($this->user->is_dentist && !$this->user->is_approved) {
            return redirect(getLangUrl('welcome-to-dentavox'));
        }
        $this->handleMenu();
        $current_ban = $this->user->isBanned('vox');
        $prev_bans = null;
        $time_left = '';
        $ban_reason = '';
        $ban_alternatives = '';
        $ban_alternatives_buttons = '';
        if( $current_ban ) {
            $prev_bans = $this->user->getPrevBansCount('vox', $current_ban->type);
            if($current_ban->type=='mistakes') {
                $ban_reason = trans('vox.page.bans.banned-mistakes-title-'.$prev_bans);
            } else {
                $ban_reason = trans('vox.page.bans.banned-too-fast-title-'.$prev_bans);
            }
            if($prev_bans==1) {
                $ban_alternatives = trans('vox.page.bans.banned-alternative-1');
                $ban_alternatives_buttons = '
                <a href="https://dentacare.dentacoin.com/" target="_blank">
                    <img src="'.url('new-vox-img/bans-dentacare.png').'" />
                </a>';
            } else if($prev_bans==2) {
                $ban_alternatives = trans('vox.page.bans.banned-alternative-2');
                $ban_alternatives_buttons = '
                <a href="https://reviews.dentacoin.com/" target="_blank">
                    <img src="'.url('new-vox-img/bans-trp.png').'" />
                </a>';
            } else if($prev_bans==3) {
                $ban_alternatives = trans('vox.page.bans.banned-alternative-3');
                $ban_alternatives_buttons = '
                <a href="https://dentacare.dentacoin.com/" target="_blank">
                    <img src="'.url('new-vox-img/bans-dentacare.png').'" />
                </a>';
            } else {
                $ban_alternatives = trans('vox.page.bans.banned-alternative-4');
                $ban_alternatives_buttons = '
                <a href="https://dentacare.dentacoin.com/" target="_blank">
                    <img src="'.url('new-vox-img/bans-dentacare.png').'" />
                </a>
                <a href="https://reviews.dentacoin.com/" target="_blank">
                    <img src="'.url('new-vox-img/bans-trp.png').'" />
                </a>';
            }
            if( $current_ban->expires ) {
                $now = Carbon::now();
                $time_left = $current_ban->expires->diffInHours($now).':'.
                    str_pad($current_ban->expires->diffInMinutes($now)%60, 2, '0', STR_PAD_LEFT).':'.
                    str_pad($current_ban->expires->diffInSeconds($now)%60, 2, '0', STR_PAD_LEFT);
            } else {
                $time_left = null;
            }
        }
        return $this->ShowVoxView('profile-vox', [
            'menu' => $this->menu,
            'prev_bans' => $prev_bans,
            'current_ban' => $current_ban,
            'ban_reason' => $ban_reason,
            'ban_alternatives' => $ban_alternatives,
            'ban_alternatives_buttons' => $ban_alternatives_buttons,
            'time_left' => $time_left,
            'histories' => $this->user->vox_rewards->where('vox_id', '!=', 34),
            'payouts' => $this->user->history->where('type', '=', 'vox-cashout'),
            'js' => [
                'profile.js',
            ]
        ]);
    }
    //
    //Privacy
    //
    public function privacy($locale=null) {
        if($this->user->is_dentist && !$this->user->is_approved) {
            return redirect(getLangUrl('welcome-to-dentavox'));
        }
        if($this->user->isBanned('vox')) {
            return redirect(getLangUrl('profile/vox'));
        }
        $this->handleMenu();

        if(Request::isMethod('post')) {
            if( Request::input('action') ) {
                if( Request::input('action')=='delete' ) {
                    $this->user->sendTemplate( 30 );
                    $this->user->self_deleted = 1;
                    $this->user->save();
                    $this->user->deleteActions();
                    User::destroy( $this->user->id );
                    Auth::guard('web')->logout();
                    return redirect( getLangUrl('/') );
                }
            }
        }
        return $this->ShowVoxView('profile-privacy', [
            'menu' => $this->menu,
            'js' => [
                'profile.js',
            ],
        ]);
    }
    public function privacy_download($locale=null) {
        $html = $this->showView('users-data', array(
            'genders' => $this->genders,
        ))->render();
        $tmp_path = '/tmp/'.$this->user->id;
        if(!is_dir($tmp_path)) {
            mkdir($tmp_path);
        }
        file_put_contents($tmp_path.'/my-private-info.html', $html);
        if($this->user->hasimage) {
            copy( $this->user->getImagePath(), $tmp_path.'/'.$this->user->id.'.jpg' );
        }
        if($this->user->photos->isNotEmpty()) {
            foreach ($this->user->photos as $photo) {
                copy( $photo->getImagePath(), $tmp_path.'/'.$photo->id.'.jpg' );
            }
        }
        exec('zip -rj0 '.$tmp_path.'.zip '.$tmp_path.'/*');
        exec('rm -rf '.$tmp_path);
        $mtext = $this->user->getName().' just requested his/hers personal information<br/>
User\'s email is: '.$this->user->email.'<br/>
Link to user\'s profile in CMS: https://reviews.dentacoin.com/cms/users/edit/'.$this->user->id;
        Mail::send([], [], function ($message) use ($mtext) {
            $sender = config('mail.from.address');
            $sender_name = config('mail.from.name');
            $message->from($sender, $sender_name);
            $message->to( 'privacy@dentacoin.com' ); //$sender
            //$message->to( 'dokinator@gmail.com' );
            $message->replyTo($sender, $sender_name);
            $message->subject('New Personal Data Download Request');
            $message->attach('/tmp/'.$this->user->id.'.zip');
            $message->setBody($mtext, 'text/html'); // for HTML rich messages
        });
        return Response::download($tmp_path.'.zip', 'your-private-info.zip');
    }
    //
    //Invites
    //
    public function invite($locale=null) {
        if($this->user->is_dentist && !$this->user->is_approved) {
            return redirect(getLangUrl('welcome-to-dentavox'));
        }
        if($this->user->isBanned('vox')) {
            return redirect(getLangUrl('profile/vox'));
        }
        $this->handleMenu();

        if(Request::isMethod('post') && $this->user->canInvite('vox') ) {
            if(Request::Input('is_contacts')) {
                if(empty(Request::Input('contacts')) || !is_array( Request::Input('contacts') ) ) {
                    return Response::json(['success' => false, 'message' => trans('vox.page.profile.'.$this->current_subpage.'.contacts-none-selected') ] );
                }
                foreach (Request::Input('contacts') as $inv_info) {
                    $inv_arr = explode('|', $inv_info);
                    $email = $name = '';
                    if(count($inv_arr)>1) {
                        $email = $inv_arr[ count($inv_arr)-1 ];
                        $name = $inv_arr[0];
                    } else {
                        $email = $inv_arr[0];
                    }
                    $already = UserInvite::where([
                        ['user_id', $this->user->id],
                        ['invited_email', 'LIKE', $email],
                    ])->first();
                    if(!$already) {
                        $invitation = new UserInvite;
                        $invitation->user_id = $this->user->id;
                        $invitation->invited_email = $email;
                        $invitation->invited_name = $name;
                        $invitation->save();
                        //Mega hack
                        $dentist_name = $this->user->name;
                        $dentist_email = $this->user->email;
                        $this->user->name = '';
                        $this->user->email = $email;
                        $this->user->save();
                        $this->user->sendTemplate( $this->user->is_dentist ? 27 : 25, [
                            'friend_name' => $dentist_name,
                            'invitation_id' => $invitation->id
                        ]);
                        //Back to original
                        $this->user->name = $dentist_name;
                        $this->user->email = $dentist_email;
                        $this->user->save();
                    }
                }
                return Response::json(['success' => true, 'message' => trans('vox.page.profile.'.$this->current_subpage.'.contacts-success') ] );
            } else {
                $validator = Validator::make(Request::all(), [
                    'email' => ['required', 'email'],
                    'name' => ['required', 'string'],
                ]);
                if ($validator->fails()) {
                    return Response::json(['success' => false, 'message' => trans('vox.page.profile.'.$this->current_subpage.'.failure') ] );
                } else {
                    $already = UserInvite::where([
                        ['user_id', $this->user->id],
                        ['invited_email', 'LIKE', Request::Input('email')],
                    ])->first();
                    if($already) {
                        return Response::json(['success' => false, 'message' => trans('vox.page.profile.'.$this->current_subpage.'.already-invited') ] );
                    }
                    $invitation = new UserInvite;
                    $invitation->user_id = $this->user->id;
                    $invitation->invited_email = Request::Input('email');
                    $invitation->invited_name = Request::Input('name');
                    $invitation->save();
                    //Mega hack
                    $dentist_name = $this->user->name;
                    $dentist_email = $this->user->email;
                    $this->user->name = Request::Input('name');
                    $this->user->email = Request::Input('email');
                    $this->user->save();
                    $this->user->sendTemplate( $this->user->is_dentist ? 27 : 25 , [
                        'friend_name' => $dentist_name,
                        'invitation_id' => $invitation->id
                    ]);
                    //Back to original
                    $this->user->name = $dentist_name;
                    $this->user->email = $dentist_email;
                    $this->user->save();
                    return Response::json(['success' => true, 'message' => trans('vox.page.profile.'.$this->current_subpage.'.success') ] );
                }
            }
        }
        return $this->ShowVoxView('profile-invite', [
            'menu' => $this->menu,
            'js' => [
                'profile.js',
                'hello.all.js',
            ],
        ]);
    }

    //
    //Info
    //
    public function upload($locale=null) {
        if($this->user->is_dentist && !$this->user->is_approved) {
            return Response::json(['success' => false ]);
        }
        if($this->user->isBanned('vox')) {
            return Response::json(['success' => false ]);
        }
        $this->handleMenu();
        if( Request::file('image') && Request::file('image')->isValid() ) {
            $img = Image::make( Input::file('image') )->orientate();
            $this->user->addImage($img);
            return Response::json(['success' => true, 'thumb' => $this->user->getImageUrl(true), 'name' => '' ]);
        }


    }

    public function info($locale=null) {
        if($this->user->is_dentist && !$this->user->is_approved) {
            return redirect(getLangUrl('welcome-to-dentavox'));
        }
        if($this->user->isBanned('vox')) {
            return redirect(getLangUrl('profile/vox'));
        }
        $this->handleMenu();

        if(Request::isMethod('post')) {
            $validator_arr = [];
            foreach ($this->profile_fields as $key => $value) {
                $arr = [];
                if (!empty($value['required'])) {
                    $arr[] = 'required';
                }
                if (!empty($value['is_email'])) {
                    $arr[] = 'email';
                    $arr[] = 'unique:users,email,'.$this->user->id;
                }
                if (!empty($value['min'])) {
                    $arr[] = 'min:'.$value['min'];
                }
                if (!empty($value['max'])) {
                    $arr[] = 'max:'.$value['max'];
                }
                if (!empty($value['number'])) {
                    $arr[] = 'numeric';
                }
                if (!empty($value['values'])) {
                    $arr[] = 'in:'.implode(',', array_keys($value['values']) );
                }
                if (!empty($arr)) {
                    $validator_arr[$key] = $arr;
                }
            }
            $validator = Validator::make(Request::all(), $validator_arr);
            if ($validator->fails()) {
                return redirect( getLangUrl('profile/info') )
                    ->withInput()
                    ->withErrors($validator);
            } else {
                $send_validate_email = $this->user->email != Request::input('email');
                foreach ($this->profile_fields as $key => $value) {
                    $this->user->$key = Request::input($key);
                }
                $this->user->save();
                Request::session()->flash('success-message', trans('vox.page.profile.info.updated'));
                return redirect( getLangUrl('profile/info') );
            }
        }
        return $this->ShowVoxView('profile-info', [
            'menu' => $this->menu,
            'fields' => $this->profile_fields,
            'js' => [
                'profile.js',
            ],
        ]);
    }
    public function change_password($locale=null) {
        if($this->user->is_dentist && !$this->user->is_approved) {
            return redirect(getLangUrl('welcome-to-dentavox'));
        }
        if($this->user->isBanned('vox')) {
            return redirect(getLangUrl('profile/vox'));
        }
        $validator = Validator::make(Request::all(), [
            'cur-password' => 'required',
            'new-password' => 'required|min:6',
            'new-password-repeat' => 'required|same:new-password',
        ]);
        if ($validator->fails()) {
            return redirect( getLangUrl('profile/info') )
                ->withInput()
                ->withErrors($validator);
        } else {
            if ( !Hash::check(Request::input('cur-password'), $this->user->password) ) {
                Request::session()->flash('error-message', trans('vox.page.profile.wrong-password'));
                return redirect( getLangUrl('profile/info') );
            }

            $this->user->password = bcrypt(Request::input('new-password'));
            $this->user->save();

            Request::session()->flash('success-message', trans('vox.page.profile.info.password-updated'));
            return redirect( getLangUrl('profile/info'));
        }
    }
    public function jwt($locale=null) {
        $ret = [
            'success' => false
        ];
        if($this->user->isBanned('vox')) {
            $ret['message'] = 'banned';
            return Response::json( $ret );
        }

        if($this->user->is_dentist && !$this->user->is_approved) {
            $ret['message'] = 'not-verified';
            return Response::json( $ret );
        }
        $jwt = Request::input('jwtToken');
        $civic = Civic::where('jwtToken', 'LIKE', $jwt)->first();
        if(!empty($civic)) {
            $data = json_decode($civic->response, true);
            $ret['weak'] = true;
            if(!empty($data['data'])) {
                foreach ($data['data'] as $key => $value) {
                    if( mb_strpos( $value['label'], 'documents.' ) !==false ) {
                        unset($ret['weak']);
                        break;
                    }
                }
            }
            if(empty($ret['weak']) && !empty($data['userId'])) {
                $u = User::where('civic_id', 'LIKE', $data['userId'])->first();
                if(!empty($u) && $u->id != $this->user->id) {
                    $ret['duplicate'] = true;
                } else {
                    $this->user->civic_kyc = 1;
                    $this->user->civic_id = $data['userId'];
                    $this->user->save();
                    $ret['success'] = true;
                    Request::session()->flash('success-message', trans('vox.page.profile.wallet.civic-validated'));
                }
            }
        }

        return Response::json( $ret );
    }
    public function balance($locale=null) {
        return Response::json( User::getBalance( Request::input('vox-address') ) );
    }
    public function gdpr($locale=null) {
        $this->user->gdpr_privacy = true;
        $this->user->save();
        Request::session()->flash('success-message', trans('vox.page.profile.gdpr-done'));
        return redirect( getLangUrl('profile'));
    }
}