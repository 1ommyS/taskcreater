<?php


namespace App\libs;


class Sberbank
{
    private static string $username = "itpark32-api";

    private static string $password = "jU4FC6pGDF9w";

    public function getOrderStatus ($orderId)
    {
        $url = "https://securepayments.sberbank.ru/payment/rest/getOrderStatus.do?orderId=" . $orderId . "&language=ru&password=" . $this::$password . "&userName=" . $this::$username;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
       curl_close($ch);
        if ( $response ) {
            $response = json_decode($response, true);
            return $response;
        }
        return false;
    }
    public function registerOrder ($total, $order, $returnUrl)
   {
       $url = "https://securepayments.sberbank.ru/payment/rest/register.do?amount=" . intval($total) . "00&currency=643&language=ru&orderNumber=" . $order . "&password=" . $this::$password . "&userName=" . $this::$username . "&returnUrl=https://itpark32.ru".$returnUrl . "&pageView=DESKTOP&sessionTimeoutSecs=1200";
       $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

       if ( $response ) {
           $response = json_decode($response, true);
           return $response;
       }
        return false;
    }
}