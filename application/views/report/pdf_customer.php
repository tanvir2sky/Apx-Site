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
    <h1 align="center">Customer list</h1>
    <table  class="table table-bordered">
        <thead>
        <tr>

            <th>Sr. no</th>
            <th>Account number</th>
            <th>Account type</th>
            <th>Company name</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Country</th>
            <th>City</th>
            <th>Address line 1</th>
            <th>State</th>

        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($pdf_data) && !empty($pdf_data)) {
            $count = 1;

            foreach ($pdf_data as $value) {

                ?>
                <tr>
                    <td><?php  echo $count++; ?></td>
                    <td><?php  echo $value['accountNumber']; ?></td>
                    <td><?php  echo $value['accountType']; ?></td>
                    <td><?php  echo $value['companyName']; ?></td>
                    <td><?php  echo $value['firstName']; ?></td>
                    <td><?php  echo $value['lastName']; ?></td>
                    <td><?php  echo $value['email']; ?></td>
                    <td><?php  echo $value['phone']; ?></td>
                    <td><?php  echo $value['countryCode']; ?></td>
                    <td><?php  echo $value['city']; ?></td>
                    <td><?php  echo $value['addressLine1']; ?></td>
                    <td><?php  echo $value['state']; ?></td>

                </tr>
                <?php
            }

        }
        ?>
        </tbody>
    </table>
</html>