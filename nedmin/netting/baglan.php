<?php 


try {



	$db=new PDO("mysql:host=localhost;dbname=nopecost_nopecost;charset=utf8",'nopecost','S6k9y79cRx');

	//echo "veritabanı bağlantısı başarılı";

}



catch (PDOExpception $e) {



	echo $e->getMessage();

}



 ?>