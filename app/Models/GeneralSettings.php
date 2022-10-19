<?php

namespace App\Models;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public $company_name;
    public $website_title;
    public $website_description;
    public $website_keywords;
    public $website_logo;
    public $system_logo;
    public $loading_logo;
    public $login_page_logo;
    public $social_image;
    public $maintenance_mode;
    public $timezone;
    public $current_version;
    public $active_theme;

    public static function fields(): array
    {
        $settings = app(GeneralSettings::class);

        $fields = [
            'company_name'     =>   [
                'label'         =>  'settings.company_name',
                'translatable'  =>  true,
                'type'          =>  'string',
                'value'         =>  json_decode($settings->company_name, true),
                'required'      =>  true
            ],
            'system_logo'     =>   [
                'label'         =>  'settings.system_logo',
                'translatable'  =>  false,
                'type'          =>  'image',
                'value'         =>  $settings->system_logo,
                'required'      =>  false
            ],
            'loading_logo'     =>   [
                'label'         =>  'settings.loading_logo',
                'translatable'  =>  false,
                'type'          =>  'image',
                'value'         =>  $settings->loading_logo,
                'required'      =>  false
            ],
            'login_page_logo'     =>   [
                'label'         =>  'settings.login_page_logo',
                'translatable'  =>  false,
                'type'          =>  'image',
                'value'         =>  $settings->login_page_logo,
                'required'      =>  false
            ],
            'website_title'     =>   [
                'label'         =>  'settings.website_title',
                'translatable'  =>  true,
                'type'          =>  'string',
                'value'         =>  json_decode($settings->website_title, true),
                'required'      =>  true
            ],
            'website_description'     =>   [
                'label'         =>  'settings.website_description',
                'translatable'  =>  true,
                'type'          =>  'text',
                'value'         =>  json_decode($settings->website_description, true),
                'required'      =>  false
            ],
            'website_keywords'     =>   [
                'label'         =>  'settings.website_keywords',
                'translatable'  =>  true,
                'type'          =>  'text',
                'value'         =>  json_decode($settings->website_keywords, true),
                'required'      =>  false
            ],
            'website_logo'     =>   [
                'label'         =>  'settings.website_logo',
                'translatable'  =>  false,
                'type'          =>  'image',
                'value'         =>  $settings->website_logo,
                'required'      =>  false
            ],
            'social_image'     =>   [
                'label'         =>  'settings.social_image',
                'translatable'  =>  false,
                'type'          =>  'image',
                'value'         =>  $settings->social_image,
                'required'      =>  false
            ],
            'maintenance_mode'     =>   [
                'label'         =>  'settings.maintenance_mode',
                'translatable'  =>  false,
                'value'         =>  $settings->maintenance_mode,
                'type'          =>  'bool',
                'required'      =>  false
            ],
            'timezone'     =>   [
                'label'         =>  'settings.timezone',
                'translatable'  =>  false,
                'type'          =>  'select',
                'options'       =>  array(
                                        '-12'   =>  "(UTC-12:00) International Date Line West",
                                        '-11'   =>  "(UTC-11:00) Coordinated Universal Time-11",
                                        '-10'   =>  "(UTC-10:00) Hawaii",
                                        '-9'    =>  "(UTC-09:00) Alaska",
                                        '-7'    =>  "(UTC-07:00) Pacific Time (US & Canada)",
                                        '-8'    =>  "(UTC-08:00) Pacific Time (US & Canada)",
                                        '-6'    =>  "(UTC-06:00) Central America",
                                        '-5'    =>  "(UTC-06:00) Central Time (US & Canada)",
                                        '-4'    =>  "(UTC-05:00) Eastern Time (US & Canada)",
                                        '-4.5'  =>  "(UTC-04:30) Caracas",
                                        '-2.5'  =>  "(UTC-03:30) Newfoundland",
                                        '-3'    =>  "(UTC-03:00) Brasilia",
                                        '-2'    =>  "(UTC-02:00) Coordinated Universal Time-02",
                                        '-1'    =>  "(UTC-02:00) Mid-Atlantic - Old",
                                        '1' =>  "(UTC) Casablanca",
                                        '0' =>  "(UTC) Edinburgh, London",
                                        '1' =>  "(UTC+01:00) Edinburgh, London",
                                        '1' =>  "(UTC+01:00) West Central Africa",
                                        '1' =>  "(UTC+01:00) Windhoek",
                                        '3' =>  "(UTC+02:00) Athens, Bucharest",
                                        '3' =>  "(UTC+02:00) Beirut",
                                        '2' =>  "(UTC+02:00) Cairo",
                                        '3' =>  "(UTC+02:00) Damascus",
                                        '3' =>  "(UTC+02:00) E. Europe",
                                        '3' =>  "(UTC+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius",
                                        '3' =>  "(UTC+03:00) Istanbul",
                                        '3' =>  "(UTC+02:00) Jerusalem",
                                        '3' =>  "(UTC+03:00) Amman",
                                        '3' =>  "(UTC+03:00) Baghdad",
                                        '3' =>  "(UTC+02:00) Kaliningrad",
                                        '3' =>  "(UTC+03:00) Kuwait, Riyadh",
                                        '3' =>  "(UTC+03:00) Nairobi",
                                        '3' =>  "(UTC+03:00) Moscow, St. Petersburg, Volgograd, Minsk",
                                        '4' =>  "(UTC+04:00) Samara, Ulyanovsk, Saratov",
                                        '4.5'   =>  "(UTC+03:30) Tehran",
                                        '4' =>  "(UTC+04:00) Abu Dhabi, Muscat",
                                        '5' =>  "(UTC+04:00) Baku",
                                        '4' =>  "(UTC+04:00) Port Louis",
                                        '4' =>  "(UTC+04:00) Tbilisi",
                                        '4' =>  "(UTC+04:00) Yerevan",
                                        '4.5'   =>  "(UTC+04:30) Kabul",
                                        '5' =>  "(UTC+05:00) Ashgabat, Tashkent",
                                        '5' =>  "(UTC+05:00) Yekaterinburg",
                                        '5' =>  "(UTC+05:00) Islamabad, Karachi",
                                        '5.5'   =>  "(UTC+05:30) Chennai, Kolkata, Mumbai, New Delhi",
                                        '5.5'   =>  "(UTC+05:30) Sri Jayawardenepura",
                                        '5.75'  =>  "(UTC+05:45) Kathmandu",
                                        '6' =>  "(UTC+06:00) Nur-Sultan (Astana",
                                        '6' =>  "(UTC+06:00) Dhaka",
                                        '6.5'   =>  "(UTC+06:30) Yangon (Rangoon",
                                        '7' =>  "(UTC+07:00) Bangkok, Hanoi, Jakarta",
                                        '7' =>  "(UTC+07:00) Novosibirsk",
                                        '8' =>  "(UTC+08:00) Beijing, Chongqing, Hong Kong, Urumqi",
                                        '8' =>  "(UTC+08:00) Krasnoyarsk",
                                        '8' =>  "(UTC+08:00) Kuala Lumpur, Singapore",
                                        '8' =>  "(UTC+08:00) Perth",
                                        '8' =>  "(UTC+08:00) Taipei",
                                        '8' =>  "(UTC+08:00) Ulaanbaatar",
                                        '8' =>  "(UTC+08:00) Irkutsk",
                                        '9' =>  "(UTC+09:00) Osaka, Sapporo, Tokyo",
                                        '9' =>  "(UTC+09:00) Seoul",
                                        '9.5'   =>  "(UTC+09:30) Adelaide",
                                        '9.5'   =>  "(UTC+09:30) Darwin",
                                        '10'    =>  "(UTC+10:00) Brisbane",
                                        '10'    =>  "(UTC+10:00) Canberra, Melbourne, Sydney",
                                        '10'    =>  "(UTC+10:00) Guam, Port Moresby",
                                        '10'    =>  "(UTC+10:00) Hobart",
                                        '9' =>  "(UTC+09:00) Yakutsk",
                                        '11'    =>  "(UTC+11:00) Solomon Is., New Caledonia",
                                        '11'    =>  "(UTC+11:00) Vladivostok",
                                        '12'    =>  "(UTC+12:00) Auckland, Wellington",
                                        '12'    =>  "(UTC+12:00) Coordinated Universal Time+12",
                                        '12'    =>  "(UTC+12:00) Fiji",
                                        '12'    =>  "(UTC+12:00) Magadan",
                                        '13'    =>  "(UTC+12:00) Petropavlovsk-Kamchatsky - Old",
                                        '13'    =>  "(UTC+13:00) Nuku'alofa",
                                        '13'    =>  "(UTC+13:00) Samoa"
                                    ),
                'value'         =>  $settings->timezone,
                'required'      =>  true
            ],
            'current_version'     =>   [
                'label'         =>  '',
                'translatable'  =>  true,
                'type'          =>  'hidden',
                'value'         =>  $settings->current_version,
                'required'      =>  true
            ],
            'active_theme'     =>   [
                'label'         =>  '',
                'translatable'  =>  true,
                'type'          =>  'hidden',
                'value'         =>  $settings->active_theme,
                'required'      =>  true
            ],
        ];

        return $fields;
    }
    
    public static function group(): string
    {
        return 'general';
    }
    
    public static function encrypted(): array
    {
        return [
            
        ];
    }
}
