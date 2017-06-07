<?php

namespace app\modules\admin\models;

/**
 * This is the ActiveQuery class for [[ArticlePharmvestnik]].
 *
 * @see ArticlePharmvestnik
 */
class ArticlePharmvestnikQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ArticlePharmvestnik[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ArticlePharmvestnik|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
