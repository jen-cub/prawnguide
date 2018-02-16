	<div class="disclaimer" id="disclaimer">
		<div class="disclaimer-inner">
			<?php the_field('disclaimer', 'option'); ?>
		</div>
	</div>


	<?php wp_footer(); ?>


	<script>
var sourceSwap = function () {
    var $this = jQuery(this);
    var newSource = $this.data('alt-src');
    $this.data('alt-src', $this.attr('src'));
    $this.attr('src', newSource);
}
jQuery(function () {
    jQuery('img.front-page-button').hover(sourceSwap, sourceSwap);
});
	</script>

</body>
</html>