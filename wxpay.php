<?php

require_once "lib/WxPay.Api.php";

$test = new WxPay();

$test->WXPay('009', '1', 'Ocean Fleet-testing product');//no order, total fee, body content.

class WxPay {

    public $wxparams;

    public function __construct() {
        $this->wxparams = new WxPayUnifiedOrder();
        $this->wxparams->SetTrade_type('MWEB');
    }

    public function WXPay($trade_no, $total_fee, $body) {
        $this->wxparams->SetBody($body);
        $this->wxparams->SetOut_trade_no($trade_no);
        $this->wxparams->SetTotal_fee($total_fee);
        
        $result = WxPayApi::unifiedOrder($this->wxparams);

        // echo "[result_code]: ".$result['result_code']."</br>";
        // echo "[return_msg]: ".$result['return_msg']."</br>";
        // echo "[return_code]: ".$result['return_code']."</br>";
        // echo "[mweb_url]: <a href='".$result['mweb_url']."'>LINK</a></br>";
        header("Location: ".$result['mweb_url']);
    }
}
?>