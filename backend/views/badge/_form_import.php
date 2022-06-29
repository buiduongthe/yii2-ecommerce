<?php

use backend\models\BadgeImport;
use common\models\User;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var User $user
 */
$user = \Yii::$app->user->identity;

/* @var $this yii\web\View */
/* @var $model BadgeImport */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="booking-template-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'options' => [
            'id' => 'formImport',
            'data-pjax' => true,
            'autocomplete' => 'off',
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>
    <div class="row">
        <div class="col-md-12"><a class="float-right" href="/templates/Badge.xlsx?<?php echo time() ?>"><i
                        class="fas fa-download"></i>Tải mẫu tập tin Excel</a></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'excelFile')->fileInput(["accept" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'is_confirmed')->checkbox() ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-upload"></i> ' . Yii::t('app', 'Upload'), ['class' => 'btn btn-success float-right ']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs(<<< EOT_JS_CODE
    $(document).ready(function () {
        var formImport = $('#formImport');
        formImport.on('beforeSubmit', function() {
            var data = formImport.serialize();
            $.ajax({
                url: formImport.attr('action'),
                type: 'POST',
                data:  new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                success: function (result) {
                    $.pjax.reload({container: '#grid1'});
                    toastr.success(result.message);
                },
                error: function (xhr) {
                    var jsonResponse = JSON.parse(xhr.responseText);
                    toastr.error(jsonResponse.message);
                }
             });
             return false;
        });
    });
EOT_JS_CODE
    , \yii\web\View::POS_READY);
?>
