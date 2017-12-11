<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;

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
                <?php
                $with_subm = \app\models\FormDigitalSignature::selectableChoices('organisation');
                $core_data = \app\models\FormDigitalSignature::selectables();
                $organisations = array_merge($with_subm, $core_data);

                ?>
                <?= Html::dropDownList('FormDigitalSignature[organisation]', isset($organisation_name) ? $organisation_name : '', $organisations, ['id' => 'organisation_name', 'class' => 'form-control', 'autoFocus' => true, 'prompt' => 'Επιλέξτε...']) ?>
            </div>
        </div>
        <div class="row"><p>&nbsp;</p></div>
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
                <?= Html::submitButton('Συνέχεια', ['class' => 'btn btn-primary']) ?>
                <?=
                Html::a(Html::icon('question-sign') . ' Δεν βρίσκω το φορέα μου', '#', [
                    'class' => 'btn btn-default',
                    'data' => [
                        'toggle' => 'modal',
                        'target' => '#add-organisation-modal',
                    ],
                ])

                ?>
                <?php // Html::a('Δεν βρίσκω το φορέα μου', ['add-organisation'], ['class' => 'btn btn-default'])  ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
Modal::begin([
    'id' => 'add-organisation-modal',
    'header' => '<h3>Νέος φορέας;</h3>',
]);

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <p>Η εφαρμογή δέχεται στοιχεία από συγκεκριμένους φορείς. 
                Εάν ο φορέας σας δεν είναι διαθέσιμος, παρακαλώ επικοινωνήστε μαζί μας.</p>
        </div>
    </div>
    <div class="row">
        <p>&nbsp;</p>
    </div>
    <div class="row">
        <div class="col-sm-12 text-right">
            <div class="form-group">
                <?=
                Html::a('ΟΚ', '#', [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'toggle' => 'modal',
                        'target' => '#add-organisation-modal',
                    ],
                ])

                ?>
            </div>
        </div>
    </div>
</div>
<?php
Modal::end();
