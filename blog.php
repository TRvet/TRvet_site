<?php
// Modo manutenção para a página do Blog
$blogMaintenance = true;
if($blogMaintenance){
  http_response_code(503);
  header('Retry-After: 3600'); // sugere que volte em até 1 hora
  $meta = [
    'title' => 'Blog em manutenção | TRvet',
    'description' => 'Estamos atualizando nosso conteúdo. Volte em breve.',
    'image' => '/assets/img/trvet-logo.svg',
    'url' => (isset($_SERVER['HTTP_HOST']) ? (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . '/blog.php' : '/blog.php'),
  ];
  require __DIR__ . '/includes/head.php';
  include __DIR__ . '/includes/header.php';
  ?>
  <main id="conteudo-principal" class="py-5">
    <div class="container text-center">
      <h1 class="section-title mb-3">Blog em manutenção</h1>
      <p class="lead">Estamos realizando melhorias e atualizações no nosso Blog.</p>
      <p>Por favor, volte em breve. Agradecemos a compreensão!</p>
      <a class="btn btn-purple mt-3" href="/index.php">Voltar à página inicial</a>
    </div>
  </main>
  <?php include __DIR__ . '/includes/footer.php'; exit; }
$meta = [
  'title' => 'Blog | TRvet',
  'description' => 'Artigos sobre telerradiologia veterinária e boas práticas clínicas.',
  'image' => '/assets/img/trvet-logo.svg',
  'url' => (isset($_SERVER['HTTP_HOST']) ? (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . '/blog.php' : '/blog.php'),
];
require __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';

$postsFile = __DIR__ . '/data/posts.json';
$posts = [];
if(file_exists($postsFile)){
  $json = file_get_contents($postsFile);
  $posts = json_decode($json, true) ?: [];
}
// Formata datas no padrão português: "9 de Outubro de 2025"
function formatDatePt($dateStr){
  try {
    $dt = new DateTime($dateStr);
  } catch(Exception $e){
    return $dateStr;
  }
  $meses = [1=>'Janeiro',2=>'Fevereiro',3=>'Março',4=>'Abril',5=>'Maio',6=>'Junho',7=>'Julho',8=>'Agosto',9=>'Setembro',10=>'Outubro',11=>'Novembro',12=>'Dezembro'];
  $dia = $dt->format('j');
  $mes = $meses[(int)$dt->format('n')] ?? $dt->format('m');
  $ano = $dt->format('Y');
  return "$dia de $mes de $ano";
}
?>

<main id="conteudo-principal" class="pucrs-blog py-5">
  <div class="container">
    <h1 class="section-title mb-4">Blog</h1>
    <!-- Breadcrumbs JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        {"@type": "ListItem", "position": 1, "name": "Início", "item": "/index.php"},
        {"@type": "ListItem", "position": 2, "name": "Blog", "item": "/blog.php"}
      ]
    }
    </script>

    <div class="pucrs-list">
      <?php foreach($posts as $p): ?>
        <article class="pucrs-item d-md-flex gap-4 align-items-start py-3">
          <a class="pucrs-thumb" href="/post.php?slug=<?php echo urlencode($p['slug']); ?>" aria-label="Abrir artigo">
            <img src="<?php echo $p['image']; ?>" alt="<?php echo htmlspecialchars($p['title']); ?>" class="img-fluid card-shadow" loading="lazy">
          </a>
          <div class="pucrs-content">
            <h2 class="pucrs-title"><a href="/post.php?slug=<?php echo urlencode($p['slug']); ?>"><?php echo htmlspecialchars($p['title']); ?></a></h2>
            <p class="pucrs-meta">Por <strong>PUCRS Online</strong> | <?php echo formatDatePt($p['date']); ?></p>
            <p class="pucrs-excerpt"><?php echo htmlspecialchars($p['excerpt']); ?></p>
            <a class="btn btn-purple pucrs-read" href="/post.php?slug=<?php echo urlencode($p['slug']); ?>">Ler mais</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
