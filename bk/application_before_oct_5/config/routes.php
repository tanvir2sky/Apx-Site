<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
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
/*
@ Shipments routing
*/
$route['list-shipments'] = 'Manageshipments/listShipment';
$route['new-shipment'] = 'Manageshipments/addShipment';
$route['edit-shipment/:any()'] = 'Manageshipments/editShipment/$1';
$route['add-shipment-action'] = 'Manageshipments/addShipmentAction';
$route['change-shipment-status/:any()'] = 'Manageshipments/changeStatus/$1';
$route['get-customer-info'] = 'Manageshipments/getCustomerInfo';
$route['get-zone-countries'] = 'Manageshipments/getZoneCountries';
$route['get-rate-list'] = 'Manageshipments/getRateList';
$route['upload-shipments'] = 'Manageshipments/uploadShipment';
$route['upload-shipment-action'] = 'Manageshipments/uploadShipmentAction';
$route['show-shipment/:any()'] = 'Manageshipments/showShipment/$1';
$route['trashed-shipment'] = 'Manageshipments/trashedShipment';
$route['trash-shipment/:any()'] = 'Manageshipments/trashShipment/$1';
$route['delete-shipment/:any()'] = 'Manageshipments/deleteShipment/$1';
/*
@ General routing 
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
