<!-- 商品一覧TOP -->
<div class="container">
   <div class="row">
        <div class="col-sm-12 col-xs-12">
            <h4 style="text-align: center">つかいかた</h4>
            <p>１：出品</p>
            <p>２：コメント欄で話し合い</p>
            <p>３：成立</p>
            <p>４：「取引場所」で受け渡し</p>
            <h5 style="text-align: center">いらなくなったもの、自分がまとめたノートなどを出品してみよう</h5>
        <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3 col-xs-12">
            <h3>カテゴリー一覧</h3>
            <ul class="list-group">
            <?php foreach ($categories as $category): ?>
                <li class="list-group-item">
                    <?php echo $this->Html->link(
                        $category['Category']['name'],
                            array(
                                'controller' => 'posts',
                                'action' => 'categoryIndex',
                                $category['Category']['id']
                            )
                        );
                    ?>
                </li>
            <?php endforeach; ?>
            </ul>
            <?php unset($category); ?>
            
            <hr>

            <?php
                echo $this->Form->create('Post',
                    array(
                        'controller' => 'posts',
                        'action' => 'index',
                        'type' => 'post',
                        'class' => 'form-group'
                    )
                );
            ?>
            <div class="input-group">
                <?php
                    echo $this->Form->input('search_word', array(
                        'label' => false,
                        'placeholder' => '文字を入力してください',
                        'class' => 'form-control'
                        ));
                ?>
                <span class="input-group-btn">
                   <?php echo $this->Form->submit('検索', array('class' => 'btn btn-primary')); ?>
                </span>
            <?php echo $this->Form->end();?>
            </div>
            <hr>

            <?php
                echo $this->Html->link(
                    '出品',
                    array(
                        'controller' => 'posts',
                        'action' => 'add'
                    ),
                    array(
                        'class' => 'btn btn-warning col-sm-12 col-xs-12',
                        'style' => 'width: 100%'
                    )
                );
            ?>
        </div>

        <div class="col-sm-9 col-xs-12">
            <h2>
                一覧
                <div class="btn-group pull-right">
                    <?php
                        echo $this->Paginator->sort('Post.price', '価格安い順', array(
                            'class' => 'btn btn-primary',
                            'role' => 'button'
                        ));
                     ?>
                    <?php 
                        echo $this->Paginator->sort('Post.created', '新着順', array(
                            'class' => 'btn btn-primary',
                            'role' => 'button',
                            'direction' => 'desc'
                        ));
                    ?>
                </div>
            </h2>
            <hr>                
            <?php foreach ($posts as $post): ?>
                <ul style="list-style: none;" class="thumbnails disp-inBlock col-sm-12">
                    <div class="col-sm-12 thumbnail" style="height: 100%; width: 100%; text-overflow: ellipsis">
                            <div class="col-sm-12 col-xs-12">
                                <li>
                                    <?php
                                        echo $this->Html->link(
                                           '編集',
                                           array('action' => 'edit', $post['Post']['id']),
                                           array('class' => ' btn btn-success pull-right')
                                        );
                                    ?>
                                    <?php
                                         echo $this->Form->postLink(
                                             '削除',
                                             array('action' => 'delete', $post['Post']['id']),
                                             array(
                                                 'confirm' => '削除してもよろしいですか？',
                                                 'class' => 'btn btn-danger pull-right'
                                             )
                                         );
                                    ?>
                                </li>
                                <li>
                                   <h3 style="height: 100%; overflow: hidden; width: 100%; text-overflow: ellipsis; white-space: nowrap;">
                                       <?php
                                           echo $this->Html->link(
                                               $post['Post']['title'],
                                                   array(
                                                       'controller' => 'posts',
                                                       'action' => 'view',
                                                       $post['Post']['id']
                                                   )
                                               );
                                       ?>
                                   </h3>
                                </li> 
                            </div>
                            <div class="col-sm-5 col-xs-12">  
                                <li style="height: 100%; width: 100%; text-overflow: ellipsis">
                                   <?php
                                        echo $this->Upload->uploadImage($post['Post'],'Post.img',
                                            array('style' => 'thumb'),
                                            array('url' => array(
                                                'controller' => 'posts',
                                                'action' => 'view',
                                                $post['Post']['id']))
                                        );
                                    ?> 
                                </li>
                            </div>
                            <div class="col-sm-7 col-xs-12">
                                <li style="height: 100%; overflow: hidden; width: 100%; text-overflow: ellipsis; white-space: nowrap;">
                                投稿者名：<?php echo h($post['Post']['name']); ?>
                                </li>
                                <li style="height: 100%; overflow: hidden; width: 100%; text-overflow: ellipsis; white-space: nowrap;">
                                カテゴリー：<?php echo h($post['Category']['name']); ?>
                                </li>
                                <li style="height: 100%; overflow: hidden; width: 100%; text-overflow: ellipsis; white-space: nowrap;">
                                価格：<?php echo h($post['Post']['price']); ?>円
                                </li>
                                <li style="height: 100%; overflow: hidden; width: 100%; text-overflow: ellipsis; white-space: nowrap;">
                                取引場所：<?php echo h($post['Post']['place']); ?>
                                </li>
                                <li style="height: 100%; overflow: hidden; width: 100%; text-overflow: ellipsis; white-space: nowrap;">
                                最終更新日時：<?php echo h($post['Post']['modified']); ?>
                                </li>
                                <li>紹介文</li>
                                <li style="height: 100%; overflow: hidden; white-space: nowrap; width: 100%; text-overflow: ellipsis;"><?php echo h($post['Post']['body']); ?></li> 
                            </div>
                    </div>
                </ul>
            <?php endforeach; ?>
            <?php unset($post); ?>
           
            <br clear="all">
            <hr>
            
            <div class="pagination" style="">
                <?php 
                        echo $this->Paginator->prev('< 前へ', array(), null, array('class' => 'prev disabled'));
                    echo $this->Paginator->numbers(array('separator' => '')); 
                    echo $this->Paginator->next('次へ >', array(), null, array('class' => 'next disabled'));
                ?>
                <br>
                <?php
                     echo $this->Paginator->counter(array('format' => '全%count%件' ));
                     echo $this->Paginator->counter(array('format' => '{:page}/{:pages}ページを表示'));
                ?>
            </div>
        </div>
        </div>
    </div>
</div>
