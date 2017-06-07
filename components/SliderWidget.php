<?php

namespace app\components;

use yii\base\Widget;
use app\models\Slider;

class SliderWidget extends Widget {

    public $name;
    public $tpl;

    public function init() {
        parent::init();
        if ($this->name === null) {
            $this->name = 'frontpage';
        }
        if ($this->tpl === null) {
            $this->tpl = 'default';
        }
        $this->tpl .= '.php';
    }

    public function run() {
        $slider = Slider::find()->where(['active' => '1', 'name' => $this->name])->asArray()->all();
        if (!empty($slider)): {
                echo '<div class = "slider"><div class = "camera_wrap">';
                foreach ($slider as $slide):
                    include __DIR__ . '/slider_tpl/' . $this->tpl;
                endforeach;
                echo '</div></div>';
            }
        endif;

        return;
    }

}
