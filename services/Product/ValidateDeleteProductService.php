<?php 
    class ValidateDeleteProductService 
    {
        public static function handle($param)
        {
            $db = DB::connect();
        
            $findProduct = $db->prepare("SELECT * FROM products WHERE id = :id");
            $findProduct->bindParam(':id', $param);
            $findProduct->execute();
            $existsProduct = $findProduct->fetchObject();
            
            if (!$existsProduct) {
                http_response_code(404);
                echo json_encode(["data" => 'Rota não encontrada!']);
                exit;
            }
        }
    }