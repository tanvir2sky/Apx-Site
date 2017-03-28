<!--sidebar-menu-->
<div id="sidebar"><a href="<?php echo base_url(); ?>dashboard" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="active"><a href="index.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <?php 
     if(access_control_apx('ship_manage','Full')==true){?>
    <li class="submenu"> <a href="#"><i class="icon icon-shopping-cart"></i> <span>Shipments</span> <span class="label label-important">6</span></a>
      <ul>
        <li><a href="<?php echo base_url(); ?>new-shipment">New Shipment</a></li>
        <li><a href="<?php echo base_url(); ?>list-shipments">Search Shipment</a></li>
        <li><a href="<?php echo base_url(); ?>export-shipments">Export Shipment</a></li>
        <li><a href="<?php echo base_url(); ?>upload-shipments">Upload Shipments</a></li>
        <li><a href="<?php echo base_url(); ?>trashed-shipment">Trashed Shipment</a></li>
      </ul>
    </li>
    <?php 
      }
     if(access_control_apx('customers_manage','Full')==true){?>
    <li class="submenu"> <a href="#"><i class="icon icon-th"></i> <span>Customer Services</span> <span class="label label-important">1</span></a>
      <ul>
        <li><a href="<?php echo base_url(); ?>list-shipments">List Shipment</a></li>
        <li><a href="<?php echo base_url(); ?>problem-shipments">Problem Shipments</a></li>
        <li><a href="<?php echo base_url(); ?>solved-issues">Solved Issues</a></li>

        <li><a href="<?php echo base_url(); ?>upload-shipments">Upload Shipments</a></li>
        <li><a href="fwd-accounts.php">Forward to Acccounts</a></li>
        <li><a href="fwd-operations.php">Forward to Operations</a></li>
      </ul>
    </li>
     <?php 
      }
     if(access_control_apx('accounts_manage','Full')==true){?>
    <li class="submenu"> <a href="#"><i class="icon icon-folder-open"></i> <span>Accounts</span> <span class="label label-important">5</span></a>
      <ul>
        <li><a href="<?php echo base_url(); ?>account-shipments">List Shipment</a></li>
        <li><a href="<?php echo base_url(); ?>upload-invoice">Upload Invoice</a></li>
        <li><a href="<?php echo base_url(); ?>differ-shipment">Differ Shipments</a></li>
        <li><a href="shipment-ledger">Ledger</a></li>
      </ul>
    </li>
    <?php 
      }
     if(access_control_apx('oprations_manage','Full')==true){?>
        <li class="submenu"> <a href="#"><i class="icon icon-folder-open"></i> <span>Operations</span> <span class="label label-important">5</span></a>
      <ul>

        <li><a href="<?php echo base_url(); ?>operation-shipments">List Shipment</a></li>
        <li><a href="<?php echo base_url(); ?>upload-shipments">Upload Shipments</a></li>

      </ul>
    </li>
    <?php 
      }
     if(access_control_apx('users_manage','Full')==true){?>
       <li class="submenu"> <a href="#"><i class="icon icon-folder-open"></i> <span>Admin</span> <span class="label label-important">5</span></a>
         <ul>

           <li><a href="<?php echo base_url(); ?>admin-shipments">List Shipment</a></li>
           <li><a href="<?php echo base_url(); ?>upload-shipments">Upload Shipments</a></li>

         </ul>
       </li>
    <li class="submenu"> <a href="#"><i class="icon-user"></i> <span>User Levels</span> <span class="label label-important">9</span></a>
      <ul>
        <li><a href="<?php echo base_url(); ?>list-super-admins">Super Admins</a></li>
        <li><a href="<?php echo base_url(); ?>list-admins">Admins</a></li>
        <li><a href="<?php echo base_url(); ?>list-accounts">Accounts</a></li>
        <li><a href="<?php echo base_url(); ?>list-operations">Operations</a></li>
        <li><a href="<?php echo base_url(); ?>list-customer-service">Customer Services</a></li>
        <?php 
        if(access_control_apx('users_manage','Trash')==true){?>
        <li><a href="<?php echo base_url(); ?>trashed-app-users">Trashed App Users</a></li>
        <?php } ?>
      </ul>
    </li>
    <?php 
      }
     if(access_control_apx('reports_manage','Full')==true){?>
        <li class="submenu"> <a href="#"><i class="icon icon-book"></i> <span>Reports</span> <span class="label label-important">7</span></a>
      <ul>
        <li><a href="<?php echo base_url() ?>report-user">View Users</a></li>
        <li><a href="<?php echo base_url() ?>report-branches">View Branches</a></li>
        <li><a href="<?php echo base_url() ?>report-customer">View all customers</a></li>
        <li><a href="<?php echo base_url() ?>report-transit">Report Intransit</a></li>
        <li><a href="<?php echo base_url() ?>report-delivered">Report Delivered</a></li>
        <li><a href="<?php echo base_url() ?>report-lost">Report Lost</a></li>
        <li><a href="<?php echo base_url() ?>report-problem">Report Problem</a></li>
        <li><a href="<?php echo base_url() ?>report-refunded">Report Refunded</a></li>
        <li><a href="<?php echo base_url() ?>report-partial">Report Partial</a></li>
        <li><a href="<?php echo base_url() ?>report-manifest">Report Manifest</a></li>
        <li><a href="<?php echo base_url() ?>report-un-manifest">Report Unmenifest</a></li>
        <li><a href="<?php echo base_url() ?>report-checked">Report Checked</a></li>
        <li><a href="<?php echo base_url() ?>report-un-checked">Report Unchecked</a></li>
        <li><a href="<?php echo base_url() ?>report-billed">Report Billed</a></li>
        <li><a href="<?php echo base_url() ?>report-un-billed">Report Unbilled</a></li>
        <li><a href="<?php echo base_url() ?>report-without-dhl">Report Without DHL</a></li>
        <li><a href="<?php echo base_url() ?>report-cash">Cash Customer</a></li>
        <li><a href="<?php echo base_url() ?>report-booked">Cash Booked Shipment</a></li>
        <li><a href="<?php echo base_url() ?>report-ledger">Report Ledger</a></li>

      </ul>
    </li>
    <?php 
      }
    if(access_control_apx('general_setting','Full')==true){?>
        <li class="submenu"> <a href="#"><i class="icon icon-wrench"></i> <span>Genral Settings</span> <span class="label label-important">9</span></a>
      <ul>
        <li><a href="<?php echo base_url(); ?>list-countries">Countries</a></li>
        <li><a href="<?php echo base_url(); ?>list-branches">Branches</a></li>
        <li><a href="<?php echo base_url(); ?>trashed-branches">Trashed Branches</a></li>
        <li><a href="<?php echo base_url(); ?>list-customer">Customer</a></li>
        <li><a href="<?php echo base_url(); ?>trashed-customer">Trashed Customer</a></li>
        <li><a href="<?php echo base_url(); ?>list-gst">GST Setting</a></li>
        <li><a href="<?php echo base_url(); ?>list-fuel-surcharge">Fuel Surcharge</a></li>
        <li><a href="<?php echo base_url(); ?>list-pricelist">Price List</a></li>
        <li><a href="<?php echo base_url(); ?>list-pricelist-f">Frieght Chrarges</a></li>
        <li><a href="<?php echo base_url(); ?>report-cost-price">Cost</a></li>
        <li><a href="<?php echo base_url(); ?>report-cost-profit">Profit</a></li>
        <li><a href="<?php echo base_url(); ?>upload-wp-csv">Rates upload</a></li>
        <li><a href="#">Shipment Settings</a></li>
      </ul>
    </li>
    <?php } ?>
  </ul>
</div>
<!--sidebar-menu-->