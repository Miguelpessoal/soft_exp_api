<?php
    class RequestContent
    {
        public static function handle()
        {
            if($_POST && !empty($_POST)) {
                return $_POST;
            }
            
            $content = file_get_contents('php://input');
            $content = json_decode($content, true);
            return $content;
        }
    }