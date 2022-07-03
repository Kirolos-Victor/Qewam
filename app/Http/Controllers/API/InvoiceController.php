<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\CreateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Customer;
use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Http\JsonResponse;

class InvoiceController extends BaseController
{
    public function index(Invoice $invoice): JsonResponse
    {
        return $this->handleResponse(new InvoiceResource($invoice), 'Successful');
    }

    public function create(CreateInvoiceRequest $request): JsonResponse
    {
        $customer = Customer::where('id', $request->customer_id)->first();
        return $this->handleResponse(
            (new InvoiceService())->get($request),
            'You have successfully created an invoice!'
        );
    }
}
