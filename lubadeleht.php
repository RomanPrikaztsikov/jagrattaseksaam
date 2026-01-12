<?php
require_once("konf.php");
global $yhendus;
$kask=$yhendus->prepare(
    "SELECT id, eesnimi, perekonnanimi, teooriatulemus,  
 slaalom, ringtee, t2nav, luba FROM jalgrattaeksam;");  $kask->bind_result($id, $eesnimi, $perekonnanimi, $teooriatulemus,   $slaalom, $ringtee, $t2nav, $luba);
$kask->execute();
?>
<!doctype html>
<html>
<head>
    <title>Lõpetamine</title>
</head>
<body>
<h1>Lõpetamine</h1>
<table>
    <?php
    while($kask->fetch()){
        echo " 
 <tr> 
 <td>$eesnimi</td> 
 <td>$perekonnanimi</td> 
 <td>$teooriatulemus</td> 
 <td>$slaalom</td> 
 <td>$ringtee</td> 
 <td>$t2nav</td> 
 <td>$luba</td> 
 </tr> 
 ";
    }
    ?>
</table>
</body>
</html>