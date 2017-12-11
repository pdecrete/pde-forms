<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use dosamigos\switchinput\SwitchBox;

?>
<div class="form-digital-signature-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-3">
            <?=
            $form->field($model, 'period_in')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Επιλέξτε μήνα'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'startView' => 'year',
                    'minViewMode' => 'months',
                    'format' => 'mm-yyyy'
                ]
            ]);

            ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'organisation_type')->dropDownList(\app\models\FormDigitalSignature::selectableChoices('organisation_type')) ?>
        </div>
        <div class="col-md-5">
            <?php
            $with_subm = \app\models\FormDigitalSignature::selectableChoices('organisation');
            $core_data = \app\models\FormDigitalSignature::selectables();
            $organisations = array_merge($with_subm, $core_data);

            ?>
            <?= $form->field($model, 'organisation')->dropDownList($organisations, ['prompt' => 'Επιλέξτε...']) ?>
        </div>
    </div>

    <div class="row">
        <h2>Υπεύθυνος υποβολής στοιχείων</h2>
        <div class="col-md-5">
            <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <h2>Αναπληρωτής υποβολής στοιχείων</h2>
        <div class="col-md-5">
            <?= $form->field($model, 'substitute_fullname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'substitute_email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'substitute_phone')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?=
            $form->field($model, 'published')->widget(SwitchBox::className(), [
                'options' => [
                    'label' => '',
                ],
                'clientOptions' => [
                    'onColor' => 'success',
                    'onText' => 'ΝΑΙ',
                    'offColor' => 'danger',
                    'offText' => 'ΟΧΙ',
                ]
            ]);

            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'employees_sign')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'employees_sign_digital')->textInput(['type' => 'number']) ?>
        </div>
    </div>

    <div class="row">
        <?php // $form->field($model, 'training_action')->textInput(['maxlength' => true])?>
        <?= $form->field($model, 'training_action')->dropDownList(\app\models\FormDigitalSignature::selectableChoices('training_action')) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'training_action_other')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'employees_trained')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'procedures_digital')->textInput(['type' => 'number']) ?>
        </div>
    </div>

    <div class="row">
        <?= $form->field($model, 'procedures_titles')->textarea(['rows' => 5]) ?>
    </div>

    <div class="row">
        <div class="form-group">
            <?= Html::submitButton('Αποθήκευση', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Άκυρο', ['new'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
