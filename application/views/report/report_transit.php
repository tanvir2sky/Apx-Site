
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
                        <span class="span1"><input   type="text" placeholder="From date" name="from_date1" id="myDateStart" value="01-01-2015" class="datepicker span12" style="margin:5px;"/></span><span class="span1"><input placeholder="To date" type="text" name="to_date1" size="4" value="01-01-2025" id="myDateEnd" class="datepicker span12" style="margin:5px;"></span>
                        <input type="button" name="dtrange1" id="rangeClick" class="btn btn-default" value="Search" style="margin:5px;">
                        <span class="pull-right"><button id="ship_data_pdf" class="btn btn-primary" style="margin:5px;">Export Pdf</button><button class="btn btn-info" id="ship_data" style="margin:5px;">Export Csv</button></span>
                    </div>
                    <div class="widget-content nopadding">
                        <table  class="table table-bordered data-table-special with-check">
                            <thead>
                            <tr>
                                <th width="3%"><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
                                <th width="3%">Sr.<br/>no
                                <th width="5%">Date</th>
                                <th>Air Way Bill #</th>
                                <th>Account Number</th>
                                <th>Country</th>
                                <th>Receiver Company</th>

                                <th>Balance</th>

                                <th>Csd Status</th>
                                <th>Opr Status</th>
                                <th>Adm Status</th>
                                <th>Act Status</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($users) && !empty($users)){
                                $count=1;
                                foreach ($users as $key => $value) {




                                    ?>
                                    <tr class="gradeX">

                                        <td><input type="checkbox" class="shipids" name="ship_id[]" value="<?php echo $value['ship_id']; ?>"/></td>
                                        <td><?php  echo $count++; ?></td>
                                        <td><?php  echo date('d-m-Y',strtotime($value['date'])); ?></td>
                                        <td><?php  echo $value['air_way_number']; ?></td>
                                        <td><?php  echo $value['accountNumber']; ?></td>
                                        <td><?php  echo $value['country']; ?></td>
                                        <td><?php  echo $value['receiverCompany']; ?></td>

                                        <td><?php  echo $value['shipBalance']; ?></td>
                                        <td><?php  echo $value['csdStatus']; ?></td>
                                        <td><?php  echo $value['oprStatus']; ?></td>
                                        <td><?php  echo $value['admStatus']; ?></td>
                                        <td><?php  echo $value['actStatus']; ?></td>




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