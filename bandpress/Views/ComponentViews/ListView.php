<?php

namespace bandpress\Views\ComponentViews;

// renders a linked list of entities.
// must have implemented name() and url()
class ListView{
    private $list;
    public function __construct($list){
        $this->list = $list;
    }

    public function render(){
        if (empty($this->list)){
            ?>
                <ul class='list-unstyled'>
                    <li>You have none.</li>
                </ul>
            <?php
        }
        else{
            ?>
            <ul class="list-unstyled">
            <?php foreach($this->list as $item):?>
                <li><a href="<?=$item->url();?>"><?= $item->name();?></a></li>
            <?php endforeach;?>
            </ul>
            <?php
        }
    }
}