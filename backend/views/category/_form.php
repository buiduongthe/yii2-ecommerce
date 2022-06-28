<?php

use backend\models\Category;
use common\models\Constant;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'parent_id')->dropdownList(
                ArrayHelper::map(Category::find()->all(), 'id', 'name'),
                [
                    'prompt' => 'Select Category',
                ],
            ) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'code')->textInput() ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'is_featured')->checkbox([
                'template' => '<div class="icheck-success">{input}{label}{error}</div>',
                'labelOptions' => [
                    'class' => ''
                ],
                'uncheck' => null,
                'checked' => false,
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'status')->dropdownList(
                [
                    Constant::STATUS_DEFAULT_ACTIVE => Constant::STATUS_DEFAULT_ACTIVE,
                    Constant::STATUS_DEFAULT_INACTIVE => Constant::STATUS_DEFAULT_INACTIVE,
                ]
            ) ?>
        </div>
        <div class="col-md-2">
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
