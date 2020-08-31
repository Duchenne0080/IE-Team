<?php

/**
 * SSL Labs API v3. Helps to get ssl grade for each endpoint of the host.
 *
 * Class SslLabsApi
 */
class SslLabsApi {

	const ENTRY_POINT = 'https://api.ssllabs.com/api/v3/';

	/**
	 * @var string The server hostname needed to proceed the checks
	 */
	private $host;

	/**
	 * @var stdClass|null The API returned body
	 */
	public $body;

	/**
	 * @var string HTTP response code of the response
	 */
	private $responseCode;

	/**
	 * @var bool
	 */
	private $wpError;

	/**
	 * SslLabsApi constructor.
	 *
	 * @param string $host The server hostname needed to proceed the checks
	 */
	public function __construct( $host ) {
		$this->host = $host;
	}

	/**
	 * This call is used to initiate an assessment, or to retrieve the status of an assessment in progress.
	 *
	 * @param string $startNew
	 * @param string $publish
	 * @param string $all
	 * @param string $ignoreMismatch
	 */
	public function endpointAnalyze( $startNew = null, $publish = 'off', $all = 'done', $ignoreMismatch = 'off' ) {
		$queryParams = [
			'host'           => $this->host,
			'publish'        => $publish,
			'all'            => $all,
			'ignoreMismatch' => $ignoreMismatch
		];

		if ( ! empty( $startNew ) ) {
			$queryParams['startNew'] = $startNew;
		}

		$this->request( 'analyze', $queryParams );
	}

	/**
	 * This call is used to initiate an assessment, or to retrieve the status of an assessment in the cache.
	 *
	 * @param $maxAge
	 * @param $all
	 * @param string $ignoreMismatch
	 */
	public function endpointAnalyzeFromCache( $maxAge, $all = 'on', $ignoreMismatch = 'off' ) {
		$queryParams = [
			'host'           => $this->host,
			'fromCache'      => 'on',
			'maxAge'         => $maxAge,
			'all'            => $all,
			'ignoreMismatch' => $ignoreMismatch
		];

		$this->request( 'analyze', $queryParams );
	}

	public function endpointGetEndpointData() {
		//TODO
	}

	public function endpointGetStatusCodes() {
		//TODO
	}

	public function endpointGetRootCertsRaw() {
		//TODO
	}

	/**
	 * Final request to the API
	 *
	 * @param string $endpoint Api endpoint
	 * @param array $queryParams Api call query params
	 */
	private function request( $endpoint, $queryParams ) {
		$url      = self::ENTRY_POINT . $endpoint . '?' . http_build_query( $queryParams );
		$response = wp_remote_get( $url, [ 'sslverify' => false ] );
		if ( ! is_wp_error( $response ) ) {
			// Successful call
			$this->parseResponse( $response );
		} else {
			$this->wpError = true;
		}
	}

	/**
	 * Retrieve response and body
	 *
	 * @param array $response
	 */
	private function parseResponse( $response ) {
		$this->responseCode = wp_remote_retrieve_response_code( $response );
		$body               = wp_remote_retrieve_body( $response );

		$bodyObj = json_decode( $body );
		// Continue here
		if ( empty( json_last_error() ) ) {
			$this->body = $bodyObj;
		}
	}

	/**
	 * Get the final grade of first endpoint of the host
	 *
	 * @return string|null
	 */
	public function getGrade() {
		if ( ! empty( $this->body ) && ! empty( $this->body->endpoints ) ) {
			// Get the grade of the first endpoint
			// TODO note that endpoints could be multiple, we should check separately
			if ( ! empty( $this->body->endpoints[0]->grade ) ) {
				return $this->body->endpoints[0]->grade;
			}
		}

		return null;
	}

	/**
	 * Get the assessment status
	 *
	 * @return string|null
	 */
	public function getStatus() {
		if ( ! empty( $this->body ) && ! empty( $this->body->status ) ) {
			return $this->body->status;
		}

		return null;
	}

	/**
	 * @return string
	 */
	public function getResponseCode() {
		return $this->responseCode;
	}

	/**
	 * Check weather error exists in the body
	 *
	 * @return bool|null
	 */
	public function errorExists() {
		if ( ! empty( $this->body ) ) {
			return ! empty( $this->body->error );
		}

		return null;
	}

	/**
	 * Check if there is server side errors
	 *
	 * @return bool|null
	 */
	public function checkForCriticalErrors() {
		if(!empty($this->getResponseCode())) {
			return in_array( $this->getResponseCode(), [ '500', '529', '503' ] );
		} else {
			return null;
		}
	}

	/**
	 * Check if there is invalid parameters error
	 *
	 * @return bool|null
	 */
	public function checkInvalidParamsError() {
		if(!empty($this->getResponseCode()) && $this->getResponseCode() === '400') {
			return true;
		} else {
			return null;
		}
	}

	/**
	 * Check if the request rate is too high
	 *
	 * @return bool|null
	 */
	public function checkRequestRateError() {
		if(!empty($this->getResponseCode()) && $this->getResponseCode() === '429') {
			return true;
		} else {
			return null;
		}
	}

	/**
	 * @return bool
	 */
	public function isWpError() {
		return $this->wpError;
	}

}