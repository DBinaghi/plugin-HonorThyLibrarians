<?php 

	/**
	 * Honor Thy Librarians plugin for Omeka
	 * 
	 * @copyright Copyright 2013 Lincoln A. Mullen
	 *            Copyright 2018-2021 Daniele Binaghi
	 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
	 *
	 */

	// Define constants that set default options
	define('HONOR_THY_LIBRARIANS_PAGE_PATH',	'librarians/');
	define('HONOR_THY_LIBRARIANS_PAGE_TITLE',	__('Librarians'));
	define('HONOR_THY_LIBRARIANS_PRE_TEXT',		__('The following people have contributed to this website.'));
	define('HONOR_THY_LIBRARIANS_POST_TEXT',	__('We want to thank them all very much for their help and support.'));

	class HonorThyLibrariansPlugin extends Omeka_Plugin_AbstractPlugin
	{

		// Define hooks
		protected $_hooks = array(
			'install',
			'uninstall',
			'initialize',
			'define_routes',
			'config_form',
			'config',
			'public_head'
		);

		protected $_filters = array (
			'public_navigation_main'
		);

		public function hookInstall() 
		{
			// Set the url to the public page as a url that can be changed
			set_option('honor_thy_librarians_page_path',	HONOR_THY_LIBRARIANS_PAGE_PATH);
			set_option('honor_thy_librarians_page_title',	HONOR_THY_LIBRARIANS_PAGE_TITLE);
			set_option('honor_thy_librarians_pre_text',		HONOR_THY_LIBRARIANS_PRE_TEXT);
			set_option('honor_thy_librarians_post_text',	HONOR_THY_LIBRARIANS_POST_TEXT);
			set_option('honor_thy_librarians_sort_order',	'name');
			set_option('honor_thy_librarians_use_css',		0);
		}

		public function hookUninstall()
		{
			delete_option('honor_thy_librarians_page_path');
			delete_option('honor_thy_librarians_page_title');
			delete_option('honor_thy_librarians_pre_text');
			delete_option('honor_thy_librarians_post_text');
			delete_option('honor_thy_librarians_sort_order');
			delete_option('honor_thy_librarians_use_css');
		}

		public function hookInitialize()
		{
			add_translation_source(dirname(__FILE__) . '/languages');
			add_shortcode('librarians_table', array($this, 'librariansTable'));
		}

		public function hookDefineRoutes($args) {
			// Get the path to the librarians page from the options
			$page_path = get_option('honor_thy_librarians_page_path');

			// Direct the path to the view for this plugin
			$router = $args['router'];
			$router->addroute(
				'honor_thy_librarians_path',
				new Zend_Controller_Router_Route(
					$page_path, 
					array(
						'module'		=> 'honor-thy-librarians',
						'controller'	=> 'index',
						'action'		=> 'index'
					)
				)
			);
		}

		public function hookConfigForm() 
		{
			include 'config_form.php';
		}

		public function hookConfig($args)
		{
			$post = $args['post'];
			set_option('honor_thy_librarians_page_path',	$post['htl_page_path']);
			set_option('honor_thy_librarians_page_title',	$post['htl_page_title']);
			set_option('honor_thy_librarians_pre_text',		$post['htl_pre_text']);
			set_option('honor_thy_librarians_post_text',	$post['htl_post_text']);
			set_option('honor_thy_librarians_sort_order', 	$post['htl_sort_order']);
			set_option('honor_thy_librarians_use_css',	 	$post['htl_use_css']);
		}

		public function hookPublicHead()
		{
			if (get_option('honor_thy_librarians_use_css')) {
				queue_css_file('honor-thy-librarians');
			}
		}
		
		public function filterPublicNavigationMain($nav) 
		{
			$nav[] = array(
				'label' => get_option('honor_thy_librarians_page_title'),
				'uri' => url(get_option('honor_thy_librarians_page_path'))
			);
			return $nav;
		}
		
		public function librariansTable($args, $view)
		{
			return $view->librarians()->displayTable($args['arg1']);
		}
	}
?>
