@if(!empty($first_free_hour))
    <form method="POST" id="submit-schedule-a-meeting" action="{{ route('submit-schedule-a-meeting', ['lang' => config('app.locale')]) }}">
        <input type="hidden" name="date-slug" value="1"/>
        <input type="hidden" name="hour" value="{{$first_free_hour->id}}"/>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-sm-offset-1 col-lg-2 col-lg-offset-3 hours">
                    @foreach($meeting_hours as $hour)
                        <div class="text-center padding-bottom-10">
                            <a href="javascript:void(0)" class="solid-blue-white-btn max-width-260 margin-0-auto @if($first_free_hour->id == $hour->id) active @endif @if($hour->engaged) disabled @endif" data-hour="{{$hour->id}}">
                                @if(config('app.locale') == 'en')
                                    {{$hour->hour}}
                                @elseif(config('app.locale') == 'de')
                                    {{$hour->hour_de}}
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="col-xs-12 col-sm-7 col-lg-4 padding-top-xs-20">
                    <div class="form-row padding-bottom-15 fs-0">
                        <div class="form-cell-20 cell inline-block-bottom">
                            <label for="title">{{ __('content.title_field') }}*</label>
                            <select id="title" name="title" class="selectpicker required" data-live-search="true" required>
                                <option value="Dr.">Mr.</option>
                                <option value="Ms.">Ms.</option>
                                <option value="Dr.">Dr.</option>
                                <option value="Prof.">Prof.</option>
                                <option value="Prof. Dr.">Prof. Dr.</option>
                            </select>
                        </div>
                        <div class="form-cell-40 cell inline-block-bottom">
                            <label for="fname">{{ __('content.fname') }}*</label>
                            <input type="text" name="fname" id="fname" maxlength="100" required/>
                        </div>
                        <div class="form-cell-40 cell inline-block-bottom">
                            <label for="lname">{{ __('content.lname') }}*</label>
                            <input type="text" name="lname" id="lname" maxlength="100" required/>
                        </div>
                        <div class="form-cell-50 cell inline-block-bottom">
                            <label for="email">{{ __('content.business_email') }}*</label>
                            <input type="email" name="email" id="email" maxlength="100" required />
                        </div>
                        <div class="form-cell-50 cell inline-block-bottom">
                            <label for="country">{{ __('content.country') }}*</label>
                            <select name="country" id="country" class="selectpicker required" title="Country" data-live-search="true" required>
                                <option>Afghanistan</option>
                                <option>Åland Islands</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                                <option>American Samoa</option>
                                <option>Andorra</option>
                                <option>Angola</option>
                                <option>Anguilla</option>
                                <option>Antarctica</option>
                                <option>Antigua and Barbuda</option>
                                <option>Argentina</option>
                                <option>Armenia</option>
                                <option>Aruba</option>
                                <option>Australia</option>
                                <option>Austria</option>
                                <option>Azerbaijan</option>
                                <option>Bahamas</option>
                                <option>Bahrain</option>
                                <option>Bangladesh</option>
                                <option>Barbados</option>
                                <option>Belarus</option>
                                <option>Belgium</option>
                                <option>Belize</option>
                                <option>Benin</option>
                                <option>Bermuda</option>
                                <option>Bhutan</option>
                                <option>Bolivia, Plurinational State of</option>
                                <option>Bonaire, Sint Eustatius and Saba</option>
                                <option>Bosnia and Herzegovina</option>
                                <option>Botswana</option>
                                <option>Bouvet Island</option>
                                <option>Brazil</option>
                                <option>British Indian Ocean Territory</option>
                                <option>Brunei Darussalam</option>
                                <option>Bulgaria</option>
                                <option>Burkina Faso</option>
                                <option>Burundi</option>
                                <option>Cambodia</option>
                                <option>Cameroon</option>
                                <option>Canada</option>
                                <option>Cape Verde</option>
                                <option>Cayman Islands</option>
                                <option>Central African Republic</option>
                                <option>Chad</option>
                                <option>Chile</option>
                                <option>China</option>
                                <option>Christmas Island</option>
                                <option>Cocos (Keeling) Islands</option>
                                <option>Colombia</option>
                                <option>Comoros</option>
                                <option>Congo</option>
                                <option>Congo, the Democratic Republic of the</option>
                                <option>Cook Islands</option>
                                <option>Costa Rica</option>
                                <option>Côte d'Ivoire</option>
                                <option>Croatia</option>
                                <option>Cuba</option>
                                <option>Curaçao</option>
                                <option>Cyprus</option>
                                <option>Czech Republic</option>
                                <option>Denmark</option>
                                <option>Djibouti</option>
                                <option>Dominica</option>
                                <option>Dominican Republic</option>
                                <option>Ecuador</option>
                                <option>Egypt</option>
                                <option>El Salvador</option>
                                <option>Equatorial Guinea</option>
                                <option>Eritrea</option>
                                <option>Estonia</option>
                                <option>Ethiopia</option>
                                <option>Falkland Islands (Malvinas)</option>
                                <option>Faroe Islands</option>
                                <option>Fiji</option>
                                <option>Finland</option>
                                <option>France</option>
                                <option>French Guiana</option>
                                <option>French Polynesia</option>
                                <option>French Southern Territories</option>
                                <option>Gabon</option>
                                <option>Gambia</option>
                                <option>Georgia</option>
                                <option>Germany</option>
                                <option>Ghana</option>
                                <option>Gibraltar</option>
                                <option>Greece</option>
                                <option>Greenland</option>
                                <option>Grenada</option>
                                <option>Guadeloupe</option>
                                <option>Guam</option>
                                <option>Guatemala</option>
                                <option>Guernsey</option>
                                <option>Guinea</option>
                                <option>Guinea-Bissau</option>
                                <option>Guyana</option>
                                <option>Haiti</option>
                                <option>Heard Island and McDonald Islands</option>
                                <option>Holy See (Vatican City State)</option>
                                <option>Honduras</option>
                                <option>Hong Kong</option>
                                <option>Hungary</option>
                                <option>Iceland</option>
                                <option>India</option>
                                <option>Indonesia</option>
                                <option>Iran, Islamic Republic of</option>
                                <option>Iraq</option>
                                <option>Ireland</option>
                                <option>Isle of Man</option>
                                <option>Israel</option>
                                <option>Italy</option>
                                <option>Jamaica</option>
                                <option>Japan</option>
                                <option>Jersey</option>
                                <option>Jordan</option>
                                <option>Kazakhstan</option>
                                <option>Kenya</option>
                                <option>Kiribati</option>
                                <option>Korea, Democratic People's Republic of</option>
                                <option>Korea, Republic of</option>
                                <option>Kuwait</option>
                                <option>Kyrgyzstan</option>
                                <option>Lao People's Democratic Republic</option>
                                <option>Latvia</option>
                                <option>Lebanon</option>
                                <option>Lesotho</option>
                                <option>Liberia</option>
                                <option>Libya</option>
                                <option>Liechtenstein</option>
                                <option>Lithuania</option>
                                <option>Luxembourg</option>
                                <option>Macao</option>
                                <option>Macedonia, the former Yugoslav Republic of</option>
                                <option>Madagascar</option>
                                <option>Malawi</option>
                                <option>Malaysia</option>
                                <option>Maldives</option>
                                <option>Mali</option>
                                <option>Malta</option>
                                <option>Marshall Islands</option>
                                <option>Martinique</option>
                                <option>Mauritania</option>
                                <option>Mauritius</option>
                                <option>Mayotte</option>
                                <option>Mexico</option>
                                <option>Micronesia, Federated States of</option>
                                <option>Moldova, Republic of</option>
                                <option>Monaco</option>
                                <option>Mongolia</option>
                                <option>Montenegro</option>
                                <option>Montserrat</option>
                                <option>Morocco</option>
                                <option>Mozambique</option>
                                <option>Myanmar</option>
                                <option>Namibia</option>
                                <option>Nauru</option>
                                <option>Nepal</option>
                                <option>Netherlands</option>
                                <option>New Caledonia</option>
                                <option>New Zealand</option>
                                <option>Nicaragua</option>
                                <option>Niger</option>
                                <option>Nigeria</option>
                                <option>Niue</option>
                                <option>Norfolk Island</option>
                                <option>Northern Mariana Islands</option>
                                <option>Norway</option>
                                <option>Oman</option>
                                <option>Pakistan</option>
                                <option>Palau</option>
                                <option>Palestinian Territory, Occupied</option>
                                <option>Panama</option>
                                <option>Papua New Guinea</option>
                                <option>Paraguay</option>
                                <option>Peru</option>
                                <option>Philippines</option>
                                <option>Pitcairn</option>
                                <option>Poland</option>
                                <option>Portugal</option>
                                <option>Puerto Rico</option>
                                <option>Qatar</option>
                                <option>Réunion</option>
                                <option>Romania</option>
                                <option>Russian Federation</option>
                                <option>Rwanda</option>
                                <option>Saint Barthélemy</option>
                                <option>Saint Helena, Ascension and Tristan da Cunha</option>
                                <option>Saint Kitts and Nevis</option>
                                <option>Saint Lucia</option>
                                <option>Saint Martin (French part)</option>
                                <option>Saint Pierre and Miquelon</option>
                                <option>Saint Vincent and the Grenadines</option>
                                <option>Samoa</option>
                                <option>San Marino</option>
                                <option>Sao Tome and Principe</option>
                                <option>Saudi Arabia</option>
                                <option>Senegal</option>
                                <option>Serbia</option>
                                <option>Seychelles</option>
                                <option>Sierra Leone</option>
                                <option>Singapore</option>
                                <option>Sint Maarten (Dutch part)</option>
                                <option>Slovakia</option>
                                <option>Slovenia</option>
                                <option>Solomon Islands</option>
                                <option>Somalia</option>
                                <option>South Africa</option>
                                <option>South Georgia and the South Sandwich Islands</option>
                                <option>South Sudan</option>
                                <option>Spain</option>
                                <option>Sri Lanka</option>
                                <option>Sudan</option>
                                <option>Suriname</option>
                                <option>Svalbard and Jan Mayen</option>
                                <option>Swaziland</option>
                                <option>Sweden</option>
                                <option>Switzerland</option>
                                <option>Syrian Arab Republic</option>
                                <option>Taiwan, Province of China</option>
                                <option>Tajikistan</option>
                                <option>Tanzania, United Republic of</option>
                                <option>Thailand</option>
                                <option>Timor-Leste</option>
                                <option>Togo</option>
                                <option>Tokelau</option>
                                <option>Tonga</option>
                                <option>Trinidad and Tobago</option>
                                <option>Tunisia</option>
                                <option>Turkey</option>
                                <option>Turkmenistan</option>
                                <option>Turks and Caicos Islands</option>
                                <option>Tuvalu</option>
                                <option>Uganda</option>
                                <option>Ukraine</option>
                                <option>United Arab Emirates</option>
                                <option>United Kingdom</option>
                                <option>United States</option>
                                <option>United States Minor Outlying Islands</option>
                                <option>Uruguay</option>
                                <option>Uzbekistan</option>
                                <option>Vanuatu</option>
                                <option>Venezuela, Bolivarian Republic of</option>
                                <option>Viet Nam</option>
                                <option>Virgin Islands, British</option>
                                <option>Virgin Islands, U.S.</option>
                                <option>Wallis and Futuna</option>
                                <option>Western Sahara</option>
                                <option>Yemen</option>
                                <option>Zambia</option>
                                <option>Zimbabwe</option>
                            </select>
                        </div>
                        <div class="form-cell-50 cell inline-block-bottom">
                            <label for="company-or-practise">{{ __('content.company_or_practise') }}*</label>
                            <input type="text" name="company-or-practise" id="company-or-practise" maxlength="255" required/>
                        </div>
                        <div class="form-cell-50 cell inline-block-bottom">
                            <label for="job">{{ __('content.job_title') }}*</label>
                            <input type="text" name="job" id="job" maxlength="255" required/>
                        </div>
                        <div class="form-cell-100 cell inline-block-bottom">
                            <label for="website">{{ __('content.company_website') }}*</label>
                            <input type="text" name="website" id="website" maxlength="255" required/>
                        </div>
                        <div class="form-cell-100 cell inline-block-bottom">
                            <label for="note">{{ __('content.any_specific_inquiry') }}</label>
                            <textarea name="note" id="note" rows="3" maxlength="3000"></textarea>
                        </div>
                        <div class="form-cell-100 cell captcha-parent">
                            <div class="inline-block fs-14 width-50">
                                <input type="text" name="captcha" id="captcha" placeholder="{{ __('content.enter_captcha') }}" maxlength="5" required/>
                            </div>
                            <div class="inline-block width-50">
                                <div class="captcha-container flex">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="refresh-captcha">
                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-cell-100 cell fs-14 checkbox-container">
                            <input type="checkbox" id="privacy-policy"/>
                            <label for="privacy-policy" class="inline-block-important">{!! __('content.agree_with_privacy_policy') !!}</label>
                        </div>
                        <div class="padding-top-10 padding-left-10 text-left">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <button type="submit" class="white-solid-blue-btn min-width-200">{{ __('content.schedule_btn') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@else
    <div class="text-center padding-top-50 padding-bottom-50 padding-left-15 padding-right-15 fs-20 lato-black">{{ __('content.all_hours_taken') }}</div>
@endif