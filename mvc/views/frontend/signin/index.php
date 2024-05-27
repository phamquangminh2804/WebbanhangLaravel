<?php
    require_once "./mvc/core/redirect.php";
    require_once "./mvc/core/constant.php";
    $redirect = new redirect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $title ?></title>
    <base href="http://localhost:8080/SHOP/">
    <!-- Bootstrap -->
    <link href="public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!-- NProgress -->
    <link href="public/vendors/nprogress/nprogress.css" rel="stylesheet" />
    <!-- Animate.css -->
    <link href="public/vendors/animate.css/animate.min.css" rel="stylesheet" />
    <!-- Custom Theme Style -->
    <link href="public/build/css/custom.min.css" rel="stylesheet" />
    <link href="public/build/css/signin.css" rel="stylesheet" />
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="img">
            <img src="public/build/images/signin.png" alt="">
            
        </div>
        <div class="contents"><h1>Đăng nhập tài khoản ITShop</h1></div>
            <?php if(isset($_SESSION['flash'])){?>
            <p class="text-success"><?= $redirect->setFlash('flash');  ?></p>
            <?php } ?>
            <?php if(isset($_SESSION['errors'])){?>
            <p class="text-danger"><?= $redirect->setFlash('errors');  ?></p>
            <?php } ?>
            
            <div class="animate form login_form">
                <section class="login_content">  
                    <form action="dang-nhap.html" method="post">
                        <h1>Login Form</h1>
                        <div>
                            <input type="text" name="data_post[username]" class="form-control" placeholder="Username"
                                required="" />
                        </div>
                        <div>
                            <input type="password" name="data_post[password]" class="form-control"
                                placeholder="Password" required="" />
                        </div>
                        <div>
                            <button class="btn btn-primary">Đăng nhập</button>
                        </div>
                        <div class="line-through is-flex is-align-items-center">
                            <hr> 
                                <p>hoặc đăng nhập bằng</p> 
                            <hr>
                        </div>
                        <div class="block-login-gg-fb is-flex">
                            <div class="login-gg-fb button__login-google">
                                <img src="public/build/images/google.png" alt="google" class="login-gg-fb__icon"> 
                                <p class="login-gg-fb__text">Google</p>
                            </div> 
                            <div class="login-gg-fb button__login-zalo">
                                <img src="public/build/images/zalo1.png" alt="google" class="login-gg-fb__icon"> 
                                <p class="login-gg-fb__text">Zalo</p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div>
                            <?php if(isset($_SESSION['errors'])){?>
                            <h4 class="text-danger"><?= $redirect->setFlash('errors');  ?></h4>
                            <?php } ?>
                        </div>
                       
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>