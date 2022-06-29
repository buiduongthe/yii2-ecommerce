<?php

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
                'status',
                'availability',
                'owner_id',
                'created_by',
                'updated_by',
                'created_at',
                'updated_at',
            ],
        ]) ?>
    </div>
    <!--.col-md-12-->
</div>
<!--.row-->