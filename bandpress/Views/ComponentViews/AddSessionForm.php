<?php

namespace bandpress\Views\ComponentViews;

class AddSessionForm
{
    private $_hiddenVars;
    public function __construct( $hiddenVars)
    {   
        $this->_hiddenVars = $hiddenVars;
    }

    public function render()
    {
        ?>
        <form action="actions/addsession/" method ="POST" > 
            <?php foreach($this->_hiddenVars as $var):?>
            <input type="hidden" name="<?=$var['name'];?>" value="<?=$var['value'];?>" />
            <?php endforeach;?>
            <div class="">
                <div class="mb-3 col-3">
                    <label class="form-label" for="sessionDate">New Session:</label>
                    <input type="text" class="form-control col-3" name="date" id="sessionDate" placeholder="enter the date"/>
                    <input type="text" class="form-control col-3" name="location" id="sessionDate" placeholder="enter the location"/>
                </div>
                <!--<div class="form-check">
                    <input type="checkbox" class="form-check-input" id="isYourBand" name="isMyBand" value="yes">
                    <label class="form-check-label" for="isYourBand">Is This Your Band?</label>
                </div>-->
                <button type="submit" class="btn btn-primary">Submit</button>

            </div>
        </form>
        <?php
    }
}