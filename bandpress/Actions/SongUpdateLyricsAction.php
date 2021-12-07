<?php

namespace bandpress\Actions;
use \bandpress\Models\Song;
use \bandpress\Models\BandSong;

class SongUpdateLyricsAction{

    private $songId;

    public function __construct(){
        
    }

    public function __destruct(){}

    public function do(){
        $song_post = get_post($_REQUEST['songId']);
        if(empty($song_post)){
            $_SESSION['notifications']['errors'] = "No song with that ID";
            wp_redirect("/bandpress/");
        }
        $songClass = (empty($_REQUEST['bandId']))?"Song":"BandSong";

        $song = new \bandpress\Models\Song($song_post);
        $song->updateLyrics($_REQUEST['lyrics']);
        if(isset($_REQUEST['bandId'])){
            $song = new \bandpress\Models\BandSong($song_post);
            $band = new \bandpress\Models\Band( get_term($_REQUEST['bandId']));
            $song->setBand( $band );
            
            wp_redirect($song->url());
        }
        else{
            wp_redirect('/bandpress/');
        }

        die;
    }

}