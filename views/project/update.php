<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = Yii::t('app', 'ແກ້​ໄຂ​ໂຄງ​ການ: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '​ໂຄງ​ການ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', '​ແກ້​ໄຂ');
?>
<div class="project-update">
    <?= $this->render('_form', [
        'model' => $model,
        'loan'=>$loan
    ]) ?>

</div>
