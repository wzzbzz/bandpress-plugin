<?php

namespace bandpress\Actions;
use \vinepress\Models\User;
use \vinepress\Models\Users;
use \bandpress\Models\Session;

class AddParticipantAction
{
    
    public function __construct()
    {

    }
    public function __destruct()
    {
    }
    public function do()
    {
        
   
        // create Session object from requeset;
        $post = get_post($_REQUEST['id']);
        $session = new Session($post);
        
        $users = new Users();
        // check to see if user exists  -- TBD make this into a one liner
        $user = $users->getUserByUserLogin($_REQUEST['participant']);

        // create user if not in system
        if (false===$user) {
            
            $user = \vinepress\Controllers\UsersController::makeNonUserUser($_REQUEST['participant']);
            if($user===false){
                $_SESSION['notifications']['errors'][]="Failed to add particpant";
                die;
            }
        }

        // recast user as musician;
        $musician = new \bandpress\Models\Musician(get_user_by("ID",$user->id()));
        
        $session->addParticipant($musician);
        $musician->addSession($session);
        $_SESSION['notifications']['successes'][]="participant added";
        wp_redirect($session->url());
        die;
    }

}