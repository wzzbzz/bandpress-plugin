<?php

namespace bandpress\Views\PageViews;
use \vinepress\Views\View;
use \bandpress\Views\ComponentViews\addParticipantsForm;
use \vinepress\Views\ComponentViews\UploadForm;
use \bandpress\Views\ComponentViews\RecordingsListView;
use \vinepress\Views\ComponentViews\LinkListView;

class SessionView extends View
{

    public function renderBody()
    {
        
        /**
         * dynamically create list and form from session attriutes
         * participants first
         */

        $participantsList = new LinkListView($this->data->participants());
        $hidden = [
            [
                "name"=>"package","value"=>"bandpress"
            ],
            [
                "name"=>"action", "value"=>"AddParticipant"
            ],
            [
                "name"=>"id", "value"=>$this->data->id()
            ]
        ];

        $participantsFormArgs = [
            "action"=>"/bandpress/actions/addparticipant",
            "hidden"=>$hidden,
            'inputLabel'=>"Add a Participant",
            'inputId'=>"participantInput",
            'inputName'=>'participant',
            'buttonLabel'=>"Add"
            
            ];

        $participantsForm = new \vinepress\Views\ComponentViews\TextInputForm( $participantsFormArgs );

        $hidden = [
            [
                "name"=>"package","value"=>"bandpress"
            ],
            [
                "name"=>"action", "value"=>"AddRecording"
            ],
            [
                "name"=>"id", "value"=>$this->data->id()
            ],
            [
                "name"=>"context", "value"=>"Session"
            ]
        ];


        $recordingFormArgs = [
            "action"=>"/bandpress/actions/recordingaction",
            "hidden"=>$hidden,
            'inputLabel'=>"Upload a Recording",
            'inputId'=>"recordingInput",
            'inputName'=>'file',
            'buttonLabel'=>"Upload"
            
            ];
        $uploadRecordingForm = new UploadForm($recordingFormArgs);

        $recordingsList = new RecordingsListView($this->data->recordings());

        ?>

    <div class="container justify-content-center">
        <div id="title"><?php echo $this->data->title();?></div>
        <div class="accordion" id="sessionAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingParticipants">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#participants" aria-expanded="true" aria-controls="participants">
                        Participants
                    </button>
                </h2>
                <div id="participants" class="accordion-collapse collapse" aria-labelledby="headingParticipants" data-bs-parent="#sessionAccordion">
                    <div class="accordion-body">
                        <div>
                        </div>
                        <div>
                            <?php $participantsList->render();?>
                        </div>
                        <?php 
                            $participantsForm->render();
                        ?>
                    </div>
                 </div>
            </div>
        </div>
        <div class="accordion-item">
                <h2 class="accordion-header" id="headingRecordings">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#recordings" aria-expanded="true" aria-controls="recordings">
                        Recordings
                    </button>
                </h2>
                <div id="recordings" class="accordion-collapse collapse" aria-labelledby="headingRecordings" data-bs-parent="#sessionAccordion">
                    <div class="accordion-body">
                        <div>
                        <?php
                        $recordingsList->render();
                        ?>
                        </div>
                        <div>
                            
                        </div>
                        <?php 
                            $uploadRecordingForm->render();
                        ?>
                    </div>
                 </div>
            </div>
        </div>

    </div>
        <?php
    }

}