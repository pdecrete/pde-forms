<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FormSelectParameters */

$this->title = 'Ενημέρωση στοιχείου λίστας τιμών: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Λίστες τιμών', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Στοιχείο λίστας τιμών', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ενημέρωση';

?>
<div class="form-select-parameters-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])

    ?>

</div>
