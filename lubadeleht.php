<?php
require_once("konf.php");
global $yhendus;
if(!empty($_REQUEST["kustuta_id"])){
    $kask=$yhendus->prepare("DELETE FROM jalgrattaeksam WHERE id=?");
    $kask->bind_param("i", $_REQUEST["kustuta_id"]);
    $kask->execute();
}
if(!empty($_REQUEST["vormistamine_id"])){
    $kask=$yhendus->prepare("UPDATE jalgrattaeksam SET luba=1 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["vormistamine_id"]);
    $kask->execute();
}
$kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi, teooriatulemus, slaalom, ringtee, t2nav, luba FROM jalgrattaeksam");
$kask->bind_result($id, $eesnimi, $perekonnanimi, $teooriatulemus, $slaalom, $ringtee, $t2nav, $luba);
$kask->execute();

function asenda($nr){
    if($nr==-1){return ".";}
    if($nr== 1){return "korras";}
    if($nr== 2){return "ebaõnnestunud";}
    return "Tundmatu";
}
?>
<!doctype html>
<html>
<body>
<?php include("nav.php"); ?>
<h1>Lõpetamine</h1>
<table>
    <tr>
        <th>Eesnimi</th>
        <th>Perekonnanimi</th>
        <th>Teooriaeksam</th>
        <th>Slaalom</th>
        <th>Ringtee</th>
        <th>Tänavasõit</th>
        <th>Lubade väljastus</th>
        <th>Kustutamine</th>
    </tr>
    <?php
    while($kask->fetch()){
        $loalahter=".";
        if($luba==1){$loalahter="Väljastatud";}
        if($luba==-1 and $t2nav==1){
            $loalahter="<a href='?vormistamine_id=$id'>Vormista load</a>";  }
        echo " 
 <tr> 
 <td>$eesnimi</td> 
 <td>$perekonnanimi</td> 
 <td>$teooriatulemus</td> 
 <td>".asenda($slaalom)."</td> 
 <td>".asenda($ringtee)."</td> 
 <td>".asenda($t2nav)."</td> 
 <td>$loalahter</td> 
 <td><a href='?kustuta_id=$id'>Kustuta</a></td> 
 </tr> 
 ";
    }
    ?>
</table>
</body>
</html>