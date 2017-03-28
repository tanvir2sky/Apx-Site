<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- If you delete this tag, the sky will fall on your head -->
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Tanvir</title>
    <link type="text/css" rel="stylesheet" href="http://info-howto.com/apx-admin/uisrc/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="http://info-howto.com/apx-admin/uisrc/css/bootstrap-responsive.min.css" />
    <link type="text/css" rel="stylesheet" href="http://info-howto.com/apx-admin/uisrc/css/matrix-style.css" />
    <link type="text/css" rel="stylesheet" href="http://info-howto.com/apx-admin/uisrc/css/matrix-media.css" />
    <style type="text/css">     body{background: #FFFFFF none repeat scroll 0 0;}  </style>
</head>
<body>
<div class="content">
    <h1 align="center">SHIPMENT DETAILS</h1>
    <table  class="table table-bordered" width = 100%>
        <thead>
        <tr>
            <th>Awb No.</th>
            <th>Tracking no.</th>
            <th>Acc no</th>
            <th>Country</th>
            <th>Price list srv.</th>
            <th>Ship Type</th>
            <th>Pc's</th>
            <th>Total Paid</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>

        <?php
            foreach ($pdf as $key=>$value):
        ?>
                <?php $count =0;$count++; ?>
    <tr>


        <td>
            <?php echo $value["air_way_number"];  ?>

        </td>
        <td>
            <?php  echo $value["tracking_number"]; ?>

        </td>

        <td>
            <?php echo $value["accountNumber"]; ?>

        </td>

        <td>
            <?php echo $value["country"]; ?>

        </td>
        <td>
            <?php echo $value["priceList"]; ?>

        </td>

        <td>
            <?php echo $value["shipPcs"]; ?>

        </td>
        <td>
            <?php echo $value["shipPcs"]; ?>

        </td>
        <td>
            <?php echo $value["shipPaid"]; ?>

        </td>
        <td>
            <?php echo $value["status"]; ?>

        </td>


    </tr>
        <?php endforeach;; ?>

        </tbody>
    </table>
    </div>
    </body>
</html>