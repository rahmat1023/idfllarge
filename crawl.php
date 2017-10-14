<html>
<head>
<title> Rahmat's file.idfl.me Crawler </title>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

th {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
    background-color: #4CAF50;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

h1 {
    text-align: center;
    color: #000;
}

div.nav {
    text-align: center;
    padding: 10px;
}

div.copyright{
    text-align: center;
    padding: 10px;
}

.button {
    background-color: #4CAF50;
    border: none;
    border-radius: 4px;
    color: white;
    padding: 12px ;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    margin: 20px 10px;
    cursor: pointer;
}


</style>
</head>

<?php
// function to get webpage title
ini_set('max_execution_time', 1000);
$a=$_GET['a'];
$z=$a+199;
$b=array();
function getWeb($b,$a,$z) {
    $hasil=array();
    for ($i=$a; $i<=$z; $i++)
    {
        $hasil[$i] = 'http://file.idfl.me/file/'.$i;
    }
    return $hasil;
}

function getTitle($url) {
    $page = file_get_contents($url);
    $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $page, $match) ? $match[1] : null;
    return $title;
}

function getOwner($url) {
   $page = file_get_contents($url);  
  
    $string_awal   = '<td>';  
    $string_akhir   = '</td>';  
  
    $pos_awal = strrpos($page, $string_awal)+4;  
    $pos_akhir = strrpos($page, $string_akhir);  
    $pos_ambil = $pos_akhir-$pos_awal;
    
    $owner = substr($page, $pos_awal, $pos_ambil);
    if (strlen($owner)>100){
        $owner='Kemungkinan Terhapus';
    }
    return $owner;
}
$x=getWeb($b,$a,$z);
// get web page title
echo '<h1>File nomor '.$a.' sampai '.$z.'</h1>';
echo '<div><table>';
echo '  <tr>
            <th>Nomor</th>
            <th>File Name</th>
            <th>Owner</th>
        </tr>';
    for ($i=$a;$i<=$z;$i++){
        $sentence=getTitle($x[$i]);
        $word = 'File not found';
        if (strpos($sentence, $word) !== false) {
            echo '<tr>';
            echo '<td>'.$i.'</td>' ;
            echo '<td>Belum ada</td>' ;
            echo '<td>Belum ada</td>' ;
            echo '</tr>'; 
            }
        else{
            echo '<tr>';
            echo '<td>'.$i.'</td>' ;
            echo '<td><a href="'.$x[$i]. '">'.$sentence.'</a></td>' ;
            echo '<td>'. getOwner($x[$i]).'</a></td>' ;
            echo '</tr>'; 
        }
        
}
echo '</table></div>';

$prev=$a-200;
$next=$a+200;
echo ' <div class="nav"><a href="crawl.php?a='.$prev.'" class="button">Sebelum</a>';
echo ' <a href="index.php?" class="button">Home</a>';
echo ' <a href="crawl.php?a='.$next.'" class="button">Sesudah</a></div>';
?>
<div class="copyright">
  © Rahmat Alfianto 2017
</div>

</html>
