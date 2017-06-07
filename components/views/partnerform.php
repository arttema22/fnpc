<?php

use yii\bootstrap\ActiveForm;
?>

<section class="well bg-primary">
    <div class="container">
        <div class="block-1">
            <div class="icon">
                <i class="fa fa-envelope"></i>
            </div>
            <h3><?= Yii::t('app', 'For partners'); ?>
                <small><?= Yii::t('app', 'application for partnership'); ?></small>
            </h3>
        </div>
        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'email')->input('email') ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="btn-wr col-sm-12 wow fadeInUp animated" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: fadeInUp;">
                <a class="btn" href="#" data-type="submit">send</a>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</section>
