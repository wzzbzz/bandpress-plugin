<?php

namespace bandpress\Models;
use \vinepress\Models\TaxonomyTerm;

class Band extends TaxonomyTerm{

    public function setLeaders(){}

    public function member_ids(){
        return $this->get_meta('members');
    }
    public function members(){
        $members = [];
        foreach($this->member_ids() as $member_id){
            $user = get_user_by( "ID", $member_id );
            $members[] = new \bandpress\Models\Musician( $user );
        }
        return $members;
    }
     // we're gonna stash these as meta instead of fields 
     // maybe move away from ACF when we don't need to.
    public function addMember($new_member){
        
        if(!array_search($new_member->id(), $this->member_ids()))
        {
            $this->add_meta('members',$new_member->id());
        }
        
        
    }

    public function removeMember($member){
        $members = $this->get_field('members');
        $key = array_search($member->id(),$members);
        unset($members[$key]);
    }

    public function song_ids(){
        return $this->get_meta('songs');
    }
    public function songs(){
        $songs = [];
        foreach($this->song_ids() as $song_id){
            $song_post = get_post( $song_id );
            $songs[] = new \bandpress\Models\Song( $song );
        }
        
        return $songs;
    }

    public function addSong( $new_song ){
        $this->add_meta('songs',$new_song->id());
    }
    
    public function hasSongTitled($title){
        
        $return = false;
        foreach($songs as $song){
            if($song->title() == $title){
                $return = true;
            }
        }
        return $return; 
    }

    public function url(){
        return get_bloginfo("url") . "/bandpress/band/" . $this->slug() . "/";
    }
    
}