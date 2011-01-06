<?php
require_once "messagemedia/SmsInterface.inc";
require_once "recaptcha/recaptchalib.php";
require_once "regions.php";
require_once "product-details/mobileDetails.class.php";

sms::$config = $config;
sms::$lang = $lang;

class sms {
    static $lang = 'en-US';
    static $config = array();
    static $error = false;

    static function check_submit() {
        if (array_key_exists('sms_submit', $_POST))
            // set a form error if 
            // the submit handler returns false
            self::$error = !self::handle_submit();
    }
    static function handle_submit() {
        require_once "langconfig.inc.php";

        // gather values for Recaptcha
        $remote_addr = array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        $challenge = array_key_exists('recaptcha_challenge_field', $_POST) ? $_POST['recaptcha_challenge_field'] : '';
        $response = array_key_exists('recaptcha_response_field', $_POST) ? $_POST['recaptcha_response_field'] : '';

        // error if recaptcha response empty
        if (empty($challenge) || empty($response))
            return false;

        // check Recaptcha
        $captcha = recaptcha_check_answer(
            self::$config['recaptcha_priv_key'],
            $remote_addr,
            $challenge,
            $response);

        // error if recaptcha response is invalid
        if (!$captcha->is_valid)
            return false;

        // summon the api
        // send the phone number

        try  {
            $phone = self::clean_phone();
            $si = new SmsInterface (false, false);
            $si->addMessage ($phone, self::message());

            if (!$si->connect (self::$config["sms_username"], self::$config["sms_password"], true, false))
                return false;
            elseif (!$si->sendMessages ())
                return false;
            else
                self::success();
        } catch (Exception $e) {
            return false;
        }
    }
    static function message() {
       $mes = array_key_exists(self::$lang, self::$messages) ? self::$messages[self::$lang] : self::$messages['en-US'];
       $mes .= ' '. mobileDetails::download_url(self::$lang, mobileDetails::maemo);
       return $mes;
    }

    static function locations() {

        $countries = regionNames(self::$lang);
        $ret = array();
        foreach (self::$phonecodes as $lang_code => $data) {
            $region_name = array_key_exists($lang_code, $countries) ? $countries[$lang_code] : $data[0];
            $tel_code = self::$phonecodes[$lang_code][1];
            $ret[$region_name] = $tel_code;
        }
        ksort($ret);
        return $ret;
    }

