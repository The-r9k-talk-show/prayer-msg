<?php
$perror = '';
$phone = $_POST['phone'];
$one = '+1';

function clean_phone($pstring)
{
 $pstring = filter_var($pstring, FILTER_SANITIZE_NUMBER_INT);

 return $pstring;
}
if(isset($_POST["submit"]))
{
 if(empty($_POST["phone"]))
 {
  $perror .= '<p><label class="text-danger">Anada su telefono</label></p>';
 }
 else
 {
  $phone = clean_phone($_POST["phone"]);
 }
if($perror == '')
 {
  $pfile_open = fopen("phones.csv", "a");
  $pno_rows = count(file("phones.csv"));
  if($pno_rows > 1)
  {
   $pno_rows = ($pno_rows - 1) + 1;
  }
  $pform_data = array(
   'phone'  => $one.$phone,
  );
  fputcsv($pfile_open, $pform_data);
  $phone = '';
   }
}
?>