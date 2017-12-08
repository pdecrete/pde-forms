<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FormDigitalSignature */

$this->title = $model->period_in . '  ' . $model->organisation;
$this->params['breadcrumbs'][] = ['label' => 'Στοιχεία χρήσης ψηφιακών υπογραφών', 'url' => ['new']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="form-digital-signature-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Επιστροφή', ['new'], ['class' => 'btn btn-default']) ?>
        <?php if (true === \Yii::$app->user->identity->is('admin')) : ?>
            <?= Html::a('Τροποποίηση', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Διαγραφή', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Είστε βέβαιοι για τη διαγραφή;',
                    'method' => 'post',
                ],
            ])

            ?>
        <?php endif; ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'period_in',
            'organisation_type',
            'organisation',
            'fullname',
            'email:email',
            'phone',
            'substitute_fullname',
            'substitute_email:email',
            'substitute_phone',
            'published',
            'employees_sign',
            'employees_sign_digital',
            'training_action',
            'training_action_other',
            'employees_trained',
            'procedures_digital',
            'procedures_titles',
            'created_at_str',
            'updated_at_str',
        ],
        'template' => '<tr><th{captionOptions} class="col-md-6">{label}</th><td{contentOptions}>{value}</td></tr>'
    ])

    ?>

</div>
