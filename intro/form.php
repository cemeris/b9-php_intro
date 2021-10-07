<!doctype html>
<?php include('navigation.php'); ?>

<h2>Get method form</h2>
<form action="">
    <input type="text" name="message">
    <button type="submit">submit</button>
</form>

<a href="?message=Hello+world!&name=vitalijs">Get Request</a>

<h2>Post method form</h2>
<form action="" method="post">
    <input type="text" name="message">
    <button type="submit">submit</button>
</form>

<h2>Mixed method form</h2>
<form action="?name=Vitālijs" method="post">
    <input type="text" name="message">
    <button type="submit">submit</button>
</form>

<?php

echo "<h3>GET OUTPUT</h3>";
var_dump($_GET);


echo "<h3>POST OUTPUT</h3>";
var_dump($_POST);

echo "<h3>REQUEST OUTPUT</h3>";
var_dump($_REQUEST);