<?php

namespace App\Repositories\User;


use stdClass;
use GuzzleHttp\Client;
use App\Models\User\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client as OClient;
use Spatie\Permission\Models\Permission;
use GuzzleHttp\Exception\ClientException;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Profile\ProfileRepositoryInterface;

class UserRepository implements UserRepositoryInterface {
    const SUCCUSUS_STATUS_CODE = 200;
    const UNAUTHORISED_STATUS_CODE = 401;
    // private $host = request()->getSchemeAndHttpHost();

    public function __construct(Client $client, ProfileRepositoryInterface $profileRepository)
    {
        $this->http = $client;
        $this->profileRepository = $profileRepository;
    }

    public function register(Request $request) {
        $email = $request->email;
        $password = $request->password;
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $url = env('APP_URL') . "/oauth/token";
        $response = $this->getTokenAndRefreshToken($email, $password, $url);
        return $this->response($response["data"], $response["statusCode"]);
    }
    public function registerUser(Request $request) {

        $user = new User();
        $user->email      = $request->email;
        $user->active     = true;
        $user->confirmed  = true;
        $user->confirmation_code = md5(uniqid(mt_rand(), true));
        // first name
            if($request->filled('first_name')){
                $user->first_name    = $request->first_name;
            }else{
                $user->first_name    = $request->name;
            }
            // last name
            if($request->filled('last_name')){
                $user->last_name    = $request->last_name;
            }else{
                $user->last_name    = $request->name;
            }
            // password
            if($request->filled('password')){
                $user->password   = Hash::make($request->password);
            }else{
                $user->password   = Hash::make('123456');
            }

        $user->save();

        if($request->filled('roles')){
            $user->assignRole($request->roles);
        }
        if($request->filled('permissions')){
            $user->givePermissionTo($request->permissions);
        }
        return $user;
    }

    public function updateUser(Request $request, $id) {

        $user = User::find($id);

        $user->first_name       = $request->first_name;
        $user->last_name        = $request->last_name;
        $user->email            = $request->email;
        if($request->filled('password')){
            $user->password         = Hash::make($request->password);
        }
        if($request->filled('roles')){
            $user->assignRole($request->roles);
        }
        if($request->filled('permissions')){
            $user->givePermissionTo($request->permissions);
        }
        $user->active           = true;
        $user->save();

        return $user;
    }
    public function useractivation (Request $request, $id) {

        $user = User::find($id);
        $user->active     = $request->active;
        $user->save();
        return $user;
    }

    public function ProfileUserMail(Request $request) {
        $email = $this->profileRepository->profileusermail($request);
        return $email;
    }

    public function login(Request $request)
    {
        if($request->status == "email"){
            $email = $request->email;
        }elseif($request->status == "phone"){
            $email = $this->ProfileUserMail($request);
        }
        $password = $request->password;
        $url = request()->getSchemeAndHttpHost() . "/oauth/token";
        return $this->getTokenAndRefreshToken($email, $password, $url);
    }

    public function refreshToken(Request $request) {
        if (is_null($request->header('Refreshtoken'))) {
            return $this->response(['error'=>'Unauthorised'], self::UNAUTHORISED_STATUS_CODE);
        }

        $url = request()->getSchemeAndHttpHost() . "/oauth/token";
        $refresh_token = $request->header('Refreshtoken');
        $Oclient = $this->getOClient();
        $formParams = [ 'grant_type' => 'refresh_token',
                        'refresh_token' => $refresh_token,
                        'client_id' => $Oclient->id,
                        'client_secret' => $Oclient->secret,
                        'scope' => '*'];

        return $this->sendRequest($url, $formParams);
    }

    public function user()
    {
        $user = Auth::user()->load('roles', 'permissions');
            $data = [
                'user'       =>$user,
            ];
        return $this->response($data, self::SUCCUSUS_STATUS_CODE);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return $this->response(['message' => 'Successfully logged out'], self::SUCCUSUS_STATUS_CODE);
    }

    public function response($data, int $statusCode) {
        $response = ["data"=>$data, "statusCode"=>$statusCode];
        return $response;
    }

    public function getTokenAndRefreshToken(string $email, string $password, string $url) {

        $Oclient = $this->getOClient();
        $formParams = [ 'grant_type' => 'password',
                        'client_id' => $Oclient->id,
                        'client_secret' => $Oclient->secret,
                        'username' => $email,
                        'password' => $password,
                        'scope' => '*'];

        return $this->sendRequest($url, $formParams);
    }

    public function sendRequest(string $url, array $formParams) {
        try {
            // $url = self::BASE_URL.$route;
            $response = $this->http->post($url, [
                'headers' => [
                    'cache-control' => 'no-cache',
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => $formParams
            ]);
            $statusCode = self::SUCCUSUS_STATUS_CODE;
            $tokendata = json_decode((string) $response->getBody(), true);
            $user = $this->getAuthUser($tokendata['access_token']);

            $data = new stdClass;
            $data->access_token  = $tokendata['access_token'];
            $data->expires_in    = $tokendata['expires_in'];
            $data->refresh_token = $tokendata['refresh_token'];
            $data->token_type    = $tokendata['token_type'];
            $data->user          = $user['user'];

        } catch (ClientException $e) {
            echo $e->getMessage();
            $statusCode = $e->getCode();
            $data = ['error'=>'OAuth client error'];
        }

        return ["data" => $data, "statusCode"=>$statusCode];
    }

    public function getAuthUser($access_token) {
        $host = request()->getHost();
            $userresponse = $this->http->get($host .'/api/user', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$access_token,
                ],
            ]);

            return json_decode($userresponse->getBody(), true);
    }
    public function getOClient() {
        return OClient::where('password_client', 1)->first();
    }
}
