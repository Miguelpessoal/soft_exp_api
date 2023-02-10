<?php 
    class UpdateProductService
    {
        public static function handle($data, $param)
        {
            $db = DB::connect();
            
            //Atualiza caso todos os dados tenham sido enviados
            if (isset($data['label']) && isset($data['price']) && isset($data['product_type_id'])) {
                $request = $db->prepare("UPDATE products SET label = :label, price = :price, product_type_id = :product_type_id WHERE id = :id"); 
                $request->bindParam(':label', $data['label'],PDO::PARAM_STR);
                $request->bindParam(':price', $data['price'], PDO::PARAM_STR);
                $request->bindParam(':product_type_id', $data['product_type_id'], PDO::PARAM_INT);
                $request->bindParam(':id', $param);
                $response = $request->execute();
                
                if ($response) {
                    echo json_encode(["data" => 'Dados atualizados com sucesso!']);
                } else {
                    http_response_code(400);
                    echo json_encode(["data" => 'Erro ao atualizar dados!']);
                }
            }
            
            //Atualiza caso tenha sido enviado apenas o label e o product_type_id
            if (isset($data['label']) && isset($data['product_type_id']) && !isset($data['price'])) {
                $request = $db->prepare("UPDATE products SET label = :label, product_type_id = :product_type_id WHERE id = :id"); 
                $request->bindParam(':label', $data['label'],PDO::PARAM_STR);
                $request->bindParam(':product_type_id', $data['product_type_id'], PDO::PARAM_INT);
                $request->bindParam(':id', $param);
                $response = $request->execute();
                
                if ($response) {
                    echo json_encode(["data" => 'Dados atualizados com sucesso!']);
                } else {
                    http_response_code(400);
                    echo json_encode(["data" => 'Erro ao atualizar dados!']);
                }
            }
            
            //Atualiza caso tenha sido enviado apenas o label e o price
            if (isset($data['label']) && isset($data['price']) && !isset($data['product_type_id'])) {
                $request = $db->prepare("UPDATE products SET label = :label, price = :price WHERE id = :id"); 
                $request->bindParam(':label', $data['label'],PDO::PARAM_STR);
                $request->bindParam(':price', $data['price'], PDO::PARAM_INT);
                $request->bindParam(':id', $param);
                $response = $request->execute();
                
                if ($response) {
                    echo json_encode(["data" => 'Dados atualizados com sucesso!']);
                } else {
                    http_response_code(400);
                    echo json_encode(["data" => 'Erro ao atualizar dados!']);
                }
            }
            
            //Atualiza caso tenha sido enviado apenas o label
            if (isset($data['label']) && !isset($data['price']) && !isset($data['product_type_id'])) {
                $request = $db->prepare("UPDATE products SET label = :label WHERE id = :id"); 
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
            
            //Atualiza caso tenha sido enviado apenas o price e o product_type_id
            if (isset($data['price']) && isset($data['product_type_id']) && !isset($data['label'])) {
                $request = $db->prepare("UPDATE products SET price = :price, product_type_id = :product_type_id WHERE id = :id"); 
                $request->bindParam(':price', $data['price'], PDO::PARAM_STR);
                $request->bindParam(':product_type_id', $data['product_type_id'], PDO::PARAM_INT);
                $request->bindParam(':id', $param);
                $response = $request->execute();
                
                if ($response) {
                    echo json_encode(["data" => 'Dados atualizados com sucesso!']);
                } else {
                    http_response_code(400);
                    echo json_encode(["data" => 'Erro ao atualizar dados!']);
                }
            }
            
            //Atualiza caso tenha sido enviado apenas o price
            if (isset($data['price']) && !isset($data['label']) && !isset($data['product_type_id'])) {
                $request = $db->prepare("UPDATE products SET price = :price WHERE id = :id"); 
                $request->bindParam(':price', $data['price'], PDO::PARAM_STR);
                $request->bindParam(':id', $param);
                $response = $request->execute();
                
                if ($response) {
                    echo json_encode(["data" => 'Dados atualizados com sucesso!']);
                } else {
                    http_response_code(400);
                    echo json_encode(["data" => 'Erro ao atualizar dados!']);
                }
            }
            
            //Atualiza caso tenha sido enviado apenas o product_type_id
            if (isset($data['product_type_id']) && !isset($data['label']) && !isset($data['price'])) {
                $request = $db->prepare("UPDATE products SET product_type_id = :product_type_id WHERE id = :id"); 
                $request->bindParam(':product_type_id', $data['product_type_id'], PDO::PARAM_INT);
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