<?php

namespace bandpress\Views\PageViews;

// base classes
use \vinepress\Views\View;
use \vinepress\Models\Band;
use \vinepress\Models\Musician;

use \bandpress\Views\ComponentViews\ListView;

class BandProfilePageView extends View
{

    private $band;
    private $membersListView;
    private $addMemberForm;
    private $songsListView;
    private $addSongForm;
    private $albumsListView;
    private $addAlbumFormView;
    private $rehearsalsListView;
    private $addRehearsalFormView;
    private $gigsListView;
    private $addGigFormView;
    
    public function __construct( $data = null )
    {
        parent::__construct($data);

        $this->band = $data;

        // can context be derived from namespace?  I think it should
        $this->context = "Band";
        
        $this->membersListView = new ListView($data->members());

        /* add form */
        $hidden = [
          [
              "name"=>"package","value"=>"bandpress"
          ],
          [
              "name"=>"action", "value"=>"AddMember"
          ],
          [
              "name"=>"id", "value"=>$this->data->id()
          ],
          [
              "name"=>"context", "value"=>"Band"
          ]
      ];

      $memberFormArgs = [
          "action"=>"/bandpress/actions/addmember",
          "hidden"=>$hidden,
          'inputLabel'=>"Add a Member",
          'inputId'=>"memberInput",
          'inputName'=>'member',
          'buttonLabel'=>"Add"
          
          ];

        $this->addMemberForm = new \vinepress\Views\ComponentViews\TextInputForm( $memberFormArgs );

        $this->songsListView = new ListView($data->songs());
        $this->addSongForm = new \bandpress\Views\ComponentViews\BandAddSongForm($data);

        $this->sessionsListView = new ListView($data->sessions());
        

    }
    public function renderBody()
    {
        ?>
        <div class="container justify-content-center">
        <div id="bandname"><?php echo $this->band->name();?></div>

        <div class="accordion" id="bandAccordion">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingMembers">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#members" aria-expanded="true" aria-controls="members">
        Members
      </button>
    </h2>
    <div id="members" class="accordion-collapse collapse" aria-labelledby="headingMembers" data-bs-parent="#bandAccordion">
      <div class="accordion-body">
        <?php $this->membersListView->render();?>
        <?php $this->addMemberForm->render();?>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingSongs">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#songs" aria-expanded="false" aria-controls="collapseTwo">
        Songs
      </button>
    </h2>
    <div id="songs" class="accordion-collapse collapse" aria-labelledby="headingSongs" data-bs-parent="#bandAccordion">
      <div class="accordion-body">
        <?php $this->songsListView->render();?>
        <?php $this->addSongForm->render();?>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingAlbums">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#albums" aria-expanded="false" aria-controls="albums">
        Albums
      </button>
    </h2>
    <div id="albums" class="accordion-collapse collapse" aria-labelledby="headingAlbums" data-bs-parent="#bandAccordion">
      <div class="accordion-body">
        <?php //$this->albumsListView->render();?>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingRehearsals">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rehearsals" aria-expanded="false" aria-controls="rehearsals">
        Rehearsals
      </button>
    </h2>
    <div id="rehearsals" class="accordion-collapse collapse" aria-labelledby="headingRehearsals" data-bs-parent="#bandAccordion">
      <div class="accordion-body">
        <?php //$this->rehearsalsListView->render();?>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingGigs">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#gigs" aria-expanded="false" aria-controls="gigs">
        Gigs
      </button>
    </h2>
    <div id="gigs" class="accordion-collapse collapse" aria-labelledby="headingGigs" data-bs-parent="#bandAccordion">
      <div class="accordion-body">
        <?php //$this->gigsListView->render();?>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingSessions">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sessions" aria-expanded="false" aria-controls="sessions">
        Sessions
      </button>
    </h2>
    <div id="sessions" class="accordion-collapse collapse" aria-labelledby="headingSessions" data-bs-parent="#bandAccordion">
      <div class="accordion-body">
        <?php //$this->gigsListView->render();?>
      </div>
    </div>
  </div>
</div>
        </div>
        <?php
    }
}