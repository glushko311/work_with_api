<?php
/**
 * Created by PhpStorm.
 * User: vadim
 * Date: 08.08.17
 * Time: 18:59
 */

$request = array('UserName'=>'TWA','Password'=>'Sooner92');
//$result_json = array();
$apiUrl = 'https://admin.keywordconnects.com/webservices/KW-CP-API/CPWebServices.cfc';
$method = 'CPLogin';

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


//if ($result !== false) {
//    $result = wddx_deserialize($result);
//    if (strpos($result, '"DATA":') !== false) {
//        $data = explode('"DATA":', $result);
//        $dataStr = substr($data[1], 0, strlen($data[1]) - 1);
//        $json = json_decode($dataStr);
//        $result_json = $json;
//    }
//}

//var_dump($result_json);
?>
<!--<div class="test-block"><h3></h3></div>-->
<!---->
<!--<script-->
<!--    src="http://code.jquery.com/jquery-3.2.1.min.js"-->
<!--    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="-->
<!--    crossorigin="anonymous">-->
<!--</script>-->
<!---->
<!---->
<!--<script type="application/javascript">-->
<!--    var loginData = {'USERNAME':'TWA','PASSWORD':'Sooner92'};-->
<!--    //var loginData = {"COLUMNS":["USERNAME","PASSWORD"], "DATA":["TWA","Sooner92"]};-->
<!---->
<!--    var sendData = JSON.stringify(loginData);-->
<!--    //var sendData = "Username=TWA&Password=Sooner92";-->
<!--    //var sendData = "<Envelope xmlns='http://schemas.xmlsoap.org/soap/envelope/'><Body><CPLogin xmlns='http://kwcpapi.webservices.cfmx.basepath'><UserName>TWA</UserName><Password>Sooner92</Password></CPLogin></Body></Envelope>";-->
<!--    //console.log(loginData);-->
<!--    console.log(sendData);-->
<!---->
<!--    $.ajax({-->
<!--        type:"POST",-->
<!--        url: 'https://admin.keywordconnects.com/webservices/KW-CP-API/CPWebServices.cfc?WSDL'+"&method=" + 'CPLogin',-->
<!--        dataType: "json",-->
<!--        data: sendData,-->
<!--        success: function(data){-->
<!--            $('.test-block h3').html(data);-->
<!--            console.log('Load was performed.' + data);-->
<!--        }-->
<!--    });-->
<!---->
<!--</script>-->
<!---->

