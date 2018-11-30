<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script>
    var xmlhttp=new XMLHttpRequest();
    var url='edit.php?id';
    xmlhttp.open('GET',url,true);
    xmlhttp.send();
</script>
<?php
require_once "includs/Classes.php";
if (isset($_GET['id']))
{
    $edit=new editStudent($_GET['id']);
}