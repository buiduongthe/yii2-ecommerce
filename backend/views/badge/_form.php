<?php

use common\models\Constant;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Badge */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="badge-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'options' => [
            'id' => 'formBadge',
            'data-pjax' => true,
            'autocomplete' => 'off'
        ]
    ]); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'class')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropdownList(
                [
                    Constant::STATUS_DEFAULT_ACTIVE => Constant::STATUS_DEFAULT_ACTIVE,
                    Constant::STATUS_DEFAULT_INACTIVE => Constant::STATUS_DEFAULT_INACTIVE,
                ]
            ) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'availability')->dropdownList(
                Constant::DefaultAvailability()
            ) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success float-right']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$this->registerJs(<<< EOT_JS_CODE
    $(document).ready(function () {
        var formBadge = $('#formBadge');
        formBadge.on('beforeSubmit', function() {
            var data = formBadge.serialize();
            $.ajax({
                url: formBadge.attr('action'),
                type: 'POST',
                data: data,
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

