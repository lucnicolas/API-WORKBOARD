<?php

    //getting database connection
    require_once 'DbConnect.php';

    //array to show the response
    $response = array();

    //uploads directory, we will upload all the files inside this folder
    $target_dir = "uploads/";

    //checking if we are having an api call, using the get parameters 'apicall'
        if(isset($_GET['apicall'])){

        switch($_GET['apicall']){

            //if the api call is for uploading the image
            case 'uploadboard':
                //error message and error flag
                $message = 'Params ';
                $is_error = false;

                //validating the request to check if all the required parameters are available or not
                if(!isset($_POST['name'])){
                    $message .= "name, ";
                    $is_error = true;
                }

                if(!isset($_POST['localisation'])){
                    $message .= "localisation, ";
                    $is_error = true;
                }

                if(!isset($_POST['address'])){
                    $message .= "address, ";
                    $is_error = true;
                }

                if(!isset($_POST['status'])){
                    $message .= "status, ";
                    $is_error = true;
                }

                if(!isset($_POST['syncState'])){
                    $message .= "syncState, ";
                    $is_error = true;
                }

                if(!isset($_POST['lastUpdateDate'])){
                    $message .= "lastUpdateDate ";
                    $is_error = true;
                }

                if(!isset($_POST['lot'])){
                    $message .= "lot ";
                    $is_error = true;
                }

                if(!isset($_FILES['image']['name'])){
                    $message .= "image ";
                    $is_error = true;
                }

                //in case we have an error in validation, displaying the error message
                if($is_error){
                    $response['error'] = true;
                    $response['message'] = $message . "required.";
                }else{
                    //if validation succeeds
                    //creating a target file with a unique name, so that for every upload we create a unique file in our server
                    $target_file = $target_dir . uniqid() . '.'.pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

                    //saving the uploaded file to the uploads directory in our target file
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                        //saving the file information to our database
                        $stmt = $pdo->prepare("INSERT INTO boards (`path`, `name`, `localisation`, `address`, `status`, `is_sync`, `last_update_date`) VALUES (:path, :name, :localisation, :address, :status, :is_sync, :last_update_date)");

                        //if it is saved in database successfully
                        if($stmt->execute(['path' => $target_file, 'name' => $_POST['name'], 'localisation' => $_POST['localisation'], 'address' => $_POST['address'], 'status' => $_POST['status'], 'is_sync' => $_POST['syncState'], 'last_update_date' => $_POST['lastUpdateDate']])){

                            //displaying success response
                            $response['error'] = false;
                            $response['message'] = 'Image Uploaded Successfully';
                            $response['image'] = getBaseURL() . $target_file;
                        }else{
                            //if not saved in database
                            //showing response accordingly
                            $response['error'] = true;
                            $response['message'] = 'Could not upload image, try again...';
                        }
                    } else {
                        $response['error'] = true;
                        $response['message'] = 'Try again later...';
                    }
                }
                break;
            //if the api call is for uploading the image
            case 'uploadcompany':
                //error message and error flag
                $message = 'Params ';
                $is_error = false;

                //validating the request to check if all the required parameters are available or not
                if(!isset($_POST['name'])){
                    $message .= "name, ";
                    $is_error = true;
                }

                if(!isset($_POST['address'])){
                    $message .= "address, ";
                    $is_error = true;
                }

                if(!isset($_POST['phoneNumber'])){
                    $message .= "phoneNumber, ";
                    $is_error = true;
                }

                if(!isset($_POST['faxNumber'])){
                    $message .= "faxNumber, ";
                    $is_error = true;
                }

                if(!isset($_POST['email'])){
                    $message .= "email, ";
                    $is_error = true;
                }

                if(!isset($_POST['syncState'])){
                    $message .= "syncState, ";
                    $is_error = true;
                }

                if(!isset($_POST['lastUpdateDate'])){
                    $message .= "lastUpdateDate ";
                    $is_error = true;
                }

                //in case we have an error in validation, displaying the error message
                if($is_error){
                    $response['error'] = true;
                    $response['message'] = $message . "required.";
                }else{
                    //saving the file information to our database
                    $stmt = $pdo->prepare("INSERT INTO companies (`name`, `address`, `phoneNumber`, `faxNumber`, `email`, `is_sync`, `last_update_date`, `lot`) VALUES (:name, :address, :phoneNumber, :faxNumber, :email, :is_sync, :last_update_date, :lot)");

                    //if it is saved in database successfully
                    if($stmt->execute(['name' => $_POST['name'], 'address' => $_POST['address'], 'phoneNumber' => $_POST['phoneNumber'], 'faxNumber' => $_POST['faxNumber'], 'email' => $_POST['email'], 'is_sync' => $_POST['syncState'], 'last_update_date' => $_POST['lastUpdateDate'], 'lot' => $_POST['lot']])){

                        //displaying success response
                        $response['error'] = false;
                        $response['message'] = 'Data Uploaded Successfully';
                    }else{
                        //if not saved in database
                        //showing response accordingly
                        $response['error'] = true;
                        $response['message'] = 'Could not save data, try again...';
                    }
                }
                break;
            //we will use this case to get all the uploaded images from the database
            case 'images':
                $stmtBoards = $pdo->query("SELECT * FROM boards");
                $stmtCompanies = $pdo->query("SELECT * FROM companies");

                foreach ($stmtBoards as $row)
                {
                    $image = array();
                    $image['board']['id'] = $row['id'];
                    $image['board']['sync_at'] = $row['sync_at'];
                    $image['board']['path'] = getBaseURL() . $row['path'];
                    $image['board']['name'] = $row['name'];
                    $image['board']['localisation'] = $row['localisation'];
                    $image['board']['address'] = $row['address'];
                    $image['board']['status'] = $row['status'];
                    $image['board']['is_sync'] = $row['is_sync'];
                    $image['board']['last_update_date'] = $row['last_update_date'];

                    array_push($response, $image);

                }

                foreach ($stmtCompanies as $row)
                {
                    $image = array();
                    $image['company']['id'] = $row['id'];
                    $image['company']['sync_at'] = $row['sync_at'];
                    $image['company']['name'] = $row['name'];
                    $image['company']['address'] = $row['name'];
                    $image['company']['phone_number'] = $row['name'];
                    $image['company']['fax_number'] = $row['name'];
                    $image['company']['email'] = $row['name'];
                    $image['company']['is_sync'] = $row['is_sync'];
                    $image['company']['last_update_date'] = $row['last_update_date'];
                    $image['company']['lot'] = $row['lot'];

                    array_push($response, $image);

                }

                break;

            default:
                $response['error'] = true;
                $response['message'] = 'Invalid Operation Called';
        }

    }else{
        $response['error'] = true;
        $response['message'] = 'Invalid API Call';
    }

    function getBaseURL(){
        $url  = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $url .= $_SERVER['SERVER_NAME'];
        $url .= ($_SERVER['SERVER_PORT'] != 80) ? ':' . $_SERVER['SERVER_PORT'] : '';
        $url .= $_SERVER['REQUEST_URI'];
        return dirname($url) . '/';
    }


    header('Content-Type: application/json');
    echo json_encode($response);