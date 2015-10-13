<?php

namespace Services;

class JsonResponse {
	private $data;
	private $status;
	const STATUS_OK = 1;
	const STATUS_ERROR = 2;

	public function __construct($data, $status = self::STATUS_OK)
	{
		$this->data = $data;
		$this->status = $status;
	}

	public function makeResponse()
	{
		$this->printHeaders();
		echo json_encode($this->getResponseData());
	}

	private function printHeaders()
	{
		header('Content-Type: application/json; charset=utf-8');
	}

	private function getResponseData()
	{
		return [
			'data' => $this->data,
			'status' => $this->status
		];
	}
}