<?php

namespace bandpress\Models;
use \vinepress\Models\User;
use \bandpress\Views\ComponentViews\BandListView;
use \bandpress\Models\Band;

class Musician extends User{

    public function __construct( $data ){
        parent::__construct($data);
    }

    public function bands(){
    
        $band_ids = $this->get_meta('bands');
        $bands=[];
        foreach($band_ids as $band_id){
            $bands[]= new Band(get_term($band_id));
        }
        return $bands;
    }

    // factory method for band list component view
    public function bandListView(){
        return new BandListView( $this->bands());
    }

    public function addBand($band){
        $this->update_meta("bands", $band->id());
    }

}