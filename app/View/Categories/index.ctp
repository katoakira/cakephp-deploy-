<h1>カテゴリー一覧</h1>
<?php
//    echo $this->Html->link(
//         'カテゴリー追加',
//         array('controller' => 'categories', 'action' => 'add')
//    );
?>
<table>
    <tr>
        <th>ID</th>
        <th>カテゴリー名</th>
        <th>作成日時</th>
        <th>最終更新日時</th>
        <th>アクション</th>
    </tr>

    <?php foreach($categories as $category): ?>
    <tr>
        <td><?php echo $category['Category']['id']; ?></td>
        <td>
            <?php 
                      echo $this->Html->link($category['Category']['name'],
                           array('controller' => 'categories', 'action' => 'view'),
                           (int)$category['Category']['id']); 
            ?>
        </td>
        <td><?php echo $category['Category']['created']; ?></td>
        <td><?php echo $category['Category']['modified']; ?></td>
        <td>
            <?php
                 echo $this->Html->link('編集',
                      array('action' => 'edit', $category['Category']['id']));
                 echo $this->Html->link('削除',
                      array('action' => 'delete', $category['Category']['id']),
                      array('confirm' => '削除してもよろしいですか？')
                  );
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($category); ?>
</table>

