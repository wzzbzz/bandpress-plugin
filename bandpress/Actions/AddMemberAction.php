<?php

namespace bandpress\Actions;

class AddMemberAction
{

    public function __construct()
    {
        
    }
    public function __destruct()
    {
    }

    public function do()
    {
        $collectionClass = "\\bandpress\\Models\\".$_REQUEST['context']."s";
        $obj = $collectionClass::byId($_REQUEST['id']);
        
        $users = new \vinepress\Models\Users();
        
        // user doesn't exist
        if (empty($user = $users->getUserByUserLogin($_REQUEST['member']))) {
            
            // create user
            $user = \vinepress\Controllers\UsersController::makeNonUserUser($_REQUEST['member']);
            
        }

        $obj->addMember($user);
        $musician = \bandpress\Controllers\MusiciansController::musicianFromUserObject($user);
        $method = "add".$_REQUEST['context'];
        $musician->$method($obj);
        wp_redirect($obj->url());
        die;
    }

}