<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

function add_working_days_to_date($date, $count) {
    $date = Carbon::parse($date);
    for($i = 0; $i<$count;) {
        $date->addDay();
        if ($date->isSaturday() || $date->isSunday()) {

        } else {
            $i++;
        }
    }

    return $date;
}

function getBootstrapStyleByStatus($expression) {
    $value = "";
    $expression = Str::lower($expression);
    switch ($expression) {
        case 'действующий' :
            $value = "list-group-item-success";
            break;
        case 'недействующий' :
            $value = "list-group-item-danger";
            break;
        case 'испорченный' :
            $value = "list-group-item-danger";
            break;
        case 'утраченный' :
            $value = "list-group-item-danger";
            break;
        case 'переоформленный' :
            $value = "list-group-item-danger";
            break;
        case 'выплачено' :
            $value = "list-group-item-success";
            break;
        case 'частично выплачено' :
            $value = "list-group-item-warning";
            break;
        case 'просрочено' :
            $value = "list-group-item-warning";
            break;
        case 'вовремя' :
            $value = "list-group-item-success";
            break;
        case 'неправильная' :
            $value = "list-group-item-danger";
            break;
    }
    return $value;
}

function custom_number_format($value) {
    $value = round($value);
    return number_format($value,0,"."," ");
}

function normalize_float_format($value) {
    $normalized_value = str_replace(' ','',$value);
    $normalized_value = str_replace('&nbsp;','',$normalized_value);
    $normalized_value = str_replace(',','.',$normalized_value);
    return $normalized_value;
}

function is_filled($value) {
    if (is_null($value)) {
        return false;
    } elseif (is_string($value) && trim($value) === '') {
        return false;
    }
    return true;
}

function is_like($value1, $value2) {
    if (Str::lower($value1) == Str::lower($value2)) {
        return true;
    }
    return false;
}
