<?php
class HomePage
{
    function __construct($db)
    {
        $this->_connection = $db;
    }

    function getStudios()
    {
        //     $query = "SELECT 
        //     s.studio_id,
        //     s.studio_name,
        //     CASE
        //         WHEN s.is_active = 0 THEN 'Deactivated'
        //         WHEN b.is_cancelled = 0 THEN 'Booked'
        //         WHEN b.is_cancelled = 1 THEN 'Vacant'
        //         ELSE 'Vacant'
        //     END AS status,
        //     CASE
        //         WHEN s.is_active = 0 THEN 'table-danger'
        //         WHEN b.is_cancelled = 0 THEN 'table-success'
        //         WHEN b.is_cancelled = 1 THEN ''
        //         ELSE ''
        //     END AS status_class,
        //     b.booked_by,
        //     b.emal_id,
        //     b.reason
        // FROM
        //     studio s
        // LEFT JOIN
        //     booking b ON s.studio_id = b.studio_id
        // ORDER BY
        //     s.studio_id;
        // ";
        $query = "SELECT 
                    s.studio_id,
                    s.studio_name,
                    CASE
                        WHEN s.is_active = 0 THEN 'Deactivated'
                        WHEN MAX(b.booking_id) IS NOT NULL THEN 'Booked'
                        ELSE 'Vacant'
                    END AS status,
                    CASE
                        WHEN s.is_active = 0 THEN 'table-danger'
                        WHEN MAX(b.booking_id) IS NOT NULL THEN 'table-success'
                        ELSE ''
                    END AS status_class,
                    MAX(b.booked_by) AS booked_by,
                    MAX(b.reason) AS reason
                FROM
                    studio s
                LEFT JOIN
                    booking b ON s.studio_id = b.studio_id AND b.is_cancelled = 0
                GROUP BY
                    s.studio_id, s.studio_name, s.is_active
                ORDER BY
                    s.studio_id;    
                ";

        $result = mysqli_query($this->_connection, $query) or die("Couldn't execute query: " . mysqli_error($this->_connection));

        $studio = array();
        if (mysqli_num_rows($result) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $studio[] = $row;
            }
        }
        return json_encode(['result' => true, 'data' => $studio]);
    }

    function showBooking($data)
    {
        $query = "SELECT 
                    s.studio_id,
                    s.studio_name,
                    CASE
                        WHEN s.is_active = 0 THEN 'Deactivated'
                        WHEN MAX(b.booking_id) IS NOT NULL THEN 'Booked'
                        ELSE 'Vacant'
                    END AS status,
                    CASE
                        WHEN s.is_active = 0 THEN 'table-danger'
                        WHEN MAX(b.booking_id) IS NOT NULL THEN 'table-success'
                        ELSE ''
                    END AS status_class,
                    MAX(b.booking_id) AS booking_id,
                    MAX(b.booked_by) AS booked_by,
                    MAX(b.reason) AS reason,
                    MAX(b.emal_id) AS email
                FROM
                    studio s
                LEFT JOIN
                    booking b ON s.studio_id = b.studio_id AND b.is_cancelled = 0
                WHERE s.studio_id = " . $data['studio_id'] . "
                GROUP BY
                    s.studio_id, s.studio_name, s.is_active; 
                ";

        $result = mysqli_query($this->_connection, $query) or die("Couldn't execute query: " . mysqli_error($this->_connection));

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        }
        return json_encode(['result' => true, 'data' => $row]);
    }

    function cancelBooking($data)
    {
        $query = "UPDATE `studio_booking`.`booking`
        SET
        `is_cancelled` = 1,
        `cancelled_remarks` = '" . $data['cancel_remarks'] . "',
        `updated_by` = '" . $_SESSION['username'] . "',
        `updated_at` =  NOW()
        WHERE `booking_id` ='" . $data['booking_id'] . "';
        ";

        $result = mysqli_query($this->_connection, $query) or die("Couldn't execute query: " . mysqli_error($this->_connection));

        $studiodata = $this->makeBookingTable();

        return json_encode(['result' => true, 'table_data' => $studiodata]);
    }

    function saveBooking($data)
    {
        $query = "INSERT INTO `booking`
        (
            `studio_id`,
            `booked_by`,
            `emal_id`,
            `reason`,
            `created_by`,
            `created_at`
        )
        VALUES
        (
            '" . $data['studio_id'] . "',
            '" . $data['booked_by'] . "',
            '" . $data['emal_id'] . "',
            '" . $data['reason'] . "',
            '" . $_SESSION['username'] . "',
            NOW()
        )";

        $result = mysqli_query($this->_connection, $query) or die("Couldn't execute query: " . mysqli_error($this->_connection));

        $studiodata = $this->makeBookingTable();

        return json_encode(['result' => true, 'table_data' => $studiodata]);
    }

    function makeBookingTable()
    {

        $studios = json_decode($this->getStudios(), true);

        $html = "<table class='table table-bordered'> <tbody>";

        $studiosData = $studios['data']; // Assuming $studios['data'] contains the array of studios

        $counter = 0;
        for ($row = 1; $row <= 5; $row++) {
            $html .= "<tr>";
            for ($col = 1; $col <= 5; $col++) {
                $studio = isset($studiosData[$counter]) ? $studiosData[$counter] : null;
                $studioId = $studio ? $studio['studio_id'] : '';
                $studioName = $studio ? $studio['studio_name'] : '';
                $status = $studio ? strtolower($studio['status']) : 'vacant';
                $status_class = $studio ? $studio['status_class'] : '';
                $statusClass = strtolower($status_class); // Convert status to lowercase for class name

                // Check if studio is booked
                if ($status === 'booked') {
                    $bookedBy = $studio['booked_by'];
                    $reason = $studio['reason'];

                    $html .= "<td id='$studioId' class='$statusClass $status'>
                        <div class='row'>
                            <div class='col'>
                                <span class='fw-bold'>$studioName</span>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col'>
                                <span class='fw-sm'>(" . ucwords($status) . ")</span>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col'>
                                <span class='fw-sm'>Booked By: $bookedBy</span>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col'>
                                <span class='fw-sm'>Reason: $reason</span>
                            </div>
                        </div>
                    </td>";
                } else {
                    $html .= "<td id='$studioId' class='$statusClass $status'>
                        <div class='row'>
                            <div class='col'>
                                <span class='fw-bold'>$studioName</span>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col'>
                                <span class='fw-sm'>(" . ucwords($status) . ")</span>
                            </div>
                        </div>
                    </td>";
                }

                $counter++;
            }
            $html .= "</tr>";
        }

        $html .= "</tbody>
    </table>";

        return json_encode($html);
    }
}
