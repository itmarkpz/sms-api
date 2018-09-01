<?php

namespace CodeHub\SMS;

use GuzzleHttp\Client;

/**
 *  Abstract Class Collection
 */
abstract class Collection 
{
	protected $base_uri;

	private $params = [];

	protected $method = 'get';

	protected $segment;

	protected function fire()
	{
		$result = [];
		$method = $this->method;

		$client = new Client(['base_uri' => $this->base_uri]);

		if ($this->method == 'post') {
			$this->params['form_params'] = $this->params['query'];
			unset($this->params['query']);
		}

		$response = $client->$method($this->segment, $this->params);

		if ($response->getStatusCode() == 200) {
			$result = json_decode($response->getBody()->getContents());
		}

		return collect($result);	
	}

	protected function parameters( $index, $name, $value = '')
	{
		if ( $index && is_array($name) ) {
			if ( isset($this->params[$index]) ) {
				$this->params[$index] = array_merge($this->params[$index], array_filter($name));
			} else {
				$this->params[$index] = array_filter($name);
			}
		} else if ( collect(array_filter(func_get_args()))->count() == 3 ) {
			$this->params[$index][$name] = $value;
		}
	}
}