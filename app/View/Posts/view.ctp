<div class="container">
<div class="row">
    <div class="col-sm-12 col-xs-12">
        <h1 style="word-wrap: break-word;"><?php echo h($post['Post']['title']); ?></h1>
    </div>
</div>
<div class="row">
        <div class="col-sm-7 col-xs-12">
            <p><?php echo $this->Upload->uploadImage($post['Post'], 'Post.img', array('style' => 'big')); ?></p>
        </div> 
        <div class="col-sm-5 col-xs-12">
            <p>カテゴリー名：<?php echo h($post['Category']['name']); ?></p>
            <p>投稿者名：<?php echo h($post['User']['username']); ?></p>
            <p>価格：<?php echo $post['Post']['price']; ?>円</p>
            <p>最終更新日時：<?php echo $post['Post']['modified']; ?></p>
        </div>

        <div class="col-sm-12 col-xs-12">
            <p>紹介文</p>
            <p><?php echo h($post['Post']['body']); ?></p>
            <hr>
            <?php 
                echo $this->Form->create('Comment',array(
                    'class' => 'form-group'
                ));
            ?>
            <div class="input-group">
                <?php
                    echo $this->Form->input('body', array(
                        'style' => 'height: 40px',
                        'label' => false,
                        'placeholder' => 'コメントを入力してください',
                        'class' => 'form-control'));
                ?>
                <span class="input-group-btn">
                <?php
                    echo $this->Form->submit('送信', array(
                        'class' => 'btn btn-primary'
                    ));
                ?>
                </span>
                </div>
                <?php echo $this->Form->end(); ?>
          
            <hr>
            
            <?php foreach($post['Comment'] as $comments): ?>
            <ul style="list-style: none;">
                <li>
                <?php if($user): ?>
                    <?php if($user['id'] == $comments['user_id']): ?>
                        <div class="popover left show" style="position: relative; max-width:100%;">
                        <div class="arrow"></div>
                           <p class="popover-title">
                           <small><?php echo $comments['created']; ?></small>
                                By
                               <?php echo $comments['username']; ?>
                           </p>
                           <p class="popover-content"><?php echo $comments['body']; ?></p>
                        </div>
                    <?php else: ?>
                         <div class="popover right show" style="position: relative; max-width:100%;">
                         <div class="arrow"></div>
                            <p class="popover-title">
                            <small><?php echo $comments['created']; ?></small>
                                By
                                <?php echo $comments['username']; ?>
                            </p>
                            <p class="popover-content"><?php echo $comments['body']; ?></p>
                         </div>
                    <?php endif; ?>
                <?php else: ?>
                <?php endif; ?>   
                </li>
            </ul>
            <?php endforeach; ?>
            
            <hr> 
            
            <?php 
                echo $this->Html->link( $post['Category']['name'] . 'へ戻る', 
                    array('controller' => 'posts', 'action' => 'categoryIndex', $post['Category']['id']),
                    array('class' => 'btn btn-primary pull-left')
                );
            ?>
            <?php 
                echo $this->Html->link('TOPへ戻る',
                    array('controller' => 'posts', 'action' => 'index'),
                    array('class' => 'btn btn-primary pull-right')
                );
            ?>
        </div>
</div>
