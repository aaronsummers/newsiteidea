<?php
 
define('ROOT',$_SERVER['DOCUMENT_ROOT']);
define('WPTRICKS_STARTER_THEME',str_replace('\\','/',dirname(__FILE__)));
define('WPTRICKS_STARTER_PATH','/' . substr(WPTRICKS_STARTER_THEME,stripos(WPTRICKS_STARTER_THEME,'wp-content')));
 
/* ABOUT META BOXES ADDED BELOW */
add_action('admin_init','wptricks_about_meta_init');
 
function wptricks_about_meta_init()
{
 
	wp_enqueue_style('wptricks_about_meta_css', WPTRICKS_STARTER_PATH . '/meta.css');
 
	foreach (array('people') as $type)
	{
		add_meta_box('wptricks_about_meta', '<div class="dashicons dashicons-id"></div> Other Details', 'wptricks_about_meta_setup', $type, 'normal', 'high');
	}
	 
	add_action('save_post','wptricks_about_meta_save');
}
 
function wptricks_about_meta_setup()
{
	global $post;
	$aboutmeta = get_post_meta($post->ID,'_wptricks_about_meta',TRUE);
	include(WPTRICKS_STARTER_THEME . '/people.php');
  
	echo '<input type="hidden" name="wptricks_about_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}
 
/* SAVE ABOUT META FOR LATER */
function wptricks_about_meta_save($post_id)
{
	if (!wp_verify_nonce($_POST['wptricks_about_meta_noncename'],__FILE__)) return $post_id;
	if ($_POST['post_type'] == 'page')
	{
		if (!current_user_can('edit_page', $post_id)) return $post_id;
	} else {
		if (!current_user_can('edit_post', $post_id)) return $post_id;
	}
 
	$current_data = get_post_meta($post_id, '_wptricks_about_meta', TRUE); 
  
	$new_data = $_POST['_wptricks_about_meta'];
 
	wptricks_meta_clean($new_data);
	 
	if ($current_data)
	{
		if (is_null($new_data)) delete_post_meta($post_id,'_wptricks_about_meta');
		else update_post_meta($post_id,'_wptricks_about_meta',$new_data);
	}
	elseif (!is_null($new_data))
	{
		add_post_meta($post_id,'_wptricks_about_meta',$new_data,TRUE);
	}
 
	return $post_id;
}
 
 
function wptricks_meta_clean(&$arr)
{
	if (is_array($arr))
	{
		foreach ($arr as $i => $v)
		{
			if (is_array($arr[$i]))
			{
				wptricks_meta_clean($arr[$i]);
 
				if (!count($arr[$i]))
				{
					unset($arr[$i]);
				}
			} else {
				if (trim($arr[$i]) == '')
				{
					unset($arr[$i]);
				}
			}
		}
 
		if (!count($arr))
		{
			$arr = NULL;
		}
	}
}
 
?>