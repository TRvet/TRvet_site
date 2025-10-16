<?php
$meta = [
  'title' => 'TRvet Telerradiologia Veterinária Para todo Brasil',
  'description' => 'Laudos em telerradiologia veterinária com agilidade e precisão. Radiografia, Tomografia, ECG e assessorias especializadas.',
];
require __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>

<main id="conteudo-principal">
  <!-- Capa com Slider (Swiper) -->
  <section class="hero-slider">
    <div class="swiper swiper-hero">
      <div class="swiper-wrapper">
        <!-- Slide 1: Radiografia -->
        <div class="swiper-slide no-overlay" style="background-image:url('https://i.postimg.cc/hGksb50B/Banner-site-1.webp')">
          <div class="slide-content">
            <div class="container py-5">
              <div class="row">
                <div class="col-lg-7">
                  <h1 class="hero-title">TELERRADIOLOGIA DE EXCELÊNCIA</h1>
                  <p class="hero-sub mt-2">Na TRvet, unimos tecnologia e expertise para entregar assessoria personalizada e laudos veterinários precisos e ágeis, apoiando clínicas e hospitais com alcance global.</p>
                  <div class="mt-4 d-flex gap-3">
                    <a href="/servicos.php" class="btn btn-trvet-light">Nossos Serviços</a>
                    <a href="https://wa.me/5547992850502?text=Ol%C3%A1%2C%20vim%20do%20site%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es!" class="btn btn-trvet" target="_blank" rel="noopener">Entrar em Contato</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Slide 2: Tomografia -->
        <div class="swiper-slide" style="background-image:url('https://i.postimg.cc/X7yZGwVh/um-cao-pequeno-segurando-uma-placa-de-raios-x-com-uma-imagem-peito-destacando-cuidados-veterinarios.webp'); background-size: cover; background-position: center; background-repeat: no-repeat;">
          <div class="slide-content">
            <div class="container py-5">
              <div class="row">
                <div class="col-lg-7">
                  <h2 class="mb-2">Todos os seus laudos essenciais em um só lugar: Raio‑ X, Tomografia e Eletrocardiograma.</h2>
                  <p></p>
                  <div class="mt-3">
                    <a href="/servicos.php" class="btn btn-trvet">Conheça nossos serviços</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Slide 3: Cardiologia -->
        <div class="swiper-slide" style="background-image:url('https://i.postimg.cc/X7yZGwVh/um-cao-pequeno-segurando-uma-placa-de-raios-x-com-uma-imagem-peito-destacando-cuidados-veterinarios.webp'); background-size: cover; background-position: center; background-repeat: no-repeat;">
          <div class="slide-content">
            <div class="container py-5">
              <div class="row">
                <div class="col-lg-7">
                  <h2 class="mb-2">Assessoria especializada para decisões precisas em Ultrassom e Ecocardiograma na sua prática clínica.</h2>
                  <p></p>
                  <div class="mt-3">
                    <a href="/contato.php" class="btn btn-trvet">Fale Conosco</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-next" aria-label="Próximo slide"></div>
      <div class="swiper-button-prev" aria-label="Slide anterior"></div>
    </div>
  </section>
  <!-- Institucional curto -->
  <section class="py-5">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-lg-6">
          <img src="/assets/img/trvet-logo.svg" alt="Logo TRvet" class="img-fluid" style="max-width:160px; background: transparent; box-shadow: none">
        </div>
        <div class="col-lg-6">
          <h3 class="mb-3">Sobre a TRvet</h3>
          <p>Somos a telerradiologia veterinária do Grupo MXunique. Unimos tecnologia, ciência e humanidade para apoiar clínicas e hospitais veterinários com laudos ágeis, comunicação clara e parceria contínua.</p>
          <a href="/quem-somos.php" class="btn btn-trvet">Saiba mais</a>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Estatísticas -->
  <section class="py-5 stats">
    <div class="container">
      <div class="row text-center g-4 align-items-end">
        <div class="col-md-6">
          <div class="stat-item">
            <div class="stat-number" data-target="6" data-prefix="+" data-suffix="mil">0</div>
            <div class="stat-label">EXAMES LAUDADOS…</div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="stat-item">
            <div class="stat-number" data-target="10" data-prefix="+" data-suffix="mil">0</div>
            <div class="stat-label">VETERINÁRIOS SATISFEITOS</div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  

  <!-- Elfsight Google Reviews | Untitled Google Reviews -->
  <script src="https://elfsightcdn.com/platform.js" async></script>
  <div class="elfsight-app-dd57d608-d2c3-4459-93ce-0af9a8003358" data-elfsight-app-lazy></div>




</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
