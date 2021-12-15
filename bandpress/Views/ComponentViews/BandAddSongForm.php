<?php

namespace bandpress\Views\ComponentViews;

class BandAddSongForm
{
    public function __construct( $band )
    {
        $this->band = $band;
    }

    public function render()
    {
        ?>
        <form action="actions/bandaddsong/" method ="POST" > 
            <input type="hidden" name="action" value="bandAddSong" />
            <input type="hidden" name="band_slug" value="<?php echo $this->band->slug();?>">
            <input type="hidden" name="package" value="bandpress">
            <div class="py-5 mx-2 h-100">
                <div class="mb-3">
                    <label class="form-label" for="bandSong">Add a Song</label>
                    <input type="text" class="form-control" name="songTitle" id="songTitle" placeholder="Title"/>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </div>
        </form>
        <?php
    }
}