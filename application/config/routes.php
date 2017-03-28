<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['signin'] = 'login/signin';
$route['logout'] = 'login/logout';
$route['dashboard'] = 'dashboard';
/*
@  Admin Users routing 
*/
$route['add-app-user'] = 'Manageadmins/addAppUser';
$route['app-user-action'] = 'Manageadmins/appUserAction';
$route['edit-app-user/:any()'] = 'Manageadmins/editAppUser/$1';
$route['list-super-admins'] = 'Manageadmins/listSuperAdmins';
$route['list-admins'] = 'Manageadmins/listAdmins';
$route['list-accounts'] = 'Manageadmins/listAccounts';
$route['list-operations'] = 'Manageadmins/listOperations';
$route['list-customer-service'] = 'Manageadmins/listCustomerServices';
$route['trashed-app-users'] = 'Manageadmins/trashAppUsers';
$route['trash-app-user/:any()'] = 'Manageadmins/trashApUser/$1';
$route['change-status/:any()'] = 'Manageadmins/changeStatus/$1';
$route['app-user-detail/:any()']= 'Manageadmins/viewAppUser/$1';
$route['delete-app-user/:any()'] = 'Manageadmins/deleteAppUser/$1';
/*
@ countries routing
*/
$route['list-countries'] = 'Managcountries/countriesList';
$route['add-country'] = 'Managcountries/addCountry';
$route['edit-country/:any()'] = 'Managcountries/editCountry/$1';
$route['add-country-action'] = 'Managcountries/addCountryAction';
$route['delete-country/:any()'] = 'Managcountries/deleteCountry/$1';
/*
@ Customer branches routing
*/
$route['add-branch'] = 'Managebranches/addBranch';
$route['edit-branch/:any()'] = 'Managebranches/editBranch/$1';
$route['add-branch-action'] = 'Managebranches/addBranchAction';
$route['list-branches'] = 'Managebranches/listBranches';
$route['trashed-branches'] = 'Managebranches/trashedBranches';
$route['trash-branch/:any()'] = 'Managebranches/trashBranch/$1';
$route['change-branch-status/:any()'] = 'Managebranches/changeStatus/$1';
$route['branch-detail/:any()']= 'Managebranches/viewBranch/$1';
$route['delete-branch/:any()'] = 'Managebranches/deleteBranch/$1';
/*
@ Customer accounts routing
*/
$route['add-customer'] = 'Managecustomer/addCustomer';
$route['edit-customer/:any()'] = 'Managecustomer/editCustomer/$1';
$route['add-customer-action'] = 'Managecustomer/addCustomerAction';
$route['list-customer'] = 'Managecustomer/listCustomers';
$route['trashed-customer'] = 'Managecustomer/trashedCustomers';
$route['trash-customer/:any()'] = 'Managecustomer/trashCustomer/$1';
$route['change-customer-status/:any()'] = 'Managecustomer/changeStatus/$1';
$route['customer-detail/:any()']= 'Managecustomer/viewCustomer/$1';
$route['delete-customer/:any()'] = 'Managecustomer/deleteCustomer/$1';
/*
@ GST Setting routing
*/
$route['list-gst'] = 'Managegst/listGstValue';
$route['add-gst'] = 'Managegst/addGstValue';
$route['edit-gst/:any()'] = 'Managegst/editGstValue/$1';
$route['add-gst-action'] = 'Managegst/addGstAction';
$route['delete-gst/:any()'] = 'Managegst/deleteGst/$1';
/*
/*
@ Fuel Surcharge Setting routing
*/
$route['list-fuel-surcharge'] = 'Managefuelsurcharge/listFuelSurchargeValue';
$route['add-fuel-surcharge'] = 'Managefuelsurcharge/addFuelSurchargeValue';
$route['edit-fuel-surcharge/:any()'] = 'Managefuelsurcharge/editFuelSurchargeValue/$1';
$route['add-fuel-surcharge-action'] = 'Managefuelsurcharge/addFuelSurchargeAction';
$route['delete-fuel-surcharge/:any()'] = 'Managefuelsurcharge/deleteFuelSurcharge/$1';
/*
/*
@ Price list Setting routing
*/


