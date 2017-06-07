<?php
use yii\helpers\Url;
?>
<div data-src="<?= '/' . $slide['img'] ?>">
    <div class="camera-caption fadeIn">
        <p class="title"><?= $slide['title'] ?></p>
        <p class="description"><?= $slide['sub_title'] ?></p>
        <p><?= $slide['description'] ?></p>
        <a href="<?= Url::to($slide['url']) ?>"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
</div>