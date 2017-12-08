<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FormSelectParameters */

$this->title = $model->form . ' - ' . $model->identity;
$this->params['breadcrumbs'][] = ['label' => 'Λίστες τιμών', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="form-select-parameters-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ενημέρωση', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Διαγραφή', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Είστε βέβαιοι για τη διαγραφή;',
                'method' => 'post',
            ],
        ])

        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'form',
            'field',
            'identity',
            'label',
            'created_at_str',
            'updated_at_str',
        ],
    ])

    ?>

</div>
