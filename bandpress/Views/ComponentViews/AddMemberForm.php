<?php

namespace bandpress\Views\ComponentViews;

class AddMemberForm
{
    public function __construct( $args )
    {
    
    }

    public function render()
    {
        ?>
        <form action="actions/addmember/" method ="POST" > 
            <input type="hidden" name="action" value="AddMember" />
            <input type="hidden" name="package" value="bandpress">
            <div class="py-5 mx-2 h-100">
                <div class="mb-3">
                    <label class="form-label" for="userLogin">Add a Member</label>
                    <input type="text" class="form-control" name="userLogin" id="userLogin" />
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </div>
        </form>
        <?php
    }
}