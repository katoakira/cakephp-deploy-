<div class="users form">
<div class="container" style="padding:10px 0">
<?php echo $this->Session->flash('auth'); ?>
<?php
    echo $this->Form->create('User',array(
        'inputDefaults' => array(
            'div' => 'form-group',
            'wrapInput' => false,
            'class' => 'form-control'
        ),
        'class' => 'form-horizontal'
    ));
?>
    <fieldset>
        <legend><?php echo __('ユーザー名とパスワードを入力してください'); ?></legend>
            <?php
                echo $this->Form->input('username',
                    array(
                        'label' => 'ユーザー名',
                        'placeholder' => 'ユーザー名を入力してください'
                    )
                );
            ?>
            <?php
                echo $this->Form->input('password',
                    array(
                        'label' => 'パスワード',
                        'placeholder' => 'パスワードを入力してください'
                    )
                );
            ?>
            <?php 
               // echo $this->Html->link('パスワードを忘れた方へ', array(
               //     'controller' => 'users',
               //     'action' => 'resetPwd'
               // ));
               // echo $this->Html->link('パスワードを忘れた方', array(
               //     'controller' => 'users',
               //     'action' => 'forgotPassword'
               // ));
            ?>
    </fieldset>
    <?php echo $this->Form->submit('ログイン', array('class' => 'btn btn-primary pull-left')); ?>              
    <?php
         echo $this->Html->link('戻る',
             array('controller' => 'posts', 'action' => 'index'),
             array('class' => 'btn btn-primary pull-right')
         );
     ?>
    <?php echo $this->Form->end(); ?>
</div>
</div>
