<?php
$meta = [
  'title' => 'Nossos Serviços | TRvet',
  'description' => 'Laudos em telerradiologia veterinária e assessorias especializadas da TRvet.',
];
require __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>

<main id="conteudo-principal" class="py-5">
  <div class="container">
    <h1 class="section-title mb-4">Nossos Serviços</h1>
    <p class="mb-4">Excelência diagnóstica através da telerradiologia veterinária. Assessoria especializada e laudos ágeis, precisos e impulsionados por tecnologia, para clínicas e hospitais.</p>

    <h2 class="mt-4"><i class="fa-solid fa-check me-2" aria-hidden="true"></i>Telerradiologia Veterinária</h2>
    <div class="row g-4 mt-1">
      <?php
        $laudos = [
          ['icon' => 'fa-x-ray', 'titulo' => 'Raio X', 'desc' => 'Interpretação radiográfica precisa e orientação segura para a tomada de decisão clínica.'],
          ['icon' => 'fa-brain', 'titulo' => 'Tomografia computadorizada', 'desc' => 'Exatidão diagnóstica por meio de laudos especializados.'],
          ['icon' => 'fa-heart-pulse', 'titulo' => 'Eletrocardiograma', 'desc' => 'Leitura de eletrocardiograma com agilidade, precisão e segurança diagnóstica.'],
        ];
        foreach($laudos as $srv): ?>
        <div class="col-md-4">
          <div class="service-card p-4 h-100">
            <i class="fa-solid <?php echo $srv['icon']; ?> fa-2x text-primary" aria-hidden="true"></i>
            <h5 class="mt-3 mb-2"><?php echo $srv['titulo']; ?></h5>
            <p><?php echo $srv['desc']; ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <h2 class="mt-5"><i class="fa-solid fa-check me-2" aria-hidden="true"></i> Assessoria Especializada</h2>
    <div class="row g-4 mt-1">
      <?php
        $assessorias = [
          ['icon' => 'fa-stethoscope', 'titulo' => 'Ecocardiograma', 'desc' => 'Interpretação especializada de ecocardiograma, aliando conhecimento técnico e eficiência diagnóstica.'],
          ['icon' => 'fa-wave-square', 'titulo' => 'Ultrassonografia', 'desc' => 'Apoio diagnóstico em ultrassonografia, com agilidade e respaldo técnico especializado.'],
        ];
        foreach($assessorias as $srv): ?>
        <div class="col-md-4">
          <div class="service-card p-4 h-100">
            <i class="fa-solid <?php echo $srv['icon']; ?> fa-2x text-primary" aria-hidden="true"></i>
            <h5 class="mt-3 mb-2"><?php echo $srv['titulo']; ?></h5>
            <p><?php echo $srv['desc']; ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <p class="mt-4">Cada laudo é elaborado por médicos veterinários com formação e experiência em diagnóstico por imagem.</p>

    <div class="text-center mt-5">
      <a href="https://wa.me/5547992850502?text=Ol%C3%A1%2C%20vim%20do%20site%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es!" class="btn btn-trvet btn-lg" target="_blank" rel="noopener">Saiba mais</a>
    </div>
  </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>