<?php

namespace bandpress\Models;
use \vinepress\Models\TaxonomyTerm;

class Band extends TaxonomyTerm
{

    public function setLeaders()
    {
    }

    public function member_ids()
    {
        return $this->get_field('members');
    }

    

    public function members()
    {
        // ACF field returns user object
        $members = $this->get_field('members');
    
        // swap the user objects out for wrapper objects
        foreach($members as $i=>$member){
            // cast it as a musician.  should be BandMember?

            $members[$i] = new \bandpress\Models\Musician($member['member']);
        }
        return $members;
    }
     // we're gonna stash these as meta instead of fields 
     // maybe move away from ACF when we don't need to.
    public function addMember($new_member)
    { 
        if(!array_search($new_member->id(), $this->member_ids())) {
            $this->add_meta('members', $new_member->id());
        }
        
        
    }

    public function removeMember($member)
    {
        $members = $this->get_field('members');
        $key = array_search($member->id(), $members);
        unset($members[$key]);
    }

    public function removeAllSongs()
    {
        $this->delete_meta('songs');
    }

    public function song_ids()
    {
        return $this->get_meta('songs');

    }
    public function songs()
    {
        
        $songs = [];
        foreach($this->song_ids() as $song_id){
            $song_post = get_post($song_id);
            $song = new \bandpress\Models\BandSong($song_post);
            $song->setBand($this);
            $songs[] = $song;
        }

        $alphasort = function($a,$b){
            if ($a->name() == $b->name()) {
                return 0;
            }
            return ($a->name() < $b->name()) ? -1 : 1;
        };
        
        usort($songs,$alphasort);
        return $songs;
    }

    public function addSong( $new_song )
    {
        
        $this->add_meta('songs', $new_song->id());
    }

    public function hasSongTitled($title)
    {

        $return = false;
        
        foreach($this->songs() as $song){
            if($song->title() == $title) {
                $return = true;
            }
        }
        
        return $return; 
    }

    public function findSongBySlug($slug)
    {
        $songs = $this->songs();
        foreach($songs as $song){
            if($song->slug()==$slug) {
                return $song;
            }
        }
        return false;
    }

    public function session_ids(){
        return $this->get_meta('songs');
    }
    public function sessions()
    {
        $sessions = [];
        foreach($this->session_ids() as $session_id){
            $post = get_post($session_id);
            $session = new \bandpress\Models\Session($post);
            $sessions[] = $song;
        }
   
        return $sessions;
    }

    public function url()
    {
        return get_bloginfo("url") . "/bandpress/band/" . $this->slug() . "/";
    }
    
}