$(document).ready(function(){

    $('#notes_read').on('click',function(){
        if(this.checked==true){
            $('#internal_notes').show('slow');
        }else{
            $('#internal_notes').hide('slow');
        }
    });




    $(document).on('click','#note_button',function () {
        var a = $("#note_body").val();

        if(a== ''){
            return;
        }
        else{
            $.ajax({
                url: base_url+'add-note-action',
                type: 'post',
                data: {'note':a},
                datatype:'json',
                success: function (result) {
                    $("#myModal1").modal();
                    $("#note_body").val("");

                }
            });

        }
    });










    $('.datepicker').datepicker({
    format: 'dd-mm-yyyy'
  });

});
$(document).ready(function(){
  $.fn.dataTableExt.sErrMode = 'throw';
  aTable = $('#ship_table').DataTable({

    "bJQueryUI": true,
    "bProcessing": true,
      "oLanguage":{
          "sEmptyTable": "<h3 align='center' class='alert alert-warning'>No Data Available. Please make a New search !</h3>",
          "sProcessing":"<img src='"+base_url+"uisrc/img/processing.gif' style='z-index: 1011; position: absolute; padding: 0px; margin: 0px;  top: 150px; left: 40%; text-align: center; color: rgb(0, 0, 0); border: 0px none; cursor: default;' alt='Loading...'>"
      },
      "bFilter": true,
    "bServerSide": true,
    "sPaginationType" : "full_numbers",
    "sAjaxSource":base_url+"list-data",
    "sServerMethod": "POST",
     "aaSorting": [[ 1, "asc" ]],
     "aoColumns":[
              { "bSortable": false },
              { "bSortable": true },
              { "bSortable": false },
              { "bSortable": true },
                { "bSortable": true },
              { "bSortable": true },
              { "bSortable": true },
              { "bSortable": true },
              { "bSortable": true },
              { "bSortable": false },
              { "bSortable": false },
              { "bSortable": false },
              { "bSortable": false },
              { "bSortable": false },
          ]
  });

    $(window).bind("load", function() {
        var filter_array = JSON.stringify({"acnumber":111111111});
         //aTable.fnFilter(filter_array);
       // $("#ship_table_filter").innerText("");

    });
    $('#group_select1').on('click', function(e){
        $("#from_date1").val('');
        $("#to_date1").val('');
        if($("#group_select1").val() == "Error"){
            var filter_array = JSON.stringify({"acnumber":111111111});
        }
        else {
            var filter_array = JSON.stringify({"acnumber": $(this).val()});
        }
        aTable.fnFilter(filter_array);
    });

    $('#dtrange1').on('click', function(e){

        var from = $("#from_date1").val();
        var to = $("#to_date1").val();
        if(from=="" || to==""){
            alert('Both date fields are required');
        }
        else if(dateTotime(from) > dateTotime(to)){
            alert('From date should be less than to date.Please correct !');
        }else{
            var dateFrom = formateDate(from);
            var dateTo = formateDate(to);
            var filter_array = JSON.stringify({"datefrom":dateFrom, "dateto":dateTo, "acnumber":$("#group_select1").val()});
            aTable.fnFilter(filter_array);
        }
    });
    $("#reset1").on('click', function(e){
        window.location.href =base_url+"list-shipments";
    });



    $('select').select2();


///export shipement


    //cost table

    costTable = $('#cost_table').DataTable({

        "bJQueryUI": true,
        "bProcessing": true,
        "oLanguage":{
            "sEmptyTable": "<h3 align='center' class='alert alert-warning'>No Data Available. Please make a New search !</h3>",
            "sProcessing":"<img src='"+base_url+"uisrc/img/processing.gif' style='z-index: 1011; position: absolute; padding: 0px; margin: 0px;  top: 150px; left: 40%; text-align: center; color: rgb(0, 0, 0); border: 0px none; cursor: default;' alt='Loading...'>"
        },
        "bFilter": true,
        "bServerSide": true,
        "sPaginationType" : "full_numbers",
        "sAjaxSource":base_url+"list-cost-data",
        "sServerMethod": "POST",
        "aaSorting": [[ 1, "asc" ]],
        "aoColumns":[
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false },

        ]
    });



    //cost table


    //profit table

    profitTable = $('#profit_table').DataTable({

        "bJQueryUI": true,
        "bProcessing": true,
        "oLanguage":{
            "sEmptyTable": "<h3 align='center' class='alert alert-warning'>No Data Available. Please make a New search !</h3>",
            "sProcessing":"<img src='"+base_url+"uisrc/img/processing.gif' style='z-index: 1011; position: absolute; padding: 0px; margin: 0px;  top: 150px; left: 40%; text-align: center; color: rgb(0, 0, 0); border: 0px none; cursor: default;' alt='Loading...'>"
        },
        "bFilter": true,
        "bServerSide": true,
        "sPaginationType" : "full_numbers",
        "sAjaxSource":base_url+"list-profit-data",
        "sServerMethod": "POST",
        "aaSorting": [[ 1, "asc" ]],
        "aoColumns":[
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false },

        ]
    });



    //profit table


    $.fn.dataTableExt.sErrMode = 'throw';
    eTable = $('#export_table').DataTable({

        "bJQueryUI": true,
        "bProcessing": true,
        "oLanguage":{
            "sEmptyTable": "<h3 align='center' class='alert alert-warning'>No Data Available. Please make a New search !</h3>",
            "sProcessing":"<img src='"+base_url+"uisrc/img/processing.gif' style='z-index: 1011; position: absolute; padding: 0px; margin: 0px;  top: 150px; left: 40%; text-align: center; color: rgb(0, 0, 0); border: 0px none; cursor: default;' alt='Loading...'>"
        },
        "bFilter": true,
        "bServerSide": true,
        "sPaginationType" : "full_numbers",
        "sAjaxSource":base_url+"list-data",
        "sServerMethod": "POST",
        "aaSorting": [[ 1, "asc" ]],
        "aoColumns":[
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false },
        ]
    });

    $(window).bind("load", function() {
        var filter_array = JSON.stringify({"acnumber":111111111});
        //aTable.fnFilter(filter_array);
         $("#export_table_filter").text("");

    });
    $('#group_select5').on('click', function(e){
        $("#from_date5").val('');
        $("#to_date5").val('');
        if($("#group_select5").val() == "Error"){
            var filter_array = JSON.stringify({"acnumber":111111111});
        }
        else {
            var filter_array = JSON.stringify({"acnumber": $(this).val()});
        }
        eTable.fnFilter(filter_array);
    });

    $('#dtrange5').on('click', function(e){

        var from = $("#from_date5").val();
        var to = $("#to_date5").val();
        if(from=="" || to==""){
            alert('Both date fields are required');
        }
        else if(dateTotime(from) > dateTotime(to)){
            alert('From date should be less than to date.Please correct !');
        }else{
            var dateFrom = formateDate(from);
            var dateTo = formateDate(to);
            var filter_array = JSON.stringify({"datefrom":dateFrom, "dateto":dateTo, "acnumber":$("#group_select5").val()});
            eTable.fnFilter(filter_array);
        }
    });
    $("#resete").on('click', function(e){
        window.location.href =base_url+"export-shipments";
    });



    $('select').select2();

