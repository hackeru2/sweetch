<?php /** @noinspection PhpMissingFieldTypeInspection */

class DataController extends Controller {
    private   $dataModel;

    public function __construct() {
        $this->dataModel = $this->model('data');
    }

    public function index() {

          $data = $this->dataModel->getdata();
           
        $data = [
            'title' => 'dataS PAGE',
            'data' => $data
        ];
        
        $this->view('datas/index', $data);
    }

    public function upload()
    {
         $data = $this->dataModel->upload();
    }
}