<?php require_once('Connections/koneksi.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_rec_mhs = "-1";
if (isset($_GET['id'])) {
  $colname_rec_mhs = $_GET['id'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rec_mhs = sprintf("SELECT * FROM tbl_mhs WHERE id = %s", GetSQLValueString($colname_rec_mhs, "int"));
$rec_mhs = mysql_query($query_rec_mhs, $koneksi) or die(mysql_error());
$row_rec_mhs = mysql_fetch_assoc($rec_mhs);
$totalRows_rec_mhs = mysql_num_rows($rec_mhs);
?>
@charset "utf-8";
/* CSS Document */

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	background: #42413C;
	margin: 0;
	padding: 0;
	color: #000;
}

/* ~~ Element/tag selectors ~~ */
ul, ol, dl { /* Due to variations between browsers, it's best practices to zero padding and margin on lists. For consistency, you can either specify the amounts you want here, or on the list items (LI, DT, DD) they contain. Remember that what you do here will cascade to the .nav list unless you write a more specific selector. */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* removing the top margin gets around an issue where margins can escape from their containing div. The remaining bottom margin will hold it away from any elements that follow. */
	padding-right: 15px;
	padding-left: 15px; /* adding the padding to the sides of the elements within the divs, instead of the divs themselves, gets rid of any box model math. A nested div with side padding can also be used as an alternate method. */
}
a img { /* this selector removes the default blue border displayed in some browsers around an image when it is surrounded by a link */
	border: none;
}
/* ~~ Styling for your site's links must remain in this order - including the group of selectors that create the hover effect. ~~ */
a:link {
	color: #42413C;
	text-decoration: underline; /* unless you style your links to look extremely unique, it's best to provide underlines for quick visual identification */
}
a:visited {
	color: #6E6C64;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* this group of selectors will give a keyboard navigator the same hover experience as the person using a mouse. */
	text-decoration: none;
}

/* ~~ this fixed width container surrounds the other divs ~~ */
.container {
	width: 960px;
	background: #FFF;
	margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout */
}

/* ~~ the header is not given a width. It will extend the full width of your layout. It contains an image placeholder that should be replaced with your own linked logo ~~ */
.header {
	background: #ADB96E;
}

/* ~~ This is the layout information. ~~ 

1) Padding is only placed on the top and/or bottom of the div. The elements within this div have padding on their sides. This saves you from any "box model math". Keep in mind, if you add any side padding or border to the div itself, it will be added to the width you define to create the *total* width. You may also choose to remove the padding on the element in the div and place a second div within it with no width and the padding necessary for your design.

*/

.content {

	padding: 10px 0;
}

/* ~~ The footer ~~ */
.footer {
	padding: 10px 0;
	background: #CCC49F;
}

/* ~~ miscellaneous float/clear classes ~~ */
.fltrt {  /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page. The floated element must precede the element it should be next to on the page. */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* this class can be placed on a <br /> or empty div as the final element following the last floated div (within the #container) if the #footer is removed or taken out of the #container */
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}
-->
</style></head>

<body>

<div class="container">
  <div class="header"><a href="#"><img src="" alt="Insert Logo Here" name="Insert_logo" width="960" height="90" id="Insert_logo" style="background: #C6D580; display:block;" /></a> 
    <!-- end .header --></div>
  <div class="content">
    <h1>Detail Data Mahasiswa</h1>
    <p>Berikut detail data mahasiswa</p>
    <table width="95%" border="0" cellspacing="4" cellpadding="4">
      <tr>
        <td>ID</td>
        <td>:</td>
        <td><?php echo $row_rec_mhs['id']; ?></td>
      </tr>
      <tr>
        <td>Nama</td>
        <td>:</td>
        <td><?php echo $row_rec_mhs['nama']; ?></td>
      </tr>
      <tr>
        <td>NPM</td>
        <td>:</td>
        <td><?php echo $row_rec_mhs['npm']; ?></td>
      </tr>
      <tr>
        <td>Kelas</td>
        <td>:</td>
        <td><?php echo $row_rec_mhs['kls']; ?></td>
      </tr>
      <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td><?php echo $row_rec_mhs['jk']; ?></td>
      </tr>
      <tr>
        <td>Email</td>
        <td>:</td>
        <td><?php echo $row_rec_mhs['email']; ?></td>
      </tr>
      <tr>
        <td>Telepon</td>
        <td>:</td>
        <td><?php echo $row_rec_mhs['telp']; ?></td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td>:</td>
        <td><?php echo $row_rec_mhs['alamat']; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><input type="button" value="Cancel" onclick="self.history.back()"/></td>
      </tr>
    </table>
    <p>&nbsp;</p>
  </div>
  <div class="footer">
    <p>Footer</p>
  <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
</html>
<?php
mysql_free_result($rec_mhs);
?>
