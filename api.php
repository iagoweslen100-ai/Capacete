<?php
declare(strict_types=1);
session_start();
if (is_file(__DIR__.'/config.local.php')) require_once __DIR__.'/config.local.php';
header('Content-Type: application/json; charset=utf-8');
function out(int $code,array $data): never { http_response_code($code); echo json_encode($data); exit; }
$key=getenv('BLACKCAT_API_KEY') ?: '';
function cpfValido(string $cpf): bool {
 $cpf=preg_replace('/\\D/','',$cpf) ?? '';
 if(!cpfValido($cpf) || preg_match('/^(\\d)\\1{10}$/',$cpf)) return false;
 for($t=9;$t<11;$t++){ $s=0; for($i=0;$i<$t;$i++) $s+=(int)$cpf[$i]*(($t+1)-$i); $d=((10*$s)%11)%10; if((int)$cpf[$t]!==$d) return false; }
 return true;
}
if($key==='') out(503,['success'=>false,'message'=>'Gateway ainda não configurado no servidor.']);
if(($_GET['action']??'')!=='create') out(404,['success'=>false,'message'=>'Ação inválida.']);
if($_SERVER['REQUEST_METHOD']!=='POST') out(405,['success'=>false,'message'=>'Método inválido.']);
$input=json_decode(file_get_contents('php://input') ?: '',true);
if(!is_array($input)) out(400,['success'=>false,'message'=>'Dados inválidos.']);
$sizes=['54/XS','56/S','58/M','60/L','62/XL'];
$size=(string)($input['size']??'');
if(!in_array($size,$sizes,true)) out(422,['success'=>false,'message'=>'Selecione um tamanho válido.']);
$name=trim((string)($input['name']??''));$email=trim((string)($input['email']??''));$phone=preg_replace('/\D/','',(string)($input['phone']??''));$cpf=preg_replace('/\D/','',(string)($input['cpf']??''));
$street=trim((string)($input['street']??''));$number=trim((string)($input['number']??''));$neighborhood=trim((string)($input['neighborhood']??''));$city=trim((string)($input['city']??''));$state=strtoupper(trim((string)($input['state']??'')));$zip=preg_replace('/\D/','',(string)($input['zipCode']??''));
if(strlen($name)<5||!filter_var($email,FILTER_VALIDATE_EMAIL)||strlen($cpf)!==11||strlen($phone)<10||strlen($zip)!==8||!$street||!$number||!$neighborhood||!$city||!preg_match('/^[A-Z]{2}$/',$state)) out(422,['success'=>false,'message'=>'Confira os dados do comprador e endereço.']);
$payload=['amount'=>37990,'currency'=>'BRL','paymentMethod'=>'pix','items'=>[['title'=>'Capacete LS2 Classic Draze Vermelho - '.$size,'unitPrice'=>37990,'quantity'=>1,'tangible'=>true]],'customer'=>['name'=>$name,'email'=>$email,'phone'=>$phone,'document'=>['number'=>$cpf,'type'=>'cpf']],'shipping'=>['name'=>$name,'street'=>$street,'number'=>$number,'neighborhood'=>$neighborhood,'city'=>$city,'state'=>$state,'zipCode'=>$zip],'pix'=>['expiresInDays'=>1],'externalRef'=>'PC-'.bin2hex(random_bytes(5))];
$ch=curl_init('https://api.blackcatoficial.com/api/sales/create-sale');
curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>json_encode($payload),CURLOPT_HTTPHEADER=>['Content-Type: application/json','X-API-Key: '.$key],CURLOPT_TIMEOUT=>25]);
$raw=curl_exec($ch);$status=(int)curl_getinfo($ch,CURLINFO_HTTP_CODE);curl_close($ch);$result=json_decode((string)$raw,true);
if($status<200||$status>=300||!is_array($result)||empty($result['success'])) out(502,['success'=>false,'message'=>'Não foi possível gerar o Pix. Tente novamente.']);
$data=$result['data']??[];$payment=$data['paymentData']??[];$transaction=(string)($data['transactionId']??'');
if($transaction==='') out(502,['success'=>false,'message'=>'O gateway não retornou o identificador da transação.']);
$_SESSION['last_transaction']=$transaction;
$dir=__DIR__.'/storage';if(!is_dir($dir))mkdir($dir,0700,true);
$file=$dir.'/orders.json';$orders=[];
if(is_file($file)){ $saved=json_decode((string)file_get_contents($file),true);if(is_array($saved))$orders=$saved; }
$orders[$transaction]=['transactionId'=>$transaction,'status'=>$data['status']??'PENDING','amount'=>37990,'size'=>$size,'customer'=>['name'=>$name,'email'=>$email,'phone'=>$phone,'cpfLast4'=>substr($cpf,-4)],'shipping'=>['street'=>$street,'number'=>$number,'neighborhood'=>$neighborhood,'city'=>$city,'state'=>$state,'zipCode'=>$zip],'createdAt'=>date(DATE_ATOM)];
$tmp=$file.'.tmp';file_put_contents($tmp,json_encode($orders,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT),LOCK_EX);@chmod($tmp,0600);rename($tmp,$file);
out(200,['success'=>true,'transactionId'=>$transaction,'paymentData'=>['qrCodeBase64'=>$payment['qrCodeBase64']??null,'copyPaste'=>$payment['copyPaste']??$payment['qrCode']??null]]);
