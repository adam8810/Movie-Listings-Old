<?php

/**
 * Post Controller fuel/app/classes/controller/posts.php
 */
class Controller_Posts extends Controller {

    //list posts
    public function action_index()
    {
        echo 'h';
    }

    //add new one
    function action_add()
    {
        $fieldset = Fieldset::forge()->add_model('Model_Post');
        $form = $fieldset->form();

        $this->template->set('content', $form->build(), false); //false will tell fuel not to convert the html tags to safe string.
    }

    //edit
    function action_edit($id)
    {
        
    }

}