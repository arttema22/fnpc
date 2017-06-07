<?php
use yii\helpers\Url;
?>

<li>
    <a href="<?= Url::to(['/article-catalog/view', 'id' => $category['id']]) ?>"><?= $category['name'] ?></a>
    <?php if (isset($category['childs'])): ?>
        <ul>
            <?= $this->getMenuHtml($category['childs']) ?>
        </ul>
    <?php endif; ?>
</li>
