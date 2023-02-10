<?php 
    class ValidateProductDataService 
    {
        public static function handle($data)
        {
            $db = DB::connect();
        
            $findLabel = $db->prepare("SELECT * FROM products WHERE label = :label"); 
            $findLabel->bindParam(':label', $data['label'], PDO::PARAM_STR);
            $findLabel->execute();
            $existsThisProduct = $findLabel->fetchObject();
                        
            if ($existsThisProduct) {
                http_response_code(400);
                echo json_encode(["data" => 'Já existe um produto com esse nome!']);
                exit;
            }
        }
    }