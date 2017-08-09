<?php
/**
 * Created by PhpStorm.
 * User: vadim
 * Date: 09.08.17
 * Time: 14:51
 */

$request = array('accessKey'=>'C43FA93E-0C94-A324-5373B235CED381C7','accountID'=>'1064','PRN'=>'123456');
//$result_json = array();
$apiUrl = 'https://admin.keywordconnects.com/webservices/KW-CP-API/CPWebServices.cfc';
$method = 'CPGetHotTransfer';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl . "?method=" . $method);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANYSAFE);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($request));# Убираем вывод данных в браузер. Пусть функция их возвращает а не выводит
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
//
//if ($result !== false) {
//    $result = wddx_deserialize($result);
//    if (strpos($result, '"DATA":') !== false) {
//        $data = explode('"DATA":', $result);
//        $dataStr = substr($data[1], 0, strlen($data[1]) - 1);
//        $json = json_decode($dataStr);
//
//        var_dump($result_json);
//    }
//
//}
$assocResult = [];

if ($result !== false) {
    $result = wddx_deserialize($result);
    $result = json_decode($result);

    $arrLen = count($result->COLUMNS);
    for($i = 0; $i < $arrLen; $i++){
        $assocResult[ $result->COLUMNS[$i] ] = $result->DATA[0][$i];
    }
}
var_dump($assocResult);

//var_dump($title_json);