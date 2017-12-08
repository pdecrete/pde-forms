<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FormSelectParametersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Λίστες τιμών';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="form-select-parameters-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Νέα τιμή', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'form',
                'value' => function ($m) {
                    $parts = explode('\\', $m->form);
                    return end($parts);
                },
                'filter' => array_combine(Yii::$app->params['forms'], Yii::$app->params['forms'])
            ],
            'field',
            'identity',
            'label',
            // 'created_at',
            // 'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

    ?>
    <?php Pjax::end(); ?></div>
