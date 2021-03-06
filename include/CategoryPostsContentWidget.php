<?php

require_once 'CatPCDisplayer.php';

class CategoryPostsContentWidget extends WP_Widget{

  function CategoryPostsContentWidget() {
    $opts = array('description' => __('แสดงเรื่องในหมวดหมู่','category-posts-content') );
    parent::WP_Widget(false, $name = __('Category Posts Content','category-posts-content'), $opts);
  }

  function widget($args, $instance) {
    extract( $args );
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    $limit = (is_numeric($instance['limit'])) ? $instance['limit'] : 5;
    $orderby = ($instance['orderby']) ? $instance['orderby'] : 'date';
    $order = ($instance['order']) ? $instance['order'] : 'desc';
    $exclude = ($instance['exclude'] != '') ? $instance['exclude'] : 0;
    $excludeposts = ($instance['excludeposts'] != '') ? $instance['excludeposts'] : 0;
    $offset = (is_numeric($instance['offset'])) ? $instance['offset'] : 0;
    $category_id = $instance['categoryid'];
    $dateformat = ($instance['dateformat']) ? $instance['dateformat'] : get_option('date_format');
    $showdate = ($instance['show_date'] == 'on') ? 'yes' : 'no';
    $showexcerpt = ($instance['show_excerpt'] == 'on') ? 'yes' : 'no';
    $excerptsize = (empty($instance['excerpt_size']) ? 55 : $instance['excerpt_size']);
    $showauthor = ($instance['show_author'] == 'on') ? 'yes' : 'no';
    $showcatlink = ($instance['show_catlink'] == 'on') ? 'yes' : 'no';
    $thumbnail = ($instance['thumbnail'] == 'on') ? 'yes' : 'no';
    $thumbnail_size = ($instance['thumbnail_size']) ? $instance['thumbnail_size'] : 'thumbnail';
    $morelink = empty($instance['morelink']) ? ' ' : $instance['morelink'];

    echo $before_widget;
    echo $before_title . $title . $after_title;

    $atts = array(
      'id' => $category_id,
      'orderby' => $orderby,
      'order' => $order,
      'numberposts' => $limit,
      'date' => $showdate,
      'author' => $showauthor,
      'dateformat' => $dateformat,
      'template' => 'default',
      'excerpt' => $showexcerpt,
      'excerpt_size' => $excerptsize,
      'exclude' => $exclude,
      'excludeposts' => $excludeposts,
      'offset' => $offset,
      'catlink' => $showcatlink,
      'thumbnail' => $thumbnail,
      'thumbnail_size' => $thumbnail_size,
      'morelink' => $morelink
    );

    $catpc_displayer = new CatPCDisplayer($atts);
    echo  $catpc_displayer->display();
    echo $after_widget;
  }


  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['limit'] = strip_tags($new_instance['limit']);
    $instance['orderby'] = strip_tags($new_instance['orderby']);
    $instance['order'] = strip_tags($new_instance['order']);
    $instance['exclude'] = strip_tags($new_instance['exclude']);
    $instance['excludeposts'] = strip_tags($new_instance['excludeposts']);
    $instance['offset'] = strip_tags($new_instance['offset']);
    $instance['categoryid'] = strip_tags($new_instance['categoryid']);
    $instance['dateformat'] = strip_tags($new_instance['dateformat']);
    $instance['show_date'] = strip_tags($new_instance['show_date']);
    $instance['show_excerpt'] = strip_tags($new_instance['show_excerpt']);
    $instance['excerpt_size'] = strip_tags($new_instance['excerpt_size']);
    $instance['show_author'] = strip_tags($new_instance['show_author']);
    $instance['show_catlink'] = strip_tags($new_instance['show_catlink']);
    $instance['show_catlink'] = strip_tags($new_instance['show_catlink']);
    $instance['thumbnail'] = strip_tags($new_instance['thumbnail']);
    $instance['thumbnail_size'] = strip_tags($new_instance['thumbnail_size']);
    $instance['morelink'] = strip_tags($new_instance['morelink']);

    return $instance;
  }


  function form($instance) {
    include('catpc_widget_form.php');
  }
}

add_action('widgets_init', create_function('', 'return register_widget("CategoryPostsContentWidget");'));
?>
