<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php require_once './mvc/views/frontend/home/layout/slide.php' ?>
 <!--Slick Carousel Slider-->


<!-- sản phẩm -->

<?php if(isset($product) && $product != NULL){?>
<section class="product">
    <div class="container">
        <div class="title__product">
            <h3><b>Sản phẩm</b></h3>
        </div>
        <?php
        $productsByCategory = array();
        foreach ($product as $value) {
            $categoryId = $value['cateID'];
            $categoryName = $value['parentName'];

            if (!isset($productsByCategory[$categoryId])) {
                $productsByCategory[$categoryId] = array();
            }
            $productsByCategory[$categoryId][] = $value;
        }
        ?>
        <?php foreach ($productsByCategory as $categoryId => $products) { 
            echo "<h2>Danh mục $categoryName</h2>";
            ?>
            
                <div class="list__product">
                <?php foreach($products as $value){?>
                    <div class="card" style="height:450px;">
                        <div class="before box">
                            <div class="images">
                                <a href="<?= $value['slug'] ?>"><img src="<?= $value['image'] ?>" alt=""></a>
                            </div>
                            <div class="contents">
                                <a href="<?= $value['slug'] ?>">
                                    <p class="title"><?= $value['name'] ?></p>
                                    <p class="price">
                                        <span><?= number_format($value['price']).'đ'; ?></span>
                                    </p>
                                    <div class="info">
                                        <?php $contents = json_decode($value['properties'],true); ?>
                                        <?php if(isset($contents) && $contents != NULL){?>
                                            <?php for ($i=0; $i < 4 ; $i++) {?>
                                                <p><strong><?= $contents[$i]['name'] ?><?= $contents[$i]['name'] ? ':' : '' ?></strong>
                                                    <?= $contents[$i]['value'] ?></p>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="after box">
                            <p class="title"><?= $value['name'] ?></p>
                            <div class="btn">
                                <button class="buy"><i class="fas fa-cart-plus"></i></button>
                                <a class="detail" href="javascript:void(0)"><i class="fas fa-info-circle"></i></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.4.1/jquery-migrate.min.js" integrity="sha512-KgffulL3mxrOsDicgQWA11O6q6oKeWcV00VxgfJw4TcM8XRQT8Df9EsrYxDf7tpVpfl3qcYD96BpyPvA4d1FDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
    $('.list__product').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 3
    })
  </script>
    
</section>
<?php } ?>
<?php require_once './mvc/views/frontend/home/layout/contact.php' ?>

    
</body>
</html>