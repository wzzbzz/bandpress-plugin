<?php
namespace bandpress\Views\ComponentViews;

class AccordionSectionView{

    protected $components = [];

    private $label;
    private $id;
    private $parent;

    public function __construct(
        $label,
        $id
    )
    {
        $this->label = $label;
        $this->id = $id;
    }

    public function __destruct()
    {

    }
    
    public function render(){
        ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading<?=$this->label;?>">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $this->id;?>" aria-expanded="true" aria-controls="<?= $this->id;?>">
                <?= $this->label;?>
            </button>
            </h2>
            <div id="<?= $this->id;?>" class="accordion-collapse collapse" aria-labelledby="headingBands" data-bs-parent="#<?=$this->parent;?>Accordion">
                <div class="accordion-body">
                    <?php foreach($this->components as $component){
                        $component->render();
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
    }

    public function addComponent($component){
        $this->components[] = $component;
    }

    public function setParent($parent){
        $this->parent = $parent;
    }
}