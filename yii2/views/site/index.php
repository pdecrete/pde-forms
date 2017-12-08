<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Συγκέντρωση στοιχείων';

?>
<div class="site-index">

    <?php if ($can_admin) : ?>
        <h1>Διαχειριστικές λειτουργίες</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <p><a class="btn btn-info btn-block" href="<?= Url::to(['form-select-parameters/index']) ?>">Λίστες τιμών <span class="glyphicon glyphicon-list"></span></a></p>
                        <p>Διαχείριση των στοιχείων που επιτρέπεται να συμπληρώνονται στις φόρμες.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <p><a class="btn btn-primary btn-block" href="<?= Url::to(['form-digital-signature/index']) ?>">Στοιχεία ψηφιακών υπογραφών <span class="glyphicon glyphicon-chevron-right"></span></a></p>
                        <p>Προβολή των υποβληθέντων στοιχείων ψηφιακών υπογραφών.</p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <h1>Διαθέσιμες επιλογές</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-body">
                    <p><a class="btn btn-primary btn-block" href="<?= Url::to(['form-digital-signature/new']) ?>">Στοιχεία ψηφιακών υπογραφών <span class="glyphicon glyphicon-chevron-right"></span></a></p>
                    <p>Αφορά τη μηνιαία υποβολή στοιχείων ψηφιακών υπογραφών.</p>
                </div>
            </div>
        </div>
    </div>

</div>
