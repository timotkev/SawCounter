<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('access_roles'))
{
    function access_roles()
    {
        $CI =& get_instance();

        $CI->load->library('session');
        $CI->load->model('m_roles_permissions');

        $id_roles   = $CI->session->userdata('mapro_login')['id_roles'];
        $hasil      = $CI->m_roles_permissions->get_permissions_by_id_roles($id_roles);
        return $hasil;
    }
}

if (!function_exists('sys_name'))
{
    function sys_name()
    {
        $CI =& get_instance();

        $CI->load->model('m_settings');
        $hasil = $CI->m_settings->get_settings_by_name('sys_name');
        return $hasil;
    }
}

if (!function_exists('sys_pagination'))
{
    function sys_pagination()
    {
        $CI =& get_instance();

        $CI->load->model('m_settings');
        $hasil = $CI->m_settings->get_settings_by_name('sys_pagination');
        return $hasil;
    }
}

if (!function_exists('sys_date'))
{
    function sys_date()
    {
        $CI =& get_instance();

        $CI->load->model('m_settings');
        $hasil = $CI->m_settings->get_settings_by_name('sys_date');
        return $hasil;
    }
}

if (!function_exists('sys_date_format'))
{
    function sys_date_format($param)
    {
        $CI =& get_instance();

        $sys_date = sys_date();
        
        switch ($sys_date) { # FROM MySQL 

            case 'dd/mm/YYYY':  # 20/01/2016
                $hasil = dateSlash($param);
                break;
            
            case 'YYYY/mm/dd': # 2016/01/20
                $param = str_replace('-', '/', $param);
                $hasil = dateSlash($param);
                break;

            case 'dd-mm-YYYY': # 20-01-2016
                $hasil = dateStrip($param);
                break;

            case 'YYYY-mm-dd': #2016-01-20
                $hasil = $param;
                break;

            case 'l, d m YYYY': # Friday, 20 January 2016
                $hasil = stringDayMonthEng($param);
                break;

            case 'd m YYYY': # 20 January 2016
                $hasil = stringMonthEng($param);
                break;

            default:
                $hasil = $param;
                break;
        }

        return $hasil;
    }
}


if ( ! function_exists('dateSql'))
    {
        function dateSql($param)
        { 
            /* Convert to 2014-03-25 */
            $year = substr($param,6,4);
            $month = substr($param,3,2);
            $date = substr($param,0,2);

            return $year.'-'.$month.'-'.$date;
        }
    }

if ( ! function_exists('dateSlash'))
{
    function dateSlash($param)
    { 
        /* Convert to 25/03/2014 */
        $date = substr($param,8,2);
        $month = substr($param,5,2);
        $year = substr($param,0,4);

        return $date.'/'.$month.'/'.$year;
    }
}

if ( ! function_exists('dateStrip'))
{
    function dateStrip($param)
    { 
        /* Convert to 25-03-2014 */
        $date = substr($param,8,2);
        $month = substr($param,5,2);
        $year = substr($param,0,4);

        return $date.'-'.$month.'-'.$year;
    }
}

if ( ! function_exists('stringMonthEng'))
{
    function stringMonthEng($param)
    { 
        /* example : March 09 2014*/
        $date = substr($param,8,2);
        $month = getMonthEnglish(substr($param,5,2));
        $year = substr($param,0,4);

        return $month.' '.$date.', '.$year;
    }
}

if ( ! function_exists('stringMonthInd'))
{
    function stringMonthInd($param)
    { 
        /* example : 09 Maret 2014*/
        $date = substr($param,8,2);
        $month = getMonthIndonesia(substr($param,5,2));
        $year = substr($param,0,4);

        return $date.' '.$month.' '.$year;
    }
}

if ( ! function_exists('stringDayMonthEng'))
{
    function stringDayMonthEng($param)
    { 
        /* example : Monday, March 09 2014*/
        $param = substr($param,0,10);
        $day = getDayEnglish($param);
        $date = substr($param,8,2);
        $month = getMonthEnglish(substr($param,5,2));
        $year = substr($param,0,4);

        return $day.', '.$month.' '.$date.' '.$year;
    }
}

if ( ! function_exists('stringDayMonthInd'))
{
    function stringDayMonthInd($param)
    { 
        /* example : Senin, 09 Maret 2014*/
        $param = substr($param,0,10);
        $hari = getDayIndonesia($param);
        $tgl = substr($param,8,2);
        $bln = getMonthIndonesia(substr($param,5,2));
        $thn = substr($param,0,4);

        return $hari.', '.$tgl.' '.$bln.' '.$thn;
    }
}

if ( ! function_exists('fullTimeDateEN'))
{
    function fullTimeDateEN($param) # Input DateTime
    { 
        /* example : Senin 25 Jan 2015, 08:30:59 */
        $time = substr($param, -8, 8);

        $param = substr($param,0,10);
        $hari = getDayEnglish($param);
        $tgl = substr($param,8,2);
        $bln = ucfirst(singkatan_bulan(substr($param,5,2)));
        $thn = substr($param,0,4);
        
        return $hari.', '.$tgl.' '.$bln.' '.$thn.' '.$time;
    }
}

if ( ! function_exists('fullTimeDateIND'))
{
    function fullTimeDateIND($param) # Input DateTime
    { 
        /* example : Senin 25 Jan 2015, 08:30:59 */
        $time = substr($param, -8, 8);

        $param = substr($param,0,10);
        $hari = getDayIndonesia($param);
        $tgl = substr($param,8,2);
        $bln = ucfirst(singkatan_bulan(substr($param,5,2)));
        $thn = substr($param,0,4);
        
        return $hari.', '.$tgl.' '.$bln.' '.$thn.' '.$time;
    }
}

if ( ! function_exists('fullTimeDigit'))
{
    function fullTimeDigit($param) # Input DateTime
    { 
        /* example : Sen 25/01/2015, 08:30:59 */
        $time = substr($param, -8, 8);

        $param = substr($param,0,10);
        $hari = getDayDigitInd($param);
        $tgl = substr($param,8,2);
        $bln = substr($param,5,2);
        $thn = substr($param,0,4);
        
        return $hari.', '.$tgl.'/'.$bln.'/'.$thn.' '.$time;
    }
}

if ( ! function_exists('getDayEnglish'))
{
    function getDayEnglish($param)
    { 
        /* Monday sampai Sunday */
        $day_array = array(
            "1" => "Monday",
            "2" => "Tuesday",
            "3" => "Wednesday",
            "4" => "Thursday",
            "5" => "Friday",
            "6" => "Saturday",
            "7" => "Sunday"
        );

        $date_array=explode('-', $param);
        $day_n=date("N",mktime(0, 0, 0, $date_array[1], $date_array[2], $date_array[0]));
        return $day_array[$day_n];
    }
}

if ( ! function_exists('getDayIndonesia'))
{
    function getDayIndonesia($param)
    { 
        /* Senin sampai Minggu */
        $hari_array = array(
            "1" => "Senin",
            "2" => "Selasa",
            "3" => "Rabu",
            "4" => "Kamis",
            "5" => "Jumat",
            "6" => "Sabtu",
            "7" => "Minggu"
        );

        $tgl_array=explode('-', $param);
        $hari_n=date("N",mktime(0, 0, 0, $tgl_array[1], $tgl_array[2], $tgl_array[0]));
        return $hari_array[$hari_n];
    }
}

if ( ! function_exists('getDayDigitInd'))
{
    function getDayDigitInd($param)
    { 
        /* Senin sampai Minggu */
        $hari_array = array(
            "1" => "Sen",
            "2" => "Sel",
            "3" => "Rab",
            "4" => "Kam",
            "5" => "Jum",
            "6" => "Sab",
            "7" => "Min"
        );

        $tgl_array=explode('-', $param);
        $hari_n=date("N",mktime(0, 0, 0, $tgl_array[1], $tgl_array[2], $tgl_array[0]));
        return $hari_array[$hari_n];
    }
}

if ( ! function_exists('getMonthEnglish'))
{
    function getMonthEnglish($param)
    { 
        /* January sampai December */
        switch ($param){
            case 1: 
                return "January";
            break;

            case 2:
                return "Febuary";
            break;

            case 3:
                return "March";
            break;

            case 4:
                return "April";
            break;

            case 5:
                return "May";
            break;

            case 6:
                return "June";
            break;

            case 7:
                return "July";
            break;

            case 8:
                return "Augusts";
            break;

            case 9:
                return "September";
            break;

            case 10:
                return "October";
            break;

            case 11:
                return "November";
            break;

            case 12:
                return "December";
            break;
        }
    }
}


if ( ! function_exists('getMonthIndonesia'))
{
    function getMonthIndonesia($param)
    { 
        /* Januari sampai Desember */
        switch ($param){
            case 1: 
                return "Januari";
            break;

            case 2:
                return "Febuari";
            break;

            case 3:
                return "Maret";
            break;

            case 4:
                return "April";
            break;

            case 5:
                return "Mei";
            break;

            case 6:
                return "Juni";
            break;

            case 7:
                return "Juli";
            break;

            case 8:
                return "Agustus";
            break;

            case 9:
                return "September";
            break;

            case 10:
                return "Oktober";
            break;

            case 11:
                return "Nopember";
            break;

            case 12:
                return "Desember";
            break;
        }
    }
}

if ( ! function_exists('singkatan_bulan'))
{
    function singkatan_bulan($param)
    { 
        /* Januari sampai Desember */
        switch ($param){
            case '01': 
                return "jan";
            break;

            case '02':
                return "feb";
            break;

            case '03':
                return "mar";
            break;

            case '04':
                return "apr";
            break;

            case '05':
                return "mei";
            break;

            case '06':
                return "jun";
            break;

            case '07':
                return "jul";
            break;

            case '08':
                return "agt";
            break;

            case '09':
                return "sep";
            break;

            case '10':
                return "okt";
            break;

            case '11':
                return "nov";
            break;

            case '12':
                return "des";
            break;
        }
    }
}