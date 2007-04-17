<?php
/*
Plugin Name: Google Blog Search Preview
Plugin URI: http://www.jaysonjc.com/wordpress/google-blog-search-preview-plugin-for-wordpress/
Description: Displays Google Blog Search Preview in the activity tab of Dashboard. Similar to technorati incoming links.
Author: Jayson Joseph Chacko
Version: 1.1
Author URI: http://www.jaysonjc.com
*/
require_once (ABSPATH . WPINC . "/rss.php");


class jj_gblogsearch {

	function jj_preview_gblog_search_links() {
		$google_blog_search_feed = 'http://blogsearch.google.com/blogsearch_feeds?hl=en&ie=utf-8&num=10&output=rss&q=link:';
		$google_blog_search_url = 'http://blogsearch.google.com/blogsearch?hl=en&ie=utf-8&num=10&q=link:';
		$myUrl = trailingslashit(get_option('home'));

		$rss = @fetch_rss($google_blog_search_feed . $myUrl);

		if ( isset($rss->items)) {
		?>
		asdas
		<h3><?php _e('Google Blog Search'); ?> <cite><a href="<?php echo $google_blog_search_url . $myUrl; ?>"><?php _e('More &raquo;'); ?></a></cite></h3>
		<ul>
		<?php
		$rss->items = array_slice($rss->items, 0, 10);
		foreach ($rss->items as $item ) {
		?>
			<li><a href="<?php echo wp_filter_kses($item['link']); ?>"><?php echo wptexturize(wp_specialchars($item['title'])); ?></a></li>
		<?php } ?>
		</ul>
		<?php
		}

	}
}

add_action('activity_box_end', array('jj_gblogsearch','jj_preview_gblog_search_links'));
?>