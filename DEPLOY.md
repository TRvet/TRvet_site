# Deploy 24/7 sem localhost

Este projeto já está pronto para rodar em contêiner (Dockerfile). Abaixo há um passo a passo para publicar 24/7 usando Render (sempre ligado) e apontar o domínio via Cloudflare.

## Opção recomendada: Render (Web Service)

1. Suba o código para um repositório (GitHub/GitLab/Bitbucket).
2. No Render, clique em New → Blueprint e selecione este repositório.
3. Render lerá `render.yaml` e criará um Web Service com Docker.
4. Plano: "Standard" (para ficar sempre ligado). Região: Oregon (padrão). Health check: `/`.
5. Após o deploy, você terá um domínio `https://<nome>.onrender.com`.

## Configurar o domínio na Cloudflare

1. Acesse o painel da Cloudflare do domínio `trvet.com.br`.
2. Se você usa Cloudflare Tunnel hoje, remova/pare as rotas dos hostnames (`www`, `trvet.com.br`) ou desative o túnel.
3. Em DNS, crie um `CNAME` para `www` apontando para o domínio do Render (ex.: `trvet-website.onrender.com`).
4. Ative o proxy (nuvem laranja) para manter CDN e proteção.
5. Opcional: crie o `CNAME` também para o root (`trvet.com.br`) usando Page Rules ou um redirecionamento para `www`.

## Validação

- Acesse `https://www.trvet.com.br/` e confirme HTTP 200.
- Verifique que o GTM (`GTM-PWSNBZGJ`) aparece no HTML, e que não há `gtag/js?id=G-E8GFRKFZVE` direto (pois o GA4 é carregado via GTM).
- Use Tag Assistant e GA4 DebugView para confirmar eventos.

## Observações

- O Dockerfile usa `php:8.2-apache` e habilita `mod_rewrite`.
- Não é necessário Cloudflare Tunnel no novo cenário; o tráfego passa por Cloudflare Proxy até o Render.
- Para outras plataformas (Fly.io, Railway, DO App Platform), este Dockerfile também funciona.