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
    if (!$PAGE->course || $PAGE->course->id == SITEID || !has_capability('tool/iprestriction:manageiprestrictions', $context)) {
        return null;
    }

    $url = new moodle_url('/admin/tool/iprestriction/edit.php',
            array('courseid' => $course->id)
            );
    $pluginname = get_string('pluginname', 'tool_iprestriction');

    // Add the configuration page link.
    $navigation->add($pluginname, $url, navigation_node::TYPE_SETTING, null, null, new pix_icon('i/settings', ''));
}

/**
 * Check if users IP is whitelisted for the course they are
 * trying to access. Non whitelisted IPs receive an error.
 * Does not apply to site administrators.
 * Function is called by Moodle at the end of require_login().
 *
 * @param object|integer $courseorid Course to check.
 * @param bool $autologinguest Are guests automatically logged in.
 * @param context $cm Context.
 * @param string $setwantsurltome Requested URL.
 * @param bool $preventredirect Stop Moodle redirects.
 */
function tool_iprestriction_after_require_login(
        $courseorid,
        $autologinguest=true,
        $cm=null,
        $setwantsurltome=true,
        $preventredirect=false) {

    if (is_object($courseorid)) {
        $courseid = $courseorid->id;
    } else {
        $courseid = $courseorid;
    }

    // Get whitelisted IPs for course.
    $manager = new \tool_iprestriction\restriction_manager();
    $ips = $manager->get_restriction($courseid);

    // Check if user IP is in whitelist.
    if ($ips && !remoteip_in_list($ips)) {
        print_error(get_string('ipblocked', 'tool_iprestriction', getremoteaddr(null)));
    }
}

