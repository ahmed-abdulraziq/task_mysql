<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manage Employees</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Employees</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
                                    class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
                            <a href="#deleteEmployeeModal" onclick="Delete()" class="btn btn-danger"
                                data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rs_result as $employee):
                            ?>
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" name="options[]" value="<?= $employee['Employee_id'] ?>">
                                        <label></label>
                                    </span>
                                </td>
                                <td>
                                    <?= $employee['Employee_name'] ?>
                                </td>
                                <td>
                                    <?= $employee['Employee_email'] ?>
                                </td>
                                <td>
                                    <?= $employee['Employee_address'] ?>
                                </td>
                                <td>
                                    <?= $employee['Employee_phone'] ?>
                                </td>
                                <td style="display: flex;">
                                    <a href="#" data-target="#editEmployeeModal" class="edit"
                                        onclick="Edit('<?= $employee['Employee_id'] ?>', '<?= $employee['Employee_name'] ?>', '<?= $employee['Employee_email'] ?>', '<?= $employee['Employee_address'] ?>', '<?= $employee['Employee_phone'] ?>')"
                                        data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
                                            title="Edit">&#xE254;</i></a>
                                    <a href="#" data-target="#deleteEmployeeModal" class="delete"
                                        onclick="Delete(<?= $employee['Employee_id'] ?>)" data-toggle="modal"><i
                                            class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                        <script src="script/main.js"></script>
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <b>
                            <?= $per_page_record ?>
                        </b> out of <b>
                            <?= $total_records ?>
                        </b> entries</div>
                    <ul class="pagination">
                        <li class="page-item <?= $page >= 2 ? '' : 'disabled' ?>"><a <?= $page >= 2 ? ("href='?page=" . ($page - 1)) . "'" : '' ?>>Previous</a></li>
                        <?php
                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo "<li class='page-item " . ($i == $page ? 'active' : '') . "'><a href='?page=$i' class='page-link'>$i</a></li>";
                        }
                        ?>
                        <li class="page-item <?= $page < $total_pages ? '' : 'disabled' ?>"><a <?= ($page < $total_pages) ? ("href='?page=" . ($page + 1) . "'") : '' ?>>Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" name="address" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" name="submit" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input id="editId" name="id" type="hidden">
                        <div class="form-group">
                            <label>Name</label>
                            <input id="editName" type="text" class="form-control" name="name" value="" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input id="editEmail" type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea id="editAddress" class="form-control" name="address" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input id="editPhone" type="text" class="form-control" name="phone" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" name="submit" value="Edit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input id="deleteId" type="hidden" name="id">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" name="submit" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>