<?php

use Carbon\Carbon;
use App\Models\Upload;
use App\Models\Setting;
use App\Models\Currency;
use App\Models\Language;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Examination\MarksGrade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Examination\ExaminationSettings;

function getPagination($ITEM)
{
    return view('common.pagination', compact('ITEM'));
}


function setting($name)
{
    if ($name == 'currency_symbol') {
        $currencyCode = Setting::where('name', 'currency_code')->first()?->value;
        return Currency::where('code', $currencyCode)->first()?->symbol;
    }

    $setting_data = Setting::where('name', $name)->first();
    if ($setting_data) {
        return $setting_data->value;
    }

    return null;
}

function examSetting($name)
{
    $setting_data = ExaminationSettings::where('name', $name)->where('session_id', setting('session'))->first();
    if ($setting_data) {
        return $setting_data->value;
    }

    return null;
}



function findDirectionOfLang()
{
    $data = Language::where('code', Session::get('locale'))->select('direction')->first();
    return @$data->direction != null ? strtolower(@$data->direction) : '';
}

// for menu active
if (!function_exists('set_menu')) {
    function set_menu(array $path, $active = 'show')
    {
        foreach ($path as $route) {
            if (Route::currentRouteName() == $route) {
                return $active;
            }
        }
        return (request()->is($path)) ? $active : '';
        // return call_user_func_array('Request::is', (array) $path) ? $active : '';
    }
}

// for  submenu list item active
if (!function_exists('menu_active_by_route')) {
    function menu_active_by_route($route)
    {
        return request()->routeIs($route) ? 'mm-show' : 'in-active';
    }
}


// get upload path
if (!function_exists('uploadPath')) {
    function uploadPath($id)
    {
        $row = Upload::find($id);
        return $row->path;
    }
}


function ___($key = null, $replace = [], $locale = null)
{
    $input       = explode('.', $key);
    $file        = $input[0];
    $term        = $input[1];
    $app_local   = Session::get('locale');

    try {

        if ($app_local == "") {
            $app_local = 'en';
        }

        $jsonString  = file_get_contents(base_path('lang/' . $app_local . '/' . $file . '.json'));

        $data        = json_decode($jsonString, true);

        if (@$data[$term]) {
            return $data[$term];
        } else {
            $str          =  $term;
            $firstChar    = strtoupper($str[0]);
            $removechar   = substr($str, 1);
            $newStr       = $firstChar . $removechar;
            $resultStr    = str_replace('_', ' ', $newStr);

            $newItem      = [$str => $resultStr];
            $newData      = json_encode(array_merge($data, $newItem), JSON_PRETTY_PRINT);
            file_put_contents(base_path('lang/' . $app_local . '/' . $file . '.json'), stripslashes($newData));

            return $resultStr;
        }

        return $term;
    } catch (\Exception $e) {
        return $term;
    }
}

// global thumbnails
if (!function_exists('globalAsset')) {
    function globalAsset($path, $default_image = null)
    {
        if (file_exists(@$path)) {
            return url($path);
        } else {
            return url("backend/uploads/default-images/$default_image");
        }
    }
}


// Permission check
if (!function_exists('hasPermission')) {
    function hasPermission($keyword)
    {
        if (in_array($keyword, Auth::user()->permissions ?? [])) {
            return true;
        }
        return false;
    }
}

// Date format
if (!function_exists('dateFormat')) {
    function dateFormat($keyword)
    {
        return date('d M Y', strtotime($keyword));
    }
}
if (!function_exists('timeFormat')) {
    function timeFormat($keyword)
    {
        return date('g:i A', strtotime($keyword));
    }
}
// Mark grade
if (!function_exists('markGrade')) {
    function markGrade($data)
    {
        $result = MarksGrade::where('session_id', setting('session'))->where('percent_upto', '>=', $data)->where('percent_from', '<=', $data)->first();
        if ($result) {
            return $result->name;
        }
        return '...';
    }
}

if (!function_exists('userTheme')) {
    function userTheme()
    {
        $session_theme = Session::get('user_theme');

        if (isset($session_theme)) {
            return $session_theme;
        } else {
            return 'default-theme';
        }
    }
}

if (!function_exists('leadingZero')) {
    function withLeadingZero($number)
    {

        // $strNumber = $number;
        // if(strlen($strNumber) < 10){
        //     return $strNumber;
        // }

        return $number;
    }
}


if (!function_exists('setEnvironmentValue')) {
    function setEnvironmentValue($envKey, $envValue)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $str .= "\n"; // In case the searched variable is in the last line without \n
        $keyPosition = strpos($str, "{$envKey}=");
        $endOfLinePosition = strpos($str, PHP_EOL, $keyPosition);
        $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
        $str = substr($str, 0, -1);

        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
    }
}

if (!function_exists('s3Upload')) {
    function s3Upload($directory, $file)
    {
        $directory = 'public/' . $directory;
        return Storage::disk('s3')->put($directory, $file, 'public');
    }
}

if (!function_exists('s3ObjectCheck')) {
    function s3ObjectCheck($path)
    {
        return Storage::disk('s3')->exists($path);
    }
}


if (!function_exists('include_route_files')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function include_route_files($folder)
    {
        try {
            $rdi = new RecursiveDirectoryIterator($folder);
            $it = new RecursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function getAllDaysInMonth($year, $month)
    {
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;
        $days = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($year, $month, $day);
            $days[] = $date->format('Y-m-d');
        }

        return $days;
    }
}
// for frontend active menu start
if (!function_exists('active_menu')) {
    function active_menu(array $path, $active = 'active')
    {
        foreach ($path as $route) {
            if (Route::currentRouteName() == $route) {
                return $active;
            }
        }
        return (request()->is($path)) ? $active : '';
    }
}
// for frontend active menu end