    static function form() {
        $lang = self::$lang;
        $config = self::$config;
        $sms_error = self::$error;
        $sms_disabled = array_key_exists('sms_disabled', self::$config) && self::$config['sms_disabled'];

        ob_start();
        include "mobile-sms-form.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    static function success() {
        $base_url = self::$config['url_scheme'].'://'. self::$config['server_name'].'/'. self::$lang.'/mobile/';
        $header = 'Location: '. $base_url .'sms-thanks.html';
        header($header);
        exit();
    }
    static function clean_phone() {
        $phone  = preg_replace('/[^\+0-9]/', '', $_POST['phone']);
        $prefix = $_POST['prefix'];

        // if we don't have a phone throw an error
        if ($phone == '' || str_replace($prefix,'',$phone)=='')
            throw new Exception('No phone number.');


        // this means either JS is off or the user intervened to remove the prefix
        // so we'll add it back
        if (strpos($phone, $prefix) !== 0)
            $phone = $prefix.$phone;

        return $phone;
    }
    // en-US should always exist.  it's used as the fallback
    static $messages = array(
        'en-US' => "Select the link to download Firefox to your Nokia N900:",
        'pt-BR' => "Selecione o link para baixar o Firefox no seu Nokia N900:",
        'de' => "Wählen Sie den folgenden Link, um Firefox auf Ihr Nokia N900 herunterzuladen:",
        'sk' => "Pomocou tohto odkazu si môžete prevziať Firefox do svojej Nokie N900:",
        'ca' => "Seleccioneu l'enllaç per baixar el Firefox al vostre Nokia N900:",
        'ko' => "여러분의 Nokia N900에서 firefox를 다운로드 하실 수 있습니다.:",
        'tr' => "Firefox'un Nokia N900 sürümünü indirmek için aşağıdaki bağlantıyı seçin:",
        'fy-NL' => "Selektearje de keppeling om Firefox yn te laden op jo Nokia N900:",
        'nl' => "Selecteer de link om Firefox te downloaden op uw Nokia N900:",
        'it' => "Seleziona questo link per scaricare Firefox sul tuo Nokia N900:",
        'cs' => "Pomocí následujícího odkazu můžete stáhnout Firefox do své Nokie N900:",
        'pt-PT' => "Seleccione a ligação para transferir o Firefox para o seu Nokia N900:",
        'es-AR' => "Selecciona el enlace para descargar Firefox a tu Nokia N900:",
        'ru' => "Выберите ссылку, чтобы загрузить Firefox на свой Nokia N900:",
        'lt' => "Norėdami į savo „Nokia N900“ parsisiųsti „Firefox“, pažymėkite saitą:",
        'hu' => "Az alábbi hivatkozás segítségével töltheti le a Firefox böngészőt a Nokia N900 készülékre:",
        'es-ES' => "Selecciona el enlace para descargar Firefox en tu Nokia N900:",
        'he' => "בבקשה לחץ על הקישור הבא כדי להוריד את Firefox למכשיר ה־Nokia N900 שלך:",
        'da' => "Vælg linket for at hente Firefox til din Nokia N900:",
        'ar' => "اختر الوصلة لتنزيل فَيَرفُكس على جوّالك نوكيا N900:",
        'zh-TW' => "選擇下面的鏈結以下載 Firefox 至您的 Nokia N900:",
        'fr' => "Sélectionnez le lien pour télécharger Firefox pour votre Nokia N900:",
        'ga-IE' => "Roghnaigh an nasc chun Firefox a íosluchtú ar do Nokia N900:",
        'gl' => "Selecione a ligazón para baixar o Firefox no seu Nokia N900:",
        'sr' => "Одаберите следећу везу да би сте преузели фајерфокс за Nokia N900:",
        'zh-CN' => "点击下面的链接将 Firefox 下载到您的 Nokia N900:",
        'pl' => "Pobierz Firefoksa dla Twojej Nokii N900 wybierając poniższy odnośnik:",
        'ro' => "Selecteaza legatura pentru a descarca Firefox pentru Nokia N900:",
        'id' => "Pilih taut berikut untuk mengunduh Firefox ke Nokia N900 Anda:",
        'be' => "Вылучыце спасылку, каб сцягнуць Firefox на ваш Nokia N900:",
        'eu' => "Hautatu lotura Nokia N900entzat Firefox deskargatzeko:",
        'vi' => "Chon lien ket ben duoi de tai Firefox xuong dien thoai Nokia N900 cua ban:",
        'fa' => "برای بارگیری فایرفاکس بر روی تلفن خود، پیوند زیر را انتخاب نمایید:",
    );
    static $phonecodes = array(
        'ad' => array('Andorra',                           '+376'),
        'ae' => array('United Arab Emirates',              '+971'),
        'af' => array('Afghanistan',                       '+93'),
        'ag' => array('Antigua and Barbuda',               '+1'),
        'ai' => array('Anguilla',                          '+1'),
        'al' => array('Albania',                           '+355'),
        'am' => array('Armenia',                           '+374'),
        'an' => array('Netherlands Antilles',              '+599'),
        'ao' => array('Angola',                            '+244'),
        'ar' => array('Argentina',                         '+54'),
        'as' => array('American Samoa',                    '+1'),
        'at' => array('Austria',                           '+43'),
        'au' => array('Australia',                         '+61'),
        'aw' => array('Aruba',                             '+297'),
        'az' => array('Azerbaijan',                        '+994'),
        'ba' => array('Bosnia and Herzegovina',            '+387'),
        'bb' => array('Barbados',                          '+1'),
        'bd' => array('Bangladesh',                        '+880'),
        'be' => array('Belgium',                           '+32'),
        'bf' => array('Burkina Faso',                      '+226'),
        'bg' => array('Bulgaria',                          '+359'),
        'bh' => array('Bahrain',                           '+973'),
        'bi' => array('Burundi',                           '+257'),
        'bj' => array('Benin',                             '+229'),
        'bm' => array('Bermuda',                           '+1'),
        'bn' => array('Brunei Darussalam',                 '+673'),
        'bo' => array('Bolivia',                           '+591'),
        'br' => array('Brazil',                            '+55'),
        'bs' => array('Bahamas',                           '+1'),
        'bt' => array('Bhutan',                            '+975'),
        'bw' => array('Botswana',                          '+267'),
        'by' => array('Belarus',                           '+375'),
        'bz' => array('Belize',                            '+501'),
        'ca' => array('Canada',                            '+1'),
        'cd' => array('Democratic Republic of the Congo',  '+243'),
        'cf' => array('Central African Republic',          '+236'),
        'cg' => array('Congo',                             '+242'),
        'ch' => array('Switzerland',                       '+41'),
        'ci' => array('Ivory Coast',                       '+225'),
        'ck' => array('Cook Islands',                      '+682'),
        'cl' => array('Chile',                             '+56'),
        'cm' => array('Cameroon',                          '+237'),
        'cn' => array('China',                             '+86'),
        'co' => array('Colombia',                          '+57'),
        'cr' => array('Costa Rica',                        '+506'),
        'cu' => array('Cuba',                              '+53'),
        'cv' => array('Cape Verde',                        '+238'),
        'cy' => array('Cyprus',                            '+357'),
        'cz' => array('Czech Republic',                    '+420'),
        'de' => array('Germany',                           '+49'),
        'dj' => array('Djibouti',                          '+253'),
        'dk' => array('Denmark',                           '+45'),
        'dm' => array('Dominica',                          '+1'),
        'do' => array('Dominican Republic',                '+1'),
        'dz' => array('Algeria',                           '+213'),
        'ec' => array('Ecuador',                           '+593'),
        'ee' => array('Estonia',                           '+372'),
        'eg' => array('Egypt',                             '+20'),
        'er' => array('Eritrea',                           '+291'),
        'es' => array('Spain',                             '+34'),
        'et' => array('Ethiopia',                          '+251'),
        'fi' => array('Finland',                           '+358'),
        'fj' => array('Fiji',                              '+679'),
        'fk' => array('Falkland Islands',                  '+500'),
        'fm' => array('Micronesia',                        '+691'),
        'fo' => array('Faroe Islands',                     '+298'),
        'fr' => array('France',                            '+33'),
        'ga' => array('Gabon',                             '+241'),
        'gb' => array('United Kingdom',                    '+44'),
        'gd' => array('Grenada',                           '+1'),
        'ge' => array('Georgia',                           '+995'),
        'gf' => array('French Guiana',                     '+594'),
        'gh' => array('Ghana',                             '+233'),
        'gi' => array('Gibraltar',                         '+350'),
        'gl' => array('Greenland',                         '+299'),
        'gm' => array('Gambia',                            '+220'),
        'gn' => array('Guinea',                            '+224'),
        'gp' => array('Guadeloupe',                        '+590'),
        'gq' => array('Equatorial Guinea',                 '+240'),
        'gr' => array('Greece',                            '+30'),
        'gt' => array('Guatemala',                         '+502'),
        'gu' => array('Guam',                              '+1'),
        'gw' => array('Guinea-Bissau',                     '+245'),
        'gy' => array('Guyana',                            '+592'),
        'hk' => array('Hong Kong, China',                  '+852'),
        'hn' => array('Honduras',                          '+504'),
        'hr' => array('Croatia',                           '+385'),
        'ht' => array('Haiti',                             '+509'),
        'hu' => array('Hungary',                           '+36'),
        'id' => array('Indonesia',                         '+62'),
        'ie' => array('Ireland',                           '+353'),
        'il' => array('Israel',                            '+972'),
        'in' => array('India',                             '+91'),
        'iq' => array('Iraq',                              '+964'),
        'ir' => array('Iran',                              '+98'),
        'is' => array('Iceland',                           '+354'),
        'it' => array('Italy',                             '+39'),
        'jm' => array('Jamaica',                           '+1'),
        'jo' => array('Jordan',                            '+962'),
        'jp' => array('Japan',                             '+81'),
        'ke' => array('Kenya',                             '+254'),
        'kg' => array('Kyrgyzstan',                        '+996'),
        'kh' => array('Cambodia',                          '+855'),
        'ki' => array('Kiribati',                          '+686'),
        'km' => array('Comoros',                           '+269'),
        'kn' => array('Saint Kitts and Nevis',             '+1'),
        'kp' => array('North Korea',                       '+850'),
        'kr' => array('South Korea',                       '+82'),
        'kw' => array('Kuwait',                            '+965'),
        'ky' => array('Cayman Islands',                    '+1'),
        'kz' => array('Kazakhstan',                        '+7'),
        'la' => array('Laos',                              '+856'),
        'lb' => array('Lebanon',                           '+961'),
        'lc' => array('Saint Lucia',                       '+1'),
        'li' => array('Liechtenstein',                     '+423'),
        'lk' => array('Sri Lanka',                         '+94'),
        'lr' => array('Liberia',                           '+231'),
        'ls' => array('Lesotho',                           '+266'),
        'lt' => array('Lithuania',                         '+370'),
        'lu' => array('Luxembourg',                        '+352'),
        'lv' => array('Latvia',                            '+371'),
        'ly' => array('Libya',                             '+218'),
        'ma' => array('Morocco',                           '+212'),
        'mc' => array('Monaco',                            '+377'),
        'md' => array('Moldova',                           '+373'),
        'me' => array('Montenegro',                        '+382'),
        'mg' => array('Madagascar',                        '+261'),
        'mh' => array('Marshall Islands',                  '+692'),
        'mk' => array('Republic of Macedonia',             '+389'),
        'ml' => array('Mali',                              '+223'),
        'mm' => array('Myanmar',                           '+95'),
        'mn' => array('Mongolia',                          '+976'),
        'mo' => array('Macao, China',                      '+853'),
        'mp' => array('Northern Mariana Islands',          '+1'),
        'mq' => array('Martinique',                        '+596'),
        'mr' => array('Mauritania',                        '+222'),
        'ms' => array('Montserrat',                        '+1'),
        'mt' => array('Malta',                             '+356'),
        'mu' => array('Mauritius',                         '+230'),
        'mv' => array('Maldives',                          '+960'),
        'mw' => array('Malawi',                            '+265'),
        'mx' => array('Mexico',                            '+52'),
        'my' => array('Malaysia',                          '+60'),
        'mz' => array('Mozambique',                        '+258'),
        'na' => array('Namibia',                           '+264'),
        'nc' => array('New Caledonia',                     '+687'),
        'ne' => array('Niger',                             '+227'),
        'ng' => array('Nigeria',                           '+234'),
        'ni' => array('Nicaragua',                         '+505'),
        'nl' => array('Netherlands',                       '+31'),
        'no' => array('Norway',                            '+47'),
        'np' => array('Nepal',                             '+977'),
        'nr' => array('Nauru',                             '+674'),
        'nu' => array('Niue',                              '+683'),
        'nz' => array('New Zealand',                       '+64'),
        'om' => array('Oman',                              '+968'),
        'pa' => array('Panama',                            '+507'),
        'pe' => array('Peru',                              '+51'),
        'pf' => array('French Polynesia',                  '+689'),
        'pg' => array('Papua New Guinea',                  '+675'),
        'ph' => array('Philippines',                       '+63'),
        'pk' => array('Pakistan',                          '+92'),
        'pl' => array('Poland',                            '+48'),
        'pm' => array('Saint Pierre and Miquelon',         '+508'),
        'pr' => array('Puerto Rico',                       '+1'),
        'pt' => array('Portugal',                          '+351'),
        'pw' => array('Palau',                             '+680'),
        'py' => array('Paraguay',                          '+595'),
        'qa' => array('Qatar',                             '+974'),
        'ro' => array('Romania',                           '+40'),
        'rs' => array('Serbia',                            '+381'),
        'ru' => array('Russian Federation',                '+7'),
        'rw' => array('Rwanda',                            '+250'),
        'sa' => array('Saudi Arabia',                      '+966'),
        'sb' => array('Solomon Islands',                   '+677'),
        'sc' => array('Seychelles',                        '+248'),
        'sd' => array('Sudan',                             '+249'),
        'se' => array('Sweden',                            '+46'),
        'sg' => array('Singapore',                         '+65'),
        'sh' => array('Saint Helena',                      '+290'),
        'si' => array('Slovenia',                          '+386'),
        'sk' => array('Slovakia',                          '+421'),
        'sl' => array('Sierra Leone',                      '+232'),
        'sm' => array('San Marino',                        '+378'),
        'sn' => array('Senegal',                           '+221'),
        'so' => array('Somalia',                           '+252'),
        'sr' => array('Suriname',                          '+597'),
        'st' => array('Sao Tome and Principe',             '+239'),
        'sv' => array('El Salvador',                       '+503'),
        'sy' => array('Syria',                             '+963'),
        'sz' => array('Swaziland',                         '+268'),
        'tc' => array('Turks and Caicos Islands',          '+1'),
        'td' => array('Chad',                              '+235'),
        'tg' => array('Togo',                              '+228'),
        'th' => array('Thailand',                          '+66'),
        'tj' => array('Tajikistan',                        '+992'),
        'tk' => array('Tokelau',                           '+690'),
        'tl' => array('Democratic Republic of Timor-Leste','+670'),
        'tm' => array('Turkmenistan',                      '+993'),
        'tn' => array('Tunisia',                           '+216'),
        'to' => array('Tonga',                             '+676'),
        'tr' => array('Turkey',                            '+90'),
        'tt' => array('Trinidad and Tobago',               '+1'),
        'tv' => array('Tuvalu',                            '+688'),
        'tw' => array('Taiwan',                            '+886'),
        'tz' => array('Tanzania',                          '+255'),
        'ua' => array('Ukraine',                           '+380'),
        'ug' => array('Uganda',                            '+256'),
        'us' => array('United States of America',          '+1'),
        'uy' => array('Uruguay',                           '+598'),
        'uz' => array('Uzbekistan',                        '+998'),
        'va' => array('Vatican City State',                '+379'),
        'vc' => array('Saint Vincent and the Grenadines',  '+1'),
        've' => array('Venezuela',                         '+58'),
        'vg' => array('British Virgin Islands',            '+1'),
        'vi' => array('United States Virgin Islands',      '+1'),
        'vn' => array('Vietnam',                           '+84'),
        'vu' => array('Vanuatu',                           '+678'),
        'wf' => array('Wallis and Futuna',                 '+681'),
        'ws' => array('Samoa',                             '+685'),
        'ye' => array('Yemen',                             '+967'),
        'yt' => array('Mayotte',                           '+269'),
        'za' => array('South Africa',                      '+27'),
        'zm' => array('Zambia',                            '+260'),
        'zw' => array('Zimbabwe',                          '+263'),
    );
}

