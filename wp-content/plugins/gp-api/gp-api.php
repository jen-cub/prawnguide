<?php

/**
 *
 * @wordpress-plugin
 * Plugin Name: Greenpeace API
 * Description: A connector module to communicate with the Greenpeace API
 * Author: Agency
 * Version: 1.0
 * Author URI: http://agency.sc/
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}


// // Temporary Country Detect
// if(empty($_SERVER["HTTP_CF_IPCOUNTRY"]))
// 	$_SERVER["HTTP_CF_IPCOUNTRY"] = "AU";

// if(session_id() == '')
//      session_start();

/**
 * Main Music Australia Registration Class
 *
 * @class MA_Registration
 * @version 0.1
 */
class GP_API {

	function __construct() {

		$this->path = plugin_dir_path(__FILE__);
		$this->folder = basename($this->path);
		$this->dir = plugin_dir_url(__FILE__);
		$this->version = '1.0';

		$this->gp_form_id = 'PRWNG2015-SIGNUP'; 
		$this->gp_form_key = 'ba4405ac-9d3e-11e5-9f89-5';
		$this->gp_form_url = 'https://www.greenpeace.org.au/api/post/';

		$this->error = false;
		$this->notice = false;

		// Actions
		// add_action('init', array($this, 'register_types'), 10, 0);
		// add_action('wp', array($this, 'setup_cron_schedules'));

		// Load NRO
		// add_action('wp_loaded', array($this , 'forms'));
		add_action('parse_request', array($this , 'custom_url_paths'));

		add_action('admin_menu', array($this, 'register_options_page'));

		add_action('gpap_api', array($this, 'submit_petition'), 10, 1);


	}

	/**
	 * Register options page
	 */
	public function register_options_page() {

		// main page
		add_options_page('Greenpeace API', 'Greenpeace API', 'manage_options', 'gp_api_options', array($this, 'include_options'));
		add_action('admin_init', array($this, 'plugin_options'));

	}


	/**
	 * Get options template
	 */
	public function include_options() {

		require('gp-options.php');

	}


	/**
	 * Register plugin settings
	 */
	public function plugin_options() {

		register_setting('gp_api_options', 'gp_thankyou_id');

	}


	/**
	 * Custom URLS
	 *
	 * Manages custom permalinks and routes for
	 * plugin pages and API calls
	 *
	 */
	public function custom_url_paths($wp) {
		$pagename = (isset($wp->query_vars['pagename'])) ? $wp->query_vars['pagename'] : $wp->request;
		switch ($pagename) {
			case 'gpap/submit':
				$this->output_json($this->submit($_POST));
				break;
			default:
				break;
		}
	}


	/**
	 * Submit a new petition signature
	 *
	 * @param $vars $_POST data
	 */
	public function submit($vars) {

		$vars = array(
			'firstname' => $_POST['first_name'],
			'lastname' => $_POST['last_name'],
			'email' => $_POST['email'],
			'country' => $_POST['country'],
			'postcode' => $_POST['postcode'],
			'phone' => $_POST['phone'],
			'src' => (isset($_POST['src'])) ? filter_var($_POST['src'], FILTER_SANITIZE_URL) : 'UP', //$_POST['src'],
			'opt-email' => 1
		);

		if ($res = $this->submit_to_greenpeace($vars)) {

			return array('success' => true);

		} else {

			return array('success' => false, 'message' => $this->errors[0]);
		}

	}

	private function submit_to_greenpeace($values) {

		$fields = array(
			'firstname' => $values['firstname'],
			'lastname' => $values['lastname'],
			'email' => $values['email'],
			'country' => $values['country'],
			'postcode' => $values['postcode'],
			'phone' => $values['phone'],
			'src' => $values['src'],
			'opt-email' => isset($values['opt-email']) ? intval($values['opt-email']) : 1,
			'opt-offline-action' => ($values['consent']) ? 1 : 0,
			'GPAP_FORMID' => $this->gp_form_id,
			'GPAP_FORMKEY' => $this->gp_form_key
		);

		$post_fields = http_build_query($fields);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->gp_form_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);

		$response = curl_exec($ch);
		curl_close($ch);

		$response = json_decode($response);
		// print_r($response);
		// exit;

		if ($response->GPAP_API->status->statusCode == 200) {

			return true;

		} else if ($response->GPAP_API->status->statusCode == 300) {

			foreach ($response->GPAP_API->fields as $key => $field) {

				foreach ($field as $field_key => $field_value) {

					if ($field_value->code != '0') {
						$this->errors[] = __($field_value->text, 'gpapi');
					}

				}

			}

			return false;

		} else {
			$this->errors[] = __("Sorry, we are unable to process your request at this time. Please try again later.",'gp_api');
			return false;

		}

	}

	/**
	 * Email wrapper, to allow for string replacement
	 */
	public function email($to, $subject, $message, $replacements=array()) {

		//replacements
		foreach ($replacements as $variable => $replacement) {
			$message = str_replace($variable, $replacement, $message);
			$subject = str_replace($variable, $replacement, $subject);
		}

		//Send from the site email
		$headers = 'From: ' . get_bloginfo('name') . ' <' . get_bloginfo('admin_email') . '>' . "\r\n";

		//WP mail function
		wp_mail( $to, $subject, $message , $headers);
	}


	/**
	 * Output JSON
	 *
	 * @param $array Array to encode
	 */
	public function output_json($array) {

		header('Content-type: application/json');
		echo json_encode($array);
		exit();

	}


	public function redirect($path) {

		wp_redirect( $path );
	  	exit();

	}


}


/**
 * @var class Donatability $donatability
 */

$gp_api = new GP_API();
