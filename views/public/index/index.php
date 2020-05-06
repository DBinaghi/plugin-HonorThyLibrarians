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
	?> 
	
	<table id="librarians">
		<thead>
			<tr>
				<th><?php echo __('Librarian') ?></th>
				<th style="text-align: center"><?php echo __('Items added/edited') ?></th>
				<th style="text-align: center"><?php echo __('Last contribution date') ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$db = get_db();

				$sql  = "SELECT b.id, b.name, COUNT(a.id) AS total, MAX( a.added ) AS lastdate";
				$sql .= " FROM " . $db->prefix . "items a";
				$sql .= " LEFT OUTER JOIN " . $db->prefix . "users b";
				$sql .= " ON a.owner_id = b.id";
				$sql .= " GROUP BY b.id";
				if (get_option('honor_thy_librarians_sort_order') == 'count') {
					$sql .= " ORDER BY total DESC, b.name ASC";
				} elseif (get_option('honor_thy_librarians_sort_order') == 'date') {
					$sql .= " ORDER BY lastdate DESC, b.name ASC";
				} else {
					$sql .= " ORDER BY b.name";
				}

				$librarians = $db->query($sql)->fetchall();
				$key = 0;
				
				foreach ($librarians as $librarian) {
					// Construct a url to the items the person has contributed
					$search_link =  url('items/browse', array(
						'search' => '',
						'user' => $librarian['id'],
						'submit_search' => 'Search')
					);
					// Create the table that displays the librarians
					echo "<tr class='" . (++$key%2 == 1 ? "odd" : "even") . "'>";
					echo "<td><a href='" . $search_link ."' title='" . __("Click to see all contributions by this librarian") . "'>" . $librarian['name'] . "</a></td>";
					echo "<td style='text-align: right'>" . $librarian['total'] . "</td>";
					echo "<td style='text-align: right'>" . format_date($librarian['lastdate']) . "</td>";
					echo "</tr>\n";
				}
			?>
		</tbody>
	</table>

	<?php echo "<p>" . get_option('honor_thy_librarians_post_text') . "</p>"; ?>

</div>

<?php echo foot(); ?>