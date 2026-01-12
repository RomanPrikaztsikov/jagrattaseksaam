<?php
global $yhendus;
require_once("konf.php");

function registreermine($eesnimi, $perekonnanimi){
    global $yhendus;

    if(empty($eesnimi) || empty($perekonnanimi) || is_numeric($eesnimi) || is_numeric($perekonnanimi)){
        header("Location: ".$_SERVER[PHP_SELF]."?viga=1"); exit();
    }
    $kask=$yhendus->prepare(
        "INSERT INTO jalgrattaeksam(eesnimi, perekonnanimi) VALUES (?, ?)");
    $kask->bind_param("ss", $eesnimi, $perekonnanimi);
    $kask->execute();
    $yhendus->close();
}
// teooria
function teooriatulemus($teooriatulemus, $id)
{
    global $yhendus;
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET teooriatulemus=? WHERE id=?");
    $kask->bind_param("ii", $teooriatulemus, $id); $kask->execute();
}

function kuvatabel()
{
    global $yhendus;
    $kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi, teooriatulemus FROM jalgrattaeksam WHERE teooriatulemus<10");
    $kask->bind_result($id, $eesnimi, $perekonnanimi, $teooriatulemus);
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