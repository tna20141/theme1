<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package theme1
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="footer-main">
			<!-- nothing here yet -->
		</div>
		<div class="footer-bottom">
			<div class="footer-bottom-container">
				<div class="footer-bottom-social footer-bottom-area">
					<ul class="footer-social-list">
						<li class="footer-social-item">
							<a href="<?php _e('facebook_page', 'theme1'); ?>" target="_blank">
								<span aria-hidden="true">
									<i class="fa fa-facebook"></i>
								</span>
							</a>
						</li>
					</ul>
				</div>
				<div class="footer-bottom-copyright footer-bottom-area">
					<span>
						<?php
						printf('Copyright &copy %1$s ' . __('site_name', 'theme1'), date("Y"));
						?>
					</span>
				</div>
				<?php
					wp_nav_menu(array(
						'theme_location'  => 'menu-footer-links',
						'menu_class'      => 'footer-bottom-links-item',
						'container_class' => 'footer-bottom-links footer-bottom-area',
					));
				?>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
