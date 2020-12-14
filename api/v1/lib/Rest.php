<?php

class Rest
{
    public static function open($request)
    {
        $url = explode('/', $request['url']);

        $class = ucfirst($url[0]);
        array_shift($url);

        $method = $url[0];
        array_shift($url);

        $params = array();
        $params = $url;

        try {
            if (class_exists($class)) {
                if (method_exists($class, $method)) {
                    $res = call_user_func_array(array(new $class, $method), $params);
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