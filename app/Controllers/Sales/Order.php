<?php

namespace App\Controllers\Sales;

use App\Models\Sales\PenjualanOrderModel;
use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\Config\Services;

class Order extends ResourcePresenter
{
    protected $helpers = ['form'];

    public function index()
    {
        $modelOrder = new PenjualanOrderModel();
        $order = $modelOrder->where('status', 'Waiting')->findAll();

        $data = [
            'order' => $order
        ];

        return view('sales/order/index', $data);
    }

    public function show($no_pemesanan = null, $id_perusahaan = null)
    {
        $client = Services::curlrequest();

        // Get data perusahaan
        $url_get_perusahaan = $_ENV['URL_API'] . 'public/get-perusahaan/' . $id_perusahaan;
        $response_get_perusahaan = $client->request('GET', $url_get_perusahaan);
        $status = $response_get_perusahaan->getStatusCode();
        $responseJson = $response_get_perusahaan->getBody();
        $responseArray = json_decode($responseJson, true);
        $perusahaan = $responseArray['data_perusahaan'][0];

        // Get data pemesanan
        $url_get_pemesanan = $perusahaan['url'] . 'public/hbapi-get-detail-pemesanan/' . $no_pemesanan;
        $response_get_pemesanan = $client->request('GET', $url_get_pemesanan);
        $status = $response_get_pemesanan->getStatusCode();
        $responseJsonPemesanan = $response_get_pemesanan->getBody();
        $responseArrayPemesanan = json_decode($responseJsonPemesanan, true);

        dd($responseArrayPemesanan);

        // $data = [];

        // $json = [
        //     'data' => view('purchase/pemesanan/show', $data),
        // ];

        // echo json_encode($json);
    }
}
