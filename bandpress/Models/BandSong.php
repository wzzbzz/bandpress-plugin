<?php

namespace bandpress\Models;

class BandSong extends Song
{

    private $band;

    public function setBand( $band )
    {
        $this->band = $band;
    }

    public function url()
    {
        return get_bloginfo("url")."/bandpress/band/".$this->band->slug()."/song/".$this->slug()."/";
    }
}