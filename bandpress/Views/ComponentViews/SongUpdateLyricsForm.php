<?php

namespace bandpress\Views\ComponentViews;

class SongUpdateLyricsForm{
    private $song;
    private $band;

    public function __construct( $song, $band=null ){
        $this->song = $song;
        $this->band = $band;
    }

    public function setBand( $band ){
        $this->band = $band;
    }
    public function render(){
    
        
       ?>
       <form action="actions/songupdatelyrics/" method ="POST" > 
            <input type="hidden" name="action" value="songUpdateLyrics" />
            <input type="hidden" name="songId" value="<?= $this->   song->id();?>" />
            <input type="hidden" name="package" value="bandpress" />
            <?php if (!empty ($this->band)): ?>
            <input type="hidden" name="bandId" value="<?= $this->band->id();?>" />
            <?php endif;?>
            <div class="py-5 mx-2 h-100">
                <div class="mb-3">
                <textarea class="form-control" id="lyricsTextarea" name = "lyrics" rows="4"></textarea>
                <label class="form-label" for="textAreaExample">Update Lyrics</label>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </div>
        </form>
       <?php
    }

}