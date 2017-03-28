<!--main-container-part-->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo base_url(); ?>dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="javascript:void(0)" class="current"><?php if(isset($breadcromb)){echo $breadcromb;} ?></a> </div>
        <h1><?php if(isset($header)){echo $header;} ?></h1>
        <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
    </div>
    <div class="container-fluid"><hr>
        <div class="row-fluid">
            <div class="span12">
                <?php
                if(isset($error)){
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>".$error."</div>";
                }
                ?>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5><?php if(isset($title)){echo $title;} ?></h5>
                        <a href="<?php echo base_url(); ?>uploads/system/apx_invoice_sample.csv" class="pull-right" style="margin-right:10px;">Download Sample</a>
                    </div>
                    <div class="widget-content nopadding span6">
                        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>upload-invoice-action" name="basic_validate" id="basic_validate" novalidate="novalidate">
                            <div class="control-group">
                                <label class="control-label">Upload Invoice</label>
                                <div class="controls">
                                    <input type="file" class="span8" name="userfile">
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" name="upload" value="Upload" class="btn btn-success pull-right">
                                <button class="btn btn-info pull-right" onclick="history.go(-1);" type="button" style="margin-right:5px;">Go Back</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end-main-container-part-->