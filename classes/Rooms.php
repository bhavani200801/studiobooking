<?php
class Room
{
    function __construct($db)
    {
        $this->_connection = $db;
    }

    public function getRoomlist()
    {
        $query = "SELECT studio_name,studio_id,is_active FROM studio ";
        $result = mysqli_query($this->_connection, $query) or die("Couldnot execute the query. " . mysqli_error($this->_connection));
        if (mysqli_num_rows($result) > 0) {
            while ($row1 = mysqli_fetch_assoc($result)) {
                $row[] = $row1;
            }
        }
        return $row;
    }

    public function StatusUpdate($data)
    { 
        mysqli_report(MYSQLI_REPORT_ERROR  | MYSQLI_REPORT_STRICT);

        try {
            mysqli_autocommit($this->_connection, false);
            $updateStatus = " UPDATE studio SET is_active='" . $data['status'] . "' WHERE studio_id='" . $data['id'] . "' ";
            mysqli_query($this->_connection, $updateStatus);
            mysqli_commit($this->_connection);
            mysqli_autocommit($this->_connection, true);
            return 1;
        } catch (Exception $e) {
            mysqli_rollback($this->_connection);
            mysqli_autocommit($this->_connection, true);
            return 'Not saved!, Please try again.';
        }
    }

    public function getBookingList(){
        $query = "SELECT studio_name,booked_by,emal_id,reason,(CASE WHEN is_cancelled = 1 THEN 'Cancelled' ELSE 'Booked' END) as status,bk.created_by,DATE_FORMAT(bk.created_at ,'%d-%m-%Y') AS created_date,cancelled_remarks FROM booking bk
        LEFT JOIN studio as st ON st.studio_id = bk.studio_id
        ORDER BY bk.created_at desc";
        $result = mysqli_query($this->_connection, $query) or die("Couldnot execute the query. " . mysqli_error($this->_connection));
        if (mysqli_num_rows($result) > 0) {
            while ($row1 = mysqli_fetch_assoc($result)) {
                $row[] = $row1;
            }
        }
        return $row;
    }
}
