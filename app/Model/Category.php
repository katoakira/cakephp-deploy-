<?php
App::uses('AppModel', 'Model');
class Category extends AppModel {
    public $hasMany = array('Post');

    public $validate = array(
        'name' => array(
            'rule' => 'notEmpty'
        )
    );
}
