<?php
    require_once "./mvc/core/redirect.php";
    require_once "./mvc/core/constant.php";
    $redirect = new redirect();
?>

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
            <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                <th>
                    <input type="checkbox" id="check-all" onclick="toggle(this)">
                </th>
                <th class="column-title">Họ và tên</th>
                <th class="column-title">Tài khoản</th>
                <th class="column-title">Hiển thị </th> 
                <th class="column-title no-link last"><span class="nobr">Chức năng</span>
                </th>
                </tr>
            </thead>
            <?php if(isset($data['datas']) && $data['datas'] != NULL){ ?>
                <tbody>
                    <?php foreach($data['datas'] as $key => $val) {?>
                        <tr class="even<?= $val['id'] ?>">
                            <td class=""><input type="checkbox" name="foo" value="<?= $val['id'] ?>"></td>
                            <td class=""><?= $val['fullname'] ?></td>
                            <td class=""><?= $val['username'] ?></td>
                            <td class=""><input type="checkbox" onclick="checkPublish(<?= $val['id'] ?>,'publish')" id="publish<?= $val['id'] ?>" data-control="<?= $data['template'] ?>" <?= $val['publish'] == 1?'checked':'' ?> ></td>
                            <td>
                                <a href="javascript:void(0)" onclick="del(<?= $val['id'] ?>)" id="del<?= $val['id'] ?>" data-control="<?= $data['template'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <a href="<?=$data['template'].'/'.'edit/'.$val['id']  ?>?" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            <?php } ?>
            </table>
        </div>
    </div>
</div>
<script>
    function toggle(__this){
        let isChecked = __this.checked;
        let checkbox = document.querySelectorAll('input[name="foo"]');
        for(let index = 0; index < checkbox.length; index++){
            checkbox[index].checked = isChecked;
        }
    }

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

$(document).ready(function(){
    setTimeout(() => {
        $('#MessageFlash').hide(500);
    }, 1000);
});
    
</script>