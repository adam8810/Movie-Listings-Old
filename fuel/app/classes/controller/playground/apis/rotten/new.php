<?php
use \Fuel\Core;

class Controller_Playground_Apis_Rotten_New extends Controller
{
    public function action_index()
    {
        
    }
    
    public function action_user()
    {
//        $data = array();
//        $data['page_title'] = 'Create New User';
//        
//        $form = Core\Fieldset::forge('form');
//        
//        echo $form;
//        
//        return View::forge('playground/apis/new/user', $data);
        
        
        $fieldset = Fieldset::forge()->add_model('Model_Post');
        $form = $fieldset->form();

        $this->template->set('content', $form->build(), false); //false will tell fuel not to convert the html tags to safe string.
    }
    
    public function action_post()
    {
        $fieldset = Fieldset::forge()->add_model('Model_Post');
        $form = $fieldset->form();

        $this->template->set('content', $form->build(), false); //false will tell fuel not to convert the html tags to safe string.
    }
}