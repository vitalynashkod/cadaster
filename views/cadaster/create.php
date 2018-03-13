<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cadaster */

$this->title = 'Create Cadaster';
$this->params['breadcrumbs'][] = ['label' => 'Cadasters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cadaster-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
