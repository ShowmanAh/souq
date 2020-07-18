<?php

use Illuminate\Support\Facades\Config;
// get all active language
function getActiveLanguage(){
    return \App\Models\Language::active()->Selection()->get();
}
function get_default_lang(){
    return config::get('app.locale');
}
function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}
?>