$route['list-pricelist'] = 'Managepricelist/listPriceList';
$route['add-pricelist'] = 'Managepricelist/addPriceList';
$route['edit-pricelist/:any()'] = 'Managepricelist/editPriceList/$1';
$route['add-pricelist-action'] = 'Managepricelist/addPriceListAction';
$route['change-pricelist-status/:any()'] = 'Managepricelist/changeStatus/$1';
$route['delete-pricelist/:any()'] = 'Managepricelist/deletePriceList/$1';
/*
@ Zones Setting routing
*/
$route['list-zones/:any()'] = 'Managezones/listZoneValue/$1';
$route['add-zone/:any()'] = 'Managezones/addZoneValue/$1';
$route['edit-zone/:any()'] = 'Managezones/editZoneValue/$1';
$route['add-zone-action'] = 'Managezones/addZoneAction';
$route['delete-zone/:any()'] = 'Managezones/deleteZone/$1';
/**********zone countries***********/
$route['zone-countries/:any()'] = 'Managezones/ZoneCountries/$1';
$route['add-zone-countries/:any()'] = 'Managezones/addZoneCountriesValue/$1';
$route['add-zone-countries-action'] = 'Managezones/addZoneCountriesAction';
$route['delete-zone-country/:any()'] = 'Managezones/deleteZoneCountry/$1';
$route['delete-zone-countries'] = 'Managezones/deleteZoneCountries';
/*
/*
@ weight and prices routing
*/
$route['zone-weight-prices/:any()'] = 'Manageweightprices/listWeightPrices/$1';
$route['add-weight-price/:any()'] = 'Manageweightprices/addWeightPrice/$1';
$route['edit-weight-price/:any()'] = 'Manageweightprices/editWeightPrice/$1';
$route['add-weight-price-action'] = 'Manageweightprices/addWeightPriceAction';
$route['delete-weight-price/:any()'] = 'Manageweightprices/deleteWeightPrice/$1';
$route['upload-wp-csv']	= 'Manageweightprices/uploadWpCsv';
$route['upload-wp-action'] = 'Manageweightprices/uploadWpCsvAction';
$route['get-wp-zone'] = 'Manageweightprices/getWpZones';

/*
 *
 * Frieght cost routing
 */

$route['list-pricelist-f'] = 'ManagepricelistF/listPriceList';
$route['add-pricelist-f'] = 'ManagepricelistF/addPriceList';
$route['edit-pricelist-f/:any()'] = 'ManagepricelistF/editPriceList/$1';
$route['add-pricelist-action-f'] = 'ManagepricelistF/addPriceListAction';
$route['change-pricelist-status-f/:any()'] = 'ManagepricelistF/changeStatus/$1';
$route['delete-pricelist-f/:any()'] = 'ManagepricelistF/deletePriceList/$1';
/*
@ Zones Setting routing
*/
$route['list-zones-f/:any()'] = 'ManagezonesF/listZoneValue/$1';
$route['add-zone-f/:any()'] = 'ManagezonesF/addZoneValue/$1';
$route['edit-zone-f/:any()'] = 'ManagezonesF/editZoneValue/$1';
$route['add-zone-action-f'] = 'ManagezonesF/addZoneAction';
$route['delete-zone-f/:any()'] = 'ManagezonesF/deleteZone/$1';
/**********zone countries***********/
$route['zone-countries-f/:any()'] = 'ManagezonesF/ZoneCountries/$1';
$route['add-zone-countries-f/:any()'] = 'ManagezonesF/addZoneCountriesValue/$1';
$route['add-zone-countries-action-f'] = 'ManagezonesF/addZoneCountriesAction';
$route['delete-zone-country-f/:any()'] = 'ManagezonesF/deleteZoneCountry/$1';
$route['delete-zone-countries-f'] = 'ManagezonesF/deleteZoneCountries';
/*
/*
@ weight and prices routing
*/
$route['zone-weight-prices-f/:any()'] = 'ManageweightpricesF/listWeightPrices/$1';
$route['add-weight-price-f/:any()'] = 'ManageweightpricesF/addWeightPrice/$1';
$route['edit-weight-price-f/:any()'] = 'ManageweightpricesF/editWeightPrice/$1';
$route['add-weight-price-action-f'] = 'ManageweightpricesF/addWeightPriceAction';
$route['delete-weight-price-f/:any()'] = 'ManageweightpricesF/deleteWeightPrice/$1';
$route['upload-wp-csv-f']	= 'ManageweightpricesF/uploadWpCsv';
$route['upload-wp-action-f'] = 'ManageweightpricesF/uploadWpCsvAction';
$route['get-wp-zone-f'] = 'ManageweightpricesF/getWpZones';

/*
 *
 *
 *
@ Shipments routing
differ-shipment
*/


$route['differ-shipment'] = 'Manageshipments/differShipment';
$route['add-note-action'] = 'Manageshipments/addNewNote';
$route['problem-shipments'] = 'Manageshipments/problemShipment';
$route['solved-issues'] = 'Manageshipments/solvedIssues';
$route['list-differ-data'] = 'Manageshipments/listDifferData';

$route['operation-shipments'] = 'Manageshipments/operationShipment';
$route['list-operation-shipments'] = 'Manageshipments/listOperationShipment';

$route['admin-shipments'] = 'Manageshipments/adminShipment';
$route['list-admin-shipments'] = 'Manageshipments/listAdminShipment';




$route['list-shipments'] = 'Manageshipments/listShipment';
$route['export-shipments'] = 'Manageshipments/listExportShipment';
$route['list-account-shipments'] = 'Manageshipments/listAccountShipment';
$route['account-shipments'] = 'Manageshipments/accountShipment';

