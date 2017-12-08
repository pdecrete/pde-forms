<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Εισαγωγή νέου φορέα';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="add-organisation-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $form = ActiveForm::begin([
            'id' => 'add-organisation-form',
            'method' => 'POST',
            'enableClientValidation' => false
    ]);

    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <?= Html::label('Ονομασία του φορέα', 'organisation_name') ?>
            </div>
            <div class="col-md-8">
                <?= Html::textInput('FormDigitalSignature[organisation]', isset($organisation_name) ? $organisation_name : '', ['id' => 'organisation_name', 'class' => 'form-control', 'autoFocus' => true]) ?>
            </div>
        </div>
        <div class="row"><p>&nbsp;</p></div>
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
                <?= Html::submitButton('Συνέχεια', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Επιστροφή', ['new'], ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
