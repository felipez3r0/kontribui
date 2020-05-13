<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'Kontribui';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">

    <?= $this->Html->css('milligram.min.css') ?>
    <?= $this->Html->css('custom-styles.css') ?>
    <?= $this->Html->css('select2/css/select2.min.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="/"><img src="/img/kontribui.svg" alt="Kontribui"></a>
        </div>
        <div class="top-nav-links">
            <?= $this->Html->link(__('Projects'), ['controller'=>'projects','action' => 'index']) ?>
            <?= $this->Html->link(__('Parts'), ['controller'=>'parts','action' => 'index']) ?>
            <?= $this->Html->link(__('Donations'), ['controller'=>'donations','action' => 'index']) ?>
            <?= $this->Html->link(__('Areas'), ['controller'=>'areas','action' => 'index']) ?>
            <?= $this->Html->link(__('Groups'), ['controller'=>'groups','action' => 'index']) ?>
            <?= $this->Html->link(__('Users'), ['controller'=>'users','action' => 'index']) ?>
            <?= $this->Html->link(__('Profiles'), ['controller'=>'profiles','action' => 'index']) ?>
             | 
            <a href="/users/logout">Sair (X)</a>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
    <script
			  src="https://code.jquery.com/jquery-3.5.0.min.js"
			  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
			  crossorigin="anonymous"></script>
    <?= $this->Html->script('select2/js/select2.min.js') ?>
    <script>$(document).ready(function() {$('.select2').select2();});</script>
</body>
</html>
