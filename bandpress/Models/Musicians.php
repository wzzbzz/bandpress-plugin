<?php

namespace bandpress\Models;
use \vinepress\Models\Model;

class Musicians extends Model
{
    public function bySlug( $slug )
    {
        $term = get_term_by('slug', $slug, 'band');
        return new Band($term);
    }

    public function byId ( $id )
    {
        $user = get_user_by( 'ID' , $id) ;
        return new Musician( $user );
    }
}