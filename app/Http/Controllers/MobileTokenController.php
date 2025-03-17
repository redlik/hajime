<?php

namespace App\Http\Controllers;

use App\Models\MobileToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MobileTokenController extends Controller
{
    public function create($member_id)
    {
        $token = MobileToken::create(
            [
                'token' => Str::random(16),
                'member_id' => $member_id,
                'status' => true,
                'expires_at' => now()->addDays(365),
            ]
        );

        return $token->token;
    }
}
