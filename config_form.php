<?php echo js_tag('vendor/tinymce/tinymce.min'); ?>
<script type="text/javascript">
jQuery(document).ready(function () {
	Omeka.wysiwyg({
		selector: '.html-editor'
	});
});
</script>

<?php 
$htl_page_path  = get_option('honor_thy_librarians_page_path');
$htl_page_title = get_option('honor_thy_librarians_page_title');
$htl_pre_text   = get_option('honor_thy_librarians_pre_text');
$htl_post_text  = get_option('honor_thy_librarians_post_text');
$htl_sort_order = get_option('honor_thy_librarians_sort_order');
$htl_use_css	= get_option('honor_thy_librarians_use_css');
$view       	= get_view();
?>

<h2><?php echo __('Page settings'); ?></h2>

<div class="field">
	<div class="two columns alpha">
		<?php echo $view->formLabel('htl_page_path', __('Page path')); ?>
	</div>
	<div class="inputs five columns omega">
		<p class="explanation">
			<?php echo __('The path to the page listing the librarians. For example, if your site is hosted at <code>http://my-omeka-site.org/</code>, and the value of this field is <code>librarians/</code>, then your page will be displayed at <code>http://my-omeka-site.org/librarians/</code>.') ?>
		</p>
		<?php echo $view->formText('htl_page_path', $htl_page_path, array('class' => 'textinput')); ?>
	</div>
</div>

<div class="field">
	<div class="two columns alpha">
		<?php echo $view->formLabel('htl_page_title', __('Page title')); ?>
	</div>
	<div class="inputs five columns omega">
		<p class="explanation">
			<?php echo __('The title that will display on the librarians page and in the main site navigation.') ?>
		</p>
		<?php echo $view->formText('htl_page_title', $htl_page_title, array('class' => 'textinput')); ?>
	</div>
</div>

<div class="field">
	<div class="two columns alpha">
		<?php echo $view->formLabel('htl_pre_text', __('Pre display text')); ?>
	</div>
	<div class="inputs five columns omega">
		<p class="explanation">
			<?php echo __('The text that will display before the table of librarians.') ?>
		</p>
		<?php echo $view->formTextarea('htl_pre_text', $htl_pre_text, array('rows' => '10', 'cols' => '60', 'class' => array('html-editor'))); ?>
	</div>
</div>

<div class="field">
	<div class="two columns alpha">
		<?php echo $view->formLabel('htl_post_text', __('Post display text')); ?>
	</div>
	<div class="inputs five columns omega">
		<p class="explanation">
			<?php echo __('The text that will display after the table of librarians.') ?>
		</p>
		<?php echo $view->formTextarea('htl_post_text', $htl_post_text, array('rows' => '10', 'cols' => '60', 'class' => array('html-editor'))); ?>
	</div>
</div>

<h2><?php echo __('Table settings'); ?></h2>

<div class="field">
	<div class="two columns alpha">
		<?php echo $view->formLabel('htl_sort_order', __('Sort order')); ?>
	</div>
	<div class="inputs five columns omega">
		<p class="explanation">
			<?php echo __('The order librarians will be sorted on.') ?>
		</p>
		<?php echo $view->formSelect('htl_sort_order', $htl_sort_order, array(), array('name' => __('Name'), 'count' => __('Contributions'), 'date' => __('Last contribution date'))); ?>
	</div>
</div>

<div class="field">
	<div class="two columns alpha">
		<?php echo $view->formLabel('htl_use_css', __('Style table with CSS')); ?>
	</div>
	<div class="inputs five columns omega">
		<p class="explanation">
			<?php echo __('If checked, will apply plugin css stylesheet to table.') ?>
		</p>
		<?php echo $view->formCheckbox('htl_use_css', $htl_use_css, null, array('1', '0')); ?>
	</div>
</div>