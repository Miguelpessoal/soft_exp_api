<?php 
    class UpdateProductTypeService
    {
        public static function handle($data, $param)
        {
            $db = DB::connect();
            
            if (isset($data['label']) && isset($data['tax_value'])) {
                $request = $db->prepare("UPDATE product_types SET label = :label, tax_value = :tax_value WHERE id = :id"); 
                $request->bindParam(':label', $data['label'],PDO::PARAM_STR);
                $request->bindParam(':tax_value', $data['tax_value'], PDO::PARAM_STR);
                $request->bindParam(':id', $param);
                $response = $request->execute();
                
                if ($response) {
                    echo json_encode(["data" => 'Dados atualizados com sucesso!']);
                } else {
                    http_response_code(400);
                    echo json_encode(["data" => 'Erro ao atualizar dados!']);
                }
            }
            
            if (isset($data['label']) && !isset($data['tax_value'])) {
                $request = $db->prepare("UPDATE product_types SET label = :label WHERE id = :id"); 
                $request->bindParam(':label', $data['label'],PDO::PARAM_STR);
                $request->bindParam(':id', $param);
                $response = $request->execute();
                
                if ($response) {
                    echo json_encode(["data" => 'Dados atualizados com sucesso!']);
                } else {
                    http_response_code(400);
                    echo json_encode(["data" => 'Erro ao atualizar dados!']);
                }
            }
            
            if (isset($data['tax_value']) && !isset($data['label'])) {
                $request = $db->prepare("UPDATE product_types SET tax_value = :tax_value WHERE id = :id"); 
                $request->bindParam(':tax_value', $data['tax_value'], PDO::PARAM_STR);
                $request->bindParam(':id', $param);
                $response = $request->execute();
                
                if ($response) {
                    echo json_encode(["data" => 'Dados atualizados com sucesso!']);
                } else {
                    http_response_code(400);
                    echo json_encode(["data" => 'Erro ao atualizar dados!']);
                }
            }
        }
    }