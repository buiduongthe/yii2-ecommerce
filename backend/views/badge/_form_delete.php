<?php

use backend\models\BadgeDelete;
use common\models\User;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Constant;


/**
 * @var User $user
 */
$user = \Yii::$app->user->identity;

/* @var $this yii\web\View */
/* @var $model BadgeDelete */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="badge-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'options' => [
            'id' => 'form',
            'data-pjax' => true,
            'autocomplete' => 'off',
        ]
    ]); ?>
    <div class="row">
        <div class="col-md-12">Bạn chắc chắn xóa những nhãn sản phẩm đã chọn?</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'is_confirmed')->checkbox([
                'template' => '<div class="icheck-purple">{input}{label}{error}</div>',
                'labelOptions' => [
                    'class' => ''
                ],
                'uncheck' => null,
                'checked' => false,
            ])?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-trash"></i> ' . Yii::t('app', 'Delete'), ['class' => 'btn btn-danger float-right ']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs(<<< EOT_JS_CODE
    $(document).ready(function () {
        let Ids = $('#gridBadge').yiiGridView('getSelectedRows');
        let form = $('#form');
        form.on('beforeSubmit', function() {
            var data = form.serializeArray();
            data.push({name:'BadgeDelete[Ids]',value:Ids});
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data:  data,
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
