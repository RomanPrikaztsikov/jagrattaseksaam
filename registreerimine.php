<?php
require_once("konf.php");
global $yhendus;
if(isSet($_REQUEST["sisestusnupp"])){
    $kask=$yhendus->prepare("INSERT INTO jalgrattaeksam(eesnimi, perekonnanimi) VALUES (?, ?)");
    $kask->bind_param("ss", $_REQUEST["eesnimi"], $_REQUEST["perekonnanimi"]);
    $kask->execute();
    header("Location: teooriaeksam.php");
    exit();
}
?>
<!doctype html>
<html>
<head>
    <title>Kasutaja registreerimine</title>
</head>
<body>
<?php include("nav.php"); ?>
<h1>Registreerimine</h1>
<form action="?">
    <dl>
        <dt>Eesnimi:</dt>
        <dd><input type="text" name="eesnimi" /></dd>
        <dt>Perekonnanimi:</dt>
        <dd><input type="text" name="perekonnanimi" /></dd>
        <dt><input type="submit" name="sisestusnupp" value="sisesta" /></dt>
    </dl>
</form>
</body>
</html>