$route['list-data'] = 'Manageshipments/listData';
$route['list-problem-data'] = 'Manageshipments/listProblemData';
$route['list-solved-data'] = 'Manageshipments/listSolvedIssues';


$route['new-shipment'] = 'Manageshipments/addShipment';
$route['edit-shipment/:any()'] = 'Manageshipments/editShipment/$1';
$route['add-shipment-action'] = 'Manageshipments/addShipmentAction';
$route['change-opration-status/:any()'] = 'Manageshipments/changeOpStatus/$1';
$route['change-csd-status/:any()'] = 'Manageshipments/changecsdStatus/$1';
$route['change-acc-status/:any()'] = 'Manageshipments/changeAccStatus/$1';
$route['change-adm-status/:any()'] = 'Manageshipments/changeAdmStatus/$1';
$route['restore-shipment/:any()'] = 'Manageshipments/restoreShipment/$1';

$route['get-customer-info'] = 'Manageshipments/getCustomerInfo';
$route['get-zone-countries'] = 'Manageshipments/getZoneCountries';
$route['get-rate-list'] = 'Manageshipments/getRateList';
$route['upload-shipments'] = 'Manageshipments/uploadShipment';
$route['upload-shipment-action'] = 'Manageshipments/uploadShipmentAction';
$route['show-shipment/:any()'] = 'Manageshipments/showShipment/$1';
$route['trashed-shipment'] = 'Manageshipments/trashedShipment';
$route['trash-shipment/:any()'] = 'Manageshipments/trashShipment/$1';
$route['delete-shipment/:any()'] = 'Manageshipments/deleteShipment/$1';
/*Actions on shipment*/
$route['get-shipment-csv'] = 'Manageshipments/csvShipment';
$route['get-shipment-pdf'] = 'Manageshipments/pdfShipment';
$route['change-group-status'] = 'Manageshipments/statusGroup';
/*Ledger*/
$route['shipment-ledger']='Manageledger/listLedger';
$route['ledger-list']='Manageledger/listLedgerData';
$route['ledger-pdf']='Manageledger/pdfLedgerData';
$route['ledger-pdf-report']='Dashboard/pdfLedgerData';
$route['ledger-excel']='Manageledger/excelLedgerData';
$route['add-open-balance']='Manageledger/addOpenBalance';
$route['add-credit-balance']='Manageledger/addCreditBalance';
$route['add-payment-balance']='Manageledger/addPaymentBalance';
$route['add-balance-action']='Manageledger/addBalanceAction';
/*
@ General routing 
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['upload-invoice'] = 'Manageshipments/uploadInvoice';
$route['upload-invoice-action'] = 'Manageshipments/uploadInvoiceAction';


/*
 * List routes
 */
$route['report-user'] = 'Dashboard/reportUser';
$route['report-user-pdf'] = 'Dashboard/reportUserPdf';
$route['report-user-csv'] = 'Dashboard/reportUserCsv';

//branches

$route['report-branches'] = 'Dashboard/reportBranches';
$route['report-branches-pdf'] = 'Dashboard/reportBranchesPdf';
$route['report-branches-csv'] = 'Dashboard/reportBranchesCsv';

//customer

$route['report-customer'] = 'Dashboard/reportCustomer';
$route['report-customer-pdf'] = 'Dashboard/reportCustomerPdf';
$route['report-customer-csv'] = 'Dashboard/reportCustomerCsv';

//in transit
$route['report-transit'] = 'Dashboard/reportTransit';

$route['report-delivered'] = 'Dashboard/reportDelivered';
$route['report-lost'] = 'Dashboard/reportLost';
$route['report-problem'] = 'Dashboard/reportProblem';
$route['report-refunded'] = 'Dashboard/reportRefunded';
$route['report-partial'] = 'Dashboard/reportPartial';
$route['report-manifest'] = 'Dashboard/reportManifest';
$route['report-un-manifest'] = 'Dashboard/reportUnManifest';
$route['report-checked'] = 'Dashboard/reportChecked';
$route['report-un-checked'] = 'Dashboard/reportUnChecked';
$route['report-billed'] = 'Dashboard/reportBilled';
$route['report-un-billed'] = 'Dashboard/reportUnBilled';
$route['report-without-dhl'] = 'Dashboard/reportWithOutDhl';
$route['report-cash'] = 'Dashboard/reportCash';
$route['report-booked'] = 'Dashboard/reportBooked';
$route['report-ledger'] = 'Dashboard/reportLedger';
//cost price and profit
//cost price and profit
$route['report-cost-price'] = 'Dashboard/costPrice';
$route['report-cost-profit'] = 'Dashboard/costProfit';

$route['list-cost-data'] = 'Dashboard/listCostData';
$route['list-profit-data'] = 'Dashboard/listProfitData';
