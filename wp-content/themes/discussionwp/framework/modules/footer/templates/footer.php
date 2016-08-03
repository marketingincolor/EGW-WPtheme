<?php
/**
 * Footer template part
 */
?>
</div> <!-- close div.content_inner -->
</div>  <!-- close div.content -->

<footer>
	<div class="mkd-footer-inner clearfix">
		<?php
			if($display_footer_top) {
				discussion_get_footer_top();
			}
			if($display_footer_bottom) {
				discussion_get_footer_bottom();
			}
		?>
	</div>
</footer>

</div> <!-- close div.mkd-wrapper-inner  -->
</div> <!-- close div.mkd-wrapper -->
<?php wp_footer(); ?>
</body>
</html>