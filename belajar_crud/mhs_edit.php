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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tbl_mhs SET nama=%s, npm=%s, kls=%s, jk=%s, email=%s, telp=%s, alamat=%s WHERE id=%s",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['npm'], "text"),
                       GetSQLValueString($_POST['kls'], "text"),
                       GetSQLValueString($_POST['jk'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['telp'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
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

mysql_select_db($database_koneksi, $koneksi);
$query_rec_kls = "SELECT * FROM tbl_kls";
$rec_kls = mysql_query($query_rec_kls, $koneksi) or die(mysql_error());
$row_rec_kls = mysql_fetch_assoc($rec_kls);
$totalRows_rec_kls = mysql_num_rows($rec_kls);
?>
@charset "utf-8";
/* CSS Document */<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    <h1>Edit Data Mahasiswa</h1>
    <p>Silahkan edit data Mahasiswa pada form dibawah ini.</p>
    <p>&nbsp;</p>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Nama:</td>
          <td><input type="text" name="nama" value="<?php echo htmlentities($row_rec_mhs['nama'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Npm:</td>
          <td><input type="text" name="npm" value="<?php echo htmlentities($row_rec_mhs['npm'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Kls:</td>
          <td><select name="kls">
            <?php 
do {  
?>
            <option value="<?php echo $row_rec_kls['kls']?>" <?php if (!(strcmp($row_rec_kls['kls'], htmlentities($row_rec_mhs['kls'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_rec_kls['kls']?></option>
            <?php
} while ($row_rec_kls = mysql_fetch_assoc($rec_kls));
?>
          </select></td>
        </tr>
        <tr> </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Jk:</td>
          <td valign="baseline"><table>
            <tr>
              <td><input type="radio" name="jk" value="Laki-laki" <?php if (!(strcmp(htmlentities($row_rec_mhs['jk'], ENT_COMPAT, 'utf-8'),"Laki-laki"))) {echo "checked=\"checked\"";} ?> />
                Laki-laki</td>
            </tr>
            <tr>
              <td><input type="radio" name="jk" value="Perempuan" <?php if (!(strcmp(htmlentities($row_rec_mhs['jk'], ENT_COMPAT, 'utf-8'),"Perempuan"))) {echo "checked=\"checked\"";} ?> />
                Perempuan</td>
            </tr>
          </table></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Email:</td>
          <td><input type="text" name="email" value="<?php echo htmlentities($row_rec_mhs['email'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Telp:</td>
          <td><input type="text" name="telp" value="<?php echo htmlentities($row_rec_mhs['telp'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right" valign="top">Alamat:</td>
          <td><textarea name="alamat" cols="50" rows="5"><?php echo htmlentities($row_rec_mhs['alamat'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Update record" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form1" />
      <input type="hidden" name="id" value="<?php echo $row_rec_mhs['id']; ?>" />
    </form>
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

mysql_free_result($rec_kls);
?>
