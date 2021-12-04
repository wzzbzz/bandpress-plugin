<?php

namespace bandpress\Controllers;

class MusicianController{
    public function __construct(){}
    public function __destruct(){}

    public function getMusicianById($id){
        if(!is_numeric($id)){
            return false;
        }
        $user= get_user_by("ID",$id);
    }

}