<?php

namespace bandpress\Models;
use \vinepress\Models\User;
use \bandpress\Views\ComponentViews\BandListView;
use \bandpress\Models\Band;
use \bandpress\Models\Session;

class Musician extends User
{

    public function __construct( $data )
    {
        parent::__construct($data);
    }

    public function bands()
    {
    
        $band_ids = $this->get_meta('bands');
        $bands=[];
        foreach($band_ids as $band_id){
            $bands[]= new Band(get_term($band_id));
        }
        return $bands;
    }

    // factory method for band list component view
    public function bandListView()
    {
        return new BandListView($this->bands());
    }

    public function addBand($band)
    {
        $this->add_meta("bands", $band->id());
    }

    public function session_ids(){
        return $this->get_meta('sessions');
    }
    public function sessions()
    {
        $sessions = [];
        
        foreach($this->session_ids() as $session_id){
            $post = get_post($session_id);
            $session = new \bandpress\Models\Session($post);
            $sessions[] = $session;
        }
   
        return $sessions;
    }

    public function addSession( $session ){
    
        if($this->findSession($session)===false)
            $this->add_meta('sessions',$session->id());
    }

    public function findSession( $session ){
        $ids = $this->session_ids();
        
        $key = array_search( $session->id(), $ids );
        
        if($key === false){
            return false;
        }
        else{
            return new Session(get_user_by('ID',$ids[$key]));
        }
    }


}