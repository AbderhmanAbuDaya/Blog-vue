<?php
function uploadImage($folder,$image){
    $image->store('/',$folder);
    return $fileName=$image->hashName();

}
