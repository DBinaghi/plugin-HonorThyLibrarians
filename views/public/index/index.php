<?php

 /**
 * Honor Thy Contributors plugin for Omeka
 * 
 * @copyright Copyright 2013 Lincoln A. Mullen
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 *
 */

echo head(); ?>

<div id="primary">
	<?php 
		echo "<h1>" . __(get_option('honor_thy_librarians_page_title')) . "</h1>";

		echo "<p>" . get_option('honor_thy_librarians_pre_text') . "</p>";
		
		echo $this->librarians()->displayTable(array(get_option('honor_thy_librarians_sort_order')));
		
		echo "<p>" . get_option('honor_thy_librarians_post_text') . "</p>";
	?> 
</div>

<?php echo foot(); ?>