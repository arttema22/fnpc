<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\components\ArticleCatalogWidget;
use kartik\switchinput\SwitchInput;

?>

<div class="article-catalog-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <div class="form-group field-articlecatalog-parent_id">
                <label class="control-label" for="articlecatalog-parent_id"><?= Yii::t('admin', 'Category') ?></label>
                <select id="article-parent_id" class="form-control" name="ArticleCatalog[parent_id]">
                    <option value="0"><?= Yii::t('admin', 'Root category') ?></option>
                    <?= ArticleCatalogWidget::widget(['tpl' => 'select', 'model' => $model]) ?>
                </select>
            </div>

            <?= $form->field($model, 's_desc')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'active')->widget(SwitchInput::classname(), []) ?>

            <?= $form->field($model, 'col')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><?= Yii::t('admin', 'Meta tags'); ?></div>
                <div class="panel-body">
                    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
