<div id="carousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php $i = 0; ?>
        <?php foreach ($slider as $slide) { ?>
            <li data-target="#mycarousel" data-slide-to="<?= $i ?>" <?php if ($i == 0) echo'class="active"'; ?>></li>
            <?php $i++; ?>
        <?php } ?>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php $i = 0; ?>
        <?php foreach ($slider as $slide) { ?>
            <div class="item <?php if ($i == 0) echo'active'; ?>">
                <img src="/images/slider/<?= $slide['img'] ?>" data-color="lightblue" alt="<?= $slide['title'] ?>">
                <div class="carousel-caption">
                    <?= $slide['description'] ?>
                </div>
            </div>
            <?php $i ++; ?>
        <?php } ?>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>