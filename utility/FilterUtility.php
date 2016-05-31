<?php
namespace app\utility;

use yii;
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

    $categoryId = 1;
    $categoryProperties = CategoryProperty::find()->where(['category_id' => $categoryId])->all();
    $categories = array();
    foreach ($categoryProperties as $property) {
      $categories[$property['property_id']] = $property['category_data_type'];
    }

    foreach ($this->filterObj as $name => $filterProperty) {
      if($name != '_csrf') {
        array_push($this->filters, ['property_id' => str_replace('property_','',$name), 'property_value' => $filterProperty,
          'property_type' => $categories[intval(str_replace('property_','',$name))]]);
      }
    }

    $this->getVendorValues($this->filters);
  }

  public function getVendors() {
    return $this->vendors;
  }

  public function resetVendors() {
    $this->vendors = array();
  }

  private function prepareQuery($valuesAry) {
    $str = 'SELECT * FROM mob_properties_values where';
    foreach ($valuesAry as $key => $property) {
      if($property['property_type'] == 'I') {
        $values = explode('-', $property['property_value']);
        if(count($values) == 2) {
          $str .= "(property_id =" . $property['property_id'] . " AND property_value BETWEEN " . $values[0] . " AND " . $values[1] . ")";
        } else {
          $value = str_replace('+', '', $property['property_value']);
          $str .= "(property_id =" . $property['property_id'] . " AND property_value >= " . $value . ")";
        }
      } else {
        $str .= "(property_id =" . $property['property_id'] . " AND property_value = '" . $property['property_value'] . "')";
      }

      if($key < (count($valuesAry) - 1))
        $str .= ' OR ';
    }

    return $str;
  }

  private function getVendorValues($valuesAry) {
    $str = $this->prepareQuery($valuesAry);
    $connection = Yii::$app->getDb();
    $query = $connection->createCommand($str)->queryAll();

    $vendors = array();
    foreach ($query as $key => $value) {
      if(!isset($vendors[$value['vendor_id']])) {
        $vendors[$value['vendor_id']] = array();
      }
      $vendors[$value['vendor_id']][$value['property_id']] = $value['property_value'];
    }

    $filterMembers = array();
    foreach ($vendors as $id => $props) {
      $bValid = true;
      foreach ($valuesAry as $key => $property) {
        if (isset($props[$property['property_id']])) {
          if ($property['property_type'] != 'I') {
            if ($property['property_value'] != $props[$property['property_id']]) {
              $bValid = false;
              break;
            }
          } else {
            $values = explode('-', $property['property_value']);
            if(count($values) == 2) {
              if ($props[$property['property_id']] < $values[0] || $props[$property['property_id']] > $values[1]) {
                $bValid = false;
                break;
              }
            } else {
              $value = str_replace('+', '', $property['property_value']);
              if ($props[$property['property_id']] < $value) {
                $bValid = false;
                break;
              }
            }
          }
        } else {
          $bValid = false;
          break;
        }
      }

      if ($bValid) {
        $filterMembers[] = $id;
      }
    }
    $this->prepareVendorArray($filterMembers);
  }

  private function prepareVendorArray($vendorIds) {
    $vendors = Vendors::find()->where(['vendor_id' => $vendorIds])->all();
    $this->vendors = $vendors;
  }
}
