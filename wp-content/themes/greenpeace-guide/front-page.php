<?php get_header(); ?>

    <?php if (have_rows('introduction_columns')) : ?>
        <div class="container info-section">

            <?php while(have_rows('introduction_columns')) : the_row(); ?>
                <div class="three-col">
                    <?php the_sub_field('columns_content'); ?>
                </div>
            <?php endwhile; ?>

        </div><!--/info-section-->
    <?php endif; ?>

	<div class="front-page">
		<div class="front-page-container" id="front-page-container">
	
			<?php the_content(); ?>
	
		</div><!--/font-page-container-->
	</div>

    <?php if (have_rows('footer_columns')) : ?>
        <div class="container bottom-info-section">


            <div class="two-col tc-right">

                <?php $i = 1; while(have_rows('footer_states')) : the_row(); ?>

                    <div class="statecol statecol-<?php the_sub_field('columns_state'); ?>" style="display: none;">
                        <?php the_sub_field('columns_content'); ?>

                        <?php if ($link = get_sub_field('columns_link')) : ?>
                            <a href="<?php echo $link; ?>" class="ghost_btn toggle-btn">read more</a>
                        <?php endif; ?>
                    </div>

                <?php endwhile; ?>

            </div>

            <div class="two-col tc-left">

                <?php the_field('footer_info'); ?>

                <?php if ($link = get_field('footer_info_link')) : ?>
                    <a href="<?php echo $link; ?>" class="ghost_btn">read more</a>
                <?php endif; ?>

            </div>

        </div>
    <?php endif; ?>

    <?php get_template_part('partials/modal'); ?>

<?php get_footer(); ?>
