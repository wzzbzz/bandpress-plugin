<?php

namespace bandpress\Actions;

class BandAddSongAction{
    private $bandId;
    private $newUserName;
    public function __construct(){
        $this->bandSlug = $_REQUEST['band_slug'];
        $this->songTitle = $_REQUEST['songTitle'];
    }
    public function __destruct(){}
    public function do(){
        
        $term = get_term_by("slug", $this->bandSlug, "band");
        if(empty($term)){
            $_SESSION['notifications']['errors'][]="band doesn't exist";
            wp_redirect("/bandpress");
            die;
        }
        $band = new \bandpress\Models\Band( $term );

        if($band->hasSongTitled($_REQUEST['songTitle'])){
            $_SESSION['notifications']['errors'][]="you've already got that song";
            wp_redirect($band->url());
            die;
        }
        
        $args = [
            'post_title'=>$_REQUEST['songTitle'],
            'post_type'=>'song',
            'post_name'=>sanitize_title($_REQUEST['songTitle'])
        ];
        $post_id = wp_insert_post($args);
        $song = new \bandpress\Models\Song( get_post($post_id) );
        $band->addSong( $song );
        $_SESSION['notifications']['successes'][]="song added";
        wp_redirect($band->url());
        die;
    }

}