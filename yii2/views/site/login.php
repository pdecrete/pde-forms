<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Σύνδεση';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <p class="text-info">
        Χρησιμοποιήστε τα στοιχεία εισόδου που σας αποδόθηκαν.
    </p>

    <?php
    $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],
    ]);

    ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?=
        $form->field($model, 'captchavalidation', [
            'template' => "<div class=\"col-lg-offset-2 col-lg-10\">{input} {label}</div>\n<div class=\"col-lg-7 col-lg-offset-2\">{error}</div>",
        ])
        ->widget(\himiklab\yii2\recaptcha\ReCaptcha::className())
        ->label(false)

    ?>

    <?=
    $form->field($model, 'rememberMe')->checkbox([
        'template' => "<div class=\"col-lg-offset-2 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])

    ?>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <?= Html::submitButton('Σύνδεση', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
