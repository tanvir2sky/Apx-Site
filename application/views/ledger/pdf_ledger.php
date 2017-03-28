<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head>  <!-- If you delete this tag, the sky will fall on your head -->  <meta name="viewport" content="width=device-width" />  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />  <title>Apx admi</title>  <link rel="stylesheet" href="http://info-howto.com/apx-admin/uisrc/css/bootstrap.min.css" />  <link rel="stylesheet" href="http://info-howto.com/apx-admin/uisrc/css/bootstrap-responsive.min.css" />  <link rel="stylesheet" href="http://info-howto.com/apx-admin/uisrc/css/matrix-style.css" />  <link rel="stylesheet" href="http://info-howto.com/apx-admin/uisrc/css/matrix-media.css" />  <style type="text/css">     body{background: #FFFFFF none repeat scroll 0 0;}  </style></head><body><div class="content"><h1 align="center">Ledger</h1>  <table  class="table table-bordered">              <thead>                <tr>                  <th width="5%">Sr. no</th>                  <th>Date</th>                  <th>Awb Number</th>                  <th>Acc Num</th>                  <th>Payment Type</th>                  <th>Description</th>                  <th>Country</th>                  <th>Service</th>                  <th>Ship. Type</th>                  <th>Weight</th>                  <th>Pcs</th>                  <th>Debit</th>                  <th>Credit</th>                  <th>Balance</th>                </tr>              </thead>              <tbody>              <?php
        if (isset($pdf_data) && !empty($pdf_data)) {
            $count = 1;
            $blnc  = 0;
            foreach ($pdf_data as $value) {
                $blnc = +($blnc + 0 - $value['shipBalance']);
                ?>              <tr>                <td><?php
                        echo $count++;
                        ?></td>                <td><?php
                        echo date('d-m-Y', strtotime($value['date']));
                        ?></td>                <td><?php
                        echo $value['air_way_number'];
                        ?></td>                <td><?php
                        echo $value['accountNumber'];
                        ?></td>                <td><?php
                        echo '--';
                        ?></td>                <td><?php
                        echo '--';
                        ?></td>                <td><?php
                        echo convert_val('country', $value['receiverCountry']);
                        ?></td>                <td><?php
                        echo $value['listName'];
                        ?></td>                <td><?php
                        echo $value['shipType'];
                        ?></td>                <td><?php
                        echo $value['shipWeight'] . ' kg';
                        ?></td>                <td><?php
                        echo $value['shipPcs'];
                        ?></td>                <td><?php
                        echo $value['shipBalance'];
                        ?></td>                <td><?php
                        echo 0;
                        ?></td>                <td><?php
                        echo $blnc;
                        ?></td>                </tr>              <?php
            }
            echo '<tr class="alert-info"><td colspan="12">&nbsp;</td><td>Total balance</td><td>' . $blnc . '</td></tr>';
        }
        ?>              </tbody>            </table>  </div>
</body></html>