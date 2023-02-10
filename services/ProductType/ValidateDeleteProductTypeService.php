<?php 
    class ValidateDeleteProductTypeService
    {
        public static function handle($param)
        {
            $db = DB::connect();
        
            $findProductType = $db->prepare("SELECT * FROM product_types WHERE id = :id");
            $findProductType->bindParam(':id', $param);
            $findProductType->execute();
            $existsProductType = $findProductType->fetchObject();
            
            if (!$existsProductType) {
                http_response_code(400);
                echo json_encode(["data" => 'Não é possível deletar este dado, pois não existe!']);
                exit;
            }
            
            $findProduct = $db->prepare("SELECT * FROM products"); 
            $findProduct->execute();
            $existsProduct = $findProduct->fetchObject();
            
            if ($existsProduct) {
                http_response_code(400);
                echo json_encode(["data" => 'Não é possível deletar este dado, pois está vinculado a um produto!']);
                exit;
            }
        }
    }