

<?php
echo htmlspecialchars('20"21-21-31?#$%&m<d>');
echo "<br><br>";
echo htmlspecialchars("2021-12-16 14:13:10");
echo "<br><br>";
echo htmlspecialchars(99);
echo "<br><br>";
echo htmlspecialchars('');
echo "<br><br>";
echo htmlspecialchars(true);
echo "<br><br>";
// echo htmlspecialchars(null);
echo "<br><br>";
echo urlencode('<script>');
echo "<br><br>";
echo urlencode(344);

// $id = '<script>alert(3);</script>';
$id = '';

echo "<br><br>";
 echo isset($id)  ? (int) $id : 0;
echo "<br><br>";
echo rtrim('');
echo "<br><br>";
 
echo rtrim('      0 3                             ');

    



