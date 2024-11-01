<?php
/*
Plugin Name: The Viral Widget
Plugin URI: 
Description: Make your website go viral by allowing users to spread the word!
Version: 1.5
Author: Podz
Author URI: 
*/

/*  Copyright 2010 

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Hook for adding admin menus
add_action('admin_menu', 'theviralwidget_wp_add_pages');

// action function for above hook
function theviralwidget_wp_add_pages() {
    add_options_page('The Viral Widget', 'The Viral Widget', 'administrator', 'theviralwidget_wp', 'theviralwidget_wp_options_page');
}

// theviralwidget_wp_options_page() displays the page content for the Test Options submenu
function theviralwidget_wp_options_page() {

    // variables for the field and option names 
    $opt_name = 'mt_theviralwidget_address';
	$opt_name_2 = 'mt_theviralwidget_title';
    $opt_name_5 = 'mt_theviralwidget_plugin_support';
	$opt_name_6 = 'mt_theviralwidget_limit';
	$opt_name_7 = 'mt_theviralwidget_subject';
	$opt_name_10 = 'mt_theviralwidget_message';
	$opt_name_13 = 'mt_theviralwidget_authoremail';
    $hidden_field_name = 'mt_theviralwidget_submit_hidden';
    $data_field_name = 'mt_theviralwidget_address';
	$data_field_name_2 = 'mt_theviralwidget_title';
    $data_field_name_5 = 'mt_theviralwidget_plugin_support';
    $data_field_name_6 = 'mt_theviralwidget_limit';
    $data_field_name_7 = 'mt_theviralwidget_subject';
	$data_field_name_10 = 'mt_theviralwidget_message';
	$data_field_name_13 = 'mt_theviralwidget_authoremail';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
	$opt_val_2 = get_option($opt_name_2);
    $opt_val_5 = get_option($opt_name_5);
    $opt_val_6 = get_option($opt_name_6);
    $opt_val_7 = get_option($opt_name_7);
	$opt_val_10 = get_option($opt_name_10);
	$opt_val_13 = get_option($opt_name_13);

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
		$opt_val_2 = $_POST[$data_field_name_2];
        $opt_val_5 = $_POST[$data_field_name_5];
        $opt_val_6 = $_POST[$data_field_name_6];
        $opt_val_7 = $_POST[$data_field_name_7];
		$opt_val_10 = $_POST[$data_field_name_10];
		$opt_val_13 = $_POST[$data_field_name_13];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
		update_option( $opt_name_2, $opt_val_2 );
        update_option( $opt_name_5, $opt_val_5 );
        update_option( $opt_name_6, $opt_val_6 );  
        update_option( $opt_name_7, $opt_val_7 ); 
		update_option( $opt_name_10, $opt_val_10 );
		update_option( $opt_name_13, $opt_val_13 );

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'The Viral Widget Plugin Options', 'mt_trans_domain' ) . "</h2>";

    // options form
    
    $change3 = get_option("mt_theviralwidget_plugin_support");

if ($change3=="Yes" || $change3=="") {
$change3="checked";
$change31="";
} else {
$change3="";
$change31="checked";
}

    ?>
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Widget Title:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_2; ?>" value="<?php echo $opt_val_2; ?>" size="50">
</p><hr />

<p><?php _e("Subject of E-Mail (Use %NAME% for Sender's Name, %EMAIL% for Sender's E-Mail):", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_7; ?>" value="<?php echo $opt_val_7; ?>" size="50">
</p><hr />

<p><?php _e("Message in E-Mail (Use %SITEURL% for your URL, %NAME% for Sender's Name, %EMAIL% for Sender's E-Mail and %RECIPIENT% for Recipient's E-Mail):", 'mt_trans_domain' ); ?> 
<textarea name="<?php echo $data_field_name_10; ?>" rows="5" cols="40"><?php echo $opt_val_10; ?></textarea>
</p><hr />

<p><?php _e("Your E-Mail (To be BCC'ed, optional):", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_13; ?>" value="<?php echo $opt_val_13; ?>" size="50">
</p><hr />

<p><?php _e("Maximum Number of Recipients:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_6; ?>" value="<?php echo $opt_val_6; ?>" size="50">
</p><hr />

<p><?php _e("Support this Plugin?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="Yes" <?php echo $change3; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="No" <?php echo $change31; ?>>No
</p><hr />

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p><hr />

</form>
<?php
}

function show_theviralwidget_form($args) {
extract($args);

  $my_email = get_option("mt_theviralwidget_address"); 
  $title = get_option("mt_theviralwidget_title");
  $limit = get_option("mt_theviralwidget_limit");
  $plugin_support2 = get_option("mt_theviralwidget_plugin_support");
  $hidden_variable = $_POST['hidden_variable'];
  $subject = get_option("mt_theviralwidget_subject");
  $message = get_option("mt_theviralwidget_message");
  $author_email = get_option("mt_theviralwidget_authoremail");

if ($title=="") {
$title="Tell Your Friends";
}

if ($limit=="") {
$limit=10;
}

if ($subject=="") {
$subject="%NAME% recommended this webpage!";
}

if ($message=="") {
$message="Hi,

Your friend, %NAME% (%EMAIL%), recommended that you visit one of their favourite webpages, go to %SITEURL% to visit it!

Thanks!";
}

if ($author_email=="") {
$author_email=get_option('admin_email');
}


if ($hidden_variable=="done") {
$sub_name=$_POST['myname'];
$sub_email=$_POST['myemail'];
$recipients=$_POST['recipients'];

$blog_url=get_bloginfo('siteurl');

$sub_name=stripslashes(strip_tags($sub_name));
$sub_email=stripslashes(strip_tags($sub_email));
$sub_recipients=stripslashes(strip_tags($recipients));

if ($sub_name=="" || $sub_email=="" || $sub_recipients=="") {
$varwrong=1;

echo $before_title.$title.$after_title.$before_widget;

echo "<p>A required field was not filled in. Please try again.</p>";

echo '<form action="'.$_SERVER['php_self'].'" method="post">';

echo '<p>Your Name*: <input type="text" name="myname" /></p>';

echo '<p>Your E-Mail*: <input type="text" name="myemail" /></p>';

echo '<p>Recipients (E-mails, Separated by commas): <textarea name="recipients"></textarea></p>';

echo '<input type="hidden" name="hidden_variable" value="done" />';

if (is_home()) {
$Path=get_bloginfo('url');
} else {
$Path=get_permalink();
}

echo '<input type="hidden" name="url1" value="'.$Path.'" /><input type="submit" value="Submit" /></form>';

if ($plugin_support2=="Yes" || $plugin_support2=="") {
add_action('wp_footer', 'theviralwidget_plugin_support');
}

echo $after_widget;
}

if ($varwrong!=1) {
$x=1;
$message=str_replace("%SITEURL%", stripslashes($_POST['url1']), $message);
$message=str_replace("%NAME%", $sub_name, $message);
$message=str_replace("%EMAIL%", $sub_email, $message);

$message=nl2br($message);
$message=str_replace("<br />", "\n", $message);
$message=str_replace("<br>", "\n", $message);

$sub_recipients=str_replace(" ", "", $sub_recipients);
$myArray = explode(',', $sub_recipients);

foreach($myArray as $key=>$value)
    {
$headers = "From: ".$sub_email."\r\n";

if ($author_email != "") {
$headers .= "Bcc: ".$author_email."\r\n";
}

$subject=str_replace("%SITEURL%", stripslashes($_POST['url1']), $subject);
$subject=str_replace("%NAME%", $sub_name, $subject);
$subject=str_replace("%EMAIL%", $sub_email, $subject);

$emailsubject=$subject;

$message1=str_replace("%RECIPIENT%", $value, $message);

if ($x<=$limit) {
mail($value,$emailsubject,$message1,$headers);
$x ++;
}
}
echo $before_title.$title.$after_title.$before_widget."<p>Thank you for telling your friends!</p>";

echo '<form action="'.$_SERVER['php_self'].'" method="post">';

echo '<p>Your Name*: <input type="text" name="myname" /></p>';

echo '<p>Your E-Mail*: <input type="text" name="myemail" /></p>';

echo '<p>Recipients (E-Mails, Separated by commas): <textarea name="recipients"></textarea></p>';

echo '<input type="hidden" name="hidden_variable" value="done" />';

if (is_home()) {
$Path=get_bloginfo('url');
} else {
$Path=get_permalink();
}

echo '<input type="hidden" name="url1" value="'.$Path.'" /><input type="submit" value="Submit" /></form>';

if ($plugin_support2=="Yes" || $plugin_support2=="") {
add_action('wp_footer', 'theviralwidget_plugin_support');
}

echo $after_widget;
}
} else {

echo $before_title.$title.$after_title.$before_widget;

echo '<form action="'.$_SERVER['php_self'].'" method="post">';

echo '<p>Your Name*: <input type="text" name="myname" /></p>';

echo '<p>Your E-Mail*: <input type="text" name="myemail" /></p>';

echo '<p>Recipients (Separated by commas): <textarea name="recipients"></textarea></p>';

echo '<input type="hidden" name="hidden_variable" value="done" />';

if (is_home()) {
$Path=get_bloginfo('url');
} else {
$Path=get_permalink();
}

echo '<input type="hidden" name="url1" value="'.$Path.'" /><input type="submit" value="Submit" /></form>';

if ($plugin_support2=="Yes" || $plugin_support2=="") {
add_action('wp_footer', 'theviralwidget_plugin_support');
}

echo $after_widget;
}
}

function init_theviralwidget_widget() {
register_sidebar_widget('The Viral Widget', 'show_theviralwidget_form');
}

function theviralwidget_plugin_support() {
if (get_option("theviralwidget_wp_saved")=="") {
$echome="";
update_option("theviralwidget_wp_saved", $echome);
echo $echome;
} else {
$echome=get_option("theviralwidget_wp_saved");
echo $echome;
}
}

add_action("plugins_loaded", "init_theviralwidget_widget");

?>
