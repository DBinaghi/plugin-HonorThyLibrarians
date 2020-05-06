<?php echo js_tag('vendor/tinymce/tinymce.min'); ?>
<script type="text/javascript">
jQuery(document).ready(function () {
	Omeka.wysiwyg({
		selector: '.html-editor'
	});
});
</script>

<?php 
$page_path  = get_option('honor_thy_librarians_page_path');
$page_title = get_option('honor_thy_librarians_page_title');
$pre_text   = get_option('honor_thy_librarians_pre_text');
$post_text  = get_option('honor_thy_librarians_post_text');
$view       = get_view();
?>

<h2><?php echo __('Page settings'); ?></h2>

<div class="field">
	<div class="two columns alpha">
		<?php echo $view->formLabel('page_path', __('Page path')); ?>
	</div>
	<div class="inputs five columns omega">
		<p class="explanation">
			<?php echo __('The path to the page listing the librarians. For example, if your site is hosted at <code>http://my-omeka-site.org/</code>, and the value of this field is <code>librarians/</code>, then your page will be displayed at <code>http://my-omeka-site.org/librarians/</code>.') ?>
		</p>
		<?php echo $view->formText('page_path', $page_path, array('class' => 'textinput')); ?>
	</div>
</div>

<div class="field">
	<div class="two columns alpha">
		<?php echo $view->formLabel('page_title', __('Page title')); ?>
	</div>
	<div class="inputs five columns omega">
		<p class="explanation">
			<?php echo __('The title that will display on the librarians page and in the main site navigation.') ?>
		</p>
		<?php echo $view->formText('page_title', $page_title, array('class' => 'textinput')); ?>
	</div>
</div>

<div class="field">
	<div class="two columns alpha">
		<?php echo $view->formLabel('pre_text', __('Pre display text')); ?>
	</div>
	<div class="inputs five columns omega">
		<p class="explanation">
			<?php echo __('The text that will display before the table of librarians.') ?>
		</p>
		<?php echo $view->formTextarea('pre_text', $pre_text, array('rows' => '10', 'cols' => '60', 'class' => array('html-editor'))); ?>
	</div>
</div>

<div class="field">
	<div class="two columns alpha">
		<?php echo $view->formLabel('post_text', __('Post display text')); ?>
	</div>
	<div class="inputs five columns omega">
		<p class="explanation">
			<?php echo __('The text that will display after the table of librarians.') ?>
		</p>
		<?php echo $view->formTextarea('post_text', $post_text, array('rows' => '10', 'cols' => '60', 'class' => array('html-editor'))); ?>
	</div>
</div>