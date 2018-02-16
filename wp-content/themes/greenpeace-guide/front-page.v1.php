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

    <div class="ratings-container" id="ratings-container">

        <h4>We’re showing you electricity suppliers in</h4>

        <select class="state state-selector">
            <option value="" selected>Australia</option>
            <option value="act">Australian Capital Territory</option>
            <option value="nsw">New South Wales</option>
            <option value="nt" >Northern Territory</option>
            <option value="qld">Queensland</option>
            <option value="sa">South Australia</option>
            <option value="tas">Tasmania</option>
            <option value="vic">Victoria</option>
            <option value="wa">Western Australia</option>
        </select>

        <div class="providers-container">

            <?php
                $providers = get_posts(array(
                    'post_type' => 'provider',
                    'posts_per_page' => -1,
                    'meta_key' => 'provider_score',
                    'orderby' => 'meta_value'
                ));

                foreach ($providers as $post) : setup_postdata($post);

                    get_template_part('partials/provider');

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
