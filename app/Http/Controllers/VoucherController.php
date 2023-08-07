<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VoucherService;
use App\Http\Requests\VoucherRequest;

class VoucherController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $voucherService;

    public function __construct(VoucherService $voucherService)
    {
        $this->voucherService = $voucherService;
    }
    
    public function generateVoucher() 
    {
        return $this->voucherService->generateVoucher();
    }

    public function showVoucher() 
    {
        return $this->voucherService->showVoucher();
    }

    public function deleteVoucher(VoucherRequest $request) 
    {
       return $this->voucherService->deleteVoucher($request->validated());
    }

}