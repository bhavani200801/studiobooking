<?php require_once 'layouts/header.php'; ?>
<style>
    .vacant {
        background-color: white;
    }

    .booked {
        background-color: green;
    }

    .deactivated {
        background-color: red;
    }

    table {
        border-collapse: collapse;
    }

    th,
    td {
        height: 15vh;
        width: 15vh;
        text-align: center;
    }
</style>
<div class="container pt-3">
    <div class="card">
        <div class="card-header">
            Studio Booking
        </div>
        <div class="card-body" id="booking-card">
            <table class="table table-bordered">
                <tbody>
                    <?php
                    $studiosData = $studios['data']; // Assuming $studios['data'] contains the array of studios

                    $counter = 0;
                    for ($row = 1; $row <= 5; $row++) {
                        echo "<tr>";
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

                                echo "<td id='$studioId' class='$statusClass $status'>
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
                                echo "<td id='$studioId' class='$statusClass $status'>
                                <div class='row'>
                                    <div class='col'>
                                        <span class='fw-bold'>$studioName</span>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col'>
                                        <span class='fw-sm'>($status)</span>
                                    </div>
                                </div>
                            </td>";
                            }

                            $counter++;
                        }
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="bookingPopup" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="bookingPopupLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Book Studio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bookingForm" action="booking_process" method="post">
                    <input type="hidden" id="selectedStudioId" name="studioId" value="">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason:</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Book</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editBookingPopup" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="editBookingPopupLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editBookingForm" action="edit_booking_process" method="post">
                    <input type="hidden" id="selectedBookingId" name="studioId" value="">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason:</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required readonly></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">Cancel Booking</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // To Fix Sweetalert2 input focus while bootstrap modal is open
        $.fn.modal.Constructor.prototype._initializeFocusTrap = function () { return { activate: function () { }, deactivate: function () { } } };

        var popup = new bootstrap.Modal(document.getElementById("bookingPopup"));
        var edit_popup = new bootstrap.Modal(document.getElementById("editBookingPopup"));

        $(document).on('click', "td.vacant", function() {
            var studioId = $(this).attr("id");
            $("#bookingForm #selectedStudioId").val(studioId);
            popup.show();
        });

        $(document).on('click', "td.booked", function(e) {
            e.preventDefault();
            var data = {
                studio_id: $(this).attr("id")
            }
            $.ajax({
                type: "POST",
                url: "show_booking",
                data: data,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.result) {
                        var booking_data = response.data;
                        $("#editBookingForm #selectedBookingId").val(booking_data.booking_id);
                        $("#editBookingForm #name").val(booking_data.booked_by);
                        $("#editBookingForm #email").val(booking_data.email);
                        $("#editBookingForm #reason").val(booking_data.reason);
                        edit_popup.show();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        })
                    }
                }
            });
        });

        $("#bookingForm").submit(function(e) {
            e.preventDefault();
            var data = {
                studio_id: $("#bookingForm #selectedStudioId").val(),
                booked_by: $("#name").val(),
                emal_id: $("#email").val(),
                reason: $("#reason").val(),
            }
            $.ajax({
                type: "POST",
                url: "booking_process",
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response.result) {
                        var table_data = JSON.parse(response.table_data)
                        $("#booking-card").html(table_data);
                        $('#bookingForm').trigger("reset");
                        popup.hide();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        })
                    }
                }
            });
        });

        $("#editBookingForm").submit(function(e) {
            e.preventDefault();
            var data = '';

            Swal.fire({
                text: 'Are you sure you want to cancel?',
                icon: 'warning',
                input: 'text',
                inputValue: "",
                inputPlaceholder: "Enter Cancel Remarks",
                showCancelButton: true,
                confirmButtonText: 'Yes, Cancel!',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Please enter cancel remarks to proceed.'
                    }
                    data = {
                        booking_id: $("#editBookingForm #selectedBookingId").val(),
                        cancel_remarks: value,
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "cancel_booking",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            if (response.result) {
                                var table_data = JSON.parse(response.table_data)
                                $("#booking-card").html(table_data);
                                $('#editBookingForm').trigger("reset");
                                edit_popup.hide();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message,
                                })
                            }
                        }
                    });
                }
            });
        });
    });
</script>

<?php require_once 'layouts/footer.php'; ?>