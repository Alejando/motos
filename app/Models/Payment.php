<?php
namespace GlimGlam\Models;

class Payment extends \GlimGlam\Libs\CoreUtils\ModelBase {
    const TYPE_ENROLLMENT = 0;
    
    const PROVIDER_PAYPAL = 1;
    
    public function setAmountTotal($amount) {
        $iva = config('app.iva');
        $totalIva = 1+$iva;
        $ivaDesgloce = $amount-($amount/$totalIva);
        $amountWhitoutIva = $amount-$ivaDesgloce;
        echo $total = $amountWhitoutIva + $ivaDesgloce;
        echo "<br>";
        $this->subtotal = $amountWhitoutIva;
        $this->iva = $ivaDesgloce;
        $this->amount= $ivaDesgloce + $amountWhitoutIva;
    }
}