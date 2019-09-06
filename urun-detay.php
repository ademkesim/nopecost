<?php 
require_once 'header.php'; 
require_once 'nedmin/production/fonksiyon.php';

$urunsor=$db->prepare("SELECT urun.*,kullanici.* FROM urun INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id where urun_id=:id and urun_durum=:durum");
$urunsor->execute(array(
  'id' => $_GET['urun_id'],
  'durum' => 1
));

$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);



?>
<!-- Header Area End Here -->
<!-- Main Banner 1 Area Start Here -->
<div class="inner-banner-area">
  <div class="container">
    <div class="inner-banner-wrapper">
      <h2 style="color:white;"><?php echo $uruncek['urun_ad'] ?></h2>

    </div>
  </div>
</div>
<!-- Main Banner 1 Area End Here --> 
<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
  <div class="container">
    <div class="pagination-wrapper">

    </div>
  </div>  
</div> 
<!-- Inner Page Banner Area End Here -->          
<!-- Product Details Page Start Here -->
<div class="product-details-page bg-secondary">                
  <div class="container">
    <div class="row">
     <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
      <div class="inner-page-main-body">
        <div class="single-banner">
          <img src="<?php echo $uruncek['urunfoto_resimyol'] ?>" alt="product" class="img-responsive">
        </div>                                

                   <!-- <div class="product-tag-line">
                        <ul class="product-tag-item">
                            <li><a href="#">Live Preview</a></li>
                            <li><a href="#">Screenshots</a></li>
                            <li><a href="#">Documentation</a></li>
                        </ul>
                        <ul class="social-default">
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                        </ul>
                      </div>-->
                      <div class="product-details-tab-area">
                        <div class="row">
                          <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="product-details-title">
                              <li class="active"><a href="#description" data-toggle="tab" aria-expanded="false">Ürün Açıklaması</a></li>
                              <li><a href="#review" data-toggle="tab" aria-expanded="false">Adres</a></li>

                            </ul>
                          </div>
                          <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="tab-content">
                              <div class="tab-pane fade active in" id="description">
                               <p><?php echo $uruncek['urun_detay'] ?></p>
                             </div>
                             <div class="tab-pane fade" id="review">


                              <div class="container">
                                <div class="row">
                                  <div class="col-md-8">

                                    <div class="comments-list">
                                     <div class="media">
                                      <div class="media-body">

                                        <h4 class="media-heading"><img style="border-radius: 30px; float: left; margin-right: 10px;" width="32" height="32">
                                         <?php echo $uruncek['urun_adres'] ?>
                                       </h4>
                                       <b><?php echo $uruncek['urun_il']." / ".$uruncek['urun_ilce'] ?></b> 
                                     </div>
                                   </div>
                                   <hr>
                                 </div>
                               </div>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div> 
               </div>
             </div>


             <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
              <div class="fox-sidebar">
                <div class="sidebar-item">
                  <div class="sidebar-item-inner">
                    <h3 class="sidebar-item-title">Ürün Fiyatı</h3>
                    <div align="center">
                      <p style="font-size:17px;">Kaparo Ücreti : <?php echo $uruncek['urun_kaparo'] ?><span style="font-size:12px;"> TL</span></p>
                      <p style="font-size:17px;">Toplam Ücreti : <?php echo $uruncek['urun_fiyat'] ?><span style="font-size:12px;"> TL</span></p>
                      <hr>
                      <p style="font-size:17px;">Rezervasyon Tarihi : <?php echo $uruncek['urun_tarih'] ?><span style="font-size:12px;"></span></p>
                    </div>
                    <form action="odeme" method="POST">
                      <ul class="sidebar-product-btn">

                        <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">



                        <?php 

                        if ($_SESSION['userkullanici_id']==$uruncek['kullanici_id']) {?>

                          <li><a class="add-to-cart-btn" id="cart-button"><i class="fa fa-ban" aria-hidden="true"></i> Kendi Ürününüz</a></li>

                        <?php  } else {?>

                         <?php 

                         if (empty($_SESSION['userkullanici_id'])) {?>

                           <li><a href="login" class="add-to-cart-btn" id="buy-button"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mesaj Gönder</a></li>

                         <?php }

                         else if ($_SESSION['userkullanici_id']==$_GET['kullanici_id']) {?>

                           <li><button disabled=""  class="add-to-cart-btn" id="buy-button"><i class="fa fa-ban" aria-hidden="true"></i> Mesaj Gönder</button></li>

                         <?php } else {?>

                           <li><a href="mesaj-gonder?kullanici_gel=<?php echo $_GET['kullanici_id'] ?>" class="add-to-cart-btn" id="buy-button"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mesaj Gönder</a></li>

                         <?php } ?>

                       <?php }
                       ?>

                     </form>
                   </ul>
                 </div>
               </div>                                
               <div class="sidebar-item">
                <div class="sidebar-item-inner">
                  <h3 class="sidebar-item-title">Satıcı</h3>
                  <div class="sidebar-author-info">
                    <img style="width: 72px; height: 72px;" src="<?php echo $uruncek['kullanici_magazafoto'] ?>" alt="product" class="img-responsive">
                    <div class="sidebar-author-content">
                      <h3><?php echo $uruncek['kullanici_ad']." ".substr($uruncek['kullanici_soyad'],0,1) ?>.</h3>
                      <a href="satici-<?=seo($uruncek['kullanici_ad']."-".$uruncek['kullanici_soyad'])."-".$uruncek['kullanici_id'] ?>" class="view-profile">Profil Sayfası</a>
                    </div>
                  </div>
                  <ul class="sidebar-badges-item">
                    <p>Telefon No : <?php echo $uruncek['kullanici_gsm'];?></p>
                  </ul>
                </div>
              </div>
            </div>                        
          </div>
        </div>
      </div>
      <?php 
      require_once 'footer.php'; 
      ?>