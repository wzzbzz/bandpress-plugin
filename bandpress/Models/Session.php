<?php

namespace bandpress\Models;
use \vinepress\Models\Post;
use \vinepress\Models\User;
use \bandpress\Models\Musician;

class Session extends Post
{
    
    public function name()
    {
        return $this->title();
    }

    
    public function updateTitle()
    {
    }

    public function file_ids(){

    }

    public function files(){

    }

    public function filesByMediaType( $mediaType){

    }

    public function recording_ids()
    {
        // filter out photos
        return $this->get_meta("recordings");
    }

    public function recordings()
    {
        $recordings=[];
        foreach($this->recording_ids() as $id){
            $recordings[] = new \bandpress\Models\Recording(get_post($id));
        }
        return $recordings;
    }

    public function addRecording($id)
    {
        $recordings = $this->get_meta('recordings');

        if(array_search($id, $recordings)===false) {
            $this->add_meta('recordings', $id);
        }
    }
    
    // this meta will contain
    // id and role.
    // make meta storage be more robust than just a list of id references
    // add roles.
    public function participant_ids(){
        return $this->get_meta('participants');
    }

    public function participants()
    {
        $participants=[];
        foreach($this->participant_ids() as $id){
            $participants[] = new Musician(get_user_by('ID',$id));
        }
        return $participants;
    }
    public function addParticipant( $user )
    {
        if($this->findParticipant($user)===false){
            $this->add_meta('participants',$user->id());
        }
        else{
            $_SESSION['notifications']['successes'][] = "User already exists";
        }
    }

    public function findParticipant( $user ){
        $ids = $this->participant_ids();
        $key = array_search( $user->id(), $ids );
        if($key === false){
            return false;
        }
        else{
            return new Musician(get_user_by('ID',$ids[$key]));
        }
    }

    public function url()
    {
        return get_bloginfo("url") . "/bandpress/session/" . $this->slug() . "/";
    }

}