<?php

namespace App\Controllers\Resource;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\Config\Services;

class Perusahaan extends ResourcePresenter
{
    protected $helpers = ['form'];

    public function index()
    {
        // Membuat objek HTTP client
        $client = Services::curlrequest();

        // Membuat URL API
        $url = $_ENV['URL_API'] . 'public/get-perusahaan';

        // Melakukan permintaan GET ke URL API
        $response = $client->request('GET', $url);

        // Mengambil status kode HTTP
        $status = $response->getStatusCode();

        // Mengambil body respons sebagai string
        $responseJson = $response->getBody();

        $responseArray = json_decode($responseJson, true);

        $perusahaan = $responseArray['data_perusahaan'];

        $data = [
            'perusahaan' => $perusahaan
        ];

        return view('resource/perusahaan/index', $data);
    }


    public function show($id = null)
    {
        // Membuat objek HTTP client
        $client = Services::curlrequest();

        // Membuat URL API
        $url = $_ENV['URL_API'] . 'public/get-perusahaan/' . $id;

        // Melakukan permintaan GET ke URL API
        $response = $client->request('GET', $url);

        // Mengambil status kode HTTP
        $status = $response->getStatusCode();

        // Mengambil body respons sebagai string
        $responseJson = $response->getBody();

        $responseArray = json_decode($responseJson, true);

        $perusahaan = $responseArray['data_perusahaan'];

        $json = [
            'perusahaan' => $perusahaan[0]
        ];

        echo json_encode($json);
    }


    public function produk($id_perusahaan = null)
    {
        $client = Services::curlrequest();
        $url = $_ENV['URL_API'] . 'public/get-perusahaan/' . $id_perusahaan;
        $response = $client->request('GET', $url);
        $status = $response->getStatusCode();
        $responseJson = $response->getBody();
        $responseArray = json_decode($responseJson, true);
        $perusahaan = $responseArray['data_perusahaan'][0];

        // produk
        $url_produk = $perusahaan['url'] . 'hbapi-get-produks';
        $response_produk = $client->request('GET', $url_produk);
        $status = $response_produk->getStatusCode();
        $responseJsonProduk = $response_produk->getBody();
        $responseArrayProduk = json_decode($responseJsonProduk, true);
        $produk = $responseArrayProduk['products'];


        $data = [
            'perusahaan' => $perusahaan,
            'produk' => $produk
        ];

        return view('resource/perusahaan/list_produk', $data);
    }
}
