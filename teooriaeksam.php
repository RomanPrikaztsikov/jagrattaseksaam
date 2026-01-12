<?php
require_once("konf.php");
global $yhendus;
if(!empty($_REQUEST["teooriatulemus"])){
    $tulemus = $_REQUEST["teooriatulemus"];
    // Kontrollime, et punktid jääksid vahemikku 0-20
    if($tulemus >= 0 && $tulemus <= 20){
        $kask=$yhendus->prepare("UPDATE jalgrattaeksam SET teooriatulemus=? WHERE id=?");
        $kask->bind_param("ii", $tulemus, $_REQUEST["id"]);
        $kask->execute();
    }
}
$kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi FROM jalgrattaeksam WHERE teooriatulemus=-1");
$kask->bind_result($id, $eesnimi, $perekonnanimi);
$kask->execute();
?>
<!doctype html>
<html>
<head>
    <title>Teooriaeksam</title>
</head>
<body>
<?php include("nav.php"); ?>
<h1>Teooriaeksam</h1>
<table>
    <?php
    while($kask->fetch()){
        echo " 
 <tr> 
 <td>$eesnimi</td> 
 <td>$perekonnanimi</td> 
 <td><form action=''> 
 <input type='hidden' name='id' value='$id' /> 
 <input type='number' name='teooriatulemus' min='0' max='20' required />
 <input type='submit' value='Sisesta tulemus' /> 
 </form> 
 </td> 
</tr> 
 ";
    }
    ?>
</table>
</body>
</html>