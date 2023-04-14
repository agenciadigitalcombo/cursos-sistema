<?php
$CI = get_instance();
$CI->load->database();
$CI->load->dbforge();
// CREATING COURSE FORUM TABLE
$fields = array(
	'id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'unsigned' => TRUE,
		'auto_increment' => TRUE,
		'collation' => 'utf8_unicode_ci'
	),
	'user_id' => array(
		'type' => 'INT',
		'constraint' => '11',
		'default' => null,
		'null' => TRUE,
		'collation' => 'utf8_unicode_ci'
	),
	'course_id' => array(
		'type' => 'INT',
		'constraint' => '11',
		'default' => null,
		'null' => TRUE,
		'collation' => 'utf8_unicode_ci'
	),
	'title' => array(
		'type' => 'VARCHAR',
		'constraint' => '255',
		'default' => null,
		'null' => TRUE,
		'collation' => 'utf8_unicode_ci'
	),
	'description' => array(
		'type' => 'LONGTEXT',
		'default' => null,
		'null' => TRUE,
		'collation' => 'utf8_unicode_ci'
	),
	'upvoted_user_id' => array(
		'type' => 'LONGTEXT',
		'default' => null,
		'null' => TRUE,
		'collation' => 'utf8_unicode_ci'
	),
	'is_parent' => array(
		'type' => 'INT',
		'constraint' => '11',
		'default' => 0,
		'null' => TRUE,
		'collation' => 'utf8_unicode_ci'
	),
	'date_added' => array(
		'type' => 'VARCHAR',
		'constraint' => '255',
		'default' => null,
		'null' => TRUE,
		'collation' => 'utf8_unicode_ci'
	)
);
$CI->dbforge->add_field($fields);
$CI->dbforge->add_key('id', TRUE);
$attributes = array('collation' => "utf8_unicode_ci");
$CI->dbforge->create_table('course_forum', TRUE);
?>
