<?php

namespace bandpress\Views\PageViews;

use vinepress\Views\View;
use vinepress\Views\ComponentViews\ListView;
use \bandpress\Views\ComponentViews\AddBandForm;
use \bandpress\Views\ComponentViews\AddSessionForm;

class HomePageView extends View
{

    public function __construct( $data = null)
    {
        parent::__construct($data);
        $this->user = new \bandpress\Models\Musician(wp_get_current_user());
    }

    
    protected function renderBody()
    {
        $this->bandsListView = new ListView($this->user->bands());
        $this->addBandForm = new AddBandForm();

        $this->sessionsListView = new ListView($this->user->sessions());
        $hiddenVars = [
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
                    'value'=>'Musician'
                ],                
                [
                    'name'=>'id',
                    'value'=>app()->currentUser()->id()
                ],            
            
        ];
        
        $this->addSessionForm = new AddSessionForm($hiddenVars);

        ?>
       <div class="container">
       <div class="accordion" id="userAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingBands">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#bands" aria-expanded="true" aria-controls="bands">
                Bands
            </button>
            </h2>
            <div id="bands" class="accordion-collapse collapse" aria-labelledby="headingBands" data-bs-parent="#userAccordion">
                <div class="accordion-body">
                    <?php $this->bandsListView->render();?>
                    <?php $this->addBandForm->render(); ?>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSessions">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#sessions" aria-expanded="true" aria-controls="sessions">
                Sessions
            </button>
            </h2>
            <div id="sessions" class="accordion-collapse collapse" aria-labelledby="headingSessions" data-bs-parent="#userAccordion">
                <div class="accordion-body">
                    <?php $this->sessionsListView->render();?>
                    <?php $this->addSessionForm->render(); ?>
                </div>
            </div>
        </div>
  
       </div>
        <?php
    }
 
    private function renderUserBands()
    {
            $list = new \bandpress\Views\ComponentViews\ListView($this->user->bands());
        ?>
        <div class="container">

        <div class="row">
            <div class="card bg-light text-dark">
                <div class="card-header">
                    Your Bands
                </div>
                <div class="card-body">
                    <?php
                        $list->render();
                    ?>
                    <?php
                        \bandpress\Views\ComponentViews\AddBandForm::render();
                    ?>
                </div>
            </div>
        </div>
        </div>

        <?php
    }   
    private function renderUserSongs()
    {
       
        ?>
        <div class="container">

        <div class="row">
            <div class="card bg-light text-dark">
                <div class="card-header">
                Your Songs
                </div>
                <div class="card-body">
                
                </div>
            </div>
        </div>
        </div>

        <?php
    }   

    private function renderGuestUserScreen()
    {
        ?>
        <div class="container py-5 h-100">
        
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">
    
                <div class="mb-md-5 mt-md-4 pb-5">
    
                    <h2 class="display-5 fw-bold mb-2 text-uppercase">You have come to a Fork In The Internet.com!</h2>
                    <p class="text-white mb-5">Please <a class="btn btn-light text-dark fw-bold" href="/register">register</a> or <a class="btn btn-light text-dark fw-bold" href="/login">sign in</a> to see what's inside!</p>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <?php
    }
}