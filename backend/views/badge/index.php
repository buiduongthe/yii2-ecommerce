<?php

use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\BadgeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Badges');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <?= Html::button('<i class="fas fa-plus"></i> ' . Yii::t('app', 'Add'), ['value' => '/badge/create', 'id' => 'btnAdd', 'class' => 'btn btn-success float-right m-1', 'data-toggle' => "modal", 'data-target' => "#modal"]) ?>
                                <?= Html::button('<i class="fas fa-upload"></i> ' . Yii::t('app', 'Upload'), ['value' => '/badge/import', 'id' => 'btnUpload', 'class' => 'btn btn-primary float-right m-1', 'data-toggle' => "modal", 'data-target' => "#modal"]) ?>
                                <?= Html::button('<i class="fas fa-trash"></i> ' . Yii::t('app', 'Delete'), ['value' => '/badge/delete', 'id' => 'btnDelete', 'class' => 'btn btn-danger float-right m-1', 'data-toggle' => "modal", 'data-target' => "#modal"]) ?>
                            </div>
                        </div>
                        <?php Pjax::begin([
                            'id' => "grid1"
                        ]); ?>
                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'id' => "gridBadge",
                            'columns' => [
                                [
                                    'class' => 'yii\grid\SerialColumn'
                                ],
                                [
                                    'class' => 'yii\grid\CheckboxColumn',
                                ],
                                'name',
                                'color',
                                'class',
                                'status',
                                //'availability',
                                //'owner_id',
                                //'created_by',
                                //'updated_by',
                                //'created_at',
                                //'updated_at',

                                [
                                    'class' => 'hail812\adminlte3\yii\grid\ActionColumn',
                                    'template' => '{view} {update} {delete}',
                                    'buttons' => [
                                        'view' => function ($url, $model) {
                                            return Html::a('<span class="fas fa-eye"></span>', "#", ['value' => $url, 'class' => 'rowView']);
                                        },
                                        'update' => function ($url, $model) {
                                            return Html::a('<span class="fas fa-pencil-alt"></span>', "#", ['value' => $url, 'class' => 'rowUpdate']);
                                        },
                                        'delete' => function ($url, $model) {
                                            return Html::a('<span class="fas fa-trash"></span>', "#", ['value' => $url, 'class' => 'rowDelete']);
                                        },
                                    ]
                                ],
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
<?php
Modal::begin([
    'id' => 'modal',
    'title' => '',
    'headerOptions' => [
        'class' => 'bg-violet'
    ],
    'options' => [
        'style' > "overflow:hidden;",
        'tabindex' => false
    ],
    'clientOptions' => [
        'backdrop' => false
    ]
]); ?>
    <div id='modal-body'>
    </div>
<?php
Modal::end();
?>
<?php
$AddBadge = Yii::t('app', 'Add Badge');
$UpdateBadge = Yii::t('app', 'Update Badge');
$ViewBadge = Yii::t('app', 'View Badge');
$UploadBadge = Yii::t('app', 'Upload Badge');
$DeleteBadge = Yii::t('app', 'Delete Badge');
$this->registerJs(<<< EOT_JS_CODE
    $(document).ready(function () {
    
        $("body").on("click", "#btnAdd", function(event){
            event.preventDefault();
            let url = $(this).val();
            $("#modal-body").html();
            $(".modal-dialog").removeClass('modal-sx').addClass('modal-xl');
            $("#modal").modal("show"); 
            $("#modal-label").html("$AddBadge");
            $.ajax({
                url: url,
                type: 'GET',
                data: {},
                success: function (result) {
                    $("#modal-body").html(result);
                },
                error: function (xhr, jqXHR, errMsg) {
                    let jsonResponse = JSON.parse(xhr.responseText);
                    toastr.error(jsonResponse.message);
                }
            });
            return false;
        });
        
        $("body").on("click", ".rowView", function(event){
            event.preventDefault();
            let url = $(this).attr("value");
            $("#modal-body").html('');
            $(".modal-dialog").removeClass('modal-sx').addClass('modal-xl');
            $("#modal").modal("show");
            $("#modal-label").html("$ViewBadge");
            $.ajax({
                url: url,
                type: 'GET',
                data: {},
                success: function (result) {
                    $("#modal-body").html(result)
                },
                error: function (xhr, jqXHR, errMsg) {
                    let jsonResponse = JSON.parse(xhr.responseText);
                    toastr.error(jsonResponse.message);
                }
            });
            return false;
        });
        
        $("body").on("click", ".rowUpdate", function(event){
            event.preventDefault();
            let url = $(this).attr("value");
            $("#modal-body").html('');
            $(".modal-dialog").removeClass('modal-sx').addClass('modal-xl');
            $("#modal").modal("show");
            $("#modal-label").html("$UpdateBadge");
            $.ajax({
                url: url,
                type: 'GET',
                data: {},
                success: function (result) {
                    $("#modal-body").html(result)
                },
                error: function (xhr, jqXHR, errMsg) {
                    let jsonResponse = JSON.parse(xhr.responseText);
                    toastr.error(jsonResponse.message);
                }
            });
            return false;
        });
        
        $("body").on("click", "#btnUpload", function(event){
            event.preventDefault();
            let url = $(this).val();
            $("#modal-body").html();
            $(".modal-dialog").removeClass('modal-xl').addClass('modal-sx');
            $("#modal").modal("show"); 
            $("#modal-label").html("$UploadBadge");
            $.ajax({
                url: url,
                type: 'GET',
                data: {},
                success: function (result) {
                    $("#modal-body").html(result);
                },
                error: function (xhr, jqXHR, errMsg) {
                    let jsonResponse = JSON.parse(xhr.responseText);
                    toastr.error(jsonResponse.message);
                }
            });
            return false;
        });
        
        $("body").on("click", "#btnDelete", function(event){
            event.preventDefault();
            let url = $(this).val();
            $("#modal-body").html();
            $(".modal-dialog").removeClass('modal-xl').addClass('modal-sx');
            $("#modal").modal("show"); 
            $("#modal-label").html("$DeleteBadge");
            $.ajax({
                url: url,
                type: 'GET',
                data: {},
                success: function (result) {
                    $("#modal-body").html(result);
                },
                error: function (xhr, jqXHR, errMsg) {
                    let jsonResponse = JSON.parse(xhr.responseText);
                    toastr.error(jsonResponse.message);
                }
            });
            return false;
        });
       
    });
EOT_JS_CODE
    , \yii\web\View::POS_READY);

