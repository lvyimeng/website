<?php
/**
 * @package WordPress
 * @subpackage theme2196
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
  	<?php echo '<p class="nocomments">' . __('This post is password protected. Enter the password to view comments.', 'theme2196') . '</p>'; ?>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h4 class="space title_box_alt" id="comments"><?php printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'theme2196' ),
			number_format_i18n( get_comments_number() ) );?></h4>

	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
	</ol>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
    <?php echo '<p class="nocomments">' . __('No Comments Yet.', 'theme2196') . '</p>'; ?>
	<?php else : // comments are closed ?>
		<!-- If comments are closed. -->
    <?php echo '<p class="nocomments">' . __('Comments are closed.', 'theme2196') . '</p>'; ?>

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<div id="respond">

<h4 class="title_box_alt"><?php comment_form_title( _e('Leave a comment','theme2196')); ?></h4>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php _e('You must be', 'theme2196'); ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('logged in', 'theme2196'); ?></a> <?php _e('to post a comment.', 'theme2196'); ?></p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( is_user_logged_in() ) : ?>

<p><?php _e('Logged in as', 'theme2196'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'theme2196'); ?>"><?php _e('Log out &raquo;', 'theme2196'); ?></a></p>

<?php else : ?>

<p class="field"><input type="text" name="author" id="author" value="<?php _e('Name', 'theme1860'); if ($req) _e('*', 'theme1860'); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?>  onfocus="if(this.value=='<?php _e('Name', 'theme1860'); if ($req) _e('*', 'theme1860'); ?>'){this.value=''}" onblur="if(this.value==''){this.value='<?php _e('Name', 'theme1860'); if ($req) _e('*', 'theme1860'); ?>'}" /></p>

<p class="field"></label><input type="text" name="email" id="email" value="<?php _e('Email (will not be published)', 'theme1860'); if ($req) _e('*', 'theme1860'); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> onfocus="if(this.value=='<?php _e('Email (will not be published)', 'theme1860'); if ($req) _e('*', 'theme1860'); ?>'){this.value=''}" onblur="if(this.value==''){this.value='<?php _e('Email (will not be published)', 'theme1860'); if ($req) _e('*', 'theme1860'); ?>'}" /></p>

<p class="field"><input type="text" name="url" id="url" value="<?php _e('Website:', 'theme1725'); ?>" size="22" tabindex="3" onfocus="if(this.value=='<?php _e('Website:', 'theme1725'); ?>'){this.value=''}" onblur="if(this.value==''){this.value='<?php _e('Website:', 'theme1725'); ?>'}" /></p>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4" onfocus="if(this.value=='<?php _e('Your comment*', 'theme1860'); ?>'){this.value=''}" onblur="if(this.value==''){this.value='<?php _e('Your comment*', 'theme1860'); ?>'}"><?php _e('Your comment*', 'theme1860'); ?></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'theme2196'); ?>" />
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>