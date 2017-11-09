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
 * IP restriction course configutation page.
 *
 * @package     tool_iprestriction
 * @copyright   2017 Matt Porritt <mattp@catalyst-au.net>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
require_once(__DIR__.'/lib.php');

defined('MOODLE_INTERNAL') || die();

$contextid = required_param('contextid', PARAM_INT);
$courseid = required_param('courseid', PARAM_INT);
$context = context::instance_by_id($contextid, MUST_EXIST);


$PAGE->set_context($context);
$PAGE->set_url('/admin/tool/sentiment_forum/edit.php',
        array('contextid' => $context->id, 'courseid' => $courseid)
        );
$PAGE->set_title(get_string('pluginname', 'tool_iprestriction'));
$PAGE->set_heading(get_string('pluginname', 'tool_iprestriction'));

require_login();

// Output the whole shebang.
echo $OUTPUT->header();
// Some content goes here.
echo $OUTPUT->footer();
