<?php
// https://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
// but in German format

public static function timeAgo($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'Jahr',
        'm' => 'Monat',
        'w' => 'Woche',
        'd' => 'Tag',
        'h' => 'Stunde',
        'i' => 'Minute',
        's' => 'Sekunde'
    );
    foreach ($string as $k => &$v) {
        if($diff->$k) {
            $ending = substr($v, -1) == 'e' ? 'n' : 'en';

            $time = $diff->$k;
            if($diff->$k == 1) {
                $time = 'eine';
                $time = preg_match("/y|m|d/", $k) ? $time . 'm' : $time . 'r';
            }

            $v = $time . ' ' . $v . ($diff->$k > 1 ? $ending : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? 'vor ' . implode(', ', $string) : 'Gerade eben';
}
