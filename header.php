<?php 
ob_start();
session_start();
date_default_timezone_set('Europe/Istanbul');

//error_reporting(0); //Hatalar Gizlenir => Hatalarınızı göremezsiniz. /tüm işler bittikten sonra kullanın.
require_once 'nedmin/netting/baglan.php';
require_once 'nedmin/production/fonksiyon.php';

if (basename($_SERVER['PHP_SELF'])==basename(__FILE__)) {

	exit("Bu sayfaya erişim yasak");

}


//Ayar Tablosundan Site Ayarlarımızı Çekiyoruz
$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
	'id' => 0
));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);


if (isset($_SESSION['userkullanici_mail'])) {


	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail");
	$kullanicisor->execute(array(
		'mail' => $_SESSION['userkullanici_mail']
	));
	$say=$kullanicisor->rowCount();
	$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

    //Kullanıcı ID Session Atama
	if (!isset($_SESSION['userkullanici_id'])) {

		$_SESSION['userkullanici_id']=$kullanicicek['kullanici_id'];
	}

}

$kullanici_sonzaman= $_SESSION['userkullanici_sonzaman'];
$suan=time();

$fark=($suan-$kullanici_sonzaman);

if ($fark>600) {

	$zamanguncelle=$db->prepare("UPDATE kullanici SET

		kullanici_sonzaman=:kullanici_sonzaman
		
		WHERE kullanici_id={$_SESSION['userkullanici_id']}");


	$update=$zamanguncelle->execute(array(

		'kullanici_sonzaman' => date("Y-m-d H:i:s")
		
	));

	$kullanici_sonzaman= $_SESSION['userkullanici_sonzaman'];

}
?>

<!doctype html>
<html class="no-js" lang="">
<head>
	<title>
		<?php if (empty($title)) {
			echo $ayarcek['ayar_title'];
		} else {
			echo $title;
		} 
		?>
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo $ayarcek['ayar_description'] ?>">
	<meta name="keywords" content="<?php echo $ayarcek['ayar_keywords'] ?>">
	<meta name="author" content="<?php echo $ayarcek['ayar_author'] ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="img\favicon.png">

	<!-- Normalize CSS --> 
	<link rel="stylesheet" href="css\normalize.css">

	<!-- Main CSS -->         
	<link rel="stylesheet" href="css\main.css">

	<!-- Bootstrap CSS --> 
	<link rel="stylesheet" href="css\bootstrap.min.css">

	<!-- Animate CSS --> 
	<link rel="stylesheet" href="css\animate.min.css">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="css\select2.min.css">

	<!-- Font-awesome CSS-->
	<link rel="stylesheet" href="css\font-awesome.min.css">

	<!-- Owl Caousel CSS -->
	<link rel="stylesheet" href="vendor\OwlCarousel\owl.carousel.min.css">
	<link rel="stylesheet" href="vendor\OwlCarousel\owl.theme.default.min.css">

	<!-- Main Menu CSS -->      
	<link rel="stylesheet" href="css\meanmenu.min.css">

	<!-- Datetime Picker Style CSS -->
	<link rel="stylesheet" href="css\jquery.datetimepicker.css">

	<!-- ReImageGrid CSS -->
	<link rel="stylesheet" href="css\reImageGrid.css">

	<!-- Switch Style CSS -->
	<link rel="stylesheet" href="css\hover-min.css">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="style.css">

	<!-- Modernizr Js -->
	<script src="js\modernizr-2.8.3.min.js"></script>

	<!-- CK EDITOR -->
	<script src="nedmin/production/ckeditor/ckeditor.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-145422849-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-145422849-1');
	</script>
</head>
<body>

	<?php 
	if ($ayarcek['ayar_bakim']==1) {

		exit("Şuan Bakımdayız...");
	}
	?>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <!-- Add your site or application content here -->
        <!-- Preloader Start Here -->
        <div id="preloader"></div>
        <!-- Preloader End Here -->
        <!-- Main Body Area Start Here -->
        <div id="wrapper">
        	<!-- Header Area Start Here -->
        	<header>                
        		<div id="header2" class="header2-area right-nav-mobile">
        			<div class="header-top-bar">
        				<div class="container">
        					<div class="row">                         
        						<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
        							<div class="logo-area">
        								<a href="anasayfa"><img class="img-responsive" src="<?php echo $ayarcek['ayar_logo'] ?>" alt="logo"></a>
        							</div>
        						</div> 
        						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        							<br>
        							<form action="arama-detay" method="POST">
        								<div class="banner-search-area input-group">
        									<input class="form-control" style="font-size: 13px;" required="" minlength="3" name="searchkeyword" placeholder="Ne aramıştınız . . ." type="text">                    
        									<span class="input-group-addon">
        										<button type="submit" name="searchsayfa" >
        											<span class="glyphicon glyphicon-search"></span>
        										</button>  
        									</span>
        								</div>
        							</form>
        						</div>
        						<br>
        						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6" align="left">
        							<ul class="profile-notification">                                            
                                        <!--<li>
                                            <div class="notify-contact"><span>Need help?</span> Talk to an expert: +61 3 8376 6284</div>
                                        </li>-->

                                        <?php 

                                        if (isset($_SESSION['userkullanici_mail'])) {?>

                                        	<li>
                                        		<div class="notify-message">
                                        			<a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i><span>

                                        				<?php 

                                        				$mesajsay=$db->prepare("SELECT COUNT(mesaj_okunma) as say FROM mesaj where mesaj_okunma=:id and kullanici_gel=:kullanici_id");
                                        				$mesajsay->execute(array(
                                        					'id' => 0,
                                        					'kullanici_id' => $_SESSION['userkullanici_id']
                                        				));

                                        				$saycek=$mesajsay->fetch(PDO::FETCH_ASSOC);

                                        				echo $saycek['say'];

                                        				?>

                                        			</span></a>
                                        			<ul>

                                        				<?php 

                                        				$mesajsor=$db->prepare("SELECT mesaj.*,kullanici.* FROM mesaj INNER JOIN kullanici ON mesaj.kullanici_gon=kullanici.kullanici_id where mesaj.kullanici_gel=:id and mesaj.mesaj_okunma=:okunma order by mesaj_okunma,mesaj_zaman DESC limit 5");
                                        				$mesajsor->execute(array(

                                        					'id' => $_SESSION['userkullanici_id'],
                                        					'okunma' => 0

                                        				));

                                        				if ($mesajsor->rowCount()==0) {?>
                                        					<li>
                                        						<div class="notify-message-info">
                                        							<div style="color:black !important" class="notify-message-subject">Hiç Mesajınız Yok</div>

                                        						</div>
                                        					</li>

                                        				<?php }

                                        				while($mesajcek=$mesajsor->fetch(PDO::FETCH_ASSOC)) {?>



                                        					<li>
                                        						<div class="notify-message-img">
                                        							<img class="img-responsive" src="<?php echo $mesajcek['kullanici_magazafoto']; ?>" alt="profile">
                                        						</div>
                                        						<div class="notify-message-info">
                                        							<div class="notify-message-sender"><?php echo $mesajcek['kullanici_ad']." ".$mesajcek['kullanici_soyad'] ?></div>
                                        							<div class="notify-message-subject">Mesaj Detayı</div>
                                        							<div class="notify-message-date"><?php echo $mesajcek['mesaj_zaman'];?></div>
                                        						</div>
                                        						<div class="notify-message-sign">
                                        							<a  href="mesaj-detay?mesaj_id=<?php echo $mesajcek['mesaj_id'] ?>&kullanici_gon=<?php echo $mesajcek['kullanici_gon'] ?>"><i style="color:orange !important" class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                        						</div>
                                        					</li>

                                        				<?php } ?>


                                        			</ul>
                                        		</div>
                                        	</li>

                                        <?php } ?>



                                        <?php 

                                        if (isset($_SESSION['userkullanici_mail'])) {?>


                                        	<li>
                                        		
                                        		<div class="user-account-info">
                                        			<div class="user-account-info-controler">
                                        				<div class="user-account-img">
                                        				</div>
                                        				<div class="user-account-title">
                                        					<div class="user-account-name"><?php echo $kullanicicek['kullanici_ad']." ".substr($kullanicicek['kullanici_soyad'], 0,1) ?>.</div>
                                        				</div>
                                        				<div class="user-account-dropdown">
                                        					<i class="fa fa-angle-down" aria-hidden="true"></i>
                                        				</div>
                                        			</div>
                                        			<ul>
                                        				<li><a href="hesabim">Hesap Bilgilerim</a></li>
                                        				<li><a href="logout.php" id="logout-button">Çıkış</a></li>

                                        			</ul>
                                        		</div>
                                        	</li>

                                        <?php } else {?>

                                        	<li> <a class="apply-now-btn hidden-on-mobile" href="login" >Üye Girişi</a></li>
                                        	<li><a class="apply-now-btn-color hidden-on-mobile" href="register">Kayıt</a></li>


                                        <?php }

                                        ?>




                                    </ul>
                                </div>                          
                            </div>                          
                        </div>
                    </div>

                </div>
                <!-- Mobile Menu Area Start -->
                <div class="mobile-menu-area">
                	<div class="container">
                		<div class="row">
                			<div class="mobile-menu">
                				<div class="col-md-2">
                					<nav id="dropdown">
                						<ul>
                							<li class="active"><a href="anasayfa">Anasayfa</a></li>
                							<li ><a href="login">Üye Giriş</a></li>
                							<li ><a href="register">Üye Kayıt</a></li>
                						</ul>
                					</nav>
                				</div>           
                			</div>
                		</div>
                	</div>
                </div>  
                <!-- Mobile Menu Area End -->
            </header>