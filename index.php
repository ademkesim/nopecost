<?php 
require_once 'header.php'; 
?>
<div class="why-choose-area bg-primaryText">   
<!--             
  <div class="container">
    <br>
    <h3 class="title-textPrimary" style="color: #344047;"><b>Neden NopeCost?</b></h3>  
</div>  
-->
<br>
<div class="container">
    <div class="row" >
        <div class="why-choose-box" align:"center">
            <center>
            <h3><b>Uygulamamızı size daha detaylı anlatmamızı ister misiniz?</b></h3>
            <button type="button" class="btn btn-secondary"><a href="bilgilendirme">Bilgilendirme</a></button>
            </center>
        </div>
    <br>
</div>
</div>
</div>
<!-- Arama Kutusu
<div class="main-banner2-area">
    <div class="container">
        <div class="main-banner2-wrapper">                       
            <h1 style=""> <b>NopeCost</b></h1>
            <p>Aramak istediğiniz ürünü lütfen giriniz...</p>
            <form action="arama-detay" method="POST">
                <div class="banner-search-area input-group">
                    <input class="form-control" required="" minlength="3" name="searchkeyword" placeholder="Ne aramıştınız . . ." type="text">                    
                    <span class="input-group-addon">
                        <button type="submit" name="searchsayfa">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>  
                    </span>
                </form>
            </div>
        </div>
    </div>
-->
</div>

<div class="row featuredContainer bg-secondary">
    <br>
    <h3 style="text-align: center;"><b>Anasayfa Vitrini</b></h3> 
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 col-lg-push-2 col-md-push-2 col-sm-push-2">
        

        <div class="container">

        </div>
        <div class="container-fluid" id="isotope-container">

            <div class="row featuredContainer">

              <?php 
              $urunsor=$db->prepare("SELECT urun.urun_ad,urun.kategori_id,urun.urun_id,urun.urun_fiyat,urun.urun_il,urun.urun_ilce,urun.urun_kaparo,urun.urunfoto_resimyol,urun.kullanici_id,urun.urun_durum,urun.urun_onecikar,kategori.kategori_id,kategori.kategori_ad,kullanici.kullanici_id,kullanici.kullanici_ad,kullanici.kullanici_soyad,kullanici.kullanici_magazafoto FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id where urun_onecikar=:onecikar and urun_durum=:durum order by urun_zaman,urun_onecikar DESC limit 8");
              $urunsor->execute(array(
                'onecikar' => 1,
                'durum' => 1
            ));

            while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { ?>

                <!-- Start Ürün Anasayfa Listeleme -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 joomla yenigelen plugins">
                    <div class="single-item-grid">
                        <div class="item-img">
                            <a href="urun-<?=seo($uruncek['urun_ad'])."-".$uruncek['urun_id'] ?>"><img src="<?php echo $uruncek['urunfoto_resimyol'] ?>" alt="product" class="img-responsive"></a>
                            <div class="trending-sign" data-tips="Öne Çıkan Ürün"><i class="fa fa-bolt" aria-hidden="true"></i></div>
                        </div>
                        <div class="item-content">
                            <div class="item-info">
                                <div>
                                    <h3><a href="urun-<?=seo($uruncek['urun_ad'])."-".$uruncek['urun_id'] ?>""><?php echo $uruncek['urun_ad'] ?></a></h3>
                                </div>
                                <div>
                                    <span><a href="kategoriler-<?=seo($uruncek['kategori_ad'])."-".$uruncek['kategori_id'] ?>"><?php echo $uruncek['kategori_ad'] ?></a></span>
                                </div>
                                <span style="color:#000000;"><?php echo $uruncek['urun_il']." / ".$uruncek['urun_ilce'] ?></span>
                            </div>
                            <div class="item-profile">
                                <div class="price">
                                    Kaparo Ücreti : <b><?php echo $uruncek['urun_kaparo'] ?></b>₺
                                    <br>
                                    Toplam Ücret : <b><?php echo $uruncek['urun_fiyat'] ?></b>₺
                                </div>
                            </div>
                            <div class="item-profile">

                               <!-- <div class="img-wrapper"><img style="width: 38px; height: 38px;" src="<?php echo $uruncek['kullanici_magazafoto'] ?>" alt="profile" class="img-responsive img-circle"></div>-->
                               <span>Satıcı: <?php echo $uruncek['kullanici_ad']." ".substr($uruncek['kullanici_soyad'], 0,1) ?>.</span>
                           </div>
                           <a href="satici-<?=seo($uruncek['kullanici_ad']."-".$uruncek['kullanici_soyad'])."-".$uruncek['kullanici_id'] ?>">Tüm Ürünleri</a>
                       </div>
                   </div>
               </div>
           <?php } ?>
           <!-- Finish Ürün Anasayfa Listeleme -->
       </div>
   </div>
</div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 col-lg-pull-9 col-md-pull-8 col-sm-pull-8 ">
    
    <?php require_once 'sidebar.php' ?>
</div>
</div>
<br> 
<!--Footer Başalngıcı-->

<?php require_once 'footer.php'; ?>