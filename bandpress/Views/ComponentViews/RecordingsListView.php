<?php

namespace bandpress\Views\ComponentViews;
use \vinepress\Views\ComponentViews\ListView;

class RecordingsListView extends ListView{
    
    public function renderList(){

        ?>
         <ul class="list-unstyled">
            <?php foreach($this->list as $item):?>
                <li>
                <div class="d-flex justify-content-center"><?=$item->title();?></div>
                <div><?php $item->viewClass()->render();?></div>
                </li>
            <?php endforeach;?>
            </ul>
        <?php
    }

}