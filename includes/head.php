<?php
// Metadados dinâmicos por página
$defaultMeta = [
    'title' => 'TRvet Telerradiologia Veterinária Para todo Brasil',
    'description' => 'TRvet, telerradiologia veterinária do Grupo MXunique. Laudos ágeis e precisos em radiografia, tomografia e exames cardiológicos.',
    'keywords' => 'telerradiologia veterinária, laudos, raio-x, tomografia, ECG, ecocardiograma, ultrassonografia',
    'image' => '/assets/img/trvet-logo.svg',
    'url' => (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
];
$meta = isset($meta) && is_array($meta) ? array_merge($defaultMeta, $meta) : $defaultMeta;
// Base URL (sem path)
$baseUrl = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? 'localhost');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo htmlspecialchars($meta['title']); ?></title>
    <!-- Favicon prioritário em SVG (local) -->
    <link rel="icon" type="image/svg+xml" href="/assets/img/trvet-logo.svg" />
    <meta name="description" content="<?php echo htmlspecialchars($meta['description']); ?>" />
    <meta name="keywords" content="<?php echo htmlspecialchars($meta['keywords']); ?>" />
    <link rel="canonical" href="<?php echo htmlspecialchars($meta['url']); ?>" />

    

    <!-- Schema.org: Organization -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "TRvet",
      "url": "<?php echo htmlspecialchars($baseUrl); ?>",
      "logo": "<?php echo htmlspecialchars($meta['image']); ?>",
      "sameAs": [
        "https://www.instagram.com/trvetlaudos/",
        "https://wa.me/5547992850502"
      ]
    }
    </script>

    <!-- Schema.org: WebSite -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "<?php echo htmlspecialchars($baseUrl); ?>",
      "name": "<?php echo htmlspecialchars($meta['title']); ?>"
    }
    </script>

    <!-- Open Graph / Twitter -->
    <meta property="og:title" content="<?php echo htmlspecialchars($meta['title']); ?>" />
    <meta property="og:description" content="<?php echo htmlspecialchars($meta['description']); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="<?php echo htmlspecialchars($meta['image']); ?>" />
    <meta property="og:url" content="<?php echo htmlspecialchars($meta['url']); ?>" />
    <meta name="twitter:card" content="summary_large_image" />

    <!-- Tipografia -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 (cdnjs, sem SRI para evitar bloqueios em dev) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet" referrerpolicy="no-referrer" />

    <!-- Font Awesome (cdnjs, com SRI para produção) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Slick Carousel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css" />

    <!-- CSS do projeto -->
    <link rel="stylesheet" href="/assets/css/style.css" />

    <!-- Acessibilidade básica -->
    <meta name="theme-color" content="#531b6d" />
</head>
<body>
    <a class="visually-hidden-focusable" href="#conteudo-principal">Ir para conteúdo</a>