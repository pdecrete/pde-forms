<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Επιλογή φορέα';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="add-organisation-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $form = ActiveForm::begin([
            'id' => 'select-organisation-form',
            'method' => 'POST',
            'action' => ['select-organisation'],
            'enableClientValidation' => false
    ]);

    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <?= Html::label('Επιλέξτε το φορέα σας', 'organisation_name') ?>
            </div>
            <div class="col-md-8">
                <?=
                Html::dropDownList('FormDigitalSignature[organisation]', isset($organisation_name) ? $organisation_name : '', ArrayHelper::map($models, 'organisation', 'organisation', 'organisation_type'), ['id' => 'organisation_name', 'class' => 'form-control', 'autoFocus' => true])

                ?>
            </div>
        </div>
        <div class="row"><p>&nbsp;</p></div>
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
                <?= Html::submitButton('Συνέχεια', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Δεν βρίσκω το φορέα μου', ['add-organisation'], ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
