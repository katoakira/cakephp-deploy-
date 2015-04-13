<div class="users form">
<div class="container" style="padding: 10px 0">
<?php
    echo $this->Form->create('User', array(
        'inputDefaults' => array(
            'div' => 'form-group',
            'wrapInput' => false,
            'class' => 'form-control'
        ),
        'class' => 'form-horizontal'
    ));
?>
    <fieldset>
        <legend><?php echo __('新規登録'); ?></legend>
            <?php
                 echo $this->Form->input('username', array(
                    'label' => 'ユーザー名',
                    'placeholder' => 'ユーザー名を入力してください'
                ));
                 echo $this->Form->input('email', array(
                    'label' => 'Eメール',
                    'placeholder' => 'Eメールを入力してください'
                ));
                 echo $this->Form->input('password', array(
                    'label' => 'パスワード',
                    'パスワードを入力してください'
                ));
                 echo "※「ユーザー名」は出品時の「投稿者名」、コメントする際に記載されるものです"
            ?>
    </fieldset>
    <?php
         echo $this->Form->submit('登録',
           array(
               'class' => 'btn btn-primary pull-left',
               'label' => '登録'
           )
        );
    ?>
    <?php
         echo $this->Html->link('戻る',
             array('controller' => 'posts', 'action' => 'index'),
             array('class' => 'btn btn-primary pull-right')
         );
    ?>
    <?php echo $this->Form->end(); ?>
</div>
</div>
