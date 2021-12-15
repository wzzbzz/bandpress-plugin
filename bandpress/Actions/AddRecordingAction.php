<?php

namespace bandpress\Actions;
use \vinepress\Actions\UploadAction;
use \bandpress\Models\Song;
use \bandpress\Models\Band;
use \bandpress\Models\BandSong;

class AddRecordingAction extends UploadAction
{

    public function __construct()
    {

    }
    public function __destruct()
    {
    }

    public function do()
    {
         
        $collectionClass = "\\bandpress\\Models\\".$_REQUEST['context']."s";

        $obj = $collectionClass::byId($_REQUEST['id']);
        // attempt file upload
        if(is_numeric($id=$this->handleFileUpload())) {
            // if successful, add it to the enitity
            $obj->addRecording($id);
            $_SESSION['notifications']['successes'][] = 'Recording Added';
            wp_redirect($obj->url());
        }
        else{
            if(is_wp_error($id) ) {
                $_SESSION['notifications']['errors'][] = $id->errors['upload_error'][0];
            }
            else{
                $_SESSION['notifications']['errors'][] = "File Upload Error";
            }
    
            wp_redirect($obj->url());
        }

        die;

    }

}