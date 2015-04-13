<div class="users form">
<h2>パスワードの再発行</h2>
<?php
    echo $this->Form->create('User');
?>
<?php 
    echo $this->Form->input('email', array(
        'placeholder' => 'Eメールを入力してください',
        'label' => 'Eメール'
    ));
?>
<?php 
    echo $this->Form->submit('送信', array(
        'controller' => 'users',
        'action' => 'resetPwd'
    ));
?>
<?php  echo $this->Form->end();?>
