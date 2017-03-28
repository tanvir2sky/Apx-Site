
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo base_url(); ?>dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="javascript:void(0)" class="current"><?php if(isset($breadcromb)){echo $breadcromb;} ?></a> </div>
        <h1><?php if(isset($header)){echo $header;} ?></h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5><?php if(isset($title)){echo $title;} ?></h5>
                        <span class="pull-right"><a href="<?php echo base_url(); ?>add-customer"><button class="btn btn-primary" style="margin:5px;">Add New</button></a></span>
                    </div>
                    <div class="widget-content nopadding">
                        <table  class="table table-bordered data-table with-check">
                            <thead>
                            <tr>
                                <th width="3%">Sr.<br/>no
                                <th width="5%">Date</th>
                                <th width="5%">Tracking no</th>
                                <th width="5%">DHL no</th>
                                <th>Air Way Bill #</th>
                                <th>Account Number</th>
                                <th>Country</th>
                                <th>Invoice Weight</th>
                                <th>Shipment Weight</th>
                                <th width="12%">Invoice PCS</th>
                                <th width="12%">Shipment PCS</th>
                                <th>Freight</th>
                                <th>Sales tax</th>
                                <th>Total Freight</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($differ) && !empty($differ)){
                                $count=1;
                                foreach ($differ as $key => $value) {


                                    ?>
                                    <tr class="gradeX">

                                        <td><?php  echo $count++; ?></td>
                                        <td><?php  echo $value['date']; ?></td>
                                        <td><?php  echo $value['tracking_number']; ?></td>
                                        <td><?php  echo $value['dhl_no']; ?></td>


                                        <td><?php  echo $value['air_way_number']; ?></td>
                                        <td><?php  echo $value['accountNumber']; ?></td>
                                        <td><?php  echo $value['country']; ?></td>

                                        <td><?php  echo $value['weight']; ?></td>
                                        <td><?php  echo $value['shipWeight']; ?></td>
                                        <td><?php  echo $value['pcs']; ?></td>
                                        <td><?php  echo $value['shipPcs']; ?></td>
                                        <td><?php  echo $value['freight']; ?></td>
                                        <td><?php  echo $value['sales_tax']; ?></td>
                                        <td><?php  echo $value['total_fright']; ?></td>

                                    </tr>
                                <?php }}?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end-main-container-part-->