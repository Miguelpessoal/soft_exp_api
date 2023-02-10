<?php
    include_once "RequestContent.php";
    include_once "services/ProductType/ValidateUpdateProductTypeService.php";
    include_once "services/ProductType/ValidateDeleteProductTypeService.php";
    include_once "services/ProductType/ValidateLabelIsValidService.php";
    
    class ProductTypes
    {
        public function index()
        {
            $db = DB::connect();
            $request = $db->prepare("SELECT * FROM product_types ORDER BY id");
            $request->execute();
            
            $data = $request->fetchAll(PDO::FETCH_ASSOC);
                        
            if ($data) {
                echo json_encode(["data" => $data]);
            } else {
                echo json_encode(["data" => 'Não há dados!']);
            }
        }
        
        public function show ($param)
        {
            $db = DB::connect();
            $request = $db->prepare("SELECT * FROM product_types WHERE id = :id"); 
            $request->bindParam(':id', $param);
            $request->execute();
                    
            $data = $request->fetchObject();
            
            if ($data) {
                echo json_encode(["data" => $data]);
            } else {
                http_response_code(404);
                echo json_encode(["data" => 'Rota não encontrada!']);
            }
        }
        
        public function store ()
        {
            $db = DB::connect();
            $data = RequestContent::handle();
            
            ValidateLabelIsValidService::handle($data['label']);
            
            $request = $db->prepare("INSERT INTO product_types(label, tax_value) VALUES (:label, :tax_value)"); 
            $request->bindParam(':label', $data['label'],PDO::PARAM_STR);
            $request->bindParam(':tax_value', $data['tax_value'], PDO::PARAM_STR);
            $response = $request->execute();
        
            if ($response) {
                http_response_code(201);
                echo json_encode(["data" => 'Dados inseridos com sucesso!']);
            } else {
                http_response_code(400);
                echo json_encode(["data" => 'Erro ao inserir dados!']);
            }
        }
        
        public function update($param)
        {
           $data = RequestContent::handle();
    
           ValidateLabelIsValidService::handle($data['label']);
           
           ValidateUpdateProductTypeService::handle($data, $param);
        }
        
        public function delete($param)
        {
            $db = DB::connect();
                            
            ValidateDeleteProductTypeService::handle($param);
                            
            $request = $db->prepare("DELETE FROM product_types WHERE id = :id"); 
            $request->bindParam(':id', $param);
            $response = $request->execute();
            
            if ($response) {
                http_response_code(203);
                echo json_encode(["data" => 'Dados removidos com sucesso!']);
            } else {
                http_response_code(400);
                echo json_encode(["data" => 'Erro ao remover dados!']);
            }
        }
    }