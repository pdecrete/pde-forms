<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FormSelectParameters */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="form-select-parameters-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'form')->dropDownList(array_combine(Yii::$app->params['forms'], Yii::$app->params['forms'])) ?>

    <?= $form->field($model, 'field')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'identity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Αποθήκευση', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
