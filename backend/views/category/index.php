<?php

use common\models\Constant;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?= Html::a(Yii::t('app', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>


                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            [
                                'class' => 'yii\grid\CheckboxColumn',
                            ],
                            [
                                'class' => 'yii\grid\SerialColumn'
                            ],
                            [
                                'attribute' => 'parent_id',
                                'value' => function ($model) {
                                    return ($model->parentCategory) ? $model->parentCategory->name : Null;
                                }
                            ],
                            'code',
                            'name',
                            [
                                'attribute' => 'name',
                                'value' => function ($model) {
                                    if ($model->is_featured) {
                                        return Constant::MarkFeatured($model->name);
                                    }
                                    return $model->name;
                                },
                                'format' => 'raw'
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    return Constant::getTextFromArray(Constant::DefaultStatus(), $model->status);
                                },
                                'filter' => Html::activeDropDownList(
                                    $searchModel, 'status', Constant::DefaultStatus(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]
                                ),
                            ],
                            //'availability',
                            //'owner_id',
                            //'created_by',
                            //'updated_by',
                            //'created_at',
                            //'updated_at',

                            ['class' => 'hail812\adminlte3\yii\grid\ActionColumn'],
                        ],
                        'summaryOptions' => ['class' => 'summary mb-2'],
                        'pager' => [
                            'class' => 'yii\bootstrap4\LinkPager',
                        ]
                    ]); ?>

                    <?php Pjax::end(); ?>

                </div>
                <!--.card-body-->
            </div>
            <!--.card-->
        </div>
        <!--.col-md-12-->
    </div>
    <!--.row-->
</div>
