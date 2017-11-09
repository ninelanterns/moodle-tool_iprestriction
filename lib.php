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
 * Tool functions defined here.
 *
 * @package     tool_iprestriction
 * @copyright   2017 Matt Porritt <mattp@catalyst-au.net>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


/**
 * Adds a sentiment forum report link to the course admin menu.
 *
 * @param navigation_node $navigation The navigation node to extend
 * @param stdClass $course The course to object for the tool
 * @param context $context The context of the course
 * @return void|null return null if we don't want to display the node.
 */
function tool_iprestriction_extend_navigation_course($navigation, $course, $context) {
    global $PAGE;

    // Only add this settings item on non-site course pages.
    if (!$PAGE->course || $PAGE->course->id == SITEID) {
        return null;
    }

    $url = new moodle_url('/admin/tool/iprestriction/edit.php',
            array('contextid' => $context->id, 'courseid' => $course->id)
            );
    $pluginname = get_string('pluginname', 'tool_iprestriction');

    // TODO: add capability check.

    // Add the configuration page link.
    $navigation->add($pluginname, $url, navigation_node::TYPE_SETTING, null, null, new pix_icon('i/settings', ''));
}

/**
 *
 * @param unknown $courseorid
 * @param unknown $autologinguest
 * @param unknown $cm
 * @param unknown $setwantsurltome
 * @param unknown $preventredirect
 */
function tool_iprestriction_after_require_login($courseorid, $autologinguest, $cm, $setwantsurltome, $preventredirect) {
    // TODO: restriction functionality
}

