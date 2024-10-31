<?php
/*
Plugin Name: NFL Fantasy News Widget
Plugin URI: http://www.soupnetworks.com/widget/nfl
Description: NFL Fantasy News Widget for Sports Blog Content by NFLSoup.com
Version: 1.5
Author: SoupNetworks
Author URI: http://www.soupnetworks.com
License: GPL2

Copyright 2011 SoupNetworks (email: support@soupnetworks.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* Add our function to the widgets_init hook. */
add_action('widgets_init', 'nfl_fantasy_news_widget');

/* Function that registers our widget. */
function nfl_fantasy_news_widget()
{
	register_widget('NFL_Fantasy_News_Widget');
}

class NFL_Fantasy_News_Widget extends WP_Widget
{
    function NFL_Fantasy_News_Widget()
    {
		/* Widget settings. */
		$widget_ops = array('classname' => 'NFLFantasyNewsWidget', 'description' => 'NFL Fantasy News Widget for Sports Blog Content by NFLSoup.com');

		/* Widget control settings. */
		//$control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'nfl-fantasy-news-widget');
        $control_ops = array('id_base' => 'nfl-fantasy-news-widget');

		/* Create the widget. */
		$this->WP_Widget('nfl-fantasy-news-widget', 'NFL Fantasy News Widget', $widget_ops, $control_ops);
	}

    function widget($args, $instance)
    {
		extract($args);

		/* User-selected settings. */
		//$title = apply_filters('widget_title', $instance['title']);
        $title= "NFL Fantasy News Widget";
		$width = $instance['width'];
		$height = $instance['height'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
        /*
		if ($title)
			echo $before_title.$title.$after_title;
        */

		/* Display the widget. */
		echo '<iframe scrolling=no width="'.$width.'px" frameborder="0" height="'.$height.'px" src="http://www.soupnetworks.com/widget/feed-nfl"></iframe>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}

    function update($new_instance, $old_instance)
    {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['width'] = $new_instance['width'];
		$instance['height'] = $new_instance['height'];

		return $instance;
	}

    function form($instance)
    {
		/* Set up some default widget settings. */
		$defaults = array('width' => '230', 'height' => '368');
		$instance = wp_parse_args((array)$instance, $defaults);
    ?>

        <p>
			<label for="<?php echo $this->get_field_id('width'); ?>">Width:</label>
			<input id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo $instance['width']; ?>" style="width:100%;" />
            <em>Min width is 200.</em>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('height'); ?>">Height:</label>
			<input id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $instance['height']; ?>" style="width:100%;" />
		</p>
    <?php
    }
}
?>