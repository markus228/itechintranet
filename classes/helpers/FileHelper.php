<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 25.08.15
 * Time: 16:25
 */

namespace helpers;


class FileHelper
{

    static public function prettyFileSize($size) {
        // Adapted from: http://www.php.net/manual/en/function.filesize.php

        $mod = 1024;

        $units = explode(' ','B KB MB GB TB PB');
        for ($i = 0; $size > $mod; $i++) {
            $size /= $mod;
        }

        return round($size, 2) . ' ' . $units[$i];
    }

    static public function deliverFile($file) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.  urlencode(basename($file)));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        //Avoid Blocking...
        session_write_close();
        readfile($file);
        exit;
    }

    static public function outputFile($file) {
        readfile($file);
    }

    static public function encodePath($path) {
        return base64_encode($path);
    }

    static public function decodePath($encodedPath) {
        return base64_decode($encodedPath);
    }
    static public function prettyTimeDelta($date) {

        $now = time();
        $d = $now-$date;
        if( $d < 60 ) {
            $d = round($d);
            return 'vor '.($d==1?'einer Sekunde':$d.' Sekunden');
        }
        $d = $d/60;
        if( $d < 12.5 ) {
            $d = round($d);
            return 'vor '.($d==1?'einer Minute':$d.' Minuten');
        }
        switch( round($d/15) ) {
            case 1:
                return 'vor einer viertel Stunde';
            case 2:
                return 'vor einer halben Stunde';
            case 3:
                return 'vor einer dreiviertel Stunde';
        }
        $d = $d/60;
        if( $d < 6 ) {
            $d = round($d);
            return 'vor '.($d==1?'einer Stunde':$d.' Stunden');
        }
        if( $d < 36 ) {
            // ein Tag beginnt um 5 Uhr morgens
            $day_start = 5;
            if( date('j',($now-$day_start*3600)) == date('j',($date-$day_start*3600)) )
                $r = 'heute';
            elseif( date('j',($now-($day_start+24)*3600)) == date('j',($date-$day_start*3600)) )
                $r = 'gestern';
            else
                $r = 'vorgestern';
            $hour_date = intval(date('G',$date)) + (intval(date('i',$date))/60);
            $hour_now = intval(date('G',$now)) + (intval(date('i',$now))/60);
            if( $hour_date>=22.5 || $hour_date<$day_start ) {
                $r = $r=='gestern' ? 'letzte Nacht' : $r.' Nacht';
            }
            elseif( $hour_date>=$day_start && $hour_date<9 )
                $r .= ' Morgen';
            elseif( $hour_date>=9 && $hour_date<11.5 )
                $r .= ' Vormittag';
            elseif( $hour_date>=11.5 && $hour_date<13.5 )
                $r .= ' Mittag';
            elseif( $hour_date>=13.5 && $hour_date<18 )
                $r .= ' Nachmittag';
            elseif( $hour_date>=18 && $hour_date<22.5 )
                $r .= ' Abend';
            return $r;
        }
        $d = $d/24;
        if( $d < 7 ) {
            $d = round($d);
            return 'vor '.($d==1?'einem Tag':$d.' Tagen');
        }
        $d_weeks = $d/7;
        if( $d_weeks<4 ) {
            $d = round($d_weeks);
            return 'vor '.($d==1?'einer Woche':$d.' Wochen');
        }
        $d = $d/30;
        if( $d<12 ) {
            $d = round($d);
            return 'vor '.($d==1?'einem Monat':$d.' Monaten');
        }
        if( $d<18 )
            return 'vor einem Jahr';
        if( $d<21 )
            return 'vor eineinhalb Jahren';
        $d = round($d/12);
        return 'vor '.$d.' Jahren';
    }


}