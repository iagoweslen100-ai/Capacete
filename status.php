<?php
declare(strict_types=1);
session_start();
if (is_file(__DIR__.'/config.local.php')) require_once __DIR__.'/config.local.php';
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
function answer(int $code,array $data): never { http_response_code($code); echo json_encode($data); exit; }
$transaction=trim((string)($_GET['transaction']??''));
if($transaction===''||!hash_equals((string)($_SESSION['last_transaction']??''),$transaction)) answer(404,['success'=>false,'message'=>'Transação não encontrada.']);
$key=getenv('BLACKCAT_API_KEY') ?: '';
if($key==='') answer(503,['success'=>false,'message'=>'Gateway não configurado.']);
$ch=curl_init('https://api.blackcatoficial.com/api/sales/'.rawurlencode($transaction).'/status');
curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_HTTPHEADER=>['X-API-Key: '.$key,'Accept: application/json'],CURLOPT_TIMEOUT=>15,CURLOPT_SSL_VERIFYPEER=>true,CURLOPT_SSL_VERIFYHOST=>2]);
$raw=curl_exec($ch);$http=(int)curl_getinfo($ch,CURLINFO_HTTP_CODE);curl_close($ch);$result=json_decode((string)$raw,true);
if($http!==200||!is_array($result)||empty($result['success'])) answer(502,['success'=>false,'message'=>'Não foi possível consultar o pagamento.']);
answer(200,['success'=>true,'status'=>$result['data']['status']??'PENDING']);
