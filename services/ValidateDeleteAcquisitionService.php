<?php 
    class ValidateDeleteAcquisitionService 
    {
        public static function handle($param)
        {
            $db = DB::connect();
        
            $findAcquisition = $db->prepare("SELECT * FROM acquisitions WHERE id = :id");
            $findAcquisition->bindParam(':id', $param);
            $findAcquisition->execute();
            $existsAcquisition = $findAcquisition->fetchObject();
            
            if (!$existsAcquisition) {
                http_response_code(404);
                echo json_encode(["data" => 'Rota não encontrada!']);
                exit;
            }
        }
    }