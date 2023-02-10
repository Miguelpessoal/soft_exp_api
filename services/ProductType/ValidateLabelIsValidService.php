<?php 
    class ValidateLabelIsValidService
    {
        public static function handle($param)
        {
            $db = DB::connect();
        
            $findLabel = $db->prepare("SELECT * FROM product_types WHERE label = :label"); 
            $findLabel->bindParam(':label', $_POST['label']);
            $findLabel->execute();
            $existsThisProductType = $findLabel->fetchObject();
            
            if ($existsThisProductType) {
                http_response_code(400);
                echo json_encode(["data" => 'Já existe um tipo de produto com esse nome!']);
                exit;
            }
        }
    }