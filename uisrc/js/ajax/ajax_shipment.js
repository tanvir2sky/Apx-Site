$( document ).ready(function() {
	//Get customer auto data




	$(document).on('change', '#shiper_code', function() {
    $.ajax({
		url: base_url+'get-customer-info',
		type : 'POST',
		data : {'id':$(this).val()},
		datatype:'json',
		success: function(result){
			if(result!=""){
				var currentdate = new Date();
				var json = JSON.parse(result);
				$("#shiper_company").val(json['company']);
				$("#shiper_name").val(json['fname']+' '+json['lname']);
				$("#shiper_address1").val(json['address1']);
				$("#shiper_address2").val(json['address2']);
				$("#shiper_country").val(json['country']);
				$("#shiper_state").val(json['state']);
				$("#shiper_city").val(json['city']);
				$("#shiper_zip").val(json['zipCode']);
				$("#shiper_phone").val(json['phone']);
				$("#ship_user").val(json['ship_user']);
				
			}else{
				$("#shiper_company").val('');
				$("#shiper_name").val('');
				$("#shiper_address1").val('');
				$("#shiper_address2").val('');
				$("#shiper_country").val('');
				$("#shiper_state").val('');
				$("#shiper_city").val('');
				$("#shiper_zip").val('');
				$("#shiper_phone").val('');
				$("#ship_user").val('');
			}
		 }
	 });
	}); 
	//get price list by country name
	$(document).on('change', '#ship_service', function() {
	    $.ajax({
			url: base_url+'get-zone-countries',
			type : 'POST',
			data : {'listId':$(this).val()},
			datatype:'json',
			success: function(result){
				if(result!=""){
					var jsonlist = JSON.parse(result);
					pricelist='<option value="Country">Country</option>';
					jQuery.each(jsonlist, function (index, value) {
						pricelist+='<option value="'+value['countryCode']+'">'+value['countryName']+'</option>';	
					});
					$("#receiver_country").html(pricelist);
				}
			}
		});
	}); 
	//call calculation method
	$("#ship_weight").on("keyup", priceGet);
    $("#receiver_country").on("change", priceGet);
    $("#total_payed").on("keyup", priceCalculate);
    $("#ship_service").on("change", priceClear);

    //get price from  rate list
	function priceGet(){
		var listID = $("#ship_service").val();
		var weightVal = $("#ship_weight").val();
		var countryCode = $("#receiver_country").val();
	    $.ajax({
			url: base_url+'get-rate-list',
			type : 'POST',
			data : {'list_id':listID,'weight_val':weightVal,'country_code':countryCode},
			datatype:'json',
			success: function(result){
				var output = JSON.parse(result);
				if(output['message']=='Success' && output['data']==""){
					$("#total_payment").val('');
					$('#errorMsg').html('No data found to process.');
				}else if(output['message']=="Error"){
					$("#total_payment").val('');
					$('#errorMsg').html(output['data']);
				}else{
					$('#errorMsg').html('');
					$("#total_payment").val(output['data']['wprice']);
				}
			}
			
		});
	}
	function priceCalculate(){
		//alert(1231);
		var priceTotal = $("#total_payment").val();
		var pricePaid = $("#total_payed").val();
		var total=0;
		total=parseInt(priceTotal-pricePaid);
		$("#total_balance").val(total);
	}
	//clear price calculated
	function priceClear(){
		$("#ship_weight").val('');
		$("#ship_pcs").val('');
		$("#total_payment").val('');
		$("#total_payed").val('');
		$("#total_balance").val('');
		$('#errorMsg').html('');
	}
	butto
});
