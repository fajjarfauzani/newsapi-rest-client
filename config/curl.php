<?php

// Fungsi untuk mengambil data dari API menggunakan cURL
function http_request_get($url) {

    // Inisialisasi cURL
    $curl = curl_init();

    // Pengaturan request
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);

    // Menambahkan identitas aplikasi
    curl_setopt(
        $curl,
        CURLOPT_USERAGENT,
        'NewsAPI-REST-Client/1.0 (PHP cURL)'
    );


    // Menjalankan request
    $response = curl_exec($curl);

    // Memeriksa kesalahan cURL
    if ($response === false) {
        $error = curl_error($curl);
        curl_close($curl);

        throw new Exception("Request API gagal: " . $error);
    }

    // Memeriksa HTTP status
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    // Menutup koneksi
    curl_close($curl);

    // Memeriksa response server
    if ($http_code !== 200) {

        $error_data = json_decode($response, true);

        $message = $error_data['message'] 
            ?? 'Tidak ada pesan error dari API';

        throw new Exception(
            "HTTP Error: " . $http_code . " - " . $message
        );
    }

    return $response;
}