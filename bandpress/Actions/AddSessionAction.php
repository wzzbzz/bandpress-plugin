<?php

namespace bandpress\Actions;

class AddSessionAction
{
    
    public function __construct()
    {

    }
    public function __destruct()
    {
    }
    public function do()
    {
        $context = $_REQUEST['context'];
        // this is not good  
        $collectionClass = "\\bandpress\\Models\\".$context."s";
        $obj = $collectionClass::byId($_REQUEST['id']);
        $title = $_REQUEST['location']."-".$_REQUEST['date'];   
        $args = [
            'post_title'=>$title,
            'post_type'=>'session',
            'post_name'=>sanitize_title($title)
        ];
        $post_id = wp_insert_post($args);
        $session = new \bandpress\Models\Session(get_post($post_id));
        $obj->addSession($session);
        $_SESSION['notifications']['successes'][]="session added";
        wp_redirect("/bandpress");
        die;
    }

}