<?php

namespace bandpress\Actions;
use \bandpress\Controllers\BandsController;
use \bandpress\Models\Musician;


class UserAddBandAction{

    private $bandName;
    private $isCurrentUsersBand;

    public function __construct(){

        $this->bandName = $_REQUEST['bandName'];
        $this->isCurrentUsersBand = $_REQUEST['isMyBand'];

    }

    public function __destruct(){}

    public function do(){
        
        if(!is_user_logged_in()){
            wp_redirect("/");
        }
        if(!$this->bandExists()){

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
            # print error message that band exists
            $_SESSION['notifications']['errors'][] = "band exists";
            wp_redirect("/bandpress/band/{$slug()}");
        }

        die;
    }

    private function bandExists(){
        
        $term = get_term_by('name',addslashes($this->bandName),'band');

        # here for testing purposes
        if($term){
            wp_delete_term($term->term_id,'band');
        }
        return false;
        return $term!==false;
       
    }
}