<?php

namespace CodeHub\SMS;

use CodeHub\SMS\Collection;
use Exception;

/**
 * Class Semaphore
 */

class Semaphore extends Collection
{

	public function __construct( $api_key, $sender_name = '' )
	{
		$this->base_uri = 'https://api.semaphore.co/api/v4/';
	
		$this->parameters('query', [
			'apikey'     => $api_key,
			'sendername' => $sender_name
		]);
	}

	public function send( $recipient, string $message )
	{
		if (!is_array($recipient) && !is_numeric($recipient)) {
			throw new Exception("Invalid supplied recipient number");	
		}

		if (is_numeric($recipient)) $recipient = array($recipient); 

		$recipient = collect($recipient)->filter()->unique();

		if ($recipient->count() > 1000) {
		    throw new Exception( 'SMS Api is limited to sending to 1000 recipients at a time' );
		}

		$this->segment = 'messages';
		$this->method  = 'post';
		
		$this->parameters('query', [
			'number'  => $recipient->implode(','),
			'message' => $message
		]);

		return $this->fire();
	}

	public function priority( int $recipient, string $message )
	{
		$this->segment = 'priority';
		$this->parameters('query', [
			'number'  => $number,
			'message' => $message
		]);

		return $this->fire();
	}

	public function messages( array $params = [] )
	{
		$this->segment = 'messages';
		$this->parameters('query', $params);

		return $this->fire()->reverse()->values();
	}

	public function message( int $id )
	{
		$this->segment = 'messages/' . $id;

		return $this->fire();
	}

	public function account()
	{
		$this->segment = 'account';

		return $this->fire();
	}

	public function transactions( int $limit = null, int $page = null )
	{
		$this->segment = 'account/transactions';
		$this->parameters('query', [
			'limit' => $limit,
			'page'  => $page
		]);

		return $this->fire();
	}
	
	public function sendernames( int $limit = null, int $page = null )
	{
		$this->segment = 'account/sendernames';
		$this->parameters('query', [
			'limit' => $limit,
			'page'  => $page
		]);

		return $this->fire();
	}

	public function users( int $limit = null, int $page = null )
	{
		$this->segment = 'account/users';
		$this->parameters('query', [
			'limit' => $limit,
			'page'  => $page
		]);

		return $this->fire();

	}
}