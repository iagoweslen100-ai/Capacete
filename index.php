<?php
declare(strict_types=1);
session_start();
$page = $_GET['page'] ?? 'home';
if (!in_array($page, ['home','checkout'], true)) { http_response_code(404); exit('Página não encontrada.'); }
function e(string $v): string { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }
$price = '379,90';
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#101010">
<title><?= $page === 'checkout' ? 'Finalizar pedido' : 'LS2 Classic Draze Vermelho | Prime Capacetes' ?></title>
<meta name="description" content="Capacete LS2 Classic Draze Vermelho por R$ 379,90. Prime Capacetes: 8 anos de mercado e entrega em até 24 horas após aprovação do pagamento em Recife e região.">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="site-header"><a class="brand" href="index.php" aria-label="Prime Capacetes"><span class="brand-mark">P</span><span>PRIME<span class="brand-light">CAPACETES</span></span></a><div class="header-right"><span class="header-years">8 ANOS NO MERCADO</span><span class="header-contact">ATENDIMENTO</span></div></header>
<?php if ($page === 'home'): ?>
<main>
<div class="delivery-strip"><span class="pulse"></span> RECIFE E REGIÃO <b>·</b> ENTREGA EM ATÉ 24H APÓS PAGAMENTO APROVADO</div>
<section class="hero wrap">
<div class="hero-copy"><div class="eyebrow"><span>LS2</span> CLASSIC COLLECTION</div><h1>Presença marcante.<br><em>Proteção para seguir.</em></h1><p class="hero-lead">O visual esportivo do LS2 Classic Draze Vermelho, com conforto e recursos para encarar a rotina sobre duas rodas.</p>
<div class="price-line"><strong>R$ 379<sup>,90</sup></strong><span>pagamento via Pix</span></div>
<div class="hero-assurances"><span>✓ Produto novo</span><span>✓ Compra segura</span><span>✓ Atendimento local</span></div>
<div class="size-panel"><div class="size-heading"><div><b>Escolha seu tamanho</b><small>Selecione para continuar</small></div><a href="#guia-tamanho">Como medir?</a></div>
<div class="sizes" role="group" aria-label="Tamanhos disponíveis">
<button type="button" class="size-option" data-size="54/XS">54<small>XS · DISP.</small></button><button type="button" class="size-option" data-size="56/S">56<small>S · DISP.</small></button><button type="button" class="size-option" data-size="58/M">58<small>M · DISP.</small></button><button type="button" class="size-option" data-size="60/L">60<small>L · DISP.</small></button><button type="button" class="size-option" data-size="62/XL">62<small>XL · DISP.</small></button>
</div><p class="size-error" id="size-error" aria-live="polite">Selecione um tamanho para prosseguir.</p><button class="btn-primary" id="buy-button" disabled>PROSSEGUIR COM COMPRA <span>→</span></button><div class="secure-note">⌑ Seus dados são protegidos durante a compra</div></div>
</div>
<div class="hero-visual"><div class="visual-label">DRAZE <span>RED / BLACK</span></div><div class="product-stage"><div class="stage-glow"></div><img src="https://loja.jrspeedracing.com.br/wp-content/uploads/2021/03/LS2-CLASSIC-FF358-DRAZE-BLACK-RED-1-600x600.jpg" alt="Capacete LS2 Classic Draze preto, branco e vermelho" onerror="this.style.display='none';document.getElementById('fallback-product').style.display='grid'"><div id="fallback-product" class="fallback-product">LS2<br><b>DRAZE</b><small>BLACK / RED</small></div></div><div class="product-thumbs" aria-label="Galeria do capacete">
<button type="button" class="thumb active" data-image="https://loja.jrspeedracing.com.br/wp-content/uploads/2021/03/LS2-CLASSIC-FF358-DRAZE-BLACK-RED-1-600x600.jpg" aria-label="Vista lateral"></button>
<button type="button" class="thumb" data-image="https://loja.jrspeedracing.com.br/wp-content/uploads/2021/03/LS2-CLASSIC-FF358-DRAZE-BLACK-RED-4-600x600.jpg" aria-label="Vista frontal"></button>
<button type="button" class="thumb" data-image="https://loja.jrspeedracing.com.br/wp-content/uploads/2021/03/LS2-CLASSIC-FF358-DRAZE-BLACK-RED-5-600x600.jpg" aria-label="Vista traseira"></button>
<button type="button" class="thumb" data-image="https://loja.jrspeedracing.com.br/wp-content/uploads/2021/03/LS2-CLASSIC-FF358-DRAZE-BLACK-RED-2-600x600.jpg" aria-label="Outro ângulo"></button>
</div><div class="visual-caption"><span>01 / 04</span><span>DESIGN QUE NÃO PASSA DESPERCEBIDO</span></div></div>
</section>
<section class="trust-band"><div class="wrap trust-grid"><div><b>08</b><span>ANOS DE MERCADO</span></div><div><b>24H</b><span>ENTREGA EM RECIFE E REGIÃO*</span></div><div><b>PIX</b><span>PAGAMENTO DIGITAL</span></div><div><b>LS2</b><span>MARCA RECONHECIDA</span></div></div><p class="trust-foot">*Prazo de até 24 horas após a aprovação do pagamento, para Recife e região, conforme disponibilidade e confirmação do endereço.</p></section>
<section class="features wrap"><div class="section-kicker">DETALHES QUE FAZEM A DIFERENÇA</div><h2>Feito para acompanhar<br><em>seu ritmo.</em></h2><div class="feature-grid">
<article class="feature-card"><span class="feature-num">01</span><div class="feature-icon">◈</div><h3>Casco HPTT</h3><p>Construção em resina termoplástica de alta pressão, com EPS multidensidade para absorção de energia.</p></article>
<article class="feature-card"><span class="feature-num">02</span><div class="feature-icon">⌁</div><h3>Ventilação funcional</h3><p>Entradas de ar superiores e frontais para favorecer a circulação de ar durante o uso.</p></article>
<article class="feature-card"><span class="feature-num">03</span><div class="feature-icon">◉</div><h3>Conforto no dia a dia</h3><p>Forração respirável, hipoalergênica, removível e lavável para facilitar a higienização.</p></article>
<article class="feature-card"><span class="feature-num">04</span><div class="feature-icon">⟡</div><h3>Viseira prática</h3><p>Viseira plana de 2 mm com resistência a riscos e sistema de troca rápida.</p></article>
</div><p class="spec-note">Especificações de referência da linha LS2 FF358 Classic. Confirme a etiqueta, o conteúdo da embalagem e a identificação do lote do produto recebido. Acompanha viseira cristal, conforme informação do fabricante para esta linha.</p></section>
<section class="size-guide" id="guia-tamanho"><div class="wrap guide-inner"><div><div class="section-kicker">ENCONTRE O AJUSTE CERTO</div><h2>Seu tamanho,<br><em>sem dúvida.</em></h2><p>Com uma fita métrica, contorne a cabeça cerca de 2 cm acima das sobrancelhas, passando pela parte mais larga da nuca. Compare a medida com a referência abaixo e, se ficar entre dois tamanhos, procure orientação antes de comprar.</p></div><div class="size-table"><div><b>54</b><span>XS</span><small>54 cm</small></div><div><b>56</b><span>S</span><small>56 cm</small></div><div><b>58</b><span>M</span><small>58 cm</small></div><div><b>60</b><span>L</span><small>60 cm</small></div><div><b>62</b><span>XL</span><small>62 cm</small></div></div></div></section>
<section class="local-promise wrap"><div class="promise-mark">P</div><div><div class="section-kicker">PRIME CAPACETES</div><h2>Há 8 anos no mercado.<br><em>Atendimento de verdade.</em></h2><p>Uma operação focada em facilitar sua compra, com informação clara, suporte no atendimento e entrega local em Recife e região em até 24 horas após a confirmação do pagamento.</p></div><div class="promise-stamp"><b>24H</b><span>RECIFE<br>E REGIÃO</span></div></section>
<section class="final-cta"><div class="wrap final-cta-inner"><div><span>SEU PRÓXIMO ROLÊ COMEÇA AQUI</span><h2>Escolha seu tamanho<br>e garanta o seu.</h2></div><a href="#top" class="btn-light" onclick="window.scrollTo({top:0,behavior:'smooth'});return false;">ESCOLHER TAMANHO ↑</a></div></section>
</main>
<?php else: ?>
<main class="checkout-main"><div class="delivery-strip"><span class="pulse"></span> RECIFE E REGIÃO <b>·</b> ENTREGA EM ATÉ 24H APÓS PAGAMENTO APROVADO</div><div class="wrap checkout-wrap"><a href="index.php" class="back-link">← VOLTAR AO PRODUTO</a><div class="checkout-title"><div class="section-kicker">ÚLTIMA ETAPA</div><h1>Finalize seu <em>pedido.</em></h1><p>Preencha seus dados para gerar o Pix com segurança. Frete grátis para todo Pernambuco.</p></div>
<div class="checkout-grid"><form id="checkout-form" class="checkout-form" novalidate>
<h2>Dados do comprador</h2><div class="field"><label for="name">Nome completo *</label><input id="name" name="name" autocomplete="name" required maxlength="120" placeholder="Como consta no documento"></div>
<div class="field-row"><div class="field"><label for="cpf">CPF *</label><input id="cpf" name="cpf" inputmode="numeric" autocomplete="off" required maxlength="14" placeholder="000.000.000-00"></div><div class="field"><label for="phone">Telefone / WhatsApp *</label><input id="phone" name="phone" inputmode="tel" autocomplete="tel" required maxlength="16" placeholder="(81) 99999-9999"></div></div>
<div class="field"><label for="email">E-mail *</label><input id="email" name="email" type="email" autocomplete="email" required maxlength="160" placeholder="voce@email.com"></div>
<h2 class="address-heading">Endereço de entrega</h2><div class="field-row"><div class="field"><label for="zip">CEP *</label><input id="zip" name="zipCode" inputmode="numeric" autocomplete="postal-code" required maxlength="9" placeholder="00000-000"></div><div class="field"><label for="state">Estado (UF) *</label><input id="state" name="state" value="PE" required maxlength="2" placeholder="PE"></div></div>
<div class="field"><label for="street">Rua / Avenida *</label><input id="street" name="street" autocomplete="address-line1" required maxlength="160" placeholder="Nome da rua"></div>
<div class="field-row"><div class="field"><label for="number">Número *</label><input id="number" name="number" required maxlength="20" placeholder="Nº"></div><div class="field"><label for="neighborhood">Bairro *</label><input id="neighborhood" name="neighborhood" required maxlength="100" placeholder="Seu bairro"></div></div>
<div class="field"><label for="complement">Complemento</label><input id="complement" name="complement" autocomplete="address-line2" maxlength="100" placeholder="Apartamento, bloco, referência (opcional)"></div>
<div class="field"><label for="city">Cidade *</label><input id="city" name="city" autocomplete="address-level2" required maxlength="100" placeholder="Cidade"></div>
<label class="consent"><input type="checkbox" id="consent" required><span>Confirmo que os dados informados estão corretos e concordo com o uso dessas informações para processar o pedido e a entrega. *</span></label>
<p class="form-error" id="form-error" role="alert"></p><button class="btn-primary checkout-submit" type="submit" id="pay-button">GERAR PIX DE R$ 379,90 <span>→</span></button><div class="secure-note">Pagamento processado pela BlackCat. A Prime Capacetes não solicita senha bancária.</div>
</form>
<aside class="order-summary"><div class="summary-top"><span>RESUMO DO PEDIDO</span><span class="summary-secure">⌑ SEGURO</span></div><div class="summary-product"><div class="summary-thumb">LS2<br><b>DRAZE</b></div><div><b>Capacete LS2 Classic Draze Vermelho</b><small>Preto · Branco · Vermelho</small><small id="summary-size">Tamanho não selecionado</small></div></div><div class="summary-row"><span>Produto</span><b>R$ 379,90</b></div><div class="summary-row"><span>Frete em Pernambuco</span><b>GRÁTIS</b></div><div class="summary-total"><span>Total</span><b>R$ 379,90</b></div><p class="summary-delivery">Frete grátis para todo Pernambuco. Entrega em até 24h após pagamento aprovado em Recife e região; demais municípios conforme confirmação do prazo.</p></aside></div>
<section class="pix-result" id="pix-result" hidden><div class="pix-head"><span class="pix-check">✓</span><div><h2>Seu Pix está pronto</h2><p>Finalize o pagamento para confirmar seu pedido.</p></div></div><div class="pix-content"><img id="pix-qr" alt="QR Code Pix" hidden><div class="pix-code"><label for="pix-copy">PIX COPIA E COLA</label><textarea id="pix-copy" readonly></textarea><button type="button" class="btn-secondary" id="copy-pix">COPIAR CÓDIGO PIX</button><p id="copy-feedback" aria-live="polite"></p></div></div><div class="payment-status" id="payment-status">Aguardando confirmação do pagamento…</div><p class="pix-foot">Não feche esta página até concluir o pagamento. A confirmação pode levar alguns instantes.</p></section>
</div></main>
<?php endif; ?>
<footer class="site-footer"><div class="wrap footer-inner"><a class="brand brand-footer" href="index.php"><span class="brand-mark">P</span><span>PRIME<span class="brand-light">CAPACETES</span></span></a><span>© <?= date('Y') ?> Prime Capacetes. Todos os direitos reservados.</span><span>RECIFE · PERNAMBUCO</span></div></footer>
<script>window.PRIME_CONFIG={page:<?= json_encode($page) ?>,price:37990,selectedSize:<?= json_encode($_SESSION['selected_size'] ?? '') ?>};</script><script src="assets/app.js" defer></script>
</body></html>