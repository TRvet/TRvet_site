<?php
// build-static.php — Gera versão estática do site para GitHub Pages
// Requisitos: PHP CLI

error_reporting(E_ALL);
ini_set('display_errors', '1');
set_time_limit(0);

$root = __DIR__ . '/..';
$dist = $root . '/dist';

// Ambiente simulado para URLs/canonical
$_SERVER['HTTPS'] = 'on';
$_SERVER['HTTP_HOST'] = 'www.trvet.com.br';
$_SERVER['REQUEST_URI'] = '/';

function rrmdir($dir) {
  if (!is_dir($dir)) return;
  $items = scandir($dir);
  foreach ($items as $item) {
    if ($item === '.' || $item === '..') continue;
    $path = $dir . DIRECTORY_SEPARATOR . $item;
    if (is_dir($path)) rrmdir($path); else @unlink($path);
  }
  @rmdir($dir);
}

function rcopy($src, $dst) {
  if (!is_dir($src)) return;
  if (!is_dir($dst)) mkdir($dst, 0777, true);
  $items = scandir($src);
  foreach ($items as $item) {
    if ($item === '.' || $item === '..') continue;
    $srcPath = $src . DIRECTORY_SEPARATOR . $item;
    $dstPath = $dst . DIRECTORY_SEPARATOR . $item;
    if (is_dir($srcPath)) { rcopy($srcPath, $dstPath); }
    else { copy($srcPath, $dstPath); }
  }
}

function render_php($file, $get = [], $reqUri = '/') {
  $full = __DIR__ . '/../' . ltrim($file, '/');
  if (!file_exists($full)) throw new RuntimeException("Arquivo não encontrado: $file");
  // Ajusta REQUEST_URI para canonical/canonical links por página
  $_SERVER['REQUEST_URI'] = $reqUri;
  // Ajusta GET para páginas que dependem de parâmetros
  $_GET = $get;
  ob_start();
  include $full;
  return ob_get_clean();
}

function rewrite_links($html) {
  // Mapeia .php para caminhos estáticos
  $replacements = [
    '/index.php' => '/index.html',
    '/quem-somos.php' => '/quem-somos.html',
    '/servicos.php' => '/servicos.html',
    '/contato.php' => '/contato.html',
    '/blog.php' => '/blog/index.html',
  ];
  foreach ($replacements as $from => $to) {
    // href, item, @id, canonical etc.
    $html = str_replace($from, $to, $html);
  }
  // post.php?slug=XYZ -> /post/XYZ/
  // Em atributos e textos
  $html = preg_replace('#/post\.php\?slug=([A-Za-z0-9\-_%]+)#', '/post/$1/', $html);
  return $html;
}

// Limpa dist
rrmdir($dist);
mkdir($dist, 0777, true);

// Copia assets e arquivos estáticos
rcopy($root . '/assets', $dist . '/assets');
if (file_exists($root . '/robots.txt')) copy($root . '/robots.txt', $dist . '/robots.txt');

// .nojekyll para desabilitar Jekyll
file_put_contents($dist . '/.nojekyll', "\n");
// CNAME para domínio (ajuste se usar apex)
file_put_contents($dist . '/CNAME', "www.trvet.com.br\n");

// Páginas principais
$pages = [
  ['file' => '/index.php',        'out' => $dist . '/index.html',        'req' => '/index.html'],
  ['file' => '/quem-somos.php',   'out' => $dist . '/quem-somos.html',   'req' => '/quem-somos.html'],
  ['file' => '/servicos.php',     'out' => $dist . '/servicos.html',     'req' => '/servicos.html'],
  ['file' => '/contato.php',      'out' => $dist . '/contato.html',      'req' => '/contato.html'],
  ['file' => '/blog.php',         'out' => $dist . '/blog/index.html',   'req' => '/blog/index.html'],
];

foreach ($pages as $p) {
  $html = render_php($p['file'], [], $p['req']);
  $html = rewrite_links($html);
  // Garante diretório
  $dir = dirname($p['out']);
  if (!is_dir($dir)) mkdir($dir, 0777, true);
  file_put_contents($p['out'], $html);
}

// Posts do blog
$postsFile = $root . '/data/posts.json';
$posts = [];
if (file_exists($postsFile)) {
  $json = file_get_contents($postsFile);
  $posts = json_decode($json, true) ?: [];
}
foreach ($posts as $post) {
  $slug = $post['slug'] ?? '';
  if (!$slug) continue;
  $outDir = $dist . '/post/' . $slug;
  $out = $outDir . '/index.html';
  if (!is_dir($outDir)) mkdir($outDir, 0777, true);
  $html = render_php('/post.php', ['slug' => $slug], '/post/' . $slug . '/');
  $html = rewrite_links($html);
  file_put_contents($out, $html);
}

// Sitemap -> XML com links reescritos
$xml = render_php('/sitemap.php', [], '/sitemap.xml');
$xml = rewrite_links($xml);
file_put_contents($dist . '/sitemap.xml', $xml);

// Resultado
echo "Build estático concluído em: $dist\n";
?>