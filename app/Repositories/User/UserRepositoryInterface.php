<?php

namespace App\Repositories\User;

use Illuminate\Http\Request;

interface UserRepositoryInterface {
    public function register(Request $request);
    public function registerUser(Request $request);
    public function updateUser(Request $request, $user);
    public function ProfileUserMail(Request $request);
    public function login(Request $request);
    public function refreshToken(Request $request);
    public function user();
    public function logout(Request $request);
    public function response($data, int $statusCode);
    public function getTokenAndRefreshToken(string $email, string $password, string $route);
    public function sendRequest(string $route, array $formParams);
    public function getOClient();
}
