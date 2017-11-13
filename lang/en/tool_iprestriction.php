<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Plugin strings are defined here.
 *
 * @package     tool_iprestriction
 * @category    string
 * @copyright   2017 Matt Porritt <mattp@catalyst-au.net>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'IP Restriction';
$string['pluginnamedesc'] = 'Course IP Restriction configuration settings.';

$string['badip'] = 'The IP is {$a} invalid.';
$string['cachedef_restrictions'] = 'IP restriction values cache';
$string['enable'] = 'Enable';
$string['enablerestriction'] = 'Enable IP Restriction';
$string['enablerestriction_help'] = 'Enable (check) or disable (uncheck) IP whitelisting for this course';
$string['formdescription'] = 'This form controls the IP restrcition settings for this course.';
$string['ipblocked'] = 'access to this course has been restricted. Your IP address {$a} is not white listed.';
$string['whitelistips'] = 'IP Whitelist';
$string['whitelistips_help'] = 'Enter the IP adresses that are allowed to access this course. One IP per line.';
