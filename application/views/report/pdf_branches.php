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
    <h1 align="center">Brach list</h1>
    <table  class="table table-bordered">
        <thead>
        <tr>
            <th width="5%">Sr. no</th>
            <th>Branch Name</th>
            <th>Manager Name</th>
            <th>Contact No</th>
            <th>Manger con. no.</th>
            <th>Address line 1</th>
            <th>Address line 2</th>
            <th>State</th>
            <th>City</th>
            <th>Zipcode</th>

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
                    <td><?php  echo $value['name']; ?></td>
                    <td><?php  echo $value['manager']; ?></td>
                    <td><?php  echo $value['contactNu1']; ?></td>
                    <td><?php  echo $value['mangerContactNu']; ?></td>
                    <td><?php  echo $value['addressLine1']; ?></td>
                    <td><?php  echo $value['addressLine2']; ?></td>
                    <td><?php  echo $value['state']; ?></td>
                    <td><?php  echo $value['city']; ?></td>
                    <td><?php  echo $value['zipCode']; ?></td>

                </tr>
                <?php
            }

        }
        ?>
        </tbody>
    </table>
</html>