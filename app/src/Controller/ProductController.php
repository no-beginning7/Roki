<?php
require_once __DIR__ . '/../../Model/productModel.php';
require_once __DIR__ . '/../../Model/categoryModel.php';
require_once __DIR__. '/../Controller.php';

class ProductController extends Controller
{
    private $categoryModel;

    protected $indexViewName = 'product/index';
    protected $createViewName = 'product/create';
    protected $createRedirection = 'product/index';
    protected $updateViewName = 'product/update';
    protected $updateRedirection = '/product/index';
    protected $deleteViewName = 'product/delete';
    protected $deleteRedirection = '/product/index';

    public function __construct()
    {
        parent::__construct();
        $this->model = new productModel();
        $this->categoryModel = new categoryModel();
    }
    public function getCreate()
    {
        $category = $this->categoryModel->getAll();

        return $this->render($this->createViewName, [
            'category' => $category,
        ]);
    }

    public function getUpdate($id)
    {
        $edit = $this->model->getById($id);

        if($edit == false){
            header("Location: $this->updateRedirection");
        }

        $category = $this->categoryModel->getAll();

        return $this->render($this->updateViewName,  [
            'product' => $edit,
            'category' => $category,
        ]);
    }
}