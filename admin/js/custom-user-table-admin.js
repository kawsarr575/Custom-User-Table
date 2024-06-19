(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	var table = $('#custom-user-datatable').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": {
			url: customUserTable.ajaxurl,
			type: 'POST',
			data: function (d) {
				d.action = 'custom_user_table_load_users';
				d.role = $('#role-filter').val();
				d.username_sort = $('#username-sort').val();
				d.page = d.start / d.length + 1; // Calculate current page
			},
			error: function (xhr, status, error) {
				console.error('AJAX error:', status, error);
			}
		},
		"columns": [
			{ "data": "username" },
			{ "data": "email" },
			{ "data": "role" }
		],
		"language": {
			"emptyTable": "No users found",
			"zeroRecords": "No matching users found"
		},
		"lengthMenu": [10, 25, 50, 100],
		"pageLength": 10
	});

	// Filter by role
	$('#role-filter').change(function () {
		table.ajax.reload();
	});

	// Sort by username
	$('#username-sort').change(function () {
		table.ajax.reload();
	});

	// Save filters in local storage
	$('#role-filter').change(function () {
		localStorage.setItem('selectedRole', $(this).val());
	});

	$('#username-sort').change(function () {
		localStorage.setItem('usernameSort', $(this).val());
	});

	// Load filters from local storage
	if (localStorage.getItem('selectedRole')) {
		$('#role-filter').val(localStorage.getItem('selectedRole'));
	}

	if (localStorage.getItem('usernameSort')) {
		$('#username-sort').val(localStorage.getItem('usernameSort'));
	}

})( jQuery );
