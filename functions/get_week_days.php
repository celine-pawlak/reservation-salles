<?php

/**
 * @return mixed
 */
function getWeekDays()
{
    setlocale(LC_TIME, 'fr_FR.UTF8');
    $nowDay = time();
//    $weekDayStr = getdate($nowDay)['weekday'];
//    $weekDays[] = strftime('%A', $nowDay);
    $weekDays[] = null;

//    $nowDayJ1 = $nowDay + (60 * 60) * 24;
//    $nowDayJ7 = $nowDay + (60 * 60 * 24) * 7;

    for ($i = 0; $i < 7; ++$i) {
        $nowDay = $nowDay + (60 * 60 * 24);
        $weekDays[] = strftime('%A', $nowDay);
//        $weekDays[] = getdate($nowDay)['weekday'];
    }
    return $weekDays;
}