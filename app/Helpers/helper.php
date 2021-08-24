<?php

function whatBox($field = '', $type = ''){
    if($field && $type){
        if($field == $type){
            return asset('img/box-check.png');
        }
    }
    return asset('img/box.png');
}