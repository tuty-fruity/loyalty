<?php
// Theme CSS/JS
add_action( 'wp_enqueue_scripts', 'theme_css_js' );
function theme_css_js()
{
	// CSS
	wp_enqueue_style('styles-main', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '', 'all' );
	// JS
	if(!is_admin()){
		// Disable loading of jquery on wordpress core
		wp_deregister_script('jquery'); 
		wp_deregister_script( 'wp-embed');
	}

	wp_enqueue_script('script-jquery', 'https://code.jquery.com/jquery-3.2.1.min.js', array(), '', TRUE);
	wp_enqueue_script('script-jquery-form-validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js', array(), '', TRUE);
	wp_enqueue_script('script-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array(), '', TRUE);
	wp_enqueue_script('script-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), '', TRUE);
	
	wp_localize_script('script-custom', 'wpAjax', array(
		'ajaxUrl'   => admin_url('admin-ajax.php'),
		'ajaxNonce' => wp_create_nonce('wp_nonce')
	));
}

add_action('wp_ajax_register_user', 'register_user');
add_action('wp_ajax_nopriv_register_user', 'register_user');
function register_user()
{
	global $wpdb;

    $customer_name = $_POST['customer_name'];
    $eight_digit_num = $_POST['eight_digit_num'];

    $query = $wpdb->insert(
        'tbl_accounts',
        array(
            'name'=> $customer_name,
            'eigth_digit_no' => $eight_digit_num,
			// 'created_at' => '',
			// 'update_at' => ''
        )
    );

    $response = array();

    if($query == 1)
    {
        $_SESSION['id'] = $wpdb->insert_id;
        $_SESSION['status'] = 'logged_in';

        $response['status'] = 'success';
        $response['test'] = 'test message';
        $response['redirect'] = get_bloginfo('url') . '/index.php/profile/';
    }
    else
    {
        $response['status'] = 'failed';
    }

	wp_send_json($response);
	wp_die();
}

// dont call it on ajax 
function checkSession($array)
{
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

add_action('init', 'startSession', 1);
function startSession()
{
    if(!session_id()) {
        session_start();
    }
}

add_action('wp_ajax_destroy_session', 'destroy_session');
add_action('wp_ajax_nopriv_destroy_session', 'destroy_session');
function destroy_session()
{
    $session = session_destroy();
    $response = array();

    if($session == 1)
    {
        $response['status'] = 'success';
        $response['redirect'] = get_bloginfo('url') . '/index.php/registration/';
    }
    else
    {
        $response['status'] = 'failed';
    }

    wp_send_json($response);
    wp_die();
}

function get_data($table_name, $id)
{
    global $wpdb;
    $query = $wpdb->get_row("SELECT * FROM $table_name WHERE id=$id");
    return $query;
}
