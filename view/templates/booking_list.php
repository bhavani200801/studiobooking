<?php require_once 'layouts/header.php'; ?>

<div class="container pt-3">
    <div class="card">
        <div class="card-header">
            Booking List
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="booking_list">
                    <thead class="table-head-bg">
                        <tr>
                            <th scope="col">Sno</th>
                            <th scope="col">Studio Name</th>
                            <th scope="col">Booked By</th>
                            <th scope="col">Email</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Status</th>
                            <th scope="col">Cancelled Reason</th>
                            <th scope="col">Created By</th>
                            <th scope="col">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($booking_details) {
                            foreach ($booking_details as $key => $val) { ?>
                                <tr>
                                    <td><?php echo ++$key; ?></td>
                                    <td><?php echo $val['studio_name']; ?></td>
                                    <td><?php echo $val['booked_by']; ?></td>
                                    <td><?php echo $val['emal_id']; ?></td>
                                    <td><?php echo $val['reason']; ?></td>
                                    <td><?php echo $val['status']; ?></td>
                                    <td><?php echo $val['cancelled_remarks']; ?></td>
                                    <td><?php echo $val['created_by']; ?></td>
                                    <td><?php echo $val['created_date']; ?></td>

                                </tr>
                        <?php  }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'layouts/footer.php'; ?>
<script>
$('#booking_list').DataTable();
</script>