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

        // Validate header
        $this->checkTheHeaderHasTokenHeader($header);

        // Get token from header
        $token = $this->getTokenFromHeader($header);

        // Validate token
        $this->validateToken($token);

        // Check the user
        $adminId = $this->getAdminIdFromToken($token);
        $admin = $this->getAdminById($adminId);

        // Check Admin is exist
        $this->checkAdminIsExist($admin);

        $this->checkAdminIsAdmin($admin);

        $this->checkAdminStatusIsActive($admin);

        // DB query debug
        // \DB::enableQueryLog();
        // Check users Login
        $userLogin = $this->findUserLoginByAdminAndRequestData(
            $admin->id,
            $token,
            $request->ip(),
            RecordStatus::ACTIVE->value
        );
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

    /**
     * Check the header has usertoken header
     *
     * @param $header
     */
    private function checkTheHeaderHasTokenHeader($header)
    {
        if (!array_key_exists("usertoken", $header)) {
            return abort(HTTPResponse::HTTP_UNAUTHORIZED, "message.unauthorized");
        }
    }

    private function getTokenFromHeader($header): string
    {
        return $header["usertoken"][0];
    }

    private function validateToken(string $token)
    {
        $data = explode(";", base64_decode($token));

        if (sizeof($data) !== 3) {
            return abort(HTTPResponse::HTTP_BAD_REQUEST, "message.bad_request");
        }
    }

    private function getAdminIdFromToken(string $token): int
    {
        return explode(";", base64_decode($token))[1];
    }

    private function getAdminById(int $adminId)
    {
        return User::whereId($adminId)->first();
    }

    private function checkAdminIsExist($admin)
    {
        if (!$admin) {
            return abort(HTTPResponse::HTTP_FORBIDDEN, "message.forbidden");
        }
    }

    private function checkAdminIsAdmin(User $admin)
    {
        if ($admin->is_admin !== RecordStatus::ACTIVE->value) {
            return abort(HTTPResponse::HTTP_FORBIDDEN, "message.forbidden");
        }
    }

    private function checkAdminStatusIsActive(User $admin)
    {
        if ($admin->status !== RecordStatus::ACTIVE->value) {
            return abort(HTTPResponse::HTTP_FORBIDDEN, "message.forbidden");
        }
    }

    private function findUserLoginByAdminAndRequestData(int $adminId, string $token, string $requestIp, int $status)
    {
        return UserLogin::where([
            ["user_id", $adminId],
            ["token", $token],
            ["ip_address", $requestIp],
            ["status", $status],
        ])
            ->first();
    }
}
