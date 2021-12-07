<?php

namespace bandpress\Models;
use \vinepress\Models\File;
use \vinepress\Views\ComponentViews\AudioView;
use \vinepress\Views\ComponentViews\VideoView;

class Recording extends File{

    ### must be full path.  
    public function viewClass(){
        $class = "\\vinepress\\Views\\ComponentViews\\".ucfirst($this->mediaType())."View";
        return new $class( $this );
    }
}