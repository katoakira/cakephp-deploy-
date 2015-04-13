<h1>カテゴリー編集</h1>
<?php 
    echo $this->Form->create('Category');
    echo $this->Form->input('name');
    echo $this->Form->end(__('編集'));
?>
