# Prime Capacetes

Landing page e checkout Pix para o produto **LS2 Classic Draze Vermelho**.

## Stack

- PHP 8.1+ (recomendado), cURL e sessões habilitadas
- HTML/CSS/JavaScript sem dependências de build
- BlackCat API para geração e consulta do Pix

## Instalação em cPanel

1. Envie os arquivos para a pasta pública do domínio.
2. Confirme que o PHP 8.1+ e a extensão cURL estão ativos.
3. Copie `config.example.php` para `config.local.php`.
4. Edite `config.local.php` e configure uma **nova** chave privada BlackCat (a chave compartilhada em conversa deve ser revogada). Configure também a URL pública do site.
5. Garanta permissão de escrita somente na pasta `storage/` (normalmente 700 ou 750).
6. Acesse o domínio e teste a seleção de tamanho, formulário e geração do Pix em ambiente controlado.

## Configuração BlackCat

A integração usa a API oficial:

- Base: `https://api.blackcatoficial.com/api`
- Criação: `POST /sales/create-sale`
- Consulta: `GET /sales/{transactionId}/status`
- Autenticação: header `X-API-Key`
- Valor enviado em centavos: R$ 379,90 = `37990`

A chave privada é lida exclusivamente pelo PHP via variável de ambiente. Ela não deve ser incluída em arquivos públicos, JavaScript ou commits. A chave pública não é necessária para o fluxo PIX server-to-server descrito na documentação.

## Antes de vender

- Revogar a chave privada anteriormente compartilhada e emitir outra.
- Configurar a nova chave no `config.local.php` do servidor.
- Os cinco tamanhos são apresentados como disponíveis, conforme orientação comercial de estoque ilimitado informada pela loja.
- Frete grátis configurado para endereços em Pernambuco (UF PE); o backend rejeita endereços de outros estados.
- Prazo de até 24h divulgado apenas para Recife e região; demais municípios de Pernambuco devem ter prazo confirmado no atendimento.
- Testar uma transação real de baixo risco e conferir o status diretamente na BlackCat.
- Configurar HTTPS e política de privacidade / retenção de dados.

## Observações

O formulário envia dados de identificação e endereço à BlackCat para gerar uma cobrança de produto físico. Os dados do pedido são guardados em `storage/orders.json`, diretório bloqueado para acesso HTTP. Defina uma rotina de retenção e apague pedidos conforme a política de privacidade e obrigações legais.

O status do Pix é consultado no servidor diretamente na API BlackCat; a tela não confia em confirmação enviada pelo navegador.

## Fontes técnicas

- [BlackCat API](https://docs.blackcatoficial.com/)
- [LS2 Brasil – Classic Draze](https://www.ls2.com.br/capacete-ls2-classic-draze-vermelho/p)
- [GitHub – gerenciamento de repositórios](https://docs.github.com/en/repositories)
