<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FormDigitalSignature */

$this->title = 'Ενημέρωση στοιχείων';
$this->params['breadcrumbs'][] = ['label' => 'Στοιχεία χρήσης ψηφιακών υπογραφών', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->period_in, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="form-digital-signature-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])

    ?>

</div>
