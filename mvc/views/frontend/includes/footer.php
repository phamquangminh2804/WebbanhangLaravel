<?php
    require_once "./mvc/core/redirect.php";
    require_once "./mvc/core/constant.php";
    $redirect = new redirect();
?>
<section class="footer">
    <div class="container">
        <div class="list_items">
            <div class="item">
                <h3>SHOPPING</h3>
                <div class="info__company">
                    <p><strong>Website:</strong><a href="http://khanhduydemo1998.com/">PhamQuangMinh.com</a></p>
                    <p><strong>Địa chỉ:</strong>TPCT</p>
                    <p><strong>Số điện thoại:</strong><a href="tel:0982824398">0398163696</a></p>
                </div>
            </div>
            <div class="item">
                <ul>
                    <li><a href="">Tích điểm Quà tặng VIP</a></li>
                    <li><a href="">Lịch sử mua hàng</a></li>
                    <li><a href="">Tìm hiểu về mua trả góp</a></li>
                    <li><a href="">Chính sách bảo hành</a></li>
                </ul>
            </div>
            <div class="item">
                <ul>
                    <li><a href="">Giới thiệu công ty (MWG.vn)</a></li>
                    <li><a href="">Tuyển dụng</a></li>
                    <li><a href="">Gửi góp ý, khiếu nại</a></li>
                    <li><a href="">Tìm siêu thị (3.160 shop)</a></li>
                    <li><a href="">Xem bản mobile</a></li>
                </ul>
            </div>
            <div class="item">
                <h3><b>Tổng đài hỗ trợ</b></h3>
                <ul>
                    <li><a href="">Gọi mua: <b>1900 232 460</b> (7:30 - 22:00)</a></li>
                    <li><a href="">Khiếu nại: <b>1800.1062 </b>(8:00 - 21:30)</a></li>
                    <li><a href="">Bảo hành: <b>1900 232 464</b> (8:00 - 21:00)</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="show__cart">
    <div class="header"> <button class="close__cart">Đóng</button></div>
    <div class="list__items_cart">
        <?php if(isset($data_index['cart']) && $data_index !== NULL){?>
        <?php foreach($data_index['cart'] as $key => $val){?>
        <div class="item">
            <div class="box__one">
                <div class="image">
                    <img src="<?= $val['image'] ?>" alt="">
                </div>
                <div class="name__product">
                    <p><?= $val['name'] ?> </p>
                    <p><?= number_format($val['price']) ?> đ</p>
                </div>
            </div>
            <div class="box__two">
                <p>Số lượng: <span><?= $val['qty'] ?></span></p>
            </div>
            <div class="box__tree">
                <a href="javascript:void(0)" onClick="deleteItem(<?= $val['productID'] ?>)"><i
                        data-id="<?= $val['productID'] ?>" class="fa-solid fa-trash"></i></a>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
    </div>
    <div class="box">
        <p><strong>Tổng giá:</strong><span id="total_Price_header">
                <?php $total = 0; if(isset($data_index['cart']) && $data_index !== NULL){?>
                <?php foreach($data_index['cart'] as $key => $val){?>
                <?php $total = $total + $val['price']* $val['qty']; ?>
                <?php } ?>
                <?php } ?>
                <?= number_format($total); ?>
                đ</span></p>
        <a class="goto_cart" href="gio-hang.html">
            Vào giỏ hàng
        </a>
    </div>
</div>
<?php if(isset($_SESSION['flash'])){?>

<div class="message">
    <p class="text-success"><?= $redirect->setFlash('flash');  ?></p>
</div>
<?php } ?>

<footer>
    <div class="container">
        <p>@Design by Vo Khanh Duy , Year 2022</p>
    </div>
</footer>
<div class="rings__phone">
    <div class="b1 box__phone"></div>
    <div class="b2 box__phone"></div>
    <div class="box__phone phone">
        <a href="tel:0982824398" title="0982824398"><i class="fas fa-phone-alt"></i></a>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
$('.slick_slide').slick({
    arrows: false,
    fade: true,
    centerMode: true,
    focusOnSelect: true,
    cssEase: 'linear',
    autoplay: true,
    autoplaySpeed: 2000,
});
window.addEventListener('scroll', (e) => {
    if (document.documentElement.scrollTop > 120) {
        document.querySelector('.nagivation').classList.add('active');
    } else {
        document.querySelector('.nagivation').classList.remove('active');
    }
});
const heightWindow = document.documentElement.offsetHeight;
window.addEventListener('scroll', (e) => {
    document.querySelector('.show__cart').style.height = heightWindow - document.querySelector('footer')
        .offsetHeight + 'px';
});
document.querySelector('.close__cart').addEventListener("click", (e) => {
    document.querySelector('.show__cart').classList.remove('open')
});
document.querySelector('.open__cart').addEventListener("click", (e) => {
    document.querySelector('.show__cart').classList.add('open')
});

function deleteItem(id) {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'cart/deleteProductById');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    let total__Price = 0;
    xhr.onload = function(e) {
        if (this.responseText) {
            const data = JSON.parse(this.responseText);
            let list__items_cart = document.querySelector('.list__items_cart');
            let element2 = '';
            data.map((v) => {
                if (v.qty <= 0) return;
                total__Price += parseInt(v.qty * v.price)
                element2 += `
                     <div class="item">
                        <div class="box__one">
                            <div class="image">
                                <img src="${v.image}" alt="">
                            </div>
                            <div class="name__product">
                                <p>${v.name} </p>
                                <p>${formatMoney(v.price)} đ</p>
                            </div>
                        </div>
                        <div class="box__two">
                            <p>Số lượng:  <span>${v.qty}</span></p>
                        </div>
                        <div class="box__tree">
                            <a href="javascript:void(0)" onClick="deleteItem(${v.productID})"><i  data-id="${v.productID}" class="fa-solid fa-trash"></i></a>
                        </div>
                    </div>
                    `
            });
            list__items_cart.innerHTML = element2;
            document.querySelector('.total_qty').innerHTML = data.length;
            document.getElementById('total_Price_header').innerHTML = total__Price.format(0)
        }
    }
    xhr.send(`id=${id}`);
}

function formatMoney(__this) {
    let val = __this.toString(); // Chuyển đổi __this thành chuỗi
    let arr = val.split('.');
    let val_num = arr[0];
    let len = val_num.length;
    let result = '';
    let j = 0;
    for (let index = len; index > 0; index--) {
        j++;
        if (j % 3 === 1 && j !== 1) {
            result = val_num.substr(index - 1, 1) + ',' + result;
        } else {
            result = val_num.substr(index - 1, 1) + result;
        }
    }
    return result;
}

Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};
</script>
</body>

</html>