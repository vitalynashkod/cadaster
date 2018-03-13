<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cadaster */

$this->title = 'Update Cadaster: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Cadasters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cadaster-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
