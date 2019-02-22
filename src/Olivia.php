<?php
namespace darkgoldblade01\Paradox\Olivia;

use darkgoldblade01\Paradox\Olivia\Resources\Company;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;

/**
 * Class Olivia
 * @package darkgoldblade01\Paradox
 */
class Olivia
{
    /**
     * @var int $version The current version of the API used.
     */
    protected $version = 1;

    /**
     * @var string $secret_key The Secret Key given to you from Paradox.
     */
    private $secret_key;

    /**
     * @var string $account_id The Account ID given to you from Paradox.
     */
    private $account_id;

    /**
     * @var string $uid The UID given to you from Paradox.
     */
    private $uid;

    /**
     * @var string|null $token The generated JWT token that will be used.
     */
    protected $token;

    /**
     * @var array $options The options array for Guzzle.
     */
    private $options;

    /**
     * @var Client $client The GuzzleHttp Client used for the API
     */
    private $client;


    /**
     * Olivia constructor.
     *
     * @param string $account_id
     * @param string $secret_key
     * @param string $uid
     * @param array $opts An options array to over ride any default options in Guzzle
     *
     * @throws \Exception
     *
     * @return void
     */
    public function __construct( $account_id, $secret_key, $uid, array $opts = [] )
    {
        $this->account_id = $account_id;
        $this->secret_key = $secret_key;
        $this->uid = $uid;

        $defaultOpts = [
            'base_uri' => 'https://api.paradox.ai/api/v' . $this->version .'/public/',
        ];

        $this->options = array_replace_recursive($defaultOpts, $opts);

        $this->generate_token();
    }

    /**
     * Generate Token
     *
     * Generates a new JWT token to use in
     * the requests to Paradox AI.
     *
     * @throws \Exception
     *
     * @return void
     */
    protected function generate_token()
    {
        $this->token = JWT::encode(['UID' => $this->uid, 'iat' => strtotime('now')], $this->secret_key);
        $this->verify_token();
    }

    /**
     * Verify Token
     *
     * Verifies the token with
     * Paradox to confirm that
     * everything is going to work.
     *
     * @throws \Exception
     *
     * @return void
     */
    protected function verify_token()
    {
        $test = (new Client())->post(
            'https://api.paradox.ai/api/v' . $this->version . '/public/auth/verify_jwt_token', [
            'form_params' => [
                'account_id' => $this->account_id,
                'jwt_token' => $this->token,
            ]
        ])->getBody()->getContents();

        $test = json_decode($test);

        if(isset($test->error)) {
            throw new \Exception('Unable to verify credentials. Check the Secret Key, Account ID, and UID given.', 500);
        }

        $this->options['headers'] = [
            'Authorization' => "jwt {$this->account_id}:{$this->token}"
        ];

        $this->client = new Client($this->options);
    }

    /**
     * Company
     *
     * Returns a new instance of the company object.
     *
     * @throws \Exception
     *
     * @return Company
     */
    public function company()
    {
        return new Company($this->account_id, $this->secret_key, $this->uid);
    }

    /**
     * Get
     *
     * Sends a GET request to the
     * endpoint with any options added in.
     *
     * @param $endpoint
     * @param array $opts
     *
     * @return mixed
     */
    public function get($endpoint, $opts = []) {
        $response = $this->client->get($endpoint, $opts);
        return json_decode($response->getBody()->getContents());
    }

    /**
     * Post
     *
     * Sends a POST request to the
     * endpoint with any options added in.
     *
     * @param $endpoint
     * @param array $opts
     *
     * @return mixed
     */
    public function post($endpoint, $opts = []) {
        $response = $this->client->post($endpoint, $opts);
        return json_decode($response->getBody()->getContents());
    }

    /**
     * Put
     *
     * Sends a PUT request to the
     * endpoint with any options added in.
     *
     * @param $endpoint
     * @param array $opts
     *
     * @return mixed
     */
    public function put($endpoint, $opts = []) {
        $response = $this->client->put($endpoint, $opts);
        return json_decode($response->getBody()->getContents());
    }

    /**
     * Delete
     *
     * Sends a DELETE request to the
     * endpoint with any options added in.
     *
     * @param $endpoint
     * @param array $opts
     *
     * @return mixed
     */
    public function delete($endpoint, $opts = []) {
        $response = $this->client->delete($endpoint, $opts);
        return json_decode($response->getBody()->getContents());
    }
}