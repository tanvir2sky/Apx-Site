<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- If you delete this tag, the sky will fall on your head -->
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Apx</title>
    <link rel="stylesheet" href="http://info-howto.com/apx-admin/uisrc/css/bootstrap.min.css" />
    <link rel="stylesheet" href="http://info-howto.com/apx-admin/uisrc/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="http://info-howto.com/apx-admin/uisrc/css/matrix-style.css" />
    <link rel="stylesheet" href="http://info-howto.com/apx-admin/uisrc/css/matrix-media.css" />
    <style type="text/css">     body{background: #FFFFFF none repeat scroll 0 0;}  </style>
</head>
<body>
<div class="content">
    <h1 align="center">User list</h1>
    <table  class="table table-bordered">
        <thead>
        <tr>
            <th width="5%">Sr. no</th>
            <th>First name</th>
            <th>Last name</th>
            <th>User name</th>
            <th>Email</th>

        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($pdf_data) && !empty($pdf_data)) {
            $count = 1;

            foreach ($pdf_data as $value) {

                ?>
                <tr>
                    <td><?php
                        echo $count++;
                        ?></td>
                    <td><?php
                        echo $value["first_name"];
                        ?></td>
                    <td><?php
                        echo $value['last_name'];
                        ?></td>
                    <td><?php
                        echo $value['user_name'];
                        ?></td>
                    <td><?php
                        echo $value['email'];
                        ?></td>

                </tr>
                <?php
            }

        }
        ?>
        </tbody>
    </table>
</html>