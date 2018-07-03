<?php
/* @var $this yii\web\View */


use yii\helpers\Html;

$this->title = 'Save';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="amdocs-app/save" >

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('scriptSubmitted')): ?>
        <div class="alert alert-success">
            Your script was successfully saved! Stay high!
        </div>

    <?php elseif (Yii::$app->session->hasFlash('scriptValidationFailed')): ?>
        <div class="alert alert-danger">
            One of more of provided script values is not valid. Try again.
        </div>
    <?php else: ?>
        <div class="alert alert-danger">
            Something went wrong, try to return to index page.
        </div>
    <?php endif; ?>
</div>




