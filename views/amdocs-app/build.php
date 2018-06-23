<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Build';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="amdocs-app-build">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Build page. You can see here your prepared script ready to be executed: <br><br>
        <?php echo $script; ?>
    </p>
</div>