///Problem shipment table starts//

    $.fn.dataTableExt.sErrMode = 'throw';
    bTable = $('#problem_table').DataTable({

        "bJQueryUI": true,
        "bProcessing": true,
        "oLanguage":{
            "sEmptyTable": "<h3 align='center' class='alert alert-warning'>No Data Available. Please make a New search !</h3>",
            "sProcessing":"<img src='"+base_url+"uisrc/img/processing.gif' style='z-index: 1011; position: absolute; padding: 0px; margin: 0px;  top: 150px; left: 40%; text-align: center; color: rgb(0, 0, 0); border: 0px none; cursor: default;' alt='Loading...'>"
        },
        "bFilter": true,
        "bServerSide": true,
        "sPaginationType" : "full_numbers",
        "sAjaxSource":base_url+"list-problem-data",
        "sServerMethod": "POST",
        "aaSorting": [[ 1, "asc" ]],
        "aoColumns":[
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false },
        ]
    });

    $(window).bind("load", function() {
        var filter_array = JSON.stringify({"acnumber":111111111});
       // bTable.fnFilter(filter_array);
        //  $("#ship_table_filter").innerText("");

    });
    $('#group_select2').on('click', function(e){
        $("#from_date2").val('');
        $("#to_date2").val('');
        if($("#group_select2").val() == "Error"){
            var filter_array = JSON.stringify({"acnumber":111111111});
        }
        else {
            var filter_array = JSON.stringify({"acnumber": $(this).val()});
        }
        bTable.fnFilter(filter_array);
    });

    $('#dtrange2').on('click', function(e){

        var from = $("#from_date2").val();
        var to = $("#to_date2").val();
        if(from=="" || to==""){
            alert('Both date fields are required');
        }
        else if(dateTotime(from) > dateTotime(to)){
            alert('From date should be less than to date.Please correct !');
        }else{
            var dateFrom = formateDate(from);
            var dateTo = formateDate(to);
            var filter_array = JSON.stringify({"datefrom":dateFrom, "dateto":dateTo, "acnumber":$("#group_select2").val()});
            bTable.fnFilter(filter_array);
        }
    });
    $("#reset2").on('click', function(e){
        window.location.href =base_url+"problem-shipments";
    });



    $('select').select2();





    //prblem shipment table end//


    /*
      Operation table starts here


     */
    $.fn.dataTableExt.sErrMode = 'throw';
    bTable = $('#operation_table').DataTable({

        "bJQueryUI": true,
        "bProcessing": true,
        "oLanguage":{
            "sEmptyTable": "<h3 align='center' class='alert alert-warning'>No Data Available. Please make a New search !</h3>",
            "sProcessing":"<img src='"+base_url+"uisrc/img/processing.gif' style='z-index: 1011; position: absolute; padding: 0px; margin: 0px;  top: 150px; left: 40%; text-align: center; color: rgb(0, 0, 0); border: 0px none; cursor: default;' alt='Loading...'>"
        },
        "bFilter": true,
        "bServerSide": true,
        "sPaginationType" : "full_numbers",
        "sAjaxSource":base_url+"list-operation-shipments",
        "sServerMethod": "POST",
        "aaSorting": [[ 1, "asc" ]],
        "aoColumns":[
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false },
        ]
    });

    $(window).bind("load", function() {
        var filter_array = JSON.stringify({"acnumber":111111111});
        // bTable.fnFilter(filter_array);
        //  $("#ship_table_filter").innerText("");

    });




    $('select').select2();

    /*
     Operation table ends here


     */
