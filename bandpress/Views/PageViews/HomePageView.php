<?php

namespace bandpress\Views\PageViews;

use vinepress\Views\View;

class HomePageView extends View{

    public function __construct( $data = null){
       parent::__construct( $data );
       $this->user = new \bandpress\Models\Musician(wp_get_current_user());
    }

    
    protected function renderBody(){
                 
       ?>
       <div class="container">
        <?php
            $this->renderUserBands();
            $this->renderUserSongs();
        ?>
       </div>
       <?php
    }
 
    private function renderUserBands(){
            $list = new \bandpress\Views\ComponentViews\ListView( $this->user->bands());
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
    private function renderUserSongs(){
       
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

    private function renderGuestUserScreen(){
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