<?php require_once 'layouts/header.php'; ?>

<div class="container pt-3">
    <div class="card">
        <div class="card-header">
            Studio List
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="studios_table">
                    <thead class="table-head-bg">
                        <tr>
                            <th scope="col">Sno</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rooms as $key => $val) { ?>
                            <tr>
                                <td><?php echo ++$key; ?></td>
                                <td><?php echo $val['studio_name']; ?></td>
                                <td><?php echo $val['is_active'] == '1' ? 'Active' : 'Inactive'; ?></td>
                                <td><button name="change_status" class="btn btn-<?php echo  $val['is_active'] == '1' ? 'danger' : 'success'; ?>" data-status="<?php echo  $val['is_active'] == '1' ? '0' : '1'; ?>" value="<?php echo $val['studio_id'] ?>">
                                        <?php
                                        echo  $val['is_active'] == '1' ? 'Deactive' : 'Activate';
                                        ?>
                                    </button></td>
                            </tr>
                        <?php   } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'layouts/footer.php'; ?>

<script>
    $('#studios_table').DataTable();
    $('[name="change_status"]').click(function() {
        var status = $(this).data('status');
        var status_text = $(this).html().trim();
        var id = this.value;

        var postdata = {
            "id": id,
            "status": status,
        };
        console.log(postdata)
        Swal.fire({
            title: 'Are you sure?',
            text: `Do you want to ${status_text} this studio?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    data: {
                        "data": postdata
                    },
                    url: 'StatusUpdate',
                    success: function(resdata) {
                        if (resdata.trim() == 1) {
                            Swal.fire({
                                html: 'Status changed successfully.'
                            }).then(function() {
                                location.reload();
                            });
                        }
                    }
                });
            }
        })
    })
</script>