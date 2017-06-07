<?php

namespace app\modules\admin;

use Yii;

/**
 * admin module definition class
 */
class Admin extends \yii\base\Module {

    public function behaviors() {

        return [
            'ghost-access' => [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        $this->registerTranslations();

        $this->modules = [
        ];
    }

    public function registerTranslations() {
        Yii::$app->i18n->translations['admin'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/admin/messages',
        ];
    }

}
