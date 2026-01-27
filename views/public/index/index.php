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

        $preText = get_option('honor_thy_librarians_pre_text');
        if ($preText != '' && $preText != HONOR_THY_LIBRARIANS_PRE_TEXT) {
    		echo "<p>" . $preText . "</p>";
        } else {
            echo "<p>" . __(HONOR_THY_LIBRARIANS_PRE_TEXT) . "</p>";
        }
        
		echo $this->librarians()->displayTable(array(get_option('honor_thy_librarians_sort_order')));
		
        $postText = get_option('honor_thy_librarians_post_text');
        if ($postText != '' && $postText != HONOR_THY_LIBRARIANS_POST_TEXT) {
    		echo "<p>" . $postText . "</p>";
        } else {
            echo "<p>" . __(HONOR_THY_LIBRARIANS_POST_TEXT) . "</p>";
        }
	?> 
</div>

<?php echo foot(); ?>
