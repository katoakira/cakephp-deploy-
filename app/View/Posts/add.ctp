<div class="container">
<div class="row">
<h1>出品</h1>
    <?php echo $this->Form->create('Post', array('type' => 'file'));?>
    <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
    <?php echo $this->Form->input('name', array('type' => 'hidden')); ?>
    <div class="form-group">
    <?php 
        echo $this->Form->input('title', array(
            'placeholder' => 'タイトルを入力してください',
            'label' => 'タイトル',
            'class' => 'form-control'
        ));
    ?>    
    </div>
    <div class="form-group">
    <?php   
        echo $this->Form->input('category_id',array(
                'type' => 'select',
                'options' => $category,
                'label' => 'カテゴリ選択',
                'class' => 'form-control'
            ));
    ?>
    </div>
    <div class="form-group">
    <?php
        echo $this->Form->input('body', array(
            'placeholder' => '文字を入力してください',
            'label' => '紹介文',
            'class' => 'form-control'
        ));
    ?>
    </div>
    <?php echo $this->Form->file('img', array('label' => '画像')); ?>
    <div class="form-group">
    <?php echo $this->Form->input('price', array('label' => '価格', 'class' => 'form-control')); ?>円
    </div>
    <div class="form-group"> 
    <?php 
        echo $this->Form->input('place',array(
            'placeholder' => '取引場所を入力してください',
            'label' => '取引場所',
            'class' => 'form-control'
        ));
     ?>
    </div>
    <?php
        echo $this->Form->submit('出品',
             array('class' => 'btn btn-primary pull-left')
        );
    ?>
    <?php
        echo $this->Html->link('戻る',
            array('controller' => 'posts', 'action' => 'index'),
            array('class' => 'btn btn-primary pull-right')
        );
    ?>
    <?php echo $this->Form->end();?>
</div>
</div>
