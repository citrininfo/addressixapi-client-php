<?php
/*
 * Copyright 2016 Meworla GmbH.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
 
/**
 * You only need this file if you are not using composer.
 * Why are you not using composer?
 * https://getcomposer.org/
 */

function addressix_api_client_autoload($class_name)
{
  $prefix = 'AddressixAPI';
  
  $classes = explode('\\', $class_name);
  
  // only handle our own namespace
  if ($classes[0] != $prefix) {
    return;
  }
  
  // get the relative class name
  $classes = array_slice($classes, 1);

  // get filename
  $filename = dirname(__FILE__) . '/' . implode('/', $classes) . '.php';

  // if the file exists, require it
  if (file_exists($filename)) {
    require $filename;
  }
}
spl_autoload_register('addressix_api_client_autoload');
