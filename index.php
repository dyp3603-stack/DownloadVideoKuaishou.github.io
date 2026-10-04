<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error'=>'POST only']);
    exit;
}

$body=json_decode(file_get_contents('php://input'),true);
$url=trim($body['url'] ?? '');

if (!$url || !filter_var($url,FILTER_VALIDATE_URL)) {
    http_response_code(400);
    echo json_encode(['error'=>'Please provide a valid URL.']);
    exit;
}

/*
 * IMPORTANT:
 * This safe starter does NOT scrape/bypass Kuaishou protections.
 * Connect this endpoint to an authorized media-processing service/API
 * that you control or are licensed to use.
 */
$host=parse_url($url,PHP_URL_HOST);
$allowed=preg_match('/(^|\.)kuaishou\.com$/i',$host) || preg_match('/(^|\.)kwai\.com$/i',$host);

if (!$allowed) {
    http_response_code(400);
    echo json_encode(['error'=>'Only Kuaishou/Kwai URLs are accepted.']);
    exit;
}

http_response_code(501);
echo json_encode([
  'error'=>'Backend resolver is not configured yet.',
  'message'=>'Connect your authorized Kuaishou media API/resolver here. The GitHub Pages frontend is ready.'
]);
