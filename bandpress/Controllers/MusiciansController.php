<?php

namespace bandpress\Controllers;
use \bandpress\Models\Musician;

class MusiciansController
{
    public function __construct()
    {
    }
    public function __destruct()
    {
    }

    public function getMusicianById($id)
    {
        if(!is_numeric($id)) {
            return false;
        }
        $user= get_user_by("ID", $id);
    }

    // clearly this is not a good factorization of this
    public function musicianFromUserObject( $user )
    {
        return new Musician(get_user_by("ID", $user->id()));
    }

}