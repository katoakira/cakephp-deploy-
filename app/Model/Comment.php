<?php
App::uses('AppModel', 'Model');    
class Comment extends AppModel {
  
    public $name = 'Comment';    
  
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        ),
        'Post' => array(
            'className' => 'Post',
            'foreginKey' => 'post_id'
        )
    );

    public $validate = array(
        'body' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'コメントを入力してください'
            )
        )
    );  
}
