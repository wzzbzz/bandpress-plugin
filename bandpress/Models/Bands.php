<?php

namespace bandpress\Models;
use \vinepress\Models\Model;

class Bands extends Model{
    public function getBandBySlug( $slug ){
        $term = get_term_by('slug',$slug,'band');
        return new Band( $term );
    }
}