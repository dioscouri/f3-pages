<?php if (!empty($item->{'featured_image.slug'}) && (!$item->{'display.image_position'} || $item->{'display.image_position'} == 'banner')) { ?>
    <div class="banner">
        <img class="img-responsive" src="./asset/<?php echo $item->{'featured_image.slug'}; ?>" alt="">
    </div>
<?php } ?>

<article id="page-<?php echo $item->id; ?>" class="pages-page page-<?php echo $item->id; ?>">

    <div class="entry-header">
        <?php if (!empty($item->{'featured_image.slug'}) && ($item->{'display.image_position'} == 'top')) { ?>
            <p>
                <img class="img-responsive" src="./asset/<?php echo $item->{'featured_image.slug'}; ?>" alt="">
            </p>
        <?php } ?>    
        <?php if (empty($item->{'display.title_disabled'})) { ?>
        <h2 class="entry-title">
            <?php echo $item->{'title'}; ?>
        </h2>
        <?php } ?>
        <?php if (!empty($item->{'featured_image.slug'}) && ($item->{'display.image_position'} == 'below-title')) { ?>
            <p>
                <img class="img-responsive" src="./asset/<?php echo $item->{'featured_image.slug'}; ?>" alt="">
            </p>
        <?php } ?>
    </div>

    <div class="entry-description">
        <?php echo $item->{'copy'}; ?>
    </div>

</article>