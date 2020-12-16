<?php

class Rest
{
    public static function open($request)
    {
        if (!$request['url']) {
            return json_encode(array('status' => 'success', 'data' => 'API documentation: https://github.com/RaolootneXII/trasle-cloud/blob/main/README.md'));
        }

        $url = explode('/', $request['url']);

        $class = ucfirst($url[0]);
        array_shift($url);

        $method = $url[0];
        array_shift($url);

        $params = array();
        $params = $url;

        $body = json_decode(file_get_contents('php://input'), true);
        
        $post = $_POST;
        $files = $_FILES;
        
        try {
            if (class_exists($class)) {
                if (method_exists($class, $method)) {
                    $res = call_user_func_array(array(new $class, $method), array($params, $body, $post, $files));
                    return json_encode(array('status' => 'success', 'data' => $res));
                } else {
                    return json_encode(array('status' => 'erro', 'data' => 'This method does not exist'));
                }
            } else {
                return json_encode(array('status' => 'erro', 'data' => 'This class does not exist'));
            }
        } catch (Exception $e) {
            return json_encode(array('status' => 'erro', 'data' => $e->getMessage()));
        }
    }
}