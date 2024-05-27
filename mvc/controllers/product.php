<?php 
require_once 'MyController.php';
class product extends controller{
    public $ProductModels;
    public $MyController;
    public $title = 'Sản phẩm';
    function __construct(){
        $this->ProductModels = $this->models('ProductModels');
        $this->MyController = new MyController();
    }
    function index(){
        $data_index = $this->MyController->indexCustomers();
        $product = $this->ProductModels->select_array('*',['publish' => 1]);
        $data = [
            'page'          => 'contact/index',
            'data_index'    => $data_index,
            'title'         => $this->title,
            'product'       => $product,
        ];
       $this->viewFrontEnd('frontend/masterlayout', $data);
    }
   
}