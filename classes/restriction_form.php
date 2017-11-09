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
 * The mform for creating and editing course IP restrictions.
 *
 * @package     tool_iprestriction
 * @copyright   2017 Matt Porritt <mattp@catalyst-au.net>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_iprestriction;

require_once($CFG->dirroot.'/lib/formslib.php');

/**
 * The mform for creating and editing a rule.
 *
 * @package     tool_iprestriction
 * @copyright   2017 Matt Porritt <mattp@catalyst-au.net>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restriction_form extends \moodleform {

    /**
     * Mform class definition
     *
     */
    public function definition () {
        $mform = $this->_form;

        $mform->addElement('static', 'formdescription', '', get_string('formdescription', 'tool_iprestriction'));

        $mform->addElement('advcheckbox', 'enablerestriction', get_string('enablerestriction', 'tool_iprestriction'), 
                get_string('enable', 'tool_iprestriction'));
        $mform->addHelpButton('enablerestriction', 'enablerestriction', 'tool_iprestriction');

        $mform->addElement('textarea', 'whitelistips', get_string('whitelistips', 'tool_iprestriction'), 'rows="10" cols="11"');
        $mform->addHelpButton('whitelistips', 'whitelistips', 'tool_iprestriction');

        // Action buttons.
        $this->add_action_buttons(true, get_string('savechanges'));
    }

    /**
     * Form validation
     *
     * @param array $data data from the form.
     * @param array $files files uploaded.
     *
     * @return array of errors.
     */
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        return $errors;
    }
}