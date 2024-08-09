<?php

namespace App\Services;

class TextService
{
    /**
     * Sotuv operatori - operator_dealer
     * Client demoga ruxsat berganda
     */
    public function clientAgreedDemo()
    {
        return "Xurmatli mijoz! \"Real Gold Digger\" korxonasiga ishonch bildirganingiz uchun minnatdorchilik bildiramiz! Tez orada siz bilan xodimlarimiz bog'lanishadi";
    }


    /**
     * Dealer
     * Filter sotilganda tasdiqlash kodi
     */
    public function clientBoughtProduct($filterName, $paymentAmount, $code, $isFullPay = false)
    {
        if ($isFullPay) {
            return "Tabriklaymiz! Siz, F1 modelidagi filterni to'liq to'lash usuli bilan xarid qildingiz. To'lov summasi: 1000000 so'm. RGD platformasida to'lovni qabul qilish uchun tasdiqlash kodi: 123456";
        }
        return "Tabriklaymiz! Siz, F1 modelidagi filterni bo'lib to'lash usuli bilan xarid qildingiz. Boshlang'ich to'lov: 1000000 so'm, To'lov muddati: 5 oy, Har oylik to'lov summasi: 1250000 so'm. RGD platformasida to'lovni qabul qilish uchun tasdiqlash kodi: 123456 ";

    }

    /**
     * Agent
     * Client filter sotib olganda
     */
    public function taskInstallCode($filterName, $code)
    {
        return "Sizga $filterName modelidagi filter o'rnatib berildi. RGD platformasida xizmatni qabul qilish uchun tasdiqlash kodi: $code";
    }


    /**
     * Agent
     * Servis xizmat ko'rsatilganda tasdiqlash kodi
     */
    public function taskServiceCode($productDetails, $code)
    {
        return "Xurmatli mijoz! Sizga quyidagi xizmatlar ko'rsatildi: $productDetails RGD platformasida xizmatni qabul qilish uchun tasdiqlash kodi: $code";
    }

    /**
     * Agent
     * Task tugatilganda
     */
    public function taskCompleted()
    {
        return "Xurmatli Qodirov Faxriddin! To'lov tasdiqlandi! Tez orada hodimlarimiz siz bilan bog'lanishadi. Qo'shimcha ma'lumotlar uchun telefon: " . config("app.phone");
    }

    /**
     * Kassir operator - operator_cashier
     * Oylik to'lovni biror sababga kora boshqa muddatga surganda
     */
    public function installmentReason($nextPaymentDate, $remainAmount)
    {
        return "Xurmatli mijoz! Siz bo'lib to'lash muddatini uzaytirdingiz. Keyingi to'lov sanasi $nextPaymentDate Bu oydagi qoldiq summa: $remainAmount so'm.";
    }


    /**
     * Kassir - cashier
     * Oylik tolovni mijozdan olganda tasdiqlash kodi
     */
    public function installmentCode($paymentAmount, $code)
    {
        return "Ushbu oy uchun to'lov summasi: $paymentAmount so'm. RGD platformasida to'lovni qabul qilish uchun tasdiqlash kodi: $code";
    }

    /**
     * Kassir - cashier
     * Tolov tasdiqlangani haqida
     */
    public function installmentVerified($clientName, $remainAmount)
    {
        return "Xurmatli $clientName! Ma'lumotlar tasdiqlandi. Jami qoldiq summa: 4000000 so'm. Ushbu oydagi qoldiq summa: 0 so'm";
    }
}
