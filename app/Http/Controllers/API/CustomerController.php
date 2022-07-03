<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\AttachCustomerRequest;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class CustomerController extends BaseController
{
    public function index(): JsonResponse
    {
        return $this->handleResponse(
            CustomerResource::collection(Customer::all()),
            'Fetched all the customers with related users successfully'
        );
    }

    public function create(CreateCustomerRequest $request): JsonResponse
    {
        $customer = Customer::create($request->validated());
        return $this->handleResponse(new CustomerResource($customer), 'Customer created successfully');
    }

    public function attachUser(Customer $customer, AttachCustomerRequest $request): JsonResponse
    {
        $user = User::find($request->user_id);
        $user->update([
            'customer_id' => $customer->id
        ]);
        return $this->handleResponse(new CustomerResource($customer), 'The user attached to the customer successfully');
    }
}
