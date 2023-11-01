<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\Contentwarehouse;

class GoogleCloudContentwarehouseV1CustomWeightsMetadata extends \Google\Collection
{
  protected $collection_key = 'weightedSchemaProperties';
  protected $weightedSchemaPropertiesType = GoogleCloudContentwarehouseV1WeightedSchemaProperty::class;
  protected $weightedSchemaPropertiesDataType = 'array';

  /**
   * @param GoogleCloudContentwarehouseV1WeightedSchemaProperty[]
   */
  public function setWeightedSchemaProperties($weightedSchemaProperties)
  {
    $this->weightedSchemaProperties = $weightedSchemaProperties;
  }
  /**
   * @return GoogleCloudContentwarehouseV1WeightedSchemaProperty[]
   */
  public function getWeightedSchemaProperties()
  {
    return $this->weightedSchemaProperties;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudContentwarehouseV1CustomWeightsMetadata::class, 'Google_Service_Contentwarehouse_GoogleCloudContentwarehouseV1CustomWeightsMetadata');
