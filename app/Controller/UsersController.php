<?php
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {

    public $components = array('Email');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout', 'resetPwd', 'generatePwd', 'forgotPassword');
    }
    
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('ユーザー名またはパスワードが間違っています。もう一度入力してください。'));
            }
        }
    }
    
    public function logout() {
        $this->redirect($this->Auth->logout());
        $this->Session->setFlash('ログアウトしました');
    }

    public function index() {
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('無効なユーザー'));
        }
        $this->set('user', $this->User->read(null, $id));
    
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('登録しました'));
                $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('登録できません。もう一度入力してください。'));
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('編集できません'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('編集しました'));
                $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('登録できません。もう一度入力してください'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        $this->request->onlyAllow('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('削除できません'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('削除しました'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('削除できません'));
        $this->redirect(array('action' => 'index'));
    }

     public function resetPwd() {
          $this->pageTitle = 'パスワード再発行';
          $this->set('error', false);
          if (!empty($this->data)) {
              $this->recursive = 0;
              $someone = $this->User->findByEmail ($this->data['User']['email']);
              if ($someone) {
                // 新しいパスワードをセット
                $new_pwd = $this->generatePassword ();
                $this->User->id = $someone['User']['id'];
                $this->User->save (array ('pwd' => sha1(PWD_KEY.$new_pwd)) );
                // メールを送る
                $mail_file = VIEWS . 'mail/user_resetPwd.ctp';
                $msg = implode (file($mail_file));
                eval ("\$msg = \"$msg\";");
                $toName = $someone['User']['email'];
                $subject = "新しいパスワードを発行しました";
                mb_send_mail ($toName, $subject, $msg, "From: ".ADMIN_EMAIL);
                // メッセージの書き込み、別ページへリダイレクト
                $this->Session->write ('sys_msg', '新しいパスワードを送りました');
                $this->redirect ('/users/login/');
              } else {
                $this->set('error', true);
              }
          }
    }
    
    public function generatePwd () {
          $len = 8;
          srand ( (double) microtime () * 1000000);
          $seed = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
          $pass = "";
          while ($len--) {
            $pos = rand(0,61);
            $pass .= $seed[$pos];
          }
          return $pass;
    }

     public function forgotPassword() {
        if(!empty($this->data)) {
            $this->User->recursive = 0;
            $user = $this->User->findByEmail($this->data['User']['email']);
            if($user) {
                $user['User']['tmp_password'] = $this->User->createTempPassword (7);
                $user['User']['password'] = $this->Auth->password($user['User']['tmp_password']);
                if ($this->User->save($user, false)) {
                // send a mail to finish the registration
                    $this->Email->to = $this->data['User']['email'];
                    $this->Email->subject = '新しいパスワード';
                //    $this->Email->replyTo = '';
                //    $this->Email->from = '';
                    $this->Email->sendAs = 'text';
                    $this->Email->charset = 'utf-8';
                    $body = "新しいパスワード: {$user['User']['password']}";
                        if ($this->Email->send($body)) {
                            $this->Session->setFlash(__('新しいパスワードが送信されました。', true), 'warning');
                        } else {
                            $this->Session->setFlash(__('送信失敗しました。もう一度確認してください', true), 'error');
                        }
                        $this->redirect(array('controller' => 'users', 'action' => 'login'));
                }
            } else {
               $this->Session->setFlash('ユーザーが見つかりません。');
            }
        }
    }
}
