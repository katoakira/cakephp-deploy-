<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
    <title>まーけっと</title>
	<?php
//		echo $this->Html->meta('icon');

        // jQuery CDN
        echo $this->Html->script('//code.jquery.com/jquery-1.10.2.min.js');

        // Twitter Bootstrap 3.0 CDN
        echo $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css');
        echo $this->Html->script('//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js');
        echo $this->Html->meta(array('name' => 'viewport',  'content' => "width=device-width"));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body style="padding-top: 70px;">
    <div id="container">
    <!--<div class="row">-->
		<div id="header">
            <nav class="navbar navbar-fixed-top col-sm-12" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/02_cakephp/">まーけっと</a>
                </div>
               <!-- <div class="navbar-collapse collapse">-->
                    <ul class="nav navbar-nav navbar-collapse pull-right">
                        <?php if($user): ?>
                            <li>
                                <?php
                                    echo $this->Html->link('ログアウト', 
                                        array('controller' => 'users', 'action' => 'logout')
                                      );
                                 ?>
                            </li>
                            <li>
                                <a href="#"><?php echo sprintf("ようこそ %s さん", $user['username']); ?></a>
                            </li>
                        <?php else: ?>
                            <li>
                                <?php 
                                    echo $this->Html->link('ログイン',
                                        array('controller' => 'users', 'action' => 'login')
                                    );
                                 ?>
                            </li>
                            <li>
                                <?php
                                    echo $this->Html->link('新規登録', 
                                        array('controller' => 'users', 'action' => 'add')
                                    ); 
                                ?>
                            </li>
                        <?php endif; ?>
                    </ul>     
                <!--</div>-->
            </nav> 
        </div>

		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
        </div>
        </div>
	</div>
	<?php // echo $this->element('sql_dump'); ?>
</body>
</html>
