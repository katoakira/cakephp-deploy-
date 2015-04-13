<div class="container">
    <h1>
        <?php echo $category['Category']['name']; ?>
        <div class="btn-group pull-right">
            <?php
                echo $this->Paginator->sort('price', '価格安い順', array(
                    'class' => 'btn btn-primary',
                    'role' => 'button'
                ));
            ?>
            <?php
                echo $this->Paginator->sort('modified', '新着順', array(
                    'class' => 'btn btn-primary',
                    'role' => 'button'
                ));
            ?>
        </div>
    </h1>
    <hr>
    <?php foreach($category['Post'] as $post): ?>
    <ul style="list-style: none;" class="thumbnails dist-inBlock col-sm-12">
        <div class="col-sm-12 thumbnail" style="text-align: left; height: 100%; overflow: hidden; width: 100%; text-overflow: ellipsis; white-space: nowrap;">
            <div class="col-sm-12">
            <li>
                <?php
                    echo $this->Form->postLink(
                         '削除',
                         array('action' => 'delete', $post['id']),
                         array(
                             'confirm' => '削除してもよろしいですか',
                             'class' => 'btn btn-danger pull-right'
                         )
                     );
                ?>
                <?php
                    echo $this->Html->link(
                         '編集',
                         array('action' => 'edit', $post['id']),
                         array('class' => 'btn btn-success pull-right')
                    );
                ?>
            </li>
            <li>               
               <h2 style="height: 100%; overflow: hidden; width: 100%; text-overflow: ellipsis; white-space: nowrap;">
                  <?php 
                       echo $this->Html->link($post['title'],
                       array('controller' => 'posts', 'action' => 'view',$post['id'])
                       );
                   ?>
               </h2>
            </li>
            </div>
            <div class="col-sm-5" style="text-align: center;">
                <li>
                    <?php echo $this->Upload->uploadImage($post, 'Post.img',
                              array('style' => 'small'),
                              array('url' => array(
                                  'controller' => 'posts',
                                  'action' => 'view',
                                  $post['id']))
                          );
                    ?>
                 </li>
            </div>
            <div class="col-sm-7" style="text-align: left"> 
                <li><h4>投稿者名：<?php echo $post['name']; ?></h4></li>
                <li><h4>価格：<?php echo $post['price']; ?>円</h4></li>
                <li><h4>取引場所：<?php echo $post['place']; ?></h4></li>
                <li><h4>最終更新日時：<?php echo $post['modified']; ?></h4></li>
                <li><h4>紹介文</h4></li>
                <li style="height: 50%; overflow: hidden; width: 100%; text-overflow: ellipsis; white-space: nowrap;"><h4><?php echo $post['body']; ?></h4></li>
            </div>
        </div>
    </ul>
    <?php endforeach; ?>
    <?php unset($post); ?>
    
    <br clear="all">
    <hr>
    
    <div class="pagination" style="text-align: center">
        <?php
            echo $this->Paginator->prev('< 前へ', array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ''));
            echo $this->Paginator->next('次へ >', array(), null, array('class' => 'next disabled'));
        ?>
        <br /> 
        <?php
             echo $this->Paginator->counter(array('format' => '全%count%件' )); 
             echo $this->Paginator->counter(array('format' => '{:page}/{:pages}ページを表示'));
        ?>
    </div>
    <?php 
        echo $this->Html->link('戻る',
            array('action' => 'index'),
            array('class' => 'btn btn-primary pull-right')
        );
    ?>
</div>
