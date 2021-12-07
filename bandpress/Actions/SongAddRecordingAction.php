<?php

namespace bandpress\Actions;
use \vinepress\Actions\UploadAction;
use \bandpress\Models\Song;
use \bandpress\Models\Band;
use \bandpress\Models\BandSong;

class SongAddRecordingAction extends UploadAction{

    public function __construct(){

    }
    public function __destruct(){}

    public function do(){
        
        if($id=$this->handleFileUpload()){
            if(isset($_REQUEST['bandId'])){
                // needs refactor
                $song = new BandSong(get_post($_REQUEST['songId']));    
                $band = new Band( get_term($_REQUEST['bandId']) );
                $song->setBand($band);
            }
            else
                $song = new Song(get_post($_REQUEST['songId']));

            $song->addRecording( $id );
            wp_redirect($song->url());
        }
        
        else{
            wp_redirect("/");
        }

        die;
        
        wp_redirect($band->url());
        die;
    }

}