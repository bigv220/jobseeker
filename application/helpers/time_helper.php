<?php
function time_elapsed_string($ptime)
{
    $etime = time() - $ptime;

    // if ($etime < 1)
    // {
    //     return '1 seconds';
    // }
    if (($etime / (24 * 60 * 60) < 1))
    {
        return date('g:i:s a',$ptime);
    }
    

    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
        }
    }
}


?>