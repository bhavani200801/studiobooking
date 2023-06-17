<?php
class UserLogin
{
    function __construct($db)
    {
        $this->_connection = $db;
    }

    public function loginCheck($data)
    {
        if (empty($data['username'])) {
            return "Please enter username";
        }
        if (empty($data['password'])) {
            return "Please enter password";
        }

        $query = "SELECT * FROM users WHERE username='" . $data['username'] . "'";

        $result = mysqli_query($this->_connection, $query) or die("Couldn't execute query: " .  mysqli_error($this->_connection));
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            if ($row['password'] == MD5($data['password'])) {
                if ($row['is_active'] == 1) {
                    $_SESSION['userid'] = $row['userid'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['start'] = time();
                    $_SESSION['expire'] = SESSION_EXPIRY;

                    $query = "UPDATE userhistory SET loggedouttime = NOW() WHERE (userid = '" . $row['userid'] . "' and  loggedouttime IS NULL);";
                    $result = mysqli_query($this->_connection, $query) or die("Couldnot execute the query. " . mysqli_error($this->_connection));
                    $query = "INSERT INTO userhistory (userid,loggedintime,sessionid) VALUES ('" . $row['userid'] . "', NOW(), '" . session_id() . "' )";
                    $result = mysqli_query($this->_connection, $query) or die("Couldnot execute the query. " . mysqli_error($this->_connection));
                } else {
                    return "User Inactive.";
                }
            } else {
                return "Invalid Password.";
            }
        } else {
            return "Invalid User.";
        }
    }

    public function CheckUserLogin()
    {
        $query = "SELECT userhistoryid FROM userhistory WHERE sessionid ='" . session_id() . "' AND loggedouttime IS NULL AND userid = '" . $_SESSION['userid'] . "' ";
        $result = mysqli_query($this->_connection, $query) or die("Couldnot execute the query. " . mysqli_error($this->_connection));
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    function checkLogout($userid)
    {
        $query = "UPDATE userhistory set loggedouttime = now() where userid = '" . $userid . "' and loggedouttime IS NULL ";
        $result = mysqli_query($this->_connection, $query) or die("Couldnot execute the query. " . mysqli_error($this->_connection));
    }
}
