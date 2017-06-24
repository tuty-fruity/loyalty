<?php

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

