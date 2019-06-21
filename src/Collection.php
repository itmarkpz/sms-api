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

		return collect($result)->toArray();	
	}
	
	protected function setParam($name, $value = '')
	{
		if (is_array($name)) {
			$this->params = array_merge($this->params, array_filter($name));
		} else {
			$this->params[$name] = $value;
		}
	}
	
	protected function removeParam($index)
	{
		if (isset($this->params[$index])) {
			unset($this->params[$index]);
		}
	}
}