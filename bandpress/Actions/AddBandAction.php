<?php

namespace bandpress\Actions;
use \bandpress\Controllers\BandsController;
use \bandpress\Models\Musician;
use \bandpress\Models\Band;


class AddBandAction
{

    private $bandName;
    private $isCurrentUsersBand;

    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    public function do()
    {
      
        
        if(!is_user_logged_in()) {
            wp_redirect("/");
        }

        diebug($_REQUEST);
        if(!$this->bandExists()) {

            //create the band
            $band = BandsController::addBand($this->bandName);

            //add the band to the member
            $band->addMember(app()->currentUser());

            // add the member to the band;
            $musician = new Musician(wp_get_current_user());
            $musician->addBand($band);
            wp_redirect("/bandpress/");

        }
        else{
            // print error message that band exists
            $term = get_term_by('name', addslashes($this->bandName), 'band');
            $band = new Band($term);
            $musician = new Musician(wp_get_current_user());
            $musician->addBand($band);
            $band->addMember(app()->currentUser());
            $_SESSION['notifications']['errors'][] = "This band already exists in our system. <br> You must be added by an existing member.";
            wp_redirect("/bandpress/");
        }

        die;
    }

    private function bandExists()
    {
        
        $term = get_term_by('name', addslashes($this->bandName), 'band');

        return $term!==false;
       
    }
}