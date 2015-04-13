<?php 
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class User extends AppModel {
    public $hasMany = array(
        'Post' => array(
            'className' => 'Post',
            'forignKey' => 'user_id'
        ),
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'user_id'
        )
    ); 

    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'ユーザー名を入力してください'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'このユーザー名は既に登録されています'
            )
        ),
        'email' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Eメールを入力してください'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'このEメールアドレスは既に登録されています'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'パスワードを入力してください'
            )
        )
    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
        }
        return true;
    }

    public function createTempPassword($len) {
          $pass = '';
          $lchar = 0;
          $char = 0;
          for($i = 0; $i < $len; $i++) {
             while($char == $lchar) {
                $char = rand(48, 109);
                if($char > 57) $char += 7;
                if($char > 90) $char += 6;
             }
                $pass .= chr($char);
                $lchar = $char;
             }
         return $pass;
    } 

}
