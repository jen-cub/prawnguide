<?php get_header(); ?>

<?php
global $post;
$slug = get_post( $post )->post_name;
$_slug = array('good', 'bad', 'dodgy', 'okay');

if (!in_array($slug, $_slug)) {
?>

	<div class="container inner-page">
		<article>
			<?php if (have_posts()) : ?>
				<?php while(have_posts()) : the_post(); ?>

<!--				<h2><?php the_title(); ?></h2>-->
				<?php the_content(); ?>

				<?php endwhile; ?>
			<?php else: ?>

				<p>Sorry, there doesn't seem to be any content for this page!</p>

			<?php endif; ?>
		</article>
	</div>

	<?php echo str_replace('<a', '<a class="button"', get_previous_posts_link('&laquo; Previous posts')); ?>
	<?php echo str_replace('<a', '<a class="button"', get_next_posts_link('More posts &raquo;')); ?>


<?php }else { ?>

    <?php if (have_rows('introduction_columns')) : ?>
        <div class="container info-section">

            <?php while(have_rows('introduction_columns')) : the_row(); ?>
                <div class="three-col">
                    <?php the_sub_field('columns_content'); ?>
                </div>
            <?php endwhile; ?>

        </div><!--/info-section-->
    <?php endif; ?>

    <div class="ratings-container" id="ratings-container">
		
		<select class="rate-selector state state-selector">
			<option value="good" <?php echo ($slug == 'good')? ' selected' : '';?>>Good Prawns</option>
			<option value="okay" <?php echo ($slug == 'okay')? ' selected' : '';?>>Okay Prawns</option>
			<option value="dodgy" <?php echo ($slug == 'dodgy')? ' selected' : '';?>>Dodgy Prawns</option>
			<option value="bad" <?php echo ($slug == 'bad')? ' selected' : '';?>>Bad Prawns</option>			
		</select>

		<div class="providers-description"><?php the_content(); ?></div>
		
        <div class="providers-container">

            <?php
			
			    $page_rating = get_field('page_rating');
                $providers = get_posts(array(
                    'post_type' => 'provider',
                    'posts_per_page' => -1,
                    'meta_key' => 'provider_score',
                    'orderby' => 'meta_value'
                ));
                foreach ($providers as $post) : setup_postdata($post);
					$show_post = false;
				    $terms = wp_get_post_terms(get_the_ID(), 'state');
					foreach ($terms as $term) {
						if (in_array($term->term_id, $page_rating))  {
							$show_post = true;
						}
					}
					if ($show_post) {
						get_template_part('partials/prawns');
					}

                endforeach; wp_reset_postdata();
            ?>

            <div class="share">

				<ul class="sm-large-btns">
					<li>
						<a href="#" class="facebook" data-share="facebook">
							<span class="fa-stack fa-lg">
							  <i class="fa fa-circle fa-stack-2x"></i>
							  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
							</span>
						</a>
					</li>
					<li>
						<a href="#" class="twitter" data-url="" data-share="twitter" data-message="<?php the_field('twitter_default', 'option'); ?>">
							<span class="fa-stack fa-lg">
							  <i class="fa fa-circle fa-stack-2x"></i>
							  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
							</span>
						</a>
					</li>
					<li>
                        <a href="whatsapp://send?text=<?php echo urlencode(get_field('whatsapp_default', 'option')); ?>" data-href="" class="whatsapp" target="_top" onclick="window.parent.null">
    						<span class="fa-stack fa-lg">
    						  <i class="fa fa-circle fa-stack-2x"></i>
    						  <i class="fa fa-whatsapp fa-stack-1x fa-inverse"></i>
    						</span>
    					</a>
					</li>
				</ul>

			</div><!--/share-->

        </div><!--/providers-container-->

    </div><!--/ratings-container-->

    	<div class="container bottom-info-section">
		<div class="two-col tc-right">
			<h3>TAKE ACTION</h3>
			<p>We can only really know if our prawns are good, bad or ugly if they're labelled correctly. <b>But right now, Australia's seafood labelling is weak</b>. Click here to demand for more information about prawns sold in Australia. </p>
			<a href="https://www.greenpeace.org.au/action/?cid=122&src=GP1" class="ghost_btn">TAKE ACTION</a>
		</div>

		<div class="two-col tc-left">
            <h3>LEARN MORE</h3>
			<p>Our report Dodgy Prawns explains how some prawns come at a cost of human suffering and environment destruction, as well as sustainable alternatives. Click below to read the report.</p>
            <a href="http://www.greenpeace.org/australia/en/what-we-do/oceans/resources/reports/Dodgy-Prawns/" class="ghost_btn">READ THE REPORT</a>
        </div>
	</div>

    <?php get_template_part('partials/modal'); ?>

<?php } ?>

<?php get_footer(); ?>
