<?php

class MY_Vcard_Widget extends WP_Widget {
  function MY_Vcard_Widget() {
    $widget_ops = array('classname' => 'widget_theme2196_vcard', 'description' => __('Use this widget to add a vCard', 'theme2196'));
    $this->WP_Widget('widget_theme2196_vcard', __('My - vCard', 'theme2196'), $widget_ops);
    $this->alt_option_name = 'widget_theme2196_vcard';

    add_action('save_post', array(&$this, 'flush_widget_cache'));
    add_action('deleted_post', array(&$this, 'flush_widget_cache'));
    add_action('switch_theme', array(&$this, 'flush_widget_cache'));
  }

  function widget($args, $instance) {
    $cache = wp_cache_get('widget_theme2196_vcard', 'widget');

    if (!is_array($cache)) {
      $cache = array();
    }

    if (!isset($args['widget_id'])) {
      $args['widget_id'] = null;
    }

    if (isset($cache[$args['widget_id']])) {
      echo $cache[$args['widget_id']];
      return;
    }

    ob_start();
    extract($args, EXTR_SKIP);

    if (!isset($instance['title'])) { $instance['title'] = ''; }
    if (!isset($instance['address_label'])) { $instance['address_label'] = ''; }
    if (!isset($instance['address'])) { $instance['address'] = ''; }
    if (!isset($instance['tel_label'])) { $instance['tel_label'] = ''; }
    if (!isset($instance['tel_1'])) { $instance['tel_1'] = ''; }
    if (!isset($instance['tel_2'])) { $instance['tel_2'] = ''; }
	$title = apply_filters('widget_title', $instance['title']);
    echo $before_widget;
    if ($title) {
      echo $before_title;
      echo $title;
      echo $after_title;
    }
  ?>
    <div class="vcard">
		<?php if ($instance['address_label']) { ?>
        	<h4><?php echo $instance['address_label']; ?></h4>
        <?php } ?>
        <?php if ($instance['address']) { ?>
        	<div class="address"><?php echo  $instance['address']; ?></div>
        <?php } ?>
        <div class="tel_wrapper">
			<?php if ($instance['tel_label']) { ?>
                <h4><?php echo $instance['tel_label']; ?></h4>
            <?php } ?>
            <?php if ($instance['tel_1']) { ?>
                <div class="tel"><?php echo  $instance['tel_1']; ?></div>
            <?php } ?>
            <?php if ($instance['tel_2']) { ?>
                <div class="tel"><?php echo  $instance['tel_2']; ?></div>
            <?php } ?>
        </div>
    </div>
  <?php
    echo $after_widget;

    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_theme2196_vcard', $cache, 'widget');
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['address_label'] = strip_tags($new_instance['address_label']);
    $instance['address'] = strip_tags($new_instance['address']);
    $instance['tel_label'] = strip_tags($new_instance['tel_label']);
    $instance['tel_1'] = strip_tags($new_instance['tel_1']);
    $instance['tel_2'] = strip_tags($new_instance['tel_2']);
    $this->flush_widget_cache();

    $alloptions = wp_cache_get('alloptions', 'options');
    if (isset($alloptions['widget_theme2196_vcard'])) {
      delete_option('widget_theme2196_vcard');
    }

    return $instance;
  }

  function flush_widget_cache() {
    wp_cache_delete('widget_theme2196_vcard', 'widget');
  }

  function form($instance) {
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
    $address_label = isset($instance['address_label']) ? esc_attr($instance['address_label']) : '';
    $address = isset($instance['address']) ? esc_attr($instance['address']) : '';
    $tel_label = isset($instance['tel_label']) ? esc_attr($instance['tel_label']) : '';
    $tel_1 = isset($instance['tel_1']) ? esc_attr($instance['tel_1']) : '';
    $tel_2 = isset($instance['tel_2']) ? esc_attr($instance['tel_2']) : '';
  ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title (optional):', 'theme2196'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('address_label')); ?>"><?php _e('Address Label:', 'theme2196'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('address_label')); ?>" name="<?php echo esc_attr($this->get_field_name('address_label')); ?>" type="text" value="<?php echo esc_attr($address_label); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php _e('Address:', 'theme2196'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>" type="text" value="<?php echo esc_attr($address); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('tel_label')); ?>"><?php _e('Telephone Label:', 'theme2196'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('tel_label')); ?>" name="<?php echo esc_attr($this->get_field_name('tel_label')); ?>" type="text" value="<?php echo esc_attr($tel_label); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('tel_1')); ?>"><?php _e('Telephone 1:', 'theme2196'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('tel_1')); ?>" name="<?php echo esc_attr($this->get_field_name('tel_1')); ?>" type="text" value="<?php echo esc_attr($tel_1); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('tel_2')); ?>"><?php _e('Telephone 2:', 'theme2196'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('tel_2')); ?>" name="<?php echo esc_attr($this->get_field_name('tel_2')); ?>" type="text" value="<?php echo esc_attr($tel_2); ?>" />
    </p>
  <?php
  }
}

function theme2196_widget_init() {
  register_widget('MY_Vcard_Widget');
}

add_action('widgets_init', 'theme2196_widget_init');