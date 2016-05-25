<?php
namespace app\utility;

use app\models\Vendors;
use app\models\VendorsLocation;
use app\models\Category;
use app\models\CategoryProperty;
use app\models\CategoryPropertyValue;
use yii\db\Query;

class FilterUtility {

  /** constant declaration **/
  const TBL_CATEGORY_PROPERTY = 'mob_categories_properties';
  const TBL_CATEGORY_PROPERTY_VALUES = 'mob_properties_values';

  /** private declaration **/
  private $filterObj = null;
  private $vendors = null;
  private $vendorIds = null;
  private $filters = null;

  /** Methods **/
  public function __construct($reqObj) {
    $this->vendors = array();
    $this->filters = array();
    $this->filterObj = $reqObj;
    foreach ($this->filterObj as $name => $filterProperty) {
      if($name != '_csrf') {
        array_push($this->filters, ['property_id' => $name, 'property_value' => $filterProperty]);
      }
    }
    $this->getVendorForProperty();
  }

  public function getVendors() {
    return $this->vendors;
  }

  public function resetVendors() {
    $this->vendors = array();
  }

  private function isFilterProperty($property) {
    return strpos($property, 'property') >= 0 ? true : false;
  }

  private function getVendorForProperty() {
    print_r($this->filters);

    
  }

  private function loadVendorsFromId() {
    if(sizeof($this->vendorIds) > 0) {
      $query = new Query();
      $vendors = $query
          ->select('mob_vendor_master.*, mob_categories.category_title, mob_vendor_location.vendor_building_no,
            mob_vendor_location.vendor_city, mob_vendor_location.vendor_country, mob_vendor_location.vendor_latitude,
            mob_vendor_location.vendor_locality, mob_vendor_location.vendor_location_id, mob_vendor_location.vendor_longitude,
            mob_vendor_location.vendor_pincode, mob_vendor_location.vendor_state, mob_vendor_location.vendor_street')
          ->from('mob_vendor_master')
          ->leftJoin('mob_categories', '`mob_vendor_master`.`vendor_categories` = `mob_categories`.`category_id`')
          ->leftJoin('mob_vendor_location', '`mob_vendor_master`.`vendor_id` = `mob_vendor_location`.`vendor_id`')
          ->where(['mob_vendor_master.vendor_id' => $this->vendorIds]);
      $this->vendors = $vendors->all();
    }
  }
}
