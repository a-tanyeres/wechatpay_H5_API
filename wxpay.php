<?php

require_once "lib/WxPay.Api.php";

$test = new WxPay();

$test->WXPay_unifiedOrder('009', '1', 'Ocean Fleet-testing product');//no order, total fee, body content.

class WxPay {

    public $wxparams;

    public function __construct() {

    }

    /*
    ** Weixin pay functions
    */
    public function WXPay_unifiedOrder($trade_no, $total_fee, $body) {
        
        $this->wxparams = new WxPayUnifiedOrder();
        
        $this->wxparams->SetTrade_type('MWEB');
        $this->wxparams->SetBody($body);
        $this->wxparams->SetOut_trade_no($trade_no);
        $this->wxparams->SetTotal_fee($total_fee);
        
        $result = WxPayApi::unifiedOrder($this->wxparams);

        echo "[mweb_url]: <a href='".$result['mweb_url']."'>LINK</a></br>";
        return $result;
    }
    function WXPay_orderQuery($out_trade_no) {
        
        $wxparams = new WxPayOrderQuery();

        // $wxparams->SetTransaction_id($out_trade_no);
        $wxparams->SetOut_trade_no($out_trade_no);

        $result = WxPayApi::orderQuery($wxparams);

        return $result;
    }

    function WXPay_closeOrder($out_trade_no) {
    
        $wxparams = new WxPayCloseOrder();

        $wxparams->SetOut_trade_no($out_trade_no);

        $result = WxPayApi::closeOrder($wxparams);

        return $result;
    }

    function WXPay_refund($out_trade_no, $out_refund_no, $total_fee, $refund_fee, $op_user_id) {
    
        $wxparams = new WxPayRefund();

        //Choose between transaction_id and out_trade_no
        // $wxparams->SetTransaction_id($out_trade_no)
        $wxparams->SetOut_trade_no($out_trade_no);
        $wxparams->SetOut_refund_no($out_refund_no);
        $wxparams->SetTotal_fee($total_fee);
        $wxparams->SetRefund_fee($refund_fee);
        $wxparams->SetOp_user_id($op_user_id);

        $result = WxPayApi::refund($wxparams);

        return $result;
    }

    function WXPay_refundQuery($out_trade_no) {
    
        $wxparams = new WxPayRefundQuery();

        //Choose between transaction_id, out_trade_no, out_refund_no and refund_id
        // $wxparams->SetTransaction_id($out_trade_no);
        $wxparams->SetOut_trade_no($out_trade_no);
        // $wxparams->SetOut_refund_no($out_trade_no);
        // $wxparams->SetRefund_id($out_trade_no);

        $result = WxPayApi::refundQuery($wxparams);

        return $result;
    }

    function WXPay_downloadBill($bill_date) {
    
       $wxparams = new WxPayDownloadBill();

       $wxparams->SetBill_date($bill_date);

       $result = WxPayApi::downloadBill($wxparams);

       return $result;
    }

    // function WXPay_micropay() {
    //     $wxparams = new WxPayWxPayMicroPay();

    //     $result = WxPayApi::micropay($wxparams);
    // }

    // function WXPay_reverse() {
    //     $wxparams = new WxPayReverse();

    //     $result = WxPayApi::reverse($wxparams);
    // }

    function WXPay_report($sub_mch_id, $interface_url, $execute_time, $return_code, $result_code) {
    
        $wxparams = new WxPayReport();

        $wxparams->SetSub_mch_id($sub_mch_id);
        $wxparams->SetInterface_url($interface_url);
        $wxparams->SetExecute_time($execute_time);
        $wxparams->SetReturn_code($return_code);
        $wxparams->SetResult_code($result_code);

        $result = WxPayApi::report($wxparams);

        return $result;
    }
}

?>