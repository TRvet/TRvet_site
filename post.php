<?php
$slug = $_GET['slug'] ?? '';
$postsFile = __DIR__ . '/data/posts.json';
$post = null;
if($slug && file_exists($postsFile)){
  $json = file_get_contents($postsFile);
  $list = json_decode($json, true) ?: [];
  foreach($list as $p){ if($p['slug'] === $slug){ $post = $p; break; } }
}
if(!$post){ header('Location: /blog.php'); exit; }

$meta = [
  'title' => $post['title'] . ' | Blog TRvet',
  'description' => $post['excerpt'],
  'image' => $post['image'],
];
require __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>

<main id="conteudo-principal" class="py-5">
  <div class="container">
    <!-- BlogPosting JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BlogPosting",
      "headline": "<?php echo htmlspecialchars($post['title']); ?>",
      "image": "<?php echo htmlspecialchars($post['image']); ?>",
      "datePublished": "<?php echo htmlspecialchars($post['date']); ?>",
      "author": {
        "@type": "Organization",
        "name": "TRvet"
      },
      "publisher": {
        "@type": "Organization",
        "name": "TRvet",
        "logo": {
          "@type": "ImageObject",
          "url": "/assets/img/trvet-logo.svg"
        }
      },
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "/post.php?slug=<?php echo urlencode($post['slug']); ?>"
      }
    }
    </script>
    <!-- Breadcrumbs JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        {"@type": "ListItem", "position": 1, "name": "Início", "item": "/index.php"},
        {"@type": "ListItem", "position": 2, "name": "Blog", "item": "/blog.php"},
        {"@type": "ListItem", "position": 3, "name": "<?php echo htmlspecialchars($post['title']); ?>", "item": "/post.php?slug=<?php echo urlencode($post['slug']); ?>"}
      ]
    }
    </script>
    <article class="mx-auto" style="max-width: 860px;">
      <img src="<?php echo $post['image']; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="img-fluid rounded card-shadow">
      <h1 class="section-title mt-4"><?php echo htmlspecialchars($post['title']); ?></h1>
      <p class="text-muted">Publicado em <?php echo date('d/m/Y', strtotime($post['date'])); ?></p>
      <p><?php echo htmlspecialchars($post['excerpt']); ?></p>
      <p>Conteúdo completo do artigo em breve. Este é um template com metatags dinâmicas otimizadas para SEO.</p>
      <a class="btn btn-light" href="/blog.php">Voltar ao Blog</a>
    </article>
  </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
