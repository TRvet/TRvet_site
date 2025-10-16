// Inicialização geral
$(function(){
  // Slider de capa (hero)
  if($('.swiper-hero').length){
    new Swiper('.swiper-hero', {
      loop: true,
      autoplay: { delay: 5000, disableOnInteraction: false },
      pagination: { el: '.hero-slider .swiper-pagination', clickable: true },
      navigation: { nextEl: '.hero-slider .swiper-button-next', prevEl: '.hero-slider .swiper-button-prev' },
      effect: 'slide',
    });
  }
  // Swiper banners
  if($('.swiper-banners').length){
    new Swiper('.swiper-banners', {
      loop: true,
      autoplay: { delay: 5000, disableOnInteraction: false },
      pagination: { el: '.swiper-pagination', clickable: true },
      navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
      effect: 'slide',
    });
  }

  // Slick logos de parceiros
  if($('.partner-logos').length){
    $('.partner-logos').slick({
      slidesToShow: 5,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 1500,
      arrows: false,
      responsive: [
        { breakpoint: 1200, settings: { slidesToShow: 4 } },
        { breakpoint: 992, settings: { slidesToShow: 3 } },
        { breakpoint: 768, settings: { slidesToShow: 2 } },
        { breakpoint: 576, settings: { slidesToShow: 1 } }
      ]
    });
  }

  // Animações simples de entrada
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if(entry.isIntersecting){ entry.target.classList.add('animate__fadeInUp'); }
    });
  }, { threshold: 0.1 });
  document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

  // Contadores de estatísticas ao rolar
  const formatNumber = (value) => {
    return value.toLocaleString('pt-BR');
  };
  const runCounter = (el) => {
    const target = parseInt(el.getAttribute('data-target'), 10) || 0;
    const prefix = el.getAttribute('data-prefix') || '';
    const suffix = el.getAttribute('data-suffix') || '';
    const duration = 1200; // ms
    const steps = 60; // frames aproximados
    const increment = Math.ceil(target / steps);
    let current = 0;
    const tick = () => {
      current = Math.min(current + increment, target);
      el.textContent = `${prefix}${formatNumber(current)}${suffix}`;
      if(current < target){ requestAnimationFrame(tick); }
    };
    requestAnimationFrame(tick);
  };
  const statObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if(entry.isIntersecting){
        const el = entry.target;
        if(!el.dataset.counted){
          el.dataset.counted = '1';
          runCounter(el);
        }
      }
    });
  }, { threshold: 0.3 });
  document.querySelectorAll('.stat-number').forEach(el => statObserver.observe(el));

  // Acessibilidade: fecha menu ao clicar em link
  $('.navbar-collapse a.nav-link').on('click', function(){
    $('.navbar-collapse').collapse('hide');
  });

  // Efeito de toque no botão WhatsApp: simula hover no mobile
  const $whatsBtn = $('.whatsapp-float');
  if($whatsBtn.length){
    let touchTimeout;
    $whatsBtn.on('touchstart', function(){
      clearTimeout(touchTimeout);
      $(this).addClass('hovering');
    });
    $whatsBtn.on('touchend touchcancel', function(){
      const el = $(this);
      touchTimeout = setTimeout(() => el.removeClass('hovering'), 140);
    });
  }

  // Rolagem automática para os cards de avaliações do Google (Elfsight)
  (function setupElfsightAutoScroll(){
    const APP_SELECTOR = '.elfsight-app-dd57d608-d2c3-4459-93ce-0af9a8003358';
    const container = document.querySelector(APP_SELECTOR);
    if(!container){ return; }

    const findScrollable = (root) => {
      const nodes = root.querySelectorAll('*');
      for(const el of nodes){
        const style = getComputedStyle(el);
        const overflowY = style.overflowY;
        const overflowX = style.overflowX;
        const canScrollY = el.scrollHeight > el.clientHeight && overflowY !== 'hidden' && overflowY !== 'visible';
        const canScrollX = el.scrollWidth > el.clientWidth && overflowX !== 'hidden' && overflowX !== 'visible';
        if(canScrollY || canScrollX){ return el; }
      }
      return null;
    };

    const init = () => {
      if(container.dataset.elfsightAutoScroll === '1'){ return true; }
      const scroller = findScrollable(container);
      if(!scroller){ return false; }
      container.dataset.elfsightAutoScroll = '1';
      let paused = false;
      const horizontal = scroller.scrollWidth > scroller.clientWidth;
      const step = 1; // pixels por quadro
      let rafId;
      const tick = () => {
        if(!paused){
          if(horizontal){
            const max = Math.max(scroller.scrollWidth - scroller.clientWidth, 1);
            scroller.scrollLeft = (scroller.scrollLeft + step) % max;
          } else {
            const max = Math.max(scroller.scrollHeight - scroller.clientHeight, 1);
            scroller.scrollTop = (scroller.scrollTop + step) % max;
          }
        }
        rafId = requestAnimationFrame(tick);
      };

      // Pausa ao interagir
      scroller.addEventListener('mouseenter', () => { paused = true; });
      scroller.addEventListener('mouseleave', () => { paused = false; });
      scroller.addEventListener('touchstart', () => { paused = true; }, { passive: true });
      scroller.addEventListener('touchend', () => { paused = false; }, { passive: true });

      tick();
      return true;
    };

    // Tenta imediatamente; caso o conteúdo ainda não esteja injetado, observa mudanças
    if(!init()){
      const obs = new MutationObserver(() => { if(init()){ obs.disconnect(); } });
      obs.observe(container, { childList: true, subtree: true });
      // Fallback por tempo para garantir inicialização
      let tries = 0;
      const timer = setInterval(() => {
        if(init() || ++tries > 50){ clearInterval(timer); obs.disconnect(); }
      }, 300);
    }
  })();

});