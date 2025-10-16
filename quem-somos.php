<?php
$meta = [
  'title' => 'Quem Somos | TRvet',
  'description' => 'Conheça a TRvet: missão, visão, valores e nossas especialistas.',
];
require __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>

<main id="conteudo-principal" class="py-5">
  <div class="container">
    <h1 class="section-title mb-4">Quem Somos</h1>
    <p>A TRvet é uma empresa de telerradiologia veterinária integrante do Grupo MXunique, que há mais de 11 anos atua no setor veterinário com soluções inovadoras em educação, treinamentos e serviços especializados.</p>

    <p>Nosso propósito é transformar o diagnóstico por imagem veterinário, oferecendo laudos técnicos de excelência, com agilidade, precisão e suporte especializado. Nossa atuação é exclusiva em exames de imagem e assessorias avançadas em ecocardiografia e ultrassonografia, garantindo confiança e suporte estratégico para clínicas, hospitais veterinários e profissionais do setor.</p>

    

    <h2 class="section-title mt-5">Nossa Equipe de Especialistas</h2>
    <div class="row g-4 mt-1">
      <?php
        $especialistas = [
          [
            'nome' => 'Dra. Marjane Maciel Corrêa',
            'foto' => 'https://i.postimg.cc/gkQndKqG/Imagem-do-Whats-App-de-2025-09-02-s-16-53-21-d283af2a.webp',
            'bio' => [
              'Médica-veterinária pela UNISUL (2019).',
              'Residência em Diagnóstico Veterinário por Imagem – UFSM (2021-2023).',
              'Mestranda em Cirurgia e Clínica de Pequenos Animais (UFSM, 2023-2025), com foco em ultrassonografia veterinária.',
              'Proprietária da EcoX Vet Diagnóstico por Imagem.',
              'Pós-graduanda em Clínica Médica de Felinos (Unyleya, 2025).',
              'Integrante da equipe TRvet, atuando com foco em radiografias de aves e laudos especializados.'
            ]
          ],
          [
            'nome' => 'Dra. Nathalia Eberspacher',
            'foto' => 'https://i.postimg.cc/xThcYPy0/IMG-0211.webp',
            'bio' => [
              'Médica-veterinária pela UDESC (2016).',
              'Especialização em Diagnóstico por Imagem em Pequenos Animais – Facespi/Qualittas (2018).',
              'Ampla experiência em radiologia veterinária, com cursos avançados em ortopedia, aves e radiodiagnóstico.',
              'Atuação como docente e tutora em cursos de radiologia veterinária.',
              'Sócia-proprietária da clínica Nathalia Eberspacher Serviços Veterinários EIRELLI, em Balneário Camboriú/SC.',
              'Membro do corpo clínico da TRvet, responsável por laudos de radiologia digital em pequenos animais.'
            ]
          ],
          [
            'nome' => 'Dr. Lucas',
            'foto' => 'https://i.postimg.cc/SN3JqG7K/Whats-App-Image-2025-10-10-at-07-10-57.webp',
            'bio' => [
              'Formado na Universidade Unicesumar.',
              'Residência em diagnóstico por imagem pela Universidade Estadual de Londrina (UEL).',
              'Curso de tomografia computadorizada no CRV.',
              'Diversos cursos em radiologia e tomografia computadorizada.',
              'CEO da empresa Avance - Imagem Veterinária.'
            ]
          ],
          [
            'nome' => 'Dra. Sofia Wistuba',
            'foto' => 'https://i.postimg.cc/fTJJ6PXZ/Whats-App-Image-2025-08-12-at-15-14-30.webp',
            'bio' => [
              'Médica veterinária pela PUC-PR.',
              'Especialização em clínica médica e cirúrgica pela Equalis.',
              'Especialização em Cardiologia veterinária pela Anhembi Morumbi.',
              'Especialização em pneumologia e pneumologia pediátrica pelo Incor e FGV-SP.'
            ]
          ],
        ];
        foreach($especialistas as $esp): ?>
        <div class="col-md-6 col-lg-3">
          <article class="service-card p-3 h-100">
            <img src="<?php echo htmlspecialchars($esp['foto']); ?>" alt="<?php echo htmlspecialchars($esp['nome']); ?>" class="img-fluid rounded card-shadow mb-2" loading="lazy">
            <div class="p-2">
              <h5 class="mb-2"><?php echo htmlspecialchars($esp['nome']); ?></h5>
              <ul class="mb-0 small">
                <?php foreach($esp['bio'] as $b): ?>
                  <li><?php echo htmlspecialchars($b); ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </article>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>