<?php

use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FormDigitalSignatureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Στοιχεία χρήσης ψηφιακών υπογραφών';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="form-digital-signature-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?=
        Html::button(Html::icon('save') . ' Εξαγωγή σε CSV', [
            'class' => 'btn btn-primary',
            'data' => [
                'toggle' => 'modal',
                'target' => '#select-period-modal',
            ],
        ])

        ?>
    </p>
    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            // 'organisation_type',
            [
                'attribute' => 'organisation',
                'filter' => app\models\FormDigitalSignature::selectables()
            ],
            [
                'attribute' => 'period',
                'value' => 'period_in'
            ],
            'fullname',
            'email:email',
            'phone',
            // 'substitute_fullname',
            // 'substitute_email:email',
            // 'substitute_phone',
            // 'published',
            [
                'label' => 'Σύνοψη',
                'value' => function ($m) {
                    return $m->employees_sign_digital . ' / ' . $m->employees_sign;
                }
            ],
//            [
//                'attribute' => 'employees_sign',
//                'label' => 'Δικαίωμα υπογραφής',
//            ],
//            [
//                'attribute' => 'employees_sign_digital',
//                'label' => 'Έχουν ψηφιακή υπογραφή',
//            ],
            // 'training_action',
            // 'training_action_other',
            // 'employees_trained',
            // 'procedures_digital',
            // 'procedures_titles',
            // 'created_at',
            // 'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

    ?>
    <?php Pjax::end(); ?>
</div>

<?php
Modal::begin([
    'id' => 'select-period-modal',
    'header' => '<h3>Επιλέξτε μήνα αναφοράς</h3>',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]
]);

$form = ActiveForm::begin([
        'id' => 'period-form',
        'method' => 'POST',
        'action' => [
            'export',
        ],
        'options' => ['class' => 'form-horizontal'],
        'enableClientValidation' => false,
    ]);

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6"><label class="control-label">Επιλέξτε περίοδο</div>
        <div class="col-sm-6">
            <?=
            DatePicker::widget([
                'name' => 'FormDigitalSignatureSearch[period_in]',
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
    </div>
    <div class="row">
        <p>&nbsp;</p>
    </div>
    <div class="row">
        <div class="col-sm-12 text-right">
            <div class="form-group">
                <?=
                Html::button('Άκυρο', [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'toggle' => 'modal',
                        'target' => '#select-period-modal',
                    ],
                ])

                ?>
                <?=
                Html::submitButton('Εξαγωγή', [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'toggle' => 'modal',
                        'target' => '#select-period-modal',
                    ],
                ])

                ?>
            </div>
        </div>
    </div>
</div>
<?php
ActiveForm::end();
Modal::end();
