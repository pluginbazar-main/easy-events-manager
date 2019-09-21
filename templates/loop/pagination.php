<?php
/**
 * Archive Event - Pagination
 *
 * @package loop/pagination.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_query;

if( $wp_query->get( 'show_pagination' ) == 'yes' ) : ?>

	<div class="eem-pagination paginate">
		<?php echo eem_pagination(); ?>
	</div>

<?php endif; ?>