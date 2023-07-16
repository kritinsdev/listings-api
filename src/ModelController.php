<?php
namespace App;
class ModelController
{
    public function __construct(private ModelGateway $gateway)
    {
    }

    public function processRequest(string $method): void
    {
        $this->processCollectionRequest($method);
    }

    private function processCollectionRequest(string $method): void
    {
        switch ($method) {
            case "GET":
                echo json_encode($this->gateway->getAll());
                break;
            default:
                http_response_code(405);
                header("Allow: GET, POST");
        }
    }
}