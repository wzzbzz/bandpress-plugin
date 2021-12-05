<?php

namespace bandpress\Views\ComponentViews;

class BandAddMemberForm{
    public function __construct( $band ){
        $this->band = $band;
    }

    public function render(){
        ?>
        <form action="actions/bandaddmember/" method ="POST" > 
            <input type="hidden" name="action" value="bandAddMember" />
            <input type="hidden" name="band_slug" value="<?= $this->band->slug();?>">
            <input type="hidden" name="package" value="bandpress">
            <div class="py-5 mx-2 h-100">
                <div class="mb-3">
                    <label class="form-label" for="userLogin">Add a Member</label>
                    <input type="text" class="form-control" name="userLogin" id="userLogin" />
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </div>
        </form>
        <?php
    }
}