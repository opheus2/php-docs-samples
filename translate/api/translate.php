<?php
/**
 * Copyright 2016 Google Inc.
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
require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new Google\Cloud\Samples\Translate\TranslateCommand());
$application->add(new Google\Cloud\Samples\Translate\DetectLanguageCommand());
$application->add(new Google\Cloud\Samples\Translate\ListCodesCommand());
$application->add(new Google\Cloud\Samples\Translate\ListLanguagesCommand());
$application->run();
