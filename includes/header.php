<?php
$instagram = 'https://www.instagram.com/trvetlaudos/';
$whatsapp = 'https://wa.me/5547992850502?text=Ol%C3%A1%2C%20vim%20do%20site%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es!'; // substituir pelo número oficial
$sistemaLaudos = 'https://app.laudofacil.com/'; // Portal LaudoFácil
?>
<header class="topbar py-1 bg-dark text-white small">
  <div class="container d-flex justify-content-between align-items-center">
    <div>
      <i class="fa-solid fa-location-dot"></i>
      <span>Rua 10, 303 - sala 04 - Centro, Balneário Camboriú - SC</span>
    </div>
    <div class="d-flex align-items-center gap-3">
      <a href="<?php echo $instagram; ?>" class="text-white" aria-label="Instagram TRvet" target="_blank" rel="noopener"> <i class="fa-brands fa-instagram"></i> </a>
      <a href="<?php echo $whatsapp; ?>" class="text-white" aria-label="WhatsApp TRvet" target="_blank" rel="noopener"> <i class="fa-brands fa-whatsapp"></i> </a>
    </div>
  </div>
</header>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top" aria-label="Menu principal">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="/index.php">
      <img src="/assets/img/trvet-logo.svg" alt="TRvet" class="brand-logo"> 
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navTRvet" aria-controls="navTRvet" aria-expanded="false" aria-label="Alternar navegação">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navTRvet">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/index.php">Início</a></li>
        <li class="nav-item"><a class="nav-link" href="/quem-somos.php">Quem Somos</a></li>
        <li class="nav-item"><a class="nav-link" href="/servicos.php">Nossos Serviços</a></li>
        <li class="nav-item"><a class="nav-link" href="/contato.php">Contato</a></li>
        <li class="nav-item"><a class="nav-link" href="/blog.php">Blog</a></li>
      </ul>
      <div class="ms-lg-3 mt-2 mt-lg-0">
        <a class="btn btn-purple" href="<?php echo $sistemaLaudos; ?>" target="_blank" rel="noopener" aria-label="Acesso ao Sistema de Laudos">Acesso ao Sistema de Laudos</a>
      </div>
    </div>
  </div>
</nav>