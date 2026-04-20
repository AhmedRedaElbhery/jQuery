<?php

$conn = new PDO("mysql:host=localhost;dbname=units","root","");

function fill_unit_select_box($conn){
    $output = '';
    $query = "SELECT * FROM tbl_unit";
    $statment = $conn->prepare($query);
    $statment->execute();
    $result = $statment->fetchAll();

    foreach($result as $row){
        $output .= '<option value="'.$row["unit_name"].'">'.$row["unit_name"].'</option>';
    }
    return $output;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <h3 align="center">Add Remove Select Box Fields Dynamiclly</h3>
        <br />
        <h4 align="center">Enter Item Details </h4>
        <br />

        <form method="post" id="insert_form">
            <span id="error_message"></span>
            <div>
                <table class="table table-borderd" id="item_table">

                    <tr>
                        <th>Enter Item name</th>
                        <th>Enter QUantity</th>
                        <th>Select Unit</th>
                        <th><button type="button" name="add" class="btn btn-success btn-sm add"><i
                                    class="fa-solid fa-plus"></i></button></th>
                    </tr>

                </table>
                <br />
                <div align="center">

                    <input type="submit" name="submit" class="btn btn-info" value="insert" />


                </div>
            </div>
        </form>
    </div>

    <script>
    $(document).ready(function() {

        $(document).on("click", ".add", function() {

            var html = '';

            html += '<tr>';
            html += '<td><input type="text" name="item_name[]" class="form-control item_name" /></td>';
            html +=
                '<td><input type="text" name="item_quantity[]" class="form-control item_quantity" /></td>';

            html +=
                '<td><select name="item_unit[]" class="form-control item_unit"> <option value="">Select Unit </option><?php echo fill_unit_select_box($conn);?></select></td>';
            html +=
                '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fa-solid fa-minus"></i></button></td></tr>';
            $('#item_table').append(html);
        });

        $(document).on("click", ".remove", function() {

            $(this).parent().parent().remove();

        });

        $("#insert_form").on("submit", function(event) {

            event.preventDefault();

            var error = '';

            $('.item_name').each(function(index) {
                var count = index + 1;
                if ($(this).val() === '') {
                    error += "<p>Enter item name at " + count + " row</p>";
                    return false;
                }
            });

            $('.item_quantity').each(function(index) {
                var count = index + 1;
                if ($(this).val() === '') {
                    error += "<p>Enter item quantity at " + count + " row</p>";
                    return false;
                }
            });

            $('.item_unit').each(function(index) {
                var count = index + 1;
                if ($(this).val() === '') {
                    error += "<p>Select item unit at " + count + " row</p>";
                    return false;
                }
            });

            var form_data = $(this).serialize();

            if (error === '') {

                $.ajax({
                    url: "insert.php",
                    method: "POST",
                    data: form_data,
                    success: function(data) {

                        if (data == 'OK') {
                            $('#item_table').find("tr:gt(0)").remove();
                            $('#error_message').html(
                                '<div class="alert alert-success">Item Details Saved</div>'
                            );
                        }
                    }
                });

            } else {

                $('#error_message').html(
                    '<div class="alert alert-danger">' + error + '</div>'
                );
            }

        });
    });
    </script>

</body>

</html>