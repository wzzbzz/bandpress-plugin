<?php

namespace bandpress\Views\ComponentViews;
use \vinepress\Views\ComponentViews\ListView;

class RecordingsListView extends ListView{
    
    public function renderList(){

        ?>
         <ul class="list-unstyled">
            <?php foreach($this->list as $item):?>
                <li>
                <?php $item->viewClass()->render();?>
                </li>
            <?php endforeach;?>
            </ul>
        <?php
    }

}