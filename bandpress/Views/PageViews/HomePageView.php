<?php

namespace bandpress\Views\PageViews;

use vinepress\Views\View;
use vinepress\Views\ComponentViews\ListView;
use \bandpress\Views\ComponentViews\AddBandForm;
use \bandpress\Views\ComponentViews\AddSessionForm;
use \bandpress\Views\ComponentViews\AccordionView;
use \bandpress\Views\ComponentViews\AccordionSectionView;

class HomePageView extends View
{

    private $accordion;
    public function __construct( $data = null)
    {
        parent::__construct($data);
        $this->user = new \bandpress\Models\Musician(wp_get_current_user());

        $this->accordion = new AccordionView("User");
        $this->addBandsSection();
        $this->addSessionsSection();
        
    }

    protected function renderBody()
    {
        ?>
       <div class="container">
        <?php $this->accordion->render(); ?>
       </div>
        <?php
    }

    private function addBandsSection(){

        $section = new AccordionSectionView("Bands","bands");

        // add the list view
        $component = new ListView($this->user->bands());
        $section->addComponent( $component );

        $hidden = [
            [
                'name'=>'package',
                'value'=>'bandpress'
            ],
            [
                'name'=>'action',
                'value'=>'addBand'
            ],
            [
                'name'=>'context',
                'value'=>'User'
            ],                
            [
                'name'=>'id',
                'value'=>app()->currentUser()->id()
            ],            
        
        ];

        $bandFormArgs = [
            "action"=>"/bandpress/actions/addband",
            "hidden"=>$hidden,
            'inputLabel'=>"Add a Band",
            'inputId'=>"bandInput",
            'inputName'=>'band',
            'buttonLabel'=>"Add"
            
            ];
        $form = new \vinepress\Views\ComponentViews\TextInputForm( $bandFormArgs );
        $section->addComponent( $form );

        $this->accordion->addSection($section);

    }

    private function addSessionsSection( ){
        $section = new AccordionSectionView("Sessions","sessions");

        // add the list view
        $component = new ListView($this->user->sessions());
        $section->addComponent( $component );

        $hidden = [
            [
                'name'=>'package',
                'value'=>'bandpress'
            ],
            [
                'name'=>'action',
                'value'=>'addSession'
            ],
            [
                'name'=>'context',
                'value'=>'User'
            ],                
            [
                'name'=>'id',
                'value'=>app()->currentUser()->id()
            ],            
        
        ];

        $formArgs = [
            "action"=>"/bandpress/actions/addsession",
            "hidden"=>$hidden,
            'inputLabel'=>"Add a Session",
            'inputId'=>"sessionInput",
            'inputName'=>'session',
            'buttonLabel'=>"Add"
            
            ];
        $form = new \vinepress\Views\ComponentViews\TextInputForm( $formArgs );
        $section->addComponent( $form );

        $this->accordion->addSection($section);
    }



}