<?php get_header(); ?>

	<div class="container inner-page">
		<article>
			<?php if (have_posts()) : ?>
				<?php while(have_posts()) : the_post(); ?>

				<h2><?php the_title(); ?></h2>
				<?php the_content(); ?>

				<?php endwhile; ?>
			<?php else: ?>

				<p>Sorry, there doesn't seem to be any content for this page!</p>

			<?php endif; ?>
		</article>
	</div>

	<?php echo str_replace('<a', '<a class="button"', get_previous_posts_link('&laquo; Previous posts')); ?>
	<?php echo str_replace('<a', '<a class="button"', get_next_posts_link('More posts &raquo;')); ?>

<?php get_footer(); ?>
