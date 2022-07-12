<?php 

    require_once "./Class/Interface/interface.php";
    require_once "./Class/Interface/trait.php";

    class Request implements IRequest {
        use httpRequest;

        private $response = [
            "status" => "ok",
            "result" => array()
        ];

        public function success_200($result) {
            $this->response["status"] = "ok";
            $this->response["result"] = $result;
            return $this->response;
        }

        // Error for method not allowed
        public function error_405() {
            $this->response["status"] = "error";
            $this->response["result"] = array(
                "code" => "405",
                "message" => "Method not allowed"
            );
            return $this->response;
        }

        // Error for bad request
        public function error_200($string = "Data incorrect") {
            $this->response["status"] = "error";
            $this->response["result"] = array(
                "code" => "200",
                "message" => $string
            );
            return $this->response;
        }

        // Error for bad request
        public function error_400() {
            $this->response["status"] = "error";
            $this->response["result"] = array(
                "code" => "400",
                "message" => "Bad request"
            );
            return $this->response;
        }

        public function error_401($message = "Unauthorized") {
            $this->response["status"] = "error";
            $this->response["result"] = array(
                "code" => "401",
                "message" => $message
            );
            return $this->response;
        }

        // Error for data not found
        public function error_404() {
            $this->response["status"] = "error";
            $this->response["result"] = array(
                "code" => "404",
                "message" => "Not found"
            );
            return $this->response;
        }

        public function error_500() {
            $this->response["status"] = "error";
            $this->response["result"] = array(
                "code" => "500",
                "message" => "Internal server error"
            );
            return $this->response; 
        }

        public function returnResponseJSON($response) {
            return json_encode($response);
        }

        final public function httpResponseCode($method) {
            if($method == "OPTIONS") {
                exit(0);
            }

            
            echo header("Access-Control-Allow-Origin: *");
            echo header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
            echo header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
            echo header("Access-Control-Allow-Credentials: true");
            echo header("Content-Type: application/json");
        }
    }

?>