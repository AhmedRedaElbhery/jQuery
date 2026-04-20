<?php

require_once("migration.php");
require_once("select.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mian page</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>



</head>

<body>

    <div class="container">
        <h1 align="center" class="mt-5 mb-3">Multible lines</h1>

        <form method="post" id="insert_form">

            <table id="insert_table" class="table">
                <thead>
                    <th>Item Name</th>
                    <th>Item code</th>
                    <th>Item price</th>
                    <th>Description</th>
                    <th>Actions</th>
                </thead>

                <tbody id="insert_fields">

                </tbody>
            </table>

            <div class="d-flex justify-content-end ">
                <button type="button" class="btn btn-success add">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>


            <div class="d-flex justify-content-center">
                <button type="submit" id="save" class="btn btn-primary">
                    Save
                </button>
            </div>

        </form>





        <h1 align="center" class="mt-5 mb-3">Items Data</h1>

        <table id="data_table" class="table">
            <thead>
                <th>Item Name</th>
                <th>Item code</th>
                <th>Item price</th>
                <th>Description</th>
            </thead>

            <tbody>
                <?php foreach($_SESSION['items'] as $row): ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['code'] ?></td>
                    <td><?= $row['price'] ?></td>
                    <td><?= $row['description'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>


        </table>

    </div>

    <script>
    $(document).ready(function() {

        $('.add').on('click', function() {

            $("#insert_fields").append(
                '<tr>\
                    <td><input type="text" name="name[]"></td>\
                    <td><input type="text" name="code[]"></td>\
                    <td><input type="text" name="price[]"></td>\
                    <td><input type="text" name="description[]"></td>\
                    <td>\
                        <button class="btn btn-danger delete">\
                            <i class="fa-solid fa-minus"></i>\
                        </button>\
                    </td>\
                </tr>'
            );

        });

        $(document).on('click', ".delete", function() {
            $(this).parent().parent().remove();
        });


        $('#insert_form').on('submit', function(e) {
            e.preventDefault();

            var form_data = $(this).serialize();

            $.ajax({
                url: "insert.php",
                method: "POST",
                data: form_data,
                success: function(response) {
                    location.reload();
                }

            });

        });

    });
    </script>

</body>

</html>