<?php

include_once(__DIR__.'/../lib/DB.php');

class File
{
    public function upload($params, $body, $post, $files) {
        $api_key = $post['api_key'];
        
        $stmt = DB::prepare('SELECT Directory FROM Users WHERE API_KEY = :api_key');
        $stmt->bindParam(':api_key', $api_key);
        $stmt->execute();
        $res = $stmt->fetch();

        $row_count = $stmt->rowCount();
        if ($row_count == 0) {
            return "Invalid API key.";
        }

        foreach ($files as $file) {
            move_uploaded_file($file['tmp_name'], '../../cloud/'.$res->Directory.'/'.$file['name']);
        }

        return 'Saved files.';

    }
}