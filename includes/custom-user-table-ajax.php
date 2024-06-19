<?php

// AJAX handler for loading users
function custom_user_table_load_users() {
    // Get parameters
    $role = isset($_POST['role']) ? sanitize_text_field($_POST['role']) : '';
    $username_sort = isset($_POST['username_sort']) ? sanitize_text_field($_POST['username_sort']) : 'asc';
    // $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $search_value = isset($_POST['search']['value']) ? sanitize_text_field($_POST['search']['value']) : '';
    $start = isset($_POST['start']) ? intval($_POST['start']) : 0;
    $length = isset($_POST['length']) ? intval($_POST['length']) : 10;
    $per_page = 10; // Number of users per page

    // Calculate offset
    $offset = ($page - 1) * $per_page;

    // Prepare arguments for WP_User_Query
    $args = array(
        'role'     => $role,
        'orderby'  => 'login',
        'order'    => $username_sort,
        'number'   => $length,
        'offset'   => $start,
        'search'   => '*' . $search_value . '*', // Adjust search logic as needed
    );

    // Query users
    $user_query = new WP_User_Query($args);
    $users = $user_query->get_results();

    // Total users count without pagination
    $total_users = $user_query->get_total();

    // Prepare response
    $response = array(
        'draw'            => intval($_POST['draw']),
        'recordsTotal'    => $total_users,
        'recordsFiltered' => $total_users, // Placeholder for filtering logic
        'data'            => array(),
    );

    // Format user data
    if (!empty($users)) {
        foreach ($users as $user) {
            $response['data'][] = array(
                'username' => $user->user_login,
                'email'    => $user->user_email,
                'role'     => implode(', ', $user->roles),
            );
        }
    }

    // Return JSON response
    wp_send_json($response);
}
add_action('wp_ajax_custom_user_table_load_users', 'custom_user_table_load_users');

?>