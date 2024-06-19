

<div class="wrap custom-user-table">
    <h1>Custom User Table</h1>
    <div id="user-table-filters">
        <select id="role-filter">
            <option value="">All Roles</option>
            <?php
            global $wp_roles;
            foreach ($wp_roles->roles as $role => $details) {
                echo '<option value="' . esc_attr($role) . '">' . translate_user_role($details['name']) . '</option>';
            }
            ?>
        </select>
        <!-- <input type="text" id="username-sort" placeholder="Sort by Username"> -->
         <select id="username-sort">
            <option value="asc">Sort by Username (ASC)</option>
            <option value="desc">Sort by Username (DESC)</option>
        </select>
    </div>
    <table id="custom-user-datatable" class="display">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <!-- AJAX content will be loaded here -->
        </tbody>
    </table>
</div>
