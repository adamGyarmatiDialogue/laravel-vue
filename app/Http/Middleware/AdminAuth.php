<?php

namespace App\Http\Middleware;

use App\Enums\RecordStatus;
use App\Models\User;
use App\Models\UserLogin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Response as HTTPResponse;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check the users token
        $header = $request->header();

        if (!array_key_exists("usertoken", $header)) {
            return abort(HTTPResponse::HTTP_UNAUTHORIZED, "message.unauthorized");
        }

        // check data
        $token = $header["usertoken"][0];
        $data = explode(";", base64_decode($token));

        if (sizeof($data) !== 3) {
            return abort(HTTPResponse::HTTP_BAD_REQUEST, "message.bad_request");
        }

        // Check the user
        $adminId = $data[1];
        $admin = User::whereId($adminId)->first();

        if (!$admin) {
            return abort(HTTPResponse::HTTP_FORBIDDEN, "message.forbidden");
        }

        if ($admin->is_admin !== RecordStatus::ACTIVE->value) {
            return abort(HTTPResponse::HTTP_FORBIDDEN, "message.forbidden");
        }

        if ($admin->status !== RecordStatus::ACTIVE->value) {
            return abort(HTTPResponse::HTTP_FORBIDDEN, "message.forbidden");
        }

        // DB query debug
        // \DB::enableQueryLog();
        // Check users Login
        $userLogin = UserLogin::where([
            ["user_id", $admin->id],
            ["token", $token],
            ["ip_address", $request->ip()],
            ["status", RecordStatus::ACTIVE->value],
        ])
            ->first();
        // $ql = \DB::getQueryLog();
        // \Log::debug(end($ql));

        if (!$userLogin) {
            return abort(HTTPResponse::HTTP_UNAUTHORIZED, "message.unauthorized");
        }

        // Merge the users data to the request
        $request->merge([
            "admin" => $admin,
            "token" => $token,
        ]);

        return $next($request);
    }
}
