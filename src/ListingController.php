<?php
namespace App;
use App\ListingGateway;
class ListingController
{
    public function __construct(private ListingGateway $gateway)
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
                if (!empty($_GET['url'])) {
                    $listing = $this->gateway->findByUrl($_GET['url']);
                    
                    if ($listing) {
                        echo json_encode($listing);
                    } else {
                        http_response_code(404);
                        echo json_encode(["message" => "No listing found with this URL"]);
                    }
                } elseif(!empty($_GET['model_id'])) {
                    $listings = $this->gateway->getByModel($_GET['model_id']);
                    if($listings) {
                        echo json_encode($listings);
                    } else {
                        http_response_code(404);
                        echo json_encode(["message" => "No listings found for this model ID"]);
                    }
                } else {
                    echo json_encode($this->gateway->getAll());
                }
                break;
            case "POST":
                $data = (array) json_decode(file_get_contents("php://input"), true);
                
                $errors = $this->getValidationErrors($data);
                
                if ( ! empty($errors)) {
                    http_response_code(422);
                    echo json_encode(["errors" => $errors]);
                    break;
                }
                
                $id = $this->gateway->create($data);
                
                http_response_code(201);
                echo json_encode([
                    "message" => "Listing created",
                    "id" => $id
                ]);
                break;
            
            default:
                http_response_code(405);
                header("Allow: GET, POST");
        }
    }

    private function findByModel($id) {
        //logic here
    }
    
    private function getValidationErrors(array $data, bool $is_new = true): array
    {
        $errors = [];
        
        if ($is_new && empty($data["price"])) {
            $errors[] = "Price is required";
        }

        if (array_key_exists("price", $data)) {
            if (filter_var($data["price"], FILTER_VALIDATE_INT) === false) {
                $errors[] = "Price must be an integer";
            }
        }
        
        return $errors;
    }
}









