<?php
    echo $this->Form->create('User', array('action' => 'forgotpassword'));
    echo $this->Form->input('email', array('label' => '', 'placeholder' => 'Eメールを入力してください'));
    echo $this->Form->submit('パスワード再発行');
    echo $this->Form->end();
?>

