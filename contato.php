<?php
$errors = [];
$success = false;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $nome = trim($_POST['nome'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $telefone = trim($_POST['telefone'] ?? '');
  $mensagem = trim($_POST['mensagem'] ?? '');

  if($nome === '') $errors['nome'] = 'Informe seu nome';
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'E-mail inválido';
  if($mensagem === '') $errors['mensagem'] = 'Escreva sua mensagem';

  if(!$errors){
    // Simulação de envio (poderia ser mail() ou API)
    $success = true;
  }
}

$meta = [
  'title' => 'Contato | TRvet',
  'description' => 'Entre em contato com a TRvet via WhatsApp, e-mail e formulário.',
];
require __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>

<main id="conteudo-principal" class="py-5">
  <div class="container">
    <h1 class="section-title mb-4">Contato</h1>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="contact-card p-4 h-100 text-center">
          <div class="contact-icon mx-auto mb-3"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></div>
          <h5 class="text-primary mb-1">WhatsApp</h5>
          <p class="mb-3 fw-semibold">(47) 99285-0502</p>
          <a href="https://wa.me/5547992850502?text=Ol%C3%A1%2C%20vim%20do%20site%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es!" class="btn btn-purple w-100" target="_blank" rel="noopener">
            <i class="fa-brands fa-whatsapp me-2" aria-hidden="true"></i> Conversar no WhatsApp
          </a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="contact-card p-4 h-100 text-center">
          <div class="contact-icon mx-auto mb-3"><i class="fa-regular fa-envelope" aria-hidden="true"></i></div>
          <h5 class="text-primary mb-1">E-mail</h5>
          <p class="mb-3">contato@trvet.com.br</p>
          <a href="mailto:contato@trvet.com.br" class="btn btn-purple w-100">
            <i class="fa-regular fa-envelope me-2" aria-hidden="true"></i> Enviar E-mail
          </a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="contact-card p-4 h-100 text-center">
          <div class="contact-icon mx-auto mb-3"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></div>
          <h5 class="text-primary mb-1">Endereço</h5>
          <p class="mb-1 fw-semibold">Rua 10, 303 - sala 04</p>
          <p class="mb-1">Centro, Balneário Camboriú - SC</p>
          <p class="mb-3">CEP: 88330-657</p>
          <a href="https://www.google.com/maps?q=Rua+10,+303+-+sala+04,+Balne%C3%A1rio+Cambori%C3%BA,+SC+88330-657" class="btn btn-purple w-100" target="_blank" rel="noopener">
            <i class="fa-solid fa-map-location-dot me-2" aria-hidden="true"></i> Ver no Mapa
          </a>
        </div>
      </div>
    </div>
    
    <!-- Mapa de Localização -->
    <div class="mt-4">
      <h2 class="section-title mb-3">Como chegar até a TRvet</h2>
      <iframe
        src="https://www.google.com/maps?q=TRvet+Telerradiologia+Veterin%C3%A1ria%2C+Rua+10%2C+303+-+sala+04+-+Centro%2C+Balne%C3%A1rio+Cambori%C3%BA+-+SC%2C+88330-657&output=embed"
        width="100%"
        height="420"
        style="border:0;"
        allowfullscreen
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="Mapa de localização TRvet">
      </iframe>
    </div>
  </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>