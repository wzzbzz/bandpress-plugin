<?php

namespace bandpress\Actions;
use \vinepress\Actions\UploadAction;
use \bandpress\Models\Song;
use \bandpress\Models\Band;
use \bandpress\Models\BandSong;

class SongAddRecordingAction extends UploadAction
{

    public function __construct()
    {

    }
    public function __destruct()
    {
    }

    public function do()
    {
        
        if(is_numeric($id=$this->handleFileUpload())) {
            if(isset($_REQUEST['bandId'])) {
                // needs refactor
                $song = new BandSong(get_post($_REQUEST['songId']));    
                $band = new Band(get_term($_REQUEST['bandId']));
                $song->setBand($band);
            }
            else {
                $song = new Song(get_post($_REQUEST['songId']));
            }

            $song->addRecording($id);
            wp_redirect($song->url());
        }
        
        else{
            if(is_wp_error($id) ) {
                $_SESSION['notifications']['errors'][] = $id->errors['upload_error'][0];
            }
            else{
                $_SESSION['notifications']['errors'][] = "File Upload Error";
            }
            $song = new BandSong(get_post($_REQUEST[ 'songId' ])); 
            $band = new Band(get_term($_REQUEST['bandId']));
            $song->setBand($band); 
            wp_redirect($song->url());
        }

        die;
        
        wp_redirect($band->url());
        die;
    }

}