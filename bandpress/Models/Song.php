<?php

namespace bandpress\Models;
use \vinepress\Models\Post;

class Song extends Post{
    
    public function name(){
        return $this->title();
    }

    
    public function updateTitle(){}

    public function lyrics(){
        // lyrics stored in post_content;
        return $this->content();
    }
    public function updateLyrics($lyrics){
        $this->updatePostContent($lyrics);
    }
    
    public function recording_ids(){
        return $this->get_meta("recordings");
    }
    public function recordings(){
        $recordings=[];
        foreach($this->recording_ids() as $id){
            $recordings[] = new \bandpress\Models\Recording( get_post( $id) );
        }
        return $recordings;
    }
    public function addRecording($id){
        
        $recordings = $this->get_meta('recordings');

        if(array_search($id, $recordings )===false){
            $this->add_meta('recordings',$id);
        }
    }
    
    public function getContributor(){}
    public function addContributor(){}

    public function url(){
       
    }

}