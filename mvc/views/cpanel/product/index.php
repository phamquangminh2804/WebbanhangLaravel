<?php
    require_once "./mvc/core/redirect.php";
    require_once "./mvc/core/constant.php";
    $redirect = new redirect();
?>
<link rel="stylesheet" href="public/build/css/product.css">
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?= $data['title'] ?></h3>
            <a href="<?= $data['template'].'/add' ?>" class="btn btn-primary"><i class="fa fa-plus"> thêm mới</i></a>
            <a href="javascript:void(0)" onclick="delAll(this)" data-control="<?= $data['template'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            <a href="<?= $data['template'].'/index' ?>"  data-control="<?= $data['template'] ?>" class="btn btn-success"><i class="fa fa-history"></i></a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-12" id="MessageFlash">
            <?php if(isset($_SESSION['flash'])) {?>
                <h3 class="text-success"><?= $redirect->setFlash('flash') ?></h3>
            <?php } ?>
            <?php if(isset($_SESSION['errors'])) {?>
                <h3 class="text-danger  "><?= $redirect->setFlash('errors') ?></h3>
            <?php } ?>
        </div>
    </div>
    <div class="x_content">
        <div class="table-responsive">
            <div id="loadTable">
                <link rel="stylesheet" href="public/build/css/product.css">
                <?php require_once "./mvc/views/cpanel/product/loadTable.php" ?>
            </div>
        </div>
    </div>
</div>

<script>
    //==========chon tat ca
    function toggle(__this){
        let isChecked = __this.checked;
        let checkbox = document.querySelectorAll('input[name="foo"]');
        for(let index = 0; index < checkbox.length; index++){
            checkbox[index].checked = isChecked;
        }
    }
    //==============xoa toan bo
        function delAll(__this){
        let control = $(__this).attr('data-control');
        let listID = '';
        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if(result.value){
                $('input[name="foo"]').each(function(){
                    if(this.checked){
                        listID = listID + ','+this.value;
                    }
                });
                listID = listID.substr(1);
                if(listID !== ''){
                    $.ajax({
                        url:control + '/delAll',
                        method:"post",
                        data:{listID:listID},
                        dataType:'json',
                        success:function(response){
                            if(response.result ==="success"){
                                $('input[name="foo"]').each(function(){
                                    if(this.checked){
                                        $('.even'+this.value).remove();
                                    }
                                });
                            }
                        }
                    })
                }
                else{
                    Swal.fire('Error!','Vui lòng chọn mục cần xóa','Warning');
                }
            }
        });
    }

    //======thoi gian mat chu
    $(document).ready(function(){
        setTimeout(() => {
            $('#MessageFlash').hide(500);
        }, 1000);
    });


</script>
