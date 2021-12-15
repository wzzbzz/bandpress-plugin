<?php

namespace bandpress\Actions;

class BandAddMemberAction
{
    private $bandSlug;
    private $songTitle;
    public function __construct()
    {
        $this->bandSlug = $_REQUEST['band_slug'];
        $this->userLogin = $_REQUEST['userLogin'];
    }
    public function __destruct()
    {
    }

    public function do()
    {
        
        $term = get_term_by("slug", $this->bandSlug, "band");
        if(empty($term)) {
            $_SESSION['notifications']['errors'][]="band doesn't exist";
            wp_redirect("/bandpress");
            die;
        }
        $band = new \bandpress\Models\Band($term);

        $users = new \vinepress\Models\Users();
    
        // user doesn't exist
        if (empty($user = $users->getUserByUserLogin($this->userLogin))) {
            
            // create user
            $user = \vinepress\Controllers\UsersController::makeNonUserUser($this->userLogin);
            
        }
        
        $band->addMember($user);
        $musician = \bandpress\Controllers\MusiciansController::musicianFromUserObject($user);
        $musician->addBand($band);
        wp_redirect($band->url());
        die;
    }

}