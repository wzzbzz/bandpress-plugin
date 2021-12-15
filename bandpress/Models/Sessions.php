<?php

namespace bandpress\Models;
use \vinepress\Models\Model;

class Sessions extends Model
{
    public function bySlug( $slug )
    {
        $sql ="SELECT * from wp_posts WHERE post_name='{$slug}' AND post_type='session' LIMIT 1";
        if(!empty($results = $this->get_results($sql))){
            return new Session($results[0]);
        }
        return false;
    }

    public function byId ( $id )
    {
        $post = get_post( $id) ;
        return new Session( $post );
    }
}