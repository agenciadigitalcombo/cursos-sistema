<?php
$CI = get_instance();
$CI->load->database();
$CI->load->dbforge();


// CREATING CERTIFICATE TABLE
$fields = array(
	'id' => array(
		'type' => 'INT',
		'constraint' => 11,
		'unsigned' => TRUE,
		'auto_increment' => TRUE,
		'collation' => 'utf8_unicode_ci'
	),
	'student_id' => array(
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
	'shareable_url' => array(
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
$CI->dbforge->create_table('certificates', TRUE);





$settings_data = array( 'key' => 'certificate_template', 'value' => 'This is to certify that Mr. / Ms. {student} successfully completed the course with on certificate for {course}.' );

if($CI->db->get_where('settings', ['key' => 'certificate_template'])->num_rows() > 0){

	$CI->db->where('key', 'certificate_template');
	$CI->db->update('settings', $settings_data);

}else{

	$CI->db->insert('settings', $settings_data);

}
// INSERT DATA IN SETTINGS TABLE


// INSERT DATA IN SETTINGS TABLE
$settings_positons_data = array( 'key' => 'certificate-text-positons', 'value' => '
			&lt;div class=&quot;this-template&quot; style=&quot;width: 750px; position: relative;&quot;&gt;
				&lt;img width=&quot;100%&quot; src=&quot;..\..\uploads/certificates/template.jpg&quot;&gt;
				&lt;div class=&quot;draggable instructor_name&quot; style=&quot;position: absolute; font-family: &amp;quot;Miss Fajardose&amp;quot;; font-size: 40px; top: 373.892px; left: 553.889px;&quot;&gt;{instructor}&lt;/div&gt;&lt;div class=&quot;draggable course_level&quot; style=&quot;position: absolute;font-size: 16px;top: 444.861px;left: 84.8681px;&quot;&gt;{course_level}&lt;/div&gt;
&lt;div class=&quot;draggable course_language&quot; style=&quot;position: absolute; font-size: 16px; top: 155.84px; left: 65.8473px;&quot;&gt;{course_language}&lt;/div&gt;
&lt;div class=&quot;draggable student_name&quot; style=&quot;position: absolute; font-family: &amp;quot;Miss Fajardose&amp;quot;, cursive; font-size: 40px; top: 373.92px; left: 59.9063px;&quot;&gt;{student}&lt;/div&gt;
&lt;div class=&quot;draggable duration_name&quot; style=&quot;position: absolute; font-size: 16px; top: 341.837px; left: 328.806px;&quot;&gt;{total_duration}&lt;/div&gt;
&lt;div class=&quot;draggable lesson_name&quot; style=&quot;position: absolute;font-size: 16px;top: 341.882px;left: 124.868px;&quot;&gt;{total_lesson}&lt;/div&gt;
				&lt;div class=&quot;draggable course_completion_date&quot; style=&quot;position: absolute; font-size: 20px; top: 151.924px; left: 543.896px;&quot;&gt;{date}&lt;/div&gt;
				&lt;div class=&quot;draggable certificate_text&quot; style=&quot;position: absolute;width: 500px;text-align: center;font-size: 28px;top: 228.948px;font-family: &amp;quot;Pinyon Script&amp;quot;;left: 123.903px;&quot;&gt;This is to certify that Mr. / Ms. {student} successfully completed the course with on certificate for {course}.&lt;/div&gt;
				&lt;div class=&quot;draggable qrCode&quot; style=&quot;position: absolute; width: 65px; height: 65px; text-align: center; font-size: 20px; top: 76.9202px; left: 594.924px;&quot;&gt;&lt;p style=&quot;text-align: center; padding: 4px 0px;&quot;&gt;Qr code&lt;/p&gt;&lt;/div&gt;
			&lt;/div&gt;
																																																																																				');

if($CI->db->get_where('settings', ['key' => 'certificate-text-positons'])->num_rows() > 0){

	$CI->db->where('key', 'certificate-text-positons');
	$CI->db->update('settings', $settings_positons_data);
	} else {
		$CI->db->insert('settings', $settings_positons_data);
	}
?>



