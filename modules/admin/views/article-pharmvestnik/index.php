<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use app\modules\admin\models\ArticleCatalog;
use kartik\widgets\SwitchInput;
use kartik\checkbox\CheckboxX;

$this->title = Yii::t('admin', 'Pharmvestnik');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(); ?>
<div class="table-responsive">
    <h2><?= Yii::t('admin', 'Pharmvestnik') ?></h2>
    <table class="table table-hover">
        <?php foreach ($settings as $index => $setting) { ?>
            <?php if (!$setting['send']) { ?>
                <tr>
                <?php } else { ?>
                <tr class="success">
                <?php } ?>
                <td>
                    <?= $setting['date']; ?>
                </td>
                <td>    
                    <a href="<?= $setting['url']; ?>" target="_blank"><?= $setting['title']; ?></a>
                    <br>
                    <?= $setting['s_content']; ?>
                </td>
                <td> 
                    <?php if (!$setting['send']) { ?>
                        <?=
                                $form->field($setting, "[$index]catalog_id")->
                                dropdownList(ArticleCatalog::find()->select(['name', 'id'])->
                                        indexBy('id')->column(), ['prompt' => Yii::t('admin', 'Select Category')]);
                        ?>
                        <?= $form->field($setting, "[$index]status")->checkbox(); ?>
                        <?php //= $form->field($setting, "[$index]status")->widget(SwitchInput::classname(), []); ?>
                        <?php //= $form->field($setting, "[$index]status")->widget(CheckboxX::classname(), []);  ?>
                    <?php } else { ?>
                        <small><em><?= Yii::t('admin', 'The article was transferred to the site section') ?></em></small>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>

    </table>
    <?= Html::a(Yii::t('admin', '<span class="badge">1</span> Parsing'), ['parser'], ['class' => 'btn btn-primary']) ?>
    <?= Html::submitButton(Yii::t('admin', '<span class="badge">2</span> Update'), ['class' => 'btn btn-success']); ?>
    <?= Html::a(Yii::t('admin', '<span class="badge">3</span> Send articles'), ['send'], ['class' => 'btn btn-warning']) ?>
</div>
<?php ActiveForm::end(); ?>

<br>
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="label label-info">Info</span>
            Как работать с агрегатором "Фармвестник":
        </h3>
    </div>
    <div class="panel-body">
        <dl>
            <dt>Шаг 1. Собрать статьи.</dt>
            <dd>Первым делом необходимо получить список статей с сайта Фармвестник. Для этого необходимо нажать на кнопку "Собрать статьи".
                Перед Вами появится список всех новых статей с сайта Фармвестник с возможностью перехода к оригинальной статье.</dd>
        </dl>
        <dl>
            <dt>Шаг 2. Сохранить изменения.</dt>
            <dd>Статьи из списка, которые необходимо разместить на собственном сайте необходимо отметить галочкой "Статус" и выбрать
                для них подходящие разделы. Только после этого можно нажать на кнопку "Сохранить изменения".
                Если статья была отмечена ошибочно и еще не был сделан шаг 3, то с нее можно снять отметку "Статус" и снова нажать на кнопку
                "Сохранить изменения".</dd>
        </dl>
        <dl>
            <dt>Шаг 3. Отправить выбранные статьи на сайт.</dt>
            <dd><p class="text-danger">Внимание! Этот шаг отменить нельзя.</p>
                Для того, чтобы выбранные статьи оказались на собственном сайте, необходимо нажать на кнопку "Отправить выбранные статьи на сайт".
                После этого в разделе "Фармвестник" они больше не будут доступны для редактирования. Все изменения в них можно будет вносить
                в разделе "Статьи".</dd>
        </dl>
    </div>
</div>