<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ShippingService
{
    protected $apiUrl;
    protected $token;
    protected $shopId;

    public function __construct()
    {
        $this->apiUrl = env('GHN_API_URL');
        $this->token = env('GHN_TOKEN');
        $this->shopId = env('GHN_SHOP_ID');
    }

    public function calculateFee($fromDistrict, $toDistrict, $weight, $height, $width, $length)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Token' => $this->token,
            'ShopId' => $this->shopId,
        ])->post($this->apiUrl, [
            "service_type_id" => 2, // Gói dịch vụ GHN
            "from_district_id" => $fromDistrict,
            "to_district_id" => $toDistrict,
            "weight" => $weight,
            "height" => $height,
            "width" => $width,
            "length" => $length
        ]);

        return $response->json();
    }
}
