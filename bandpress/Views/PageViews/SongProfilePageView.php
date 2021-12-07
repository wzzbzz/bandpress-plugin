<?php

namespace bandpress\Views\PageViews;
use \vinepress\Views\View;
use \bandpress\Views\ComponentViews\SongUpdateLyricsForm;
use \vinepress\Views\ComponentViews\UploadForm;
use \bandpress\Views\ComponentViews\RecordingsListView;

class SongProfilePageView extends View{

    private $band;
    private $song;

    public function setSong($song){
        $this->song = $song;
    }

    public function setBand( $band ){
        $this->band = $band;
    }

    public function renderBody(){
        $lyricsForm = new SongUpdateLyricsForm( $this->song, $this->band );

        $hidden = [
            [
                "name"=>"package","value"=>"bandpress"
            ],
            [
                "name"=>"action", "value"=>"songAddRecording"
            ],
            [
                "name"=>"songId", "value"=>$this->song->id()
            ]
        ];
        if(!empty($this->band)){
            $hidden[]=["name"=>"bandId", "value"=>$this->band->id()];
        }

        $recordingFormArgs = [
            "action"=>"/bandpress/actions/songaddrecordingaction",
            "hidden"=>$hidden,
            'inputLabel'=>"Upload a Recording",
            'inputId'=>"recordingInput",
            'inputName'=>'file',
            'buttonLabel'=>"Upload"
            
            ];
        $uploadRecordingForm = new UploadForm( $recordingFormArgs );

        $recordingsList = new RecordingsListView( $this->song->recordings());

        ?>

    <div class="container justify-content-center">
        <div id="song"><?= $this->song->name();?></div>
        <div id="credits">by <a href="<?= $this->band->url()?>"><?= $this->band->name();?></a></div>
        <div class="accordion" id="songAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingLyrics">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#lyrics" aria-expanded="true" aria-controls="lyrics">
                        Lyrics
                    </button>
                </h2>
                <div id="lyrics" class="accordion-collapse collapse" aria-labelledby="headingLyrics" data-bs-parent="#songAccordion">
                    <div class="accordion-body">
                        <div>
                        </div>
                        <div>
                            <?= $this->song->lyrics();?>
                        </div>
                        <?php 
                            $lyricsForm->render();
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
                <div id="recordings" class="accordion-collapse collapse" aria-labelledby="headingRecordings" data-bs-parent="#songAccordion">
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