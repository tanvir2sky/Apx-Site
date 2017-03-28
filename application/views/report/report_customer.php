
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
                        <span class="pull-right"><button id="customer_export_pdf" class="btn btn-primary" style="margin:5px;">Export Pdf</button><button class="btn btn-info" id="customer_export_csv" style="margin:5px;">Export Csv</button></span>
                    </div>
                    <div class="widget-content nopadding">
                        <table  class="table table-bordered data-table with-check">
                            <thead>
                            <tr>
                                <th width="3%" class="ui-state-default" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 24.8889px;"><div class="DataTables_sort_wrapper"><div class="checker" id="uniform-title-table-checkbox"><span class=""><div class="checker" id="uniform-title-table-checkbox"><span class=""><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" style="opacity: 0;"></span></div></span></div><span class="DataTables_sort_icon"></span></div></th>
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
                                <th>Status</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($users) && !empty($users)){
                                $count=1;
                                foreach ($users as $key => $value) {
                                    switch ($value["status"]){
                                        case -1:
                                            $status = 'Inactive';
                                            $statusclass = 'danger';

                                            break;
                                        case 1:
                                            $status = 'Active';
                                            $statusclass = 'success';
                                            break;
                                    }



                                    ?>
                                    <tr class="gradeX">

                                        <td><input type="checkbox" name="userIds" value="<?php echo $value['customer_id']; ?>"/></td>
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
                                        <td><span class="label label-<?php echo $statusclass;?>"><?php echo $status;?></span></td>


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