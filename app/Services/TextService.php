<?php

namespace App\Services;

class TextService
{
    public function taskInstallComplete($filterName, $paymentAmount, $code, $isFullPay = false)
    {
        return "Tabriklaymiz! Siz, F1 modelidagi filterni to'liq to'lash usuli bilan xarid qildingiz. To'lov summasi: 1000000 so'm Tasdiqlash kodi: 123456";
    }

    public function taskServiceComplete()
    {

    }

    /**
     * Client demoga ruxsat berganda
     */
    public function clientAgreedDemo()
    {
        return "Xurmatli mijoz! \"Real Gold Digger\" korxonasiga ishonch bildirganingiz uchun minnatdorchilik bildiramiz! Tez orada siz bilan xodimlarimiz bog'lanishadi";
    }

    /**
     * Client filter sotib olganda
     */
    public function clientBoughtProduct()
    {
        return "Xurmatli Qodirov Faxriddin! Sizni oilamiz a'zosi bo'lganingiz bilan tabriklaymiz! Siz o'z sog'ligingiz uchun befarq emasligingizdan xursandmiz.";
    }
}
