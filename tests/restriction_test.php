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
 * Course IP restriction unit tests.
 *
 * @package     tool_iprestriction
 * @category    phpunit
 * @copyright   2017 Matt Porritt <mattp@catalyst-au.net>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

use \tool_iprestriction\restriction_manager;


class tool_iprestriction_testcase extends advanced_testcase {

    /**
     * Test update IP restriction.
     */
    public function test_update_restriction() {
        global $DB;
        $this->resetAfterTest(true);

        // Setup form data.
        $data = new \stdClass();
        $data->courseid = 1234;
        $data->enablerestriction = 1;
        $data->whitelistips = '127.0.0.1';

        // Process restriction.
        $manager = new restriction_manager();
        $manager->update_restriction($data);

        // Check result was saved in DB.
        $record = $DB->get_record('tool_iprestriction', array ('course' => $data->courseid));

        $this->assertEquals($data->courseid, $record->course);
        $this->assertEquals($data->enablerestriction, $record->enabled);
        $this->assertEquals($data->whitelistips, $record->ips);
    }

    /**
     * Test getting IP restriction for form.
     */
    public function test_get_restriction_form() {
        global $DB;
        $this->resetAfterTest(true);

        // Setup form data.
        $data = new \stdClass();
        $data->courseid = 1234;
        $data->enablerestriction = 1;
        $data->whitelistips = '127.0.0.1';

        // Process restriction.
        $manager = new restriction_manager();
        $manager->update_restriction($data);

        // Check result.
        $formdata = $manager->get_restriction_form($data->courseid);

        $this->assertEquals($data->courseid, $formdata->courseid);
        $this->assertEquals($data->enablerestriction, $formdata->enablerestriction);
        $this->assertEquals($data->whitelistips, $formdata->whitelistips);
    }

    /**
     * Test getting IP restriction.
     */
    public function test_get_restriction() {
        global $DB;
        $this->resetAfterTest(true);

        // Setup form data.
        $data = new \stdClass();
        $data->courseid = 1234;
        $data->enablerestriction = 1;
        $data->whitelistips = '127.0.0.1';

        // Process restriction.
        $manager = new restriction_manager();
        $manager->update_restriction($data);

        // Check result.
        $ips = $manager->get_restriction($data->courseid);

        $this->assertEquals($data->whitelistips, $ips);
    }

    /**
     * Test getting IP restriction.
     */
    public function test_get_restriction_disabled() {
        global $DB;
        $this->resetAfterTest(true);

        // Setup form data.
        $data = new \stdClass();
        $data->courseid = 1234;
        $data->enablerestriction = 0;
        $data->whitelistips = '127.0.0.1';

        // Process restriction.
        $manager = new restriction_manager();
        $manager->update_restriction($data);

        // Check result.
        $ips = $manager->get_restriction($data->courseid);

        $this->assertEquals('', $ips);
    }

}
