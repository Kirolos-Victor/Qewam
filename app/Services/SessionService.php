<?php
namespace App\Services;

use App\Models\Session;
use Carbon\Carbon;

class SessionService
{
    public function execute($request)
    {
        $session = Session::create([
            'user_id' => $request->user_id
        ]);
        if ($request->type == "appointment") {
            $session->update([
                'appointment' => Carbon::now()
            ]);
        } else {
            $session->update([
                'activated' => Carbon::now()
            ]);
        }
    }
}
