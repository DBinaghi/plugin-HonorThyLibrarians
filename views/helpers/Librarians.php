<?php
	/**
	 * Helper to display librarians list.
	 *
	 * @package HonorThyLibrarians
	 */
	class HonorThyLibrarians_View_Helper_Librarians extends Zend_View_Helper_Abstract
	{
		/**
		 * Get the librarians view object.
		 *
		 * @return HonorThyLibrarians_View_Helper_Librarians This view helper.
		 */
		public function librarians()
		{
			return $this;
		}

		public function displayTable($args)
		{
			$db = get_db();
			
			$html =  "<table id='librarians'>\n";
			$html .= "<thead>\n";
			$html .= "<tr>";
			$html .= "<th>" . __('Librarian') . "</th>";
			$html .= "<th style='text-align: center'>" . __('Items added/edited') . "</th>";
			$html .= "<th style='text-align: center'>" . __('Last contribution date') . "</th>";
			$html .= "</tr>\n";
			$html .= "</thead>\n";
			$html .= "<tbody>\n";

			$sql  = "SELECT b.id, b.name, COUNT(a.id) AS total, MAX( a.added ) AS lastdate";
			$sql .= " FROM " . $db->prefix . "items a";
			$sql .= " LEFT OUTER JOIN " . $db->prefix . "users b";
			$sql .= " ON a.owner_id = b.id";
			$sql .= " GROUP BY b.id";
			if ($args['arg'] == 'count') {
				$sql .= " ORDER BY total DESC, b.name ASC";
			} elseif ($args['arg1'] == 'date') {
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
				$html .= "<tr class='" . (++$key%2 == 1 ? "odd" : "even") . "'>";
				$html .= "<td><a href='" . $search_link ."' title='" . __("Click to see all contributions by this librarian") . "'>" . $librarian['name'] . "</a></td>";
				$html .= "<td style='text-align: right'>" . $librarian['total'] . "</td>";
				$html .= "<td style='text-align: right'>" . format_date($librarian['lastdate']) . "</td>";
				$html .= "</tr>\n";
			}
			$html .= "</tbody>\n";
			$html .= "</table>\n";
			
			return $html;
		}
	}
?>