<?php

// Memanggil file konfigurasi dan fungsi cURL
require_once 'config/config.php';
require_once 'config/curl.php';

// Menyiapkan URL API beserta parameter
$params = [
    'country'  => NEWS_COUNTRY,
    'category' => NEWS_CATEGORY,
    'apiKey'   => NEWS_API_KEY
];

$url = NEWS_API_URL . '?' . http_build_query($params);

// Mengambil data dari NewsAPI
try {

    $response = http_request_get($url);

    // Mengubah JSON menjadi array PHP
    $data = json_decode($response, true);

    // Memeriksa hasil decoding JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Format response JSON tidak valid.");
    }

    // Mengambil daftar artikel
    $articles = $data['articles'] ?? [];

    // Memeriksa status API
    if (($data['status'] ?? '') !== 'ok') {
        throw new Exception("NewsAPI gagal mengambil data.");
    }

} catch (Exception $e) {

    $error = $e->getMessage();
    $articles = [];

}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewsAPI REST Client</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <h1 class="mb-2">NewsAPI REST Client</h1>
    <p class="text-muted">
        Berita teknologi dari NewsAPI
    </p>

    <hr>

    <?php if (isset($error)): ?>

        <div class="alert alert-danger">
            <?php echo htmlspecialchars($error); ?>
        </div>

    <?php elseif (empty($articles)): ?>

        <div class="alert alert-warning">
            Belum ada artikel berita yang tersedia.
        </div>

    <?php else: ?>

        <div class="row">

            <?php foreach ($articles as $article): ?>

                <div class="col-md-6 col-lg-4 mb-4">

                    <div class="card h-100 shadow-sm">

                        <?php if (!empty($article['urlToImage'])): ?>
                            <img
                                src="<?php echo htmlspecialchars($article['urlToImage']); ?>"
                                class="card-img-top"
                                style="height:200px; object-fit:cover;"
                                alt="Gambar berita">
                        <?php endif; ?>

                        <div class="card-body">

                            <h5 class="card-title">
                                <?php echo htmlspecialchars($article['title'] ?? 'Tanpa judul'); ?>
                            </h5>

                            <p class="text-muted small">
                                Sumber:
                                <?php echo htmlspecialchars($article['source']['name'] ?? 'Tidak diketahui'); ?>
                            </p>

                            <p class="card-text">
                                <?php echo htmlspecialchars($article['description'] ?? 'Deskripsi tidak tersedia.'); ?>
                            </p>

                            <a href="<?php echo htmlspecialchars($article['url'] ?? '#'); ?>"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="btn btn-primary">
                                Baca Selengkapnya
                            </a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>

</body>
</html>