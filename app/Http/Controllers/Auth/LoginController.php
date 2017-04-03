<?php

namespace Cerebox\Http\Controllers\Auth;

use Cerebox\Http\Controllers\Controller;
use Cerebox\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'login-redirect';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function redirectToFacebook(){
        $fb = new \Facebook\Facebook([
            'app_id' => config('services.facebook.client_id'), // Replace {app-id} with your app id
            'app_secret' => config('services.facebook.client_secret'),
            'default_graph_version' => 'v2.2',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl(config('services.facebook.redirect'), $permissions);


        return redirect($loginUrl);
        // return \Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(){
        $fb = new \Facebook\Facebook([
            'app_id' => config('services.facebook.client_id'), // Replace {app-id} with your app id
            'app_secret' => config('services.facebook.client_secret'),
            'default_graph_version' => 'v2.2',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        if (isset($_GET['state'])) {
            $helper->getPersistentDataHandler()->set('state', $_GET['state']);
        }

        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

        // Logged in
        // echo '<h3>Access Token</h3>';
        // var_dump($accessToken->getValue());

        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();

        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        // echo '<h3>Metadata</h3>';
        // var_dump($tokenMetadata);

        // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId(config('services.facebook.client_id')); // Replace {app-id} with your app id
        // If you know the user ID this access token belongs to, you can validate it here
        //$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();

        if (! $accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                exit;
            }

            // echo '<h3>Long-lived</h3>';
            // var_dump($accessToken->getValue());
        }

        //$_SESSION['fb_access_token'] = (string) $accessToken;

        try {
          // Get the \Facebook\GraphNodes\GraphUser object for the current user.
          // If you provided a 'default_access_token', the '{access-token}' is optional.
          $response = $fb->get('/me?fields=name,email', $accessToken);
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }

        $facebook_user = $response->getGraphUser();

        // $facebook_user = \Socialite::driver('facebook')->user();

        $user = User::where('facebook_id',$facebook_user->getId())->get()->first();

        if(is_null($user)){
            $user = User::where('email', $facebook_user->getEmail())->get()->first();

            if(!is_null($user)){
                $user->facebook_id = $facebook_user->id;
            }else{
                $user = User::create([
                    'name' => $facebook_user->getName(),
                    'email' => $facebook_user->getEmail(),
                    'facebook_id' => $facebook_user->getId()
                ]);

                \Auth::login($user);

                return redirect()->action('HomeController@editUser');
            }
        }

        \Auth::login($user);

        return redirect()->action('HomeController@loginRedirect');
    }
}
