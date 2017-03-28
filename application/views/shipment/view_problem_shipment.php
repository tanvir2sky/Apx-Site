<!--main-container-part-->
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








                        <span class="span2 pull-left" style="margin-top: 5px;">


            </span>


















                        <?php
                        if(access_control_apx('ship_manage','Add')==true){?>
                            <span class="pull-right"><a href="<?php echo base_url(); ?>new-shipment"><button class="btn btn-primary" style="margin:5px;">Add New</button></a></span>
                        <?php }
                        if(access_control_apx('ship_manage','Excel')==true){?>
                            <button class="btn btn-danger pull-right" id="ship_data_pdf" type="button" style="margin:5px;"><i class="icon-download-alt"></i> Pdf</button>
                            <button class="btn btn-info pull-right" id="ship_data" type="button" style="margin:5px;"><i class="icon-download-alt"></i> Excel</button>

                        <?php }
                        if(access_control_apx('ship_manage','Status')==true){?>

                        <?php }
                        if(access_control_apx('ship_manage','Status')==true){?>
                            <button class="btn btn-info pull-right" id="group_action" type="button" style="margin:5px;">Change Status</button>
                            <span class="span2 pull-right" >

            <select id="group_select" name="group_action">
            <?php if(($this->actionPermission) && (is_array($this->actionPermission))){
                echo '<option value="Error">Group action</option>';
                foreach ($this->actionPermission as $key => $value) {
                    if($value == 'Lost' or $value == 'Partial' or $value== 'Problem'){
                        echo '<option value="'.$value.'">'.$value.'</option>';
                    }
                    else{
                        continue;
                    }

                }
            }
            ?>
            </select>

            </span>
                        <?php }?>


                    </div>
                    <div class="widget-content nopadding">

                        <table  class="table table-bordered  with-check" id="problem_table">
                            <thead>
                            <tr>
                                <th width="3%"><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
                                <th width="3%">Sr.<br/>no
                                <th width="5%">Date</th>
                                <th>Air Way Bill #</th>
                                <th>Account Number</th>
                                <th>Country</th>
                                <th>Receiver Company</th>
                                <th width="12%">Service</th>
                                <th>Balance</th>
                                <th>Csd Status</th>
                                <th width="18%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!--load data by ajax-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end-main-container-part-->