<?php

use yii\bootstrap\Html;

$this->title = 'Έχετε υποβάλει ξανά στοιχεία στο παρελθόν;';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="form-digital-signature-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-md-6">

        <div class="panel panel-primary">
            <div class="panel-body">
                <p><?= Html::a('Έχω υποβάλλει ξανά στοιχεία <span class="glyphicon glyphicon-chevron-right"></span>', ['select-organisation'], ['class' => 'btn btn-lg btn-block btn-primary']); ?></p>
                <p>Έχω υποβάλλει ξανά στο παρελθόν στοιχεία και θα επιλέξω τον φορέα για τον οποίο υποβάλλω στοιχεία.</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-success">
            <div class="panel-body">
                <p><?= Html::a('Δεν έχω υποβάλλει ξανά στο παρελθόν στοιχεία <span class="glyphicon glyphicon-chevron-right"></span>', ['add-organisation'], ['class' => 'btn btn-lg btn-block btn-success']); ?></p>
                <p>Δεν έχω υποβάλλει ξανά στο παρελθόν στοιχεία και θα πληκτρολογήσω τα στοιχεία του νέου φορέα.</p>
            </div>
        </div>

    </div>

</div>
