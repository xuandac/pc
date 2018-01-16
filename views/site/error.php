<?php
$this->title="Trang không tồn tại";
$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex,follow']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => 'https://ketquanhanh.vn/404.html']);
?>
<section class="page-404">
    <div class="container">
        <div class="content404">
            <!--<div>Đường dẫn bạn vừa gõ sai :<p><?= "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?></p></div>-->
            <h3>Xin lỗi, trang bạn tìm không tồn tại.</h3>
            <p>Mời bạn duyệt trang khác hoặc truy cập vào nội dung bên dưới.</p>
        </div>
        <div class="google-search">
            <?php
            $fullLink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $listParams = explode("/", $fullLink);
            $count = count($listParams) - 1;
            $lastParams = $listParams[$count];
            if (!isset($_GET['q'])) {
                header("Location:https://ketquanhanh.vn/404.html?q=" . $lastParams);
                die();
            }
            ?>
            <script>
                (function () {
                    var cx = '013167173931706270675:tjafvhjqg9i';
                    var gcse = document.createElement('script');
                    gcse.type = 'text/javascript';
                    gcse.async = true;

                    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(gcse, s);
                })();
            </script>
            <gcse:search></gcse:search>

        </div>
    </div>
</section>
