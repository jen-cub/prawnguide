<?php

    $terms = wp_get_post_terms(get_the_ID(), 'state');
    $terms_class = '';

    foreach ($terms as $term) $terms_class .= $term->slug . ' ';

?>

<div class="provider <?php the_field('provider_colour'); ?> <?php echo $terms_class; ?>">

    <div class="prov-top">
        <div class="prov-logo"><?php the_post_thumbnail('full'); ?></div>
        <div class="prov-score"><?php the_field('provider_score'); ?></div>
        <div class="prov-arrow"><i class="fa fa-chevron-down"></i></div>
    </div>

    <div class="prov-detail">

        <?php the_content(); ?>

        <?php if (have_rows('provider_facts')) : ?>
            <div class="prov-points">

                <?php $i = 1; while(have_rows('provider_facts')) : the_row(); ?>

                    <?php
                        switch(get_sub_field('facts_icon')) {
                            case 'positive':
                                $image = 'lightbulb.png';
                                break;
                            case 'neutral':
                                $image = 'powerpoint.png';
                                break;
                            case 'negative':
                                $image = 'warning.png';
                                break;
                        }
                    ?>

                    <div class="prov-point <?php if ($i % 2) echo 'left-pp'; ?>">
                        <div class="prov-icon flex-item">
                            <img src="<?php bloginfo('template_directory'); ?>/assets/images/<?php echo $image; ?>" alt="lightbulb">
                        </div>

                        <div class="prov-note flex-item">
                            <p><?php if ($label = get_sub_field('facts_label')) : ?><b><?php echo $label; ?></b><br><?php endif; ?><?php the_sub_field('facts_description'); ?></p>
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

                <p class="note">Note that these are the raw scores out of 10 for each sub‐criterion, which are then weighted to produce the element scores and final overall score (see Fact Sheet)</p>

            </div><!-- / element scores -->

        <?php endif; ?>

        <?php if ($download = get_field('provider_download')) : ?>
            <div class="download-fact-sheet">
                <a target="_blank" href="<?php echo $download; ?>" class="factsheet-btn">DOWNLOAD FACT SHEET</a>
            </div>
        <?php endif; ?>

    </div><!-- / prov-detail -->

</div>
