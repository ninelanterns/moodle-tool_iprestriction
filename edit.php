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

$courseid = required_param('courseid', PARAM_INT);

$context = \context_course::instance($courseid);
$PAGE->set_context($context);
$PAGE->set_url('/admin/tool/sentiment_forum/edit.php',
        array('contextid' => $context->id, 'courseid' => $courseid)
        );
$PAGE->set_title(get_string('pluginname', 'tool_iprestriction'));
$PAGE->set_heading(get_string('pluginname', 'tool_iprestriction'));

require_login();

if (has_capability('tool/iprestriction:manageiprestrictions', $context)) {
    $manager = new \tool_iprestriction\restriction_manager();
    $formdata = $manager->get_restriction_form($courseid);
    $mform = new tool_iprestriction\restriction_form(null, array('courseid' => $courseid));
    $mform->set_data($formdata);

    if ($mform->is_cancelled()) {
        redirect(new moodle_url('/course/view.php', array('id' => $courseid)));
        exit();

    } else if ($mformdata = $mform->get_data()) {
        $manager->update_restriction($mformdata);
        redirect(new moodle_url('/course/view.php', array('id' => $courseid)));
        exit();

    } else {
        // Output the whole shebang.
        echo $OUTPUT->header();
        $mform->display();
        echo $OUTPUT->footer();
    }
} else {
    print_error('nopermissiontoshow');
}