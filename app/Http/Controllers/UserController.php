<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Socialite;

class UserController extends Controller
{

    public function getDashboard()
    {
        return view('dashboard');
    }

    public function signUpPageInit()
    {
        $client = new Client();
        $body = $client->get('http://localhost:3000/public/information/occupations')->getBody();
        $occupation = json_decode($body);
        // return ($occupation[0]->id);
        return view('signup', ['occupations' => $occupation]);
    }

    public function Fetchfield()
    {
        $client = new Client();
        $body = $client->get('http://localhost:3000/public/information/fields')->getBody();
        $interests = json_decode($body);
        return view('interest', ['fields' => $interests]);
    }
    public function sendField(Request $request)
    {
        $value = $request->session()->get('jwt_token');
        if ($value) {
            $client = new Client(); //GuzzleHttp\Client
            $body = $client->request('POST', 'http://localhost:3000/private/update/profile/fields/', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $value,
                ],
                'debug' => false,
                'json' => [
                    'add' => $request['fields'],
                    'sub' => [],
                ],

            ])->getBody();
            $obj = json_decode($body);
            return response()->json(['message' => $obj]);

        }
    }

    public function Signup(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            'username' => 'required',
            'password' => 'required|min:8',
            'confirmpassword' => 'required_with:password|same:password|min:8',
            'gender' => 'required',
            'channel' => 'required',
            'date_of_birth' =>'required'
        ]);

        if ($request['gender'] == 'M') {
            $avatar = '/src/img/dummymale.jpg';
        } else {
            $avatar = '/src/img/dummyfemale.jpeg';
        }

        $client = new Client(); //GuzzleHttp\Client
        $body = $client->post('http://localhost:3000/authentication/signup/renegade', [
            'json' => [
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => $request['password'],
                'first_name' => $request['first_name'],
                'second_name' => $request['last_name'],
                'gender' => $request['gender'],
                'occupation_id' => $request['channel'],
                'avatar' => $avatar,
                'date_of_birth' => $request['date_of_birth'],
            ],
        ])->getBody();
        $obj = json_decode($body);

        //signin
        if ($obj->state == "failure") {
            return ($obj->description);
        } elseif ($obj->state = "success") {
            $client = new Client();
            $body = $client->post('http://localhost:3000/authentication/login/renegade', [
                'json' => [
                    'username' => $request['username'],
                    'password' => $request['password'],
                ],
            ])->getBody();
            $obj = json_decode($body);
            if ($obj->state == "success") {
                $request->session()->put('jwt_token', $obj->token);
                $request->session()->put('username', $obj->user_name);
                return redirect()->route('adduserfield');
            } elseif ($obj->state == "failure") {
                // return($obj->description);
                return redirect()->back();
            }
        }
        return redirect()->route('dashboard');
    }

    public function isOn($interest)
    {
        if ($interest == 'on') {
            return 1;
        } else {
            return 0;
        }

    }

    public function SignIn(Request $request)
    {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',

        ]);

        $client = new Client();
        $body = $client->post('http://localhost:3000/authentication/login/renegade', [
            'json' => [
                'username' => $request['username'],
                'password' => $request['password'],
            ],
        ])->getBody();
        $obj = json_decode($body);
        if ($obj->state == "success") {
            $request->session()->put('jwt_token', $obj->token);
            $request->session()->put('username', $obj->user_name);
            //  $value = $request->session()->get('jwt_token');
            //  return($value);
            //  return($obj->description);
            return redirect()->route('dashboard');
        } elseif ($obj->state == "failure") {
            // return($obj->description);
            return redirect()->back();
        }

    }

    public function getLogout(Request $request)
    {
        $request->session()->forget('jwt_token');

        return redirect()->route('welcome');
    }

    public function getAccount(Request $request)
    {
        $value = $request->session()->get('jwt_token');
        $client = new Client();
        $body = $client->post('127.0.0.1:3000/private/update/profile/person/', [
            'headers' => [
                'Authorization' => 'Bearer ' . $value,
            ],
            'json' => [],

        ])->getBody();
        $obj = json_decode($body);
        return view('account', ['first_name' => $obj->data->first_name, 'last_name' => $obj->data->second_name, 'email' => $obj->data->email]);

    }

    public function postSaveAccount(Request $request)
    {
        $value = $request->session()->get('jwt_token');
        $this->validate($request, [
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
        ]);

        if($value){
        $client = new Client();
        $body = $client->post('127.0.0.1:3000/private/update/profile/accountupdate/',[
            'headers' => [
                'Authorization' => 'Bearer ' . $value,
            ],
            'json' => [
                'first_name' => $request['first_name'],
                'second_name' => $request['last_name']
            ]
        ])->getBody();
        return redirect()->route('account');
            }

    }

    public function getUserImage($filename)
    {

        $file = Storage::disk('public')->get($filename);
        return new Response($file, 200);
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleFacebookCallback()
    {
        $userfb = Socialite::driver('facebook')->user();
        // $userfb = Socialite::driver('facebook')->stateless()->user();
        $user = new User;
        $user->name = explode(" ", $userfb->name);
        // $user->last_name=$userfb->name['lastname'];
        $user->email = $userfb->email;
        $user->gender = 'male';
        $user->password = "default";
        $user->channel = "channel1";
        $user->username = " ";
        $rout = route('social');
        return redirect($rout)->with(['first' => $user->name[0], 'last' => $user->name[1], 'email' => $user->email, 'gender' => $user->gender, 'username' => $user->username]);

    }
    public function terms()
    {
        return view('terms');
    }
    public function privacy()
    {
        return view('privacy');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        // $userg = Socialite::driver('google')->user();
        $userg = Socialite::driver('google')->stateless()->user();
        $user = new User;
        $user->first_name = $userg->user['name']['givenName'];
        $user->last_name = $userg->user['name']['familyName'];
        $user->email = $userg->email;
        $user->gender = 'male';
        $user->password = "default";
        $user->channel = "channel1";
        $user->username = " ";
        $rout = route('social');
        return redirect($rout)->with(['first' => $user->first_name, 'last' => $user->last_name, 'email' => $user->email, 'gender' => $user->gender, 'username' => $user->username]);

    }
    public function socialup(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            'username' => 'required|unique:users',
            'password' => 'required|min:4',
            'confirmpassword' => 'required_with:password|same:password|min:4',
            'gender' => 'required',
            'channel' => 'required',

        ]);
        $user = new User;
        $password = bcrypt($request['password']);
        $interest = ['i1' => $request['i1'] ? 1 : -1, 'i2' => $request['i2'] ? 1 : -1, 'i3' => $request['i3'] ? 1 : -1, 'i4' => $request['i4'] ? 1 : -1, 'i5' => $request['i5'] ? 1 : -1];
        // return $request['first_name'];
        $user->email = $request['email'];
        $user->password = $password;
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->gender = $request['gender'];
        $user->channel = $request['channel'];
        $user->username = $request['username'];
        $user->interest = serialize($interest);
        if ($user->gender = 'male') {
            $user->avatar = '/src/img/dummymale.jpg';
        } else {
            $user->avatar = '/src/img/dummyfemale.jpg';
        }

        $user->save();
        Auth::login($user);
        return redirect()->route('dashboard');

    }

    public function social(Request $request)
    {

        return view('social', ['first' => $request['first'], 'last' => $request['last'], 'email' => $request['email'], 'gender' => $request['gender']]);

    }

    public function googleSignIn()
    {

        return Socialite::driver('google')->redirect();

    }

    public function googleSignInCallback()
    {
        // $userg = Socialite::driver('google')->user();
        $userg = Socialite::driver('google')->stateless()->user();
        if (Auth::attempt(['email' => $userg->email])) {

            return redirect()->route('dashboard');

        }
        return redirect()->back();

    }
    public function myposts()
    {

        return view('myposts');

    }
    public function mychats()
    {
        return view('mychats');

    }

}
