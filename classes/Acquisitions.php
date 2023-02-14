<?php 
    include_once "RequestContent.php";
    include_once "services/ValidateDeleteAcquisitionService.php";
    
    class Acquisitions
    {
        public function index()
        {
            $db = DB::connect();
            $request = $db->prepare("SELECT * FROM acquisitions ORDER BY id");
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
            $request = $db->prepare("SELECT * FROM acquisitions WHERE id = :id"); 
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
            
            $request = $db->prepare("INSERT INTO acquisitions(products_total_value, tax_total_value, acquisition_final_value) VALUES (:products_total_value, :tax_total_value, :acquisition_final_value)"); 
            $request->bindParam(':products_total_value', $data['products_total_value'],PDO::PARAM_STR);
            $request->bindParam(':tax_total_value', $data['tax_total_value'],PDO::PARAM_STR);
            $request->bindParam(':acquisition_final_value', $data['acquisition_final_value'], PDO::PARAM_STR);
            $response = $request->execute();
        
            if ($response) {
                http_response_code(201);
                echo json_encode(["data" => 'Dados inseridos com sucesso!']);
            } else {
                http_response_code(400);
                echo json_encode(["data" => 'Erro ao inserir dados!']);
            }
        }
        
        public function delete($param)
        {
            $db = DB::connect();
            
            ValidateDeleteAcquisitionService::handle($param);
                            
            $request = $db->prepare("DELETE FROM acquisitions WHERE id = :id"); 
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