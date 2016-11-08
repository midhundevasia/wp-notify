<?php
// Check for valid url
if(!defined('ABSPATH')) {
	die("Better luck next time!!!");
}

global $wp_notify;
?>
<!-- ==== Generated by WP-Notify Plugin ==== -->
<div id="notification">
<span id="notify_message">
<?php 

if($wp_notify[type] == "other") : ?>
    <ul>
    <?php
      $number_posts = $wp_notify[post_count];
      echo ($wp_notify[other_types] == 'recent_post')? "<b>Recent Posts</b>": "<b>Up Comming</b>";
      $posts = ($wp_notify[other_types] == 'recent_post')? __get_posts("publish", $number_posts ) : __get_posts( "future", $number_posts );
      foreach($posts as $post){
        echo '<li class="notify_posts"><a href="' . get_permalink($post["ID"]) . '" title="Look '.$post["post_title"].'" >' .   $post["post_title"].'</a></li> ';
      } ?>
    </ul>
 <?php else: ?>
<?= $wp_notify[custom_message]?>
<?php endif; ?>
</span>
<span class="dismiss"><a title="dismiss this notification" href="javascript:void(0);">x</a></span>
</div>
<!-- ==== Generated by WP-Notify Plugin ==== -->