<?php
global $yhendus;
require_once("konf.php");

function registrerimine($eesnimi,$perekonnanimi){
    global $yhendus;

    if(empty($eesnimi) || empty($perekonnanimi) || is_numeric($eesnimi) || is_numeric($perekonnanimi)){
        header("Location: $_SERVER[PHP_SELF]?viga=1"); exit();
    }
    $kask=$yhendus->prepare(
        "INSERT INTO jalgrattaeksam(eesnimi, perekonnanimi) VALUES (?, ?)");
    $kask->bind_param("ss", $eesnimi, $perekonnanimi);
    $kask->execute();
    $yhendus->close();
}
function teoriatulemus($teooriatulemus, $id)
{
    global $yhendus;
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET teooriatulemus=? WHERE id=?");
    $kask->bind_param("ii", $teooriatulemus, $id); $kask->execute();}

function kuvatabel()
{
    global $yhendus;
    $kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi,teooriatulemus FROM jalgrattaeksam WHERE teooriatulemus<10");
    $kask->bind_result($id, $eesnimi, $perekonnanimi, $teooriatulemus );
    $kask->execute();

    while($kask->fetch()){
        echo " 
 <tr> 
 <td>$eesnimi</td> 
 <td>$perekonnanimi</td> 
 <td><form action=''> 
 <input type='hidden' name='id' value='$id' /> 
 <input type='text' name='teooriatulemus' />
 <input type='submit' value='Sisesta tulemus' /> 
 <td>$teooriatulemus</td> 
 </form> 
 </td> 
</tr> 
 ";
    }
}

function slaalomtabel()
{
    global $yhendus;
    $kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi, slaalom FROM jalgrattaeksam WHERE teooriatulemus>=9 AND slaalom=-1");
    $kask->bind_result($id, $eesnimi, $perekonnanimi, $slaalom);
    $kask->execute();

    while($kask->fetch()){
        echo " 
 <tr> 
 <td>$eesnimi</td> 
 <td>$perekonnanimi</td> 
 <td> 
 <a href='?korras_id=$id'>Korras</a>
 <a href='?vigane_id=$id'>Ebaõnnestunud</a> 
 </td> 
</tr> 
 ";
    }
}
function slaalomKorras($id){
    global $yhendus;
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET slaalom=1 WHERE id=?");
    $kask->bind_param("i", $id);
    $kask->execute();
}
function slaalomVigane($id){
    global $yhendus;
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET slaalom=-1 WHERE id=?");
    $kask->bind_param("i", $id);
    $kask->execute();

}
?>