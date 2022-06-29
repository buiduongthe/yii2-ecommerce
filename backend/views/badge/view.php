<?php

use common\models\Constant;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Badge */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Badges'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="row">
    <div class="col-md-12">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                'color',
                'class',
                [
                    'attribute' => 'status',
                    'value' => Constant::getTextFromArray(Constant::DefaultStatus(), $model->status),
                ],
                [
                    'attribute' => 'availability',
                    'value' => Constant::getTextFromArray(Constant::DefaultStatus(), $model->availability),
                ],
                [
                    'attribute' => 'owner_id',
                    'value' => ($model->owner) ? $model->owner->full_name : "",
                ],
                [
                    'attribute' => 'created_by',
                    'value' => ($model->createdBy) ? $model->createdBy->full_name : "",
                ],
                [
                    'attribute' => 'updated_by',
                    'value' => ($model->updatedBy) ? $model->updatedBy->full_name : "",
                ],
                [
                    'attribute' => 'created_at',
                    'value' => Constant::FormatDateTime($model->created_at),
                ],
                [
                    'attribute' => 'updated_at',
                    'value' => Constant::FormatDateTime($model->updated_at),
                ],
            ],
        ]) ?>
    </div>
    <!--.col-md-12-->
</div>
<!--.row-->