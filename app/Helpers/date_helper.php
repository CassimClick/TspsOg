<?php
function dateFormatter($actualDate)
{
    $date = strtotime($actualDate);
    return date("d M Y", $date);
}