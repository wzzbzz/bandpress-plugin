<?php

namespace bandpress\Models;
use \vinepress\Models\TaxonomyTermCollection;

class Bands extends TaxonomyTermCollection
{
    public function __construct(){
        $this->taxonomy = "band";
        $this->model="\bandpress\Models\Band";
    }
    

    public function byId( $id ){
        $term = get_term( $id );
        return new Band($term);
    }
}