<?php

namespace bandpress\Views\ComponentViews;

class AccordionView{

    protected $sections = [];

    public function __construct( $label )
    {
        $this->label = $label;
    }

    public function render()
    {
        ?>
         <div class="accordion" id="<?= $this->label;?>Accordion">
            <?php 
                foreach($this->sections as $section)
                    $section->render();
            ?>
         </div>
        <?php
    }

    public function addSection( $section )
    {
        $section->setParent($this->label);
        $this->sections[] = $section;
    }
}