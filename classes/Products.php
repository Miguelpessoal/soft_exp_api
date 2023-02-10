<?php 
    include_once "RequestContent.php";
    include_once "services/ValidateProductDataService.php";
    include_once "services/UpdateProductService.php";
    include_once "services/ValidateDeleteProductService.php";
    
    class Products
    {
        public function index()
        {
            $db = DB::connect();
            $request = $db->prepare("SELECT * FROM products ORDER BY id");
            $request->execute();
            
            $data = $request->fetchAll(PDO::FETCH_ASSOC);
                        
            if ($data) {
                echo json_encode(["data" => $data]);
            } else {
                echo json_encode(["data" => 'Não há dados!']);
            }
        }
        
        public function show($param)
        {   
            $db = DB::connect();
            $request = $db->prepare("SELECT * FROM products WHERE id = :id"); 
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
        
        public function store()
        {
            $db = DB::connect();
            $data = RequestContent::handle();
            
            ValidateProductDataService::handle($data);
            
            $request = $db->prepare("INSERT INTO products(label, product_type_id, price) VALUES (:label, :product_type_id, :price)"); 
            $request->bindParam(':label', $data['label'],PDO::PARAM_STR);
            $request->bindParam(':product_type_id', $data['product_type_id'],PDO::PARAM_INT);
            $request->bindParam(':price', $data['price'], PDO::PARAM_STR);
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
           
           ValidateProductDataService::handle($data);
           
           UpdateProductService::handle($data, $param);
        }
        
        
        public function delete($param)
        {
            $db = DB::connect();
            
            ValidateDeleteProductService::handle($param);
                            
            $request = $db->prepare("DELETE FROM products WHERE id = :id"); 
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