<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('account/users_model');
		$this->load->library('account/acl');
		$this->load->config('facebook');

		$this->fb = new \Facebook\Facebook([
			'app_id' => config_item('facebook_app_id'),
			'app_secret' => config_item('facebook_app_secret'),
			'default_graph_version' => 'v2.10',
		]);
	}

	// ------------------------------------------------------------------------

	/**
	 * Index page
	 */
	public function index()
	{
		// $this->fb = new \Facebook\Facebook([
		// 	'app_id' => config_item('facebook_app_id'),
		// 	'app_secret' => config_item('facebook_app_secret'),
		// 	'default_graph_version' => 'v2.10',
		// 	// 'default_access_token' => 'c7b4728b97f7984652796b45a18b45c1', // optional
		// ]);

		// // Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
		// $helper = $fb->getRedirectLoginHelper();
		// // $helper = $fb->getJavaScriptHelper();
		// // $helper = $fb->getCanvasHelper();
		// // $helper = $fb->getPageTabHelper();

		// $access_token = $helper->getAccessToken();
		// echo $access_token; exit;

		// try {
		// 	// Get the \Facebook\GraphNodes\GraphUser object for the current user.
		// 	// If you provided a 'default_access_token', the '{access-token}' is optional.	
		// 	$response = $fb->get('/me', $accessToken);
		// } catch(\Facebook\Exceptions\FacebookResponseException $e) {
		// 	// When Graph returns an error
		// 	echo 'Graph returned an error: ' . $e->getMessage();
		// 	exit;
		// } catch(\Facebook\Exceptions\FacebookSDKException $e) {
		// 	// When validation fails or other local issues
		// 	echo 'Facebook SDK returned an error: ' . $e->getMessage();
		// 	exit;
		// }

		// $me = $response->getGraphUser();
		// echo 'Logged in as ' . $me->getName();

		// $this->load->view('start');
	}

	// ------------------------------------------------------------------------

	/**
	 * login
	 *
	 * @access	public
	 * @param	none
	 * @author 	Randy Nivales <randynivales@gmail.com>
	 */
	public function login()
	{
		$return = ($this->input->get('return')) ? $this->input->get('return') : '';
		$this->session->set_userdata('return', $return);

		$helper = $this->fb->getRedirectLoginHelper();
		$login_url = $helper->getLoginUrl(site_url(config_item('facebook_callback_url')));
		redirect($login_url, 'refresh');
	}

	// ------------------------------------------------------------------------

	/**
	 * callback
	 *
	 * @access	public
	 * @param	none
	 * @author 	Randy Nivales <randynivales@gmail.com>
	 */
	public function callback()
	{
		$helper = $this->fb->getRedirectLoginHelper();

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
		// echo $accessToken->getValue();

		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $this->fb->getOAuth2Client();

		// Get the access token metadata from /debug_token
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);
		// echo '<h3>Metadata</h3>';
		// var_dump($tokenMetadata);

		// Validation (these will throw FacebookSDKException's when they fail)
		$tokenMetadata->validateAppId(config_item('facebook_app_id'));

		// If you know the user ID this access token belongs to, you can validate it here
		//$tokenMetadata->validateUserId('123');
		$tokenMetadata->validateExpiration();

		if (! $accessToken->isLongLived()) {
			// Exchanges a short-lived access token for a long-lived one
			try {
				$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
			} catch (Facebook\Exceptions\FacebookSDKException $e) {
				echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
				exit;
			}

			echo '<h3>Long-lived</h3>';
			var_dump($accessToken->getValue());
		}


		try {
			// Get the \Facebook\GraphNodes\GraphUser object for the current user.
			// If you provided a 'default_access_token', the '{access-token}' is optional.	
			$response = $this->fb->get('/me?fields=id,name,first_name,last_name,email,picture', $accessToken);
		} catch(\Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(\Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		$me = $response->getGraphUser();
		$picture = $me->getPicture(); 
		// pr($me->getEmail()); exit;
		// exit;
		$email = ($me->getEmail()) ? $me->getEmail() : $me->getId() . '@facebook.com';

		$fbdata = array(
			'first_name' => $me->getFirstname(), 
			'last_name' => $me->getLastname(),
			'photo' => ($picture) ? $picture['url'] : 'ui/images/unknown.jpg',
			// 'sso' => 'facebook',
		);
		// pr($email); exit;

		if (! $this->ion_auth_model->identity_check($email))
		{
			// register
			$fbdata['username'] = $me->getId();
			$user_id = $this->ion_auth->register($me->getId(), config_item('facebook_default_password'), $email, $fbdata);

			if ($user_id)
			{
				$data = array(
					'Name' => $me->getFirstname() . ' ' . $me->getLastname(),
					'Date' => date('F d, Y H:i:s')
				);

				// email us
				$this->load->library('email');
				$this->email->from(config_item('website_email'), config_item('website_name'));
				$this->email->to(config_item('website_email'));
				$this->email->subject('New customer - ' . $me->getFirstname() . ' ' . $me->getLastname());
				$this->email->message(str_replace('Array', '', print_r($data, TRUE)));
				$this->email->send();

				// login the user
				$this->ion_auth->login($email, config_item('facebook_default_password'), 1);
			}
		}
		else 
		{
			$user = $this->users_model->find_by('email', $email);

			// update user info
			$this->ion_auth->update($user->id, $fbdata);

			// login
			$this->ion_auth->login($email, config_item('facebook_default_password'), 1);
		}

		// redirect to user's dashboard
		// $this->session->set_flashdata('flash_message', 'You have successfully logged in through Facebook');
		// redirect('account', 'refresh');
		if ($this->session->userdata('return'))
		{
			redirect($this->session->userdata('return'), 'refresh');
		}
		else
		{
			redirect('bookings', 'refresh');
		}
	}
}