//Soleved issue table starts here



    //solved issue table starts here


    $.fn.dataTableExt.sErrMode = 'throw';
    cTable = $('#solved_table').DataTable({

        "bJQueryUI": true,
        "bProcessing": true,
        "oLanguage":{
            "sEmptyTable": "<h3 align='center' class='alert alert-warning'>No Data Available. Please make a New search !</h3>",
            "sProcessing":"<img src='"+base_url+"uisrc/img/processing.gif' style='z-index: 1011; position: absolute; padding: 0px; margin: 0px;  top: 150px; left: 40%; text-align: center; color: rgb(0, 0, 0); border: 0px none; cursor: default;' alt='Loading...'>"
        },
        "bFilter": true,
        "bServerSide": true,
        "sPaginationType" : "full_numbers",
        "sAjaxSource":base_url+"list-solved-data",
        "sServerMethod": "POST",
        "aaSorting": [[ 1, "asc" ]],
        "aoColumns":[
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false },
        ]
    });

    $(window).bind("load", function() {
        var filter_array = JSON.stringify({"acnumber":111111111});
       // cTable.fnFilter(filter_array);
        //  $("#ship_table_filter").innerText("");

    });
    $('#group_select3').on('click', function(e){
        $("#from_date3").val('');
        $("#to_date3").val('');
        if($("#group_select3").val() == "Error"){
            var filter_array = JSON.stringify({"acnumber":111111111});
        }
        else {
            var filter_array = JSON.stringify({"acnumber": $(this).val()});
        }
        cTable.fnFilter(filter_array);
    });

    $('#dtrange3').on('click', function(e){

        var from = $("#from_date3").val();
        var to = $("#to_date3").val();
        if(from=="" || to==""){
            alert('Both date fields are required');
        }
        else if(dateTotime(from) > dateTotime(to)){
            alert('From date should be less than to date.Please correct !');
        }else{
            var dateFrom = formateDate(from);
            var dateTo = formateDate(to);
            var filter_array = JSON.stringify({"datefrom":dateFrom, "dateto":dateTo, "acnumber":$("#group_select3").val()});
            cTable.fnFilter(filter_array);
        }
    });
    $("#reset3").on('click', function(e){
        window.location.href =base_url+"solved-issues";
    });



    $('select').select2();

////account table shipment

    $.fn.dataTableExt.sErrMode = 'throw';
    dTable = $('#acc_table').DataTable({

        "bJQueryUI": true,
        "bProcessing": true,
        "oLanguage":{
            "sEmptyTable": "<h3 align='center' class='alert alert-warning'>No Data Available. Please make a New search !</h3>",
            "sProcessing":"<img src='"+base_url+"uisrc/img/processing.gif' style='z-index: 1011; position: absolute; padding: 0px; margin: 0px;  top: 150px; left: 40%; text-align: center; color: rgb(0, 0, 0); border: 0px none; cursor: default;' alt='Loading...'>"
        },
        "bFilter": true,
        "bServerSide": true,
        "sPaginationType" : "full_numbers",
        "sAjaxSource":base_url+"list-account-shipments",
        "sServerMethod": "POST",
        "aaSorting": [[ 1, "asc" ]],
        "aoColumns":[
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false },
        ]
    });

    $(window).bind("load", function() {
        var filter_array = JSON.stringify({"acnumber":111111111});
        //dTable.fnFilter(filter_array);
        //  $("#ship_table_filter").innerText("");

    });
    $('#group_select4').on('click', function(e){
        $("#from_date4").val('');
        $("#to_date4").val('');
        if($("#group_select4").val() == "Error"){
            var filter_array = JSON.stringify({"acnumber":111111111});
        }
        else {
            var filter_array = JSON.stringify({"acnumber": $(this).val()});
        }
        dTable.fnFilter(filter_array);
    });

    $('#dtrange4').on('click', function(e){

        var from = $("#from_date4").val();
        var to = $("#to_date4").val();
        if(from=="" || to==""){
            alert('Both date fields are required');
        }
        else if(dateTotime(from) > dateTotime(to)){
            alert('From date should be less than to date.Please correct !');
        }else{
            var dateFrom = formateDate(from);
            var dateTo = formateDate(to);
            var filter_array = JSON.stringify({"datefrom":dateFrom, "dateto":dateTo, "acnumber":$("#group_select4").val()});
            dTable.fnFilter(filter_array);
        }
    });
    $("#reset4").on('click', function(e){
        window.location.href =base_url+"account-shipments";
    });



    $('select').select2();

    //account table shipment
//Admin shipment table
    $.fn.dataTableExt.sErrMode = 'throw';
    adminTable = $('#admin_table').DataTable({

        "bJQueryUI": true,
        "bProcessing": true,
        "oLanguage":{
            "sEmptyTable": "<h3 align='center' class='alert alert-warning'>No Data Available. Please make a New search !</h3>",
            "sProcessing":"<img src='"+base_url+"uisrc/img/processing.gif' style='z-index: 1011; position: absolute; padding: 0px; margin: 0px;  top: 150px; left: 40%; text-align: center; color: rgb(0, 0, 0); border: 0px none; cursor: default;' alt='Loading...'>"
        },
        "bFilter": true,
        "bServerSide": true,
        "sPaginationType" : "full_numbers",
        "sAjaxSource":base_url+"list-admin-shipments",
        "sServerMethod": "POST",
        "aaSorting": [[ 1, "asc" ]],
        "aoColumns":[
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false },
        ]
    });

    $(window).bind("load", function() {
        var filter_array = JSON.stringify({"acnumber":111111111});
        adminTable.fnFilter(filter_array);
        //  $("#ship_table_filter").innerText("");

    });






    $('select').select2();



    //admin shipment table

    //  aTable///////////////////////////////

  $("#ship_table_info").addClass("span7");
  //ledger show
  oTable = $('#ledger_table').dataTable({
    "bJQueryUI": true,
    "bProcessing": true,
    "bFilter": true,
    "oLanguage":{
     "sEmptyTable": "<h3 align='center' class='alert alert-warning'>No Data Available. Please make a New search !</h3>",
    "sProcessing":"<img src='"+base_url+"uisrc/img/processing.gif' style='z-index: 1011; position: absolute; padding: 0px; margin: 0px;  top: 150px; left: 40%; text-align: center; color: rgb(0, 0, 0); border: 0px none; cursor: default;' alt='Loading...'>"
     },
    "bServerSide": true,
    "bPaginate":false,
    "sPaginationType" : "full_numbers",
    "sAjaxSource":base_url+"ledger-list",
    "sServerMethod": "POST",
     "aaSorting": [[ 1, "asc" ]],
     "aoColumns":[
              { "bSortable": true },
              { "bSortable": true},
              { "bSortable": true },
              { "bSortable": true },
              { "bSortable": false },
              { "bSortable": false },
              { "bSortable": true },
              { "bSortable": true },
              { "bSortable": true },
              { "bSortable": true },
              { "bSortable": false },
              { "bSortable": false },
              { "bSortable": false },
              { "bSortable": false },
              { "bSortable": false },
          ] 
      });
    // return on refresh
    $(window).bind("load", function() {

        var filter_array = JSON.stringify({"acnumber":111111111});
        oTable.fnFilter(filter_array);


    });
	  $('#group_select').on('click', function(e){
      $("#from_date").val('');
      $("#to_date").val('');
	  	var filter_array = JSON.stringify({"acnumber":$(this).val()});
	     oTable.fnFilter(filter_array);
	  });
	  $('#dtrange').on('click', function(e){

	  	var from = $("#from_date").val();
	  	var to = $("#to_date").val();
	  	if(from=="" || to==""){
	  		alert('Both date fields are required');
	  	}
	  	else if(dateTotime(from) > dateTotime(to)){
	  		alert('From date should be less than to date.Please correct !');
	  	}else{
	  		var dateFrom = formateDate(from);
	  		var dateTo = formateDate(to);
	  		var filter_array = JSON.stringify({"datefrom":dateFrom, "dateto":dateTo, "acnumber":$("#group_select").val()});
	        oTable.fnFilter(filter_array);
	  	}
	  });
	  $("#reset").on('click', function(e){
	  	 window.location.href =base_url+"shipment-ledger";
	   });	
	  function dateTotime(myDate) {
	  	myDate=myDate.split("-");
		var newDate=myDate[1]+"/"+myDate[0]+"/"+myDate[2];
		return new Date(newDate).getTime();
		}
	   function formateDate(myDate){
	   	myDate=myDate.split("-");
		return  newDate=myDate[2]+"-"+myDate[1]+"-"+myDate[0];
	   }
	  //reload select options
	  $("#ledger_table_filter").hide();
	  $('select').select2();
  });
   /*pdf report of ledger*/
  $(document).on('click', '#ledger_pdf', function() {
    var accNum = $("#group_select").val();
    if(accNum!=""){
      $("#ledger_table_processing").css("visibility", "visible");
      $.ajax({
      url: base_url+"ledger-pdf",
      type : 'POST',
      data : {"acnumber":accNum,"from":$("#from_date").val(),"to":$("#to_date").val()},
      datatype:'json',
      success: function(result){
        var obj = jQuery.parseJSON(result);
        if(obj.message=='Success'){
          $("#ledger_table_processing").css("visibility", "hidden");
          window.location.href =base_url+"./uploads/temp/"+obj.file;
        }else{
              alert(obj.message);
        }
      }
     });
    }else{
       alert('Please select account number !');
    }
 });

///
$(document).on('click', '#ledger_pdf_report', function() {
    var accNum = $("#group_select").val();
    if(accNum!=""){
        $("#ledger_table_processing").css("visibility", "visible");
        $.ajax({
            url: base_url+"ledger-pdf-report",
            type : 'POST',
            data : {"acnumber":accNum,"from":$("#from_date").val(),"to":$("#to_date").val()},
            datatype:'json',
            success: function(result){
                var obj = jQuery.parseJSON(result);
                if(obj.message=='Success'){
                    $("#ledger_table_processing").css("visibility", "hidden");
                    window.location.href =base_url+"./uploads/temp/"+obj.file;
                }else{
                    alert(obj.message);
                }
            }
        });
    }else{
        alert('Please select account number !');
    }
});
//ledger excel
$(document).on('click', '#ledger_excel', function() {
    var accNum = $("#group_select").val();
    if(accNum!=""){
        $("#ledger_table_processing").css("visibility", "visible");
        $.ajax({
            url: base_url+"ledger-excel",
            type : 'POST',
            data : {"acnumber":accNum,"from":$("#from_date").val(),"to":$("#to_date").val()},
            datatype:'json',
            success: function(result){
                var obj = jQuery.parseJSON(result);
                if(obj.message=='Success'){
                    $("#ledger_table_processing").css("visibility", "hidden");
                    window.location.href =base_url+"./uploads/temp/"+obj.file;
                }else{
                    alert(obj.message);
                }
            }
        });
    }else{
        alert('Please select account number !');
    }
});

  //Get ship data for reports
  $(document).on('click', '#ship_data', function() {
    var values = new Array();
    $.each($(".shipids:checked"), function() {
       values.push($(this).val());
    });
   if(values!=""){
    $("#ship_table_processing").css("visibility", "visible");
        $.ajax({
          url: base_url+'get-shipment-csv',
          type : 'POST',
          data : {'ids':values},
          datatype:'json',
          success: function(result){
            var obj = jQuery.parseJSON(result);
            if(obj.message=='Success'){
               $("#ship_table_processing").css("visibility", "hidden");
               window.location.href =base_url+"./uploads/temp/"+obj.file;
            }else{
              alert(obj.message);
            }
          }
        });
      }else{
        alert('Please select at least one record !');

    }
  });
  //Action on group
//shipment pdf
$(document).on('click', '#ship_data_pdf', function() {
    var values = new Array();
    $.each($(".shipids:checked"), function() {
        values.push($(this).val());
    });
    if(values!=""){
        $("#ship_table_processing").css("visibility", "visible");
        $("#problem_table_processing").css("visibility", "visible");
        $("#export_table_processing").css("visibility", "visible");
        $("#solved_table_processing").css("visibility", "visible");
        $.ajax({
            url: base_url+'get-shipment-pdf',
            type : 'POST',
            data : {'ids':values},
            datatype:'json',
            success: function(result){
                var obj = jQuery.parseJSON(result);
                if(obj.message=='Success'){
                    $("#ship_table_processing").css("visibility", "hidden");
                    $("#problem_table_processing").css("visibility", "hidden");
                    $("#export_table_processing").css("visibility", "hidden");
                    $("#solved_table_processing").css("visibility", "visible");
                    window.location.href =base_url+"./uploads/temp/"+obj.file;
                }else{
                    alert(obj.message);
                }
            }
        });
    }else{
        alert('Please select at least one record !');

    }
});

  //Get ship data for reports
  $(document).on('click', '#group_action', function() {
    var values = new Array();
    var status = $('#group_select').val();
    $.each($(".shipids:checked"), function() {
       values.push($(this).val());

    });

    if(status=="Error"){
       alert('Please select an action from drop down !');
    }
   else if(values!=""){
    if(confirm('Are you sure to Mark as '+status+' selected records.')==true){
      $("#ship_table_processing").css("visibility", "visible");
          $.ajax({
            url: base_url+'change-group-status',
            type : 'POST',
            data : {'ids':values,'status':status},
            datatype:'json',
            success: function(result){
              var obj = jQuery.parseJSON(result);
              if(obj.message=='Success'){
                 $("#ship_table_processing").css("visibility", "hidden");
                  window.location.href =re_url;
              }else{
                $("#ship_table_processing").css("visibility", "hidden");
                window.location.href =re_url;
              }
            }
          });
        }
      }else{
         alert('Please select at least one record !');
        }
  });
  //Get zone from list
  $(document).on('change', '#wp_price_list', function() {
    $("#zone_listing").html('');
     $.ajax({
      url: base_url+'get-wp-zone',
      type : 'POST',
      data : {'listId':$(this).val()},
      datatype:'json',
      success: function(result){
        if(result!=""){
          var jsonlist = JSON.parse(result);
          zonelist='<option value="Error">-Select-</option>';
          jQuery.each(jsonlist, function (index, value) {
            zonelist+='<option value="'+value['zone_id']+'">'+value['zoneName']+'</option>';  
          });
          $("#zone_listing").html(zonelist);
        }
      }
    });










  });
$body = $("body");

$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
    ajaxStop: function() { $body.removeClass("loading"); }
});
//Report files javascirpt here

$(document).on('click','#user_export_pdf',function () {

    var checkboxValues = [];
    $('input[name=userIds]:checked').map(function() {
        checkboxValues.push($(this).val());
    });
    if(checkboxValues!=""){


        $.ajax({
            url: base_url+'report-user-pdf',
            type : 'POST',
            data : {'ids':checkboxValues},
            datatype:'json',
            success: function(result){
                var obj = jQuery.parseJSON(result);
                if(obj.message=='Success'){


                    window.location.href =base_url+"./uploads/temp/"+obj.file;
                }else{
                    alert(obj.message);
                }
            }
        });
    }else{
        alert('Please select at least one record !');

    }







});
//report user csv
$(document).on('click','#user_export_csv',function () {

    var checkboxValues = [];
    $('input[name=userIds]:checked').map(function() {
        checkboxValues.push($(this).val());
    });
    if(checkboxValues!=""){


        $.ajax({
            url: base_url+'report-user-csv',
            type : 'POST',
            data : {'ids':checkboxValues},
            datatype:'json',
            success: function(result){
                var obj = jQuery.parseJSON(result);
                if(obj.message=='Success'){

                    window.location.href =base_url+"./uploads/temp/"+obj.file;
                }else{
                    alert(obj.message);
                }
            }
        });
    }else{
        alert('Please select at least one record !');

    }







});












$(document).on('click','#branches_export_pdf',function () {

    var checkboxValues = [];
    $('input[name=userIds]:checked').map(function() {
        checkboxValues.push($(this).val());
    });
    if(checkboxValues!=""){


        $.ajax({
            url: base_url+'report-branches-pdf',
            type : 'POST',
            data : {'ids':checkboxValues},
            datatype:'json',
            success: function(result){
                var obj = jQuery.parseJSON(result);
                if(obj.message=='Success'){


                    window.location.href =base_url+"./uploads/temp/"+obj.file;
                }else{
                    alert(obj.message);
                }
            }
        });
    }else{
        alert('Please select at least one record !');

    }







});
//report user csv
$(document).on('click','#branches_export_csv',function () {

    var checkboxValues = [];
    $('input[name=userIds]:checked').map(function() {
        checkboxValues.push($(this).val());
    });
    if(checkboxValues!=""){


        $.ajax({
            url: base_url+'report-branches-csv',
            type : 'POST',
            data : {'ids':checkboxValues},
            datatype:'json',
            success: function(result){
                var obj = jQuery.parseJSON(result);
                if(obj.message=='Success'){

                    window.location.href =base_url+"./uploads/temp/"+obj.file;
                }else{
                    alert(obj.message);
                }
            }
        });
    }else{
        alert('Please select at least one record !');

    }







});


//report customer





$(document).on('click','#customer_export_pdf',function () {

    var checkboxValues = [];
    $('input[name=userIds]:checked').map(function() {
        checkboxValues.push($(this).val());
    });
    if(checkboxValues!=""){


        $.ajax({
            url: base_url+'report-customer-pdf',
            type : 'POST',
            data : {'ids':checkboxValues},
            datatype:'json',
            success: function(result){
                var obj = jQuery.parseJSON(result);
                if(obj.message=='Success'){


                    window.location.href =base_url+"./uploads/temp/"+obj.file;
                }else{
                    alert(obj.message);
                }
            }
        });
    }else{
        alert('Please select at least one record !');

    }







});
//report user csv
$(document).on('click','#customer_export_csv',function () {

    var checkboxValues = [];
    $('input[name=userIds]:checked').map(function() {
        checkboxValues.push($(this).val());
    });
    if(checkboxValues!=""){


        $.ajax({
            url: base_url+'report-customer-csv',
            type : 'POST',
            data : {'ids':checkboxValues},
            datatype:'json',
            success: function(result){
                var obj = jQuery.parseJSON(result);
                if(obj.message=='Success'){

                    window.location.href =base_url+"./uploads/temp/"+obj.file;
                }else{
                    alert(obj.message);
                }
            }
        });
    }else{
        alert('Please select at least one record !');

    }







});


















//Report files javascript ends here




// This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {

          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
            resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
        }
      }
// resets the menu selection upon entry to this page:
function resetMenu() {
 document.gomenu.selector.selectedIndex = 2;
}
//date range

$(document).ready(function () {

    $.fn.dataTableExt.afnFiltering.push(
        function(oSettings, aData, iDataIndex){


                var dateStart = parseDateValue($("#myDateStart").val());
                var dateEnd = parseDateValue($("#myDateEnd").val());







            // aData represents the table structure as an array of columns, so the script access the date value
            // in the first column of the table via aData[2]
            var evalDate= parseDateValue(aData[2]);


            if (evalDate >= dateStart && evalDate <= dateEnd) {
                return true;
            }
            else {
                return false;
            }

        });

// Function for converting a mm/dd/yyyy date value into a numeric string for comparison (example 08/12/2010 becomes 20100812
    function parseDateValue(rawDate) {
        var dateArray= rawDate.split("-");
        var parsedDate= dateArray[2] + dateArray[1] + dateArray[0];
        return parsedDate;
    }



    // Implements the dataTables plugin on the HTML table
    $dTable = $('.data-table-special').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>'
    });

    // The dataTables plugin creates the filtering and pagination controls for the table dynamically, so these
    // lines will clone the date range controls currently hidden in the baseDateControl div and append them to
    // the feedbackTable_filter block created by dataTables

    // Create event listeners that will filter the table whenever the user types in either date range box or
    // changes the value of either box using the Datepicker pop-up calendar
    $("#rangeClick").click ( function() { $dTable.fnDraw(); } );






});




