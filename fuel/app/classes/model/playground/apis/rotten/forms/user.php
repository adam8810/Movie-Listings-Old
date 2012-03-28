<?php

class Model_New_User extends \Orm\Model {

    protected static $_table_name = 'users';
    protected static $_properties = array(
        'id',
        'first_name' => array(
            'data_type' => 'string',
            'label' => 'First Name',
            'validation' => array('required', 'max_length' => array(100), 'min_length' => array(10))),
        'last_name' => array(
            'data_type' => 'string',
            'label' => 'Last Name',
            'validatoin' => array('required', 'max_length' => array(100), 'min_length' => array(10))),
        'password' => array(
            'data_type' => 'password',
            'label' => 'Password',
        )
    );

}