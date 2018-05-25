<?php
session_start();
include_once("config.php");

function get_login_id(){
    $id=-1;
    $connection = get_mysql_connection();
    $sql = "SELECT MAX(id)AS Largestid FROM login";
    
    $result = $connection->query($sql);
   // if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //$row = $result->fetch_assoc();
        if(!empty ($row)){
            $id=$row['Largestid'];
        }
    }
    return $id;

}

function get_mysql_connection() {
    global $db_host, $db_username, $db_password, $db_name, $db_port;
    
	//Creating a new database connection
	$connection = new mysqli($db_host, $db_username, $db_password, $db_name, $db_port);

	//Checking for connection error and throwing error
	if ($connection->connect_error) {
		die('Connect Error ('.$connection->connect_errno.')'.$connection->connect_error);
	}
    
    //Return the connection
    return $connection;
}

function insert_newUser($uname,$pswd,$phone,$id){
    $error=false;
    $connection = get_mysql_connection();
    $statement =  $connection->stmt_init();
            
            //Checking if the query supplied to the prepare statement is valid
            if ($statement->prepare("INSERT INTO register (username, password, phone, id) VALUES (?, ?, ?, ?)")) {
                $statement->bind_param('ssss', $uname, $pswd, $phone, $id);
                $statement->execute();
                if($statement->affected_rows > 0) {
                        $error = false;
                    } else{
                        $error = true;
                    }
            
                    //Free the memory in which the result is stored
                    $statement->free_result();

                    //Closing the prepared statement
                    $statement->close();
            }
             else{
                $error = true;
             }
             $connection->close();
             if($error) {
                 return false;
            } else{
                return true;
            }

}

function insert_new_logger($uname, $pswd){
    $error=false;
    $connection = get_mysql_connection();
    $statement =  $connection->stmt_init();
            
            //Checking if the query supplied to the prepare statement is valid
            if ($statement->prepare("INSERT INTO login (username, password) VALUES (?, ?)")) {
                $statement->bind_param('ss', $uname, $pswd);
                $statement->execute();
                if($statement->affected_rows > 0) {
                        $error = false;
                    } else{
                        $error = true;
                    }
            
                    //Free the memory in which the result is stored
                    $statement->free_result();

                    //Closing the prepared statement
                    $statement->close();
            }
             else{
                $error = true;
             }
             $connection->close(); 
}

function redirect_if_logged_in($redirect_page) {
    if (isset($_SESSION['login_user'])) {
        header("location: $redirect_page");
    }
}

function redirect_if_not_logged_in($redirect_page) {
    if (!isset($_SESSION['login_user'])) {
        header("location: $redirect_page");
    }
}

function set_user_session($uname){
    $_SESSION['login_user'] = $uname;
}

function validate_user($username,$password){
    $error=false;
    $conn = get_mysql_connection();
    $statement =  $conn->stmt_init();
    if ($statement->prepare("SELECT username, password FROM login WHERE username = ? AND password = ?")){
        $statement->bind_param('ss', $username, $password);

        //Execute the query
        $statement->execute();
        $statement->bind_result($uname, $pwd);
        $statement->store_result();
        if($statement->num_rows > 0) {
            if($statement->fetch()){
                //Set session based on username
                set_user_session($uname);
            } else{
                $error = true;
            }
        }else{
           $error=true; 
        }
        $statement->free_result();
        $statement->close();
    } else{
        $error=true;
    }
    $conn->close();
    if($error) {
        return false;
    } else{
        return true;
    }
}

function validate_username($username,$password){
    $error=false;
    $conn = get_mysql_connection();
    $statement =  $conn->stmt_init();
    $statement->prepare("SELECT username, password FROM register WHERE username = ? AND password = ?");
    $statement->bind_param('ss', $username, $password);

        //Execute the query
        $statement->execute();
        $statement->bind_result($uname, $pwd);
        $statement->store_result();
        if($statement->num_rows > 0) {
            $error=true;
        }
        if($error) {
        return false;
    } else{
        return true;
    }
}
?>