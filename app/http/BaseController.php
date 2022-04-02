<?php

namespace App\http;

class BaseController
{
    /**
     * @var mixed
     */
    private mixed $json_data;
    private array $get_data;

    /**
     * @return mixed
     */
    public function getJsonData(): mixed
    {
        return $this->json_data;
    }

    /**
     * @return array
     */
    public function getGetData(): array
    {
        return $this->get_data;
    }

    public function __construct()
    {
        $json = file_get_contents('php://input');
        $this->json_data = json_decode($json);
        $this->get_data = $_GET;
    }

    /**
     * @param int $status
     * @param array $headers
     * @param string $response
     */
    protected function respondWithCode(int $status, array $headers, string $response)
    {
        http_response_code($status);
        foreach ($headers as $header) {
            header($header);
        }
        echo $response;
    }

    /**
     * @param array $data
     * @param int $status
     */
    protected function respondJson(array $data, int $status = 200)
    {
        $this->respondWithCode($status, ["Content-Type: application/json"], json_encode($data));
    }
}
