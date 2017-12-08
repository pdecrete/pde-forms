<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FormSelectParameters */

$this->title = 'Νέο στοιχείο λίστας τιμών';
$this->params['breadcrumbs'][] = ['label' => 'Λίστες τιμών', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="form-select-parameters-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])

    ?>

</div>
