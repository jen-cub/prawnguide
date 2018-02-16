<?php
    $terms = wp_get_post_terms(get_the_ID(), 'state');
    $terms_class = '';
    foreach ($terms as $term) $terms_class .= $term->slug . ' ';
?>
<?php #the_field('provider_colour'); ?> 
<div class="provider <?php echo $terms_class; ?>">
    <div class="prov-top">
        <div class="prov-title"><h1><?php echo get_the_title(); ?></h1><p class="provider_title_sub"><?php the_field('provider_title_sub'); ?></p><p class="provider_catch_method"><?php the_field('provider_catch_method'); ?></p></div>
          
        <div class="prov-logo"><h3><?php the_post_thumbnail('full'); ?></h3></div>
        <div class="prov-sources">
            <?php if (have_rows('provider_source')) : ?>
                <?php $i = 1; while(have_rows('provider_source')) : the_row(); ?>
                    <?php $image = 'icons-sources/' .trim(get_sub_field('provider_source_icons')).'.png'; ?>
                    <img src="<?php bloginfo('template_directory'); ?>/assets/images/<?php echo $image; ?>">
                <?php $i++; endwhile; ?>
            <?php endif; ?>
        </div>        
        <div class="prov-arrow"><i class="fa fa-chevron-down"></i></div>
    </div>

    <div class="prov-detail">

        <?php the_content(); ?>

        <p class="center width_auto"><?php the_post_thumbnail('full'); ?></p>
        
        <?php if (have_rows('provider_facts')) : ?>
            <div class="prov-points">

                <?php $i = 1; while(have_rows('provider_facts')) : the_row(); ?>
                
                    <?php $image = 'icons-facts/' .trim(get_sub_field('facts_icon')).'.png'; ?>

                    <div class="prov-point <?php if ($i % 2) echo 'left-pp'; ?>">
<!--                        <div class="prov-icon flex-item">
                            <img src="<?php bloginfo('template_directory'); ?>/assets/images/<?php echo $image; ?>" alt="lightbulb">
                        </div>
-->
                        <div class="prov-note flex-item">
                            <p><?php if ($label = get_sub_field('facts_label')) : ?><b><?php echo $label; ?> <span><?php echo get_sub_field('facts_label_sub'); ?> </span></b><?php endif; ?><?php the_sub_field('facts_description'); ?></p>
                        </div>
                    </div>

                <?php $i++; endwhile; ?>

            </div><!-- / prov points -->
        <?php endif; ?>

        <?php if (have_rows('provider_graph')) : ?>

            <h4><?php the_field('provider_graph_title'); ?></h4>

            <div class="element_scores">

                <?php while(have_rows('provider_graph')) : the_row(); ?>
                    <?php
                        $score = get_sub_field('graph_value');
                        if ($score > 8) $class = 'green';
                        elseif ($score > 6 && $score < 9) $class = 'light-green';
                        elseif ($score > 4 && $score < 7) $class = 'yellow';
                        elseif ($score > 2 && $score < 5) $class = 'orange';
                        elseif ($score > 0 && $score < 3) $class = 'red';
                        else $class = 'white';
                    ?>
                    <div class="score">
                        <div class="score-title"><span><?php the_sub_field('graph_label'); ?></span></div>
                        <div class="score-bar-bkgnd">
                            <div class="score-bar <?php echo $class; ?>" data-width="<?php echo ($score/10)*100; ?>%" style="width: 0%;">
                                <?php //echo $score; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>


            </div><!-- / element scores -->

        <?php endif; ?>

        <?php if ($download = get_field('provider_download')) : ?>
            <div class="download-fact-sheet">
                <a target="_blank" href="<?php echo $download; ?>" class="factsheet-btn">DOWNLOAD FACT SHEET</a>
            </div>
        <?php endif; ?>

    </div><!-- / prov-detail -->

</div>
