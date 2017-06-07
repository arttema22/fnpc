<?php

namespace app\modules\admin\components;

use yii\base\Widget;
use app\modules\admin\models\ProductCatalog;
use Yii;

class ProductCatalogWidget extends Widget {

    public $tpl;
    public $model;
    public $data;
    public $tree;
    public $menuHtml;

    public function init() {
        parent::init();
        if ($this->tpl === null) {
            $this->tpl = 'menu';
        }
        $this->tpl .= '.php';
    }

    public function run() {
        // get cache
        if ($this->tpl == 'menu.php') {
            $menu = Yii::$app->cache->get('menu');
            if ($menu)
                return $menu;
        }

        $this->data = ProductCatalog::find()->where(['active' => '1'])->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml .= $this->getMenuHtml($this->tree);

        // set cache
        if ($this->tpl == 'menu.php') {
//            Yii::$app->cache->set('menu', $this->menuHtml, 60);
        }
        return $this->menuHtml;
    }

    protected function getTree() {
        $tree = [];
        foreach ($this->data as $id => &$node) {
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        return $tree;
    }

    protected function getMenuHtml($tree, $tab = '') {
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category, $tab);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab) {
        ob_start();
        include __DIR__ . '/product_catalog_tpl/' . $this->tpl;
        return ob_get_clean();
    }

}
