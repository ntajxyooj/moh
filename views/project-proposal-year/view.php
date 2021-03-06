<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\ProjectProposal;
use app\models\SubmittionDeadLine;
use app\models\AttachFile;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectProposalYear */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ສະເຫນີໂຄງການ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-proposal-year-view">
<?php
$deadline=SubmittionDeadLine::find()->where('dead_line>="'.$model->submit_year.date('-m-d').'"')->andWhere(['current_year'=>$model->submit_year])->one();
if (!empty($deadline)) {
    ?>
    <p align="right">
        <?= Html::a(Yii::t('app', 'ແກ້​ໄຂ'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'ລຶບ'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php
}
?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'submit_year',
            [  
                'label' => Yii::t('app','ວັນ​ທີ່'),
                'value' => date("Y-m-d",strtotime($model->date)),
            ],
            [  
                'label' => Yii::t('app','ພະ​ແນກ'),
                'value' => $model->department->department_name,
            ],
        ],
    ]) ?>
    
    <?php
    $listproposals=ProjectProposal::find()->where(['project_proposal_year_id'=>$model->id])->all();
    ?>
    <div class="row">
    <div class="col-md-12">
        <div class="contacts table-responsive">
            <label><?=Yii::t('app','ລາຍ​ການໂຄງ​ການ​ທັງ​ໝົດ')?></label>
            <table class="table tab-content">
                <tr style="background:#eff5f5">
                    <td></td>
                    <th><?=Yii::t('app','ຊື່​​ໂຄງ​ການ')?></th>
                    <th><?=Yii::t('app','ສະ​ຖາ​ນະ')?></th>
                    <th><?=Yii::t('app','​ປີ​ເລີ່ມ')?></th>
                    <th><?=Yii::t('app','​ປີ​ສີ້ນ​ສຸດ')?></th>
                    <th><?=Yii::t('app','​ຈຳ​ນວນ​ເງີນ/​ລ້ານ​ກີບ')?></th>
                    <th></th>
                </tr>
                <?php
                    if (!empty($listproposals)) {
                        $i=0;
                        foreach ($listproposals as $proposal) {
                            $i++;
                            ?>
                <tr>
                    <td><?=$i?></td>
                    <td><?=$proposal->project_name?></td>
                    <td><?=$proposal->code_old_project?></td>
                    <td><?=$proposal->start_year?></td>
                    <td><?=$proposal->end_year?></td>
                    <td><?=number_format($proposal->amount,2)?></td>
                    <td align="right">
                    <?php
                    $attach=AttachFile::find()->where(['project_proposal_id'=>$proposal->id])->one();
                   if (!empty($attach)) {
                       echo yii\helpers\Html::a("<span class='glyphicon glyphicon-download'></span>", ['downloadfile','name'=>$attach->name], [
                        
                        'class'=>'btn btn-like btn-sm ls-modal',
                       // 'id'=>'jobPop'
                    ]);
                   }
                   if (!empty($deadline)) {
                       echo yii\helpers\Html::a("<span class='	glyphicon glyphicon-paperclip'></span>", '#', [
                            'onclick' => "
                                    $.ajax({
                                    type     :'GET',
                                    cache    : false,
                                    url  : 'index.php?r=project-proposal-year/uploadfile&id=".$proposal->id."&prid=".$model->id."',
                                    success  : function(response) {
                                    $('#edit_file').html(response);
                                    }
                                    });return false;",
                            'class'=>'btn btn-like btn-sm ls-modal',
                           // 'id'=>'jobPop'
                        ]);
                   }

                   if (!empty($attach)) {
                    echo yii\helpers\Html::a("<span class='glyphicon glyphicon-remove'></span>", ['deletefile','id'=>$attach->id,'prid'=>$model->id], [
                     
                     'class'=>'btn btn-like btn-sm ls-modal',
                    // 'id'=>'jobPop'
                 ]);
                }

                        ?>
                    </td>
                </tr>
                <?php
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</div>

<div id="edit_file"></div>
