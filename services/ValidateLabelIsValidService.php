<?php 
    class ValidateLabelIsValidService
    {
        public static function handle($data)
        {
            $db = DB::connect();
        
            $findLabel = $db->prepare("SELECT * FROM product_types WHERE label = :label"); 
            $findLabel->bindParam(':label', $data);
            $findLabel->execute();
            $existsThisProductType = $findLabel->fetchObject();
            
            if ($existsThisProductType) {
                http_response_code(400);
                echo json_encode(["data" => 'Já existe um tipo de produto com esse nome!']);
                exit;
            }
        }
    }