<?php

use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FormDigitalSignature */

$this->title = 'Υποβολή στοιχείων';
$this->params['breadcrumbs'][] = ['label' => 'Στοιχεία χρήσης ψηφιακών υπογραφών', 'url' => ['new']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="form-digital-signature-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])

    ?>

</div>
