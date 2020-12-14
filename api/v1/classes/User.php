<?php

include_once(__DIR__.'/../lib/DB.php');

class User
{
    public function register($params, $body) {
        $username = $body['username'];
        $company = $body['company'];
        $email = $body['email'];
        
        if (!$username || !$company || !$email) {
            return "Parameters are missing. Refer to the documentation.";
        }

        // Checking the email
        $stmt = DB::prepare('SELECT * FROM Users WHERE Email = :email or Company = :company');
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':company', $companu);
        $stmt->execute();
        $row_count = $stmt->rowCount();
        if ($row_count > 0) {
            return "Email or Company already registered";
        }

        // Generating api_key
        $api_key = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
        // Generating the directory name
        $directory_name = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $company)));

        // Insert
        $stmt = DB::prepare("INSERT INTO Users (Username, Company, Email, API_KEY, Directory) VALUES (:username, :company, :email, :api_key, :directory)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':company', $company);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':api_key', $api_key);
        $stmt->bindParam(':directory', $directory_name);
        $stmt->execute();

        // Create directory
        if(!mkdir('../../cloud/'. $directory_name, 0777, true)){
            return 'Failed to create directory.';
        }

        return array('message' => 'Registered.', 'api_key' => $api_key);
    }
}
