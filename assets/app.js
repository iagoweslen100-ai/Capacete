(() => {
const cfg=window.PRIME_CONFIG||{};
if(cfg.page==='home'){
 let chosen='';
 const buttons=[...document.querySelectorAll('.size-option')];
 const buy=document.getElementById('buy-button');
 buttons.forEach(btn=>btn.addEventListener('click',()=>{
  chosen=btn.dataset.size;
  buttons.forEach(b=>b.classList.toggle('selected',b===btn));
  buy.disabled=false;
  document.getElementById('size-error').textContent='Tamanho selecionado: '+chosen;
 }));
 buy.addEventListener('click',()=>{if(chosen)location.href='index.php?page=checkout&size='+encodeURIComponent(chosen)});
}
if(cfg.page==='checkout'){
 const form=document.getElementById('checkout-form');
 const size=new URLSearchParams(location.search).get('size')||cfg.selectedSize||'';
 document.getElementById('summary-size').textContent=size?'Tamanho: '+size:'Tamanho não selecionado';
 const digits=v=>v.replace(/[^0-9]/g,'');
 const cpf=document.getElementById('cpf'),phone=document.getElementById('phone'),zip=document.getElementById('zip');
 cpf.addEventListener('input',()=>{let v=digits(cpf.value).slice(0,11);cpf.value=v.replace(/(\d{3})(\d)/,'$1.$2').replace(/(\d{3})(\d)/,'$1.$2').replace(/(\d{3})(\d{1,2})$/,'$1-$2')});
 phone.addEventListener('input',()=>{let v=digits(phone.value).slice(0,11);phone.value=v.length>10?v.replace(/(\d{2})(\d{5})(\d{4})/,'($1) $2-$3'):v.replace(/(\d{2})(\d{4})(\d{0,4})/,'($1) $2-$3')});
 zip.addEventListener('input',()=>{let v=digits(zip.value).slice(0,8);zip.value=v.replace(/(\d{5})(\d)/,'$1-$2')});
 const error=document.getElementById('form-error'),pay=document.getElementById('pay-button'),result=document.getElementById('pix-result');
 form.addEventListener('submit',async ev=>{
  ev.preventDefault();error.textContent='';
  if(!size){error.textContent='Volte ao produto e selecione um tamanho.';return}
  if(!form.reportValidity())return;
  const data=Object.fromEntries(new FormData(form).entries());
  data.cpf=digits(data.cpf);data.phone=digits(data.phone);data.zipCode=digits(data.zipCode);data.size=size;
  pay.disabled=true;pay.textContent='GERANDO PIX...';
  try{
   const response=await fetch('api.php?action=create',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(data)});
   const json=await response.json();
   if(!response.ok||!json.success)throw new Error(json.message||'Não foi possível gerar o Pix.');
   form.hidden=true;document.querySelector('.order-summary').hidden=true;result.hidden=false;
   const pix=json.paymentData||{},qr=document.getElementById('pix-qr');
   if(pix.qrCodeBase64){qr.src=pix.qrCodeBase64;qr.hidden=false}
   document.getElementById('pix-copy').value=pix.copyPaste||pix.qrCode||'';
   document.getElementById('copy-pix').addEventListener('click',async()=>{
    await navigator.clipboard.writeText(document.getElementById('pix-copy').value);
    document.getElementById('copy-feedback').textContent='Código Pix copiado.';
   });
   poll(json.orderId,json.transactionId);
   result.scrollIntoView({behavior:'smooth',block:'start'});
  }catch(err){error.textContent=err.message;pay.disabled=false;pay.textContent='GERAR PIX DE R$ 379,90'}
 });
 async function poll(order,transaction){
  const el=document.getElementById('payment-status');
  for(let i=0;i<40;i++){
   try{
    const r=await fetch('api.php?action=status&order='+encodeURIComponent(order)+'&transaction='+encodeURIComponent(transaction));
    const j=await r.json();
    if(j.success&&j.status==='PAID'){el.textContent='Pagamento confirmado! A Prime Capacetes recebeu seu pedido.';return}
    if(j.success&&['CANCELLED','REFUNDED'].includes(j.status)){el.textContent='Este Pix foi cancelado ou expirou. Fale com nosso atendimento.';return}
   }catch(_){}
   await new Promise(resolve=>setTimeout(resolve,5000));
  }
  el.textContent='Ainda aguardando confirmação. Se já pagou, aguarde a atualização.';
 }
}
})();