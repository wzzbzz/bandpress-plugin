<?php

namespace bandpress\Models;
use \vinepress\Models\Post;

class Song extends Post{
    
    public function name(){
        return $this->title();
    }

    
    public function updateTitle(){}

    public function getLyrics(){}
    public function updateLyrics(){}
    
    public function getRecordings(){}
    public function addRecording(){}
    
    public function getContributor(){}
    public function addContributor(){}

}