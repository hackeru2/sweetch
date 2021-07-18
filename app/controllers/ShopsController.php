<?php /** @noinspection PhpMissingFieldTypeInspection */

class ShopsController extends Controller {
    private   $shopModel;

    public function __construct() {
        $this->shopModel = $this->model('Shop');
    }

    public function index() {

          $shop = $this->shopModel->getShops();
        $data = [
            'title' => 'SHOPS PAGE',
            'shop' => $shop
        ];

        $this->view('shops/index', $data);
    }
}