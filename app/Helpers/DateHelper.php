<?php
use Carbon\Carbon;

function format_date($date, $format = 'Y年m月d日')
{
    return Carbon::parse($date)->format($format);
}
