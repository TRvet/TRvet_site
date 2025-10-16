<?php
header('Content-Type: application/xml; charset=utf-8');
$scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost:8000';
$base = $scheme . $host;

$pages = [
  '/index.php',
  '/quem-somos.php',
  '/servicos.php',
  '/contato.php',
  '/blog.php'
];

$urls = [];
foreach($pages as $p){
  $file = __DIR__ . $p;
  $lastmod = file_exists($file) ? date('Y-m-d', filemtime($file)) : date('Y-m-d');
  $urls[] = [
    'loc' => $base . $p,
    'lastmod' => $lastmod,
    'changefreq' => 'weekly',
    'priority' => $p === '/index.php' ? '1.0' : '0.8'
  ];
}

// Posts do blog
$postsFile = __DIR__ . '/data/posts.json';
if(file_exists($postsFile)){
  $json = file_get_contents($postsFile);
  $posts = json_decode($json, true) ?: [];
  foreach($posts as $post){
    $slug = $post['slug'] ?? '';
    if(!$slug) continue;
    $lastmod = isset($post['date']) ? date('Y-m-d', strtotime($post['date'])) : date('Y-m-d');
    $urls[] = [
      'loc' => $base . '/post.php?slug=' . urlencode($slug),
      'lastmod' => $lastmod,
      'changefreq' => 'monthly',
      'priority' => '0.6'
    ];
  }
}

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
foreach($urls as $u){
  echo '<url>'; 
  echo '<loc>' . htmlspecialchars($u['loc']) . '</loc>';
  echo '<lastmod>' . htmlspecialchars($u['lastmod']) . '</lastmod>';
  echo '<changefreq>' . htmlspecialchars($u['changefreq']) . '</changefreq>';
  echo '<priority>' . htmlspecialchars($u['priority']) . '</priority>';
  echo '</url>';
}
echo '</urlset>';
?>