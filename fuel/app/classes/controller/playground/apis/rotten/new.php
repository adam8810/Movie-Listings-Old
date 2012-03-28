<?php
use \Fuel\Core;

class Controller_Playground_Apis_Rotten_New extends Controller
{
    public function action_index()
    {
        
    }
    
    public function action_user()
    {
        $data = array();
        $data['page_title'] = 'Create New User';
        
        $form = Core\Fieldset::forge('form');
        
        echo $form;
        
        return View::forge('playground/apis/new/user', $data);
    }
}