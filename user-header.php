<?php 
if (basename($_SERVER['PHP_SELF'])==basename(__FILE__)) {

    exit("Bu sayfaya erişim yasak");

}
?>

 <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 col-lg-push-3 col-md-push-4 col-sm-push-4">
                <div class="inner-page-main-body">
                    <div class="single-banner">
                        <img src="img\al.png" alt="product" class="img-responsive">
                    </div>                                
                    <div class="author-summery">
                        <div class="single-item">
                            <div class="item-title">Bölge:</div>
                            <div class="item-details"><?php echo $kullanicicek['kullanici_ilce']." / ".$kullanicicek['kullanici_il'] ?></div>                                       
                        </div>
                        <div class="single-item">
                            <div class="item-title">Kayıt Tarihi</div>
                            <div class="item-details"><?php echo $kullanicicek['kullanici_zaman']; ?></div>                                       
                        </div>
                       
                </div>
            </div>
        </div>