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

defined('MOODLE_INTERNAL') || die();

/**
 * Manage course IP restrictions.
 *
 * @package     tool_iprestriction
 * @copyright   2017 Matt Porritt <mattp@catalyst-au.net>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restriction_manager {

    /**
     *
     * @param unknown $data
     */
    public function update_restriction($data) {
        $record = new \stdClass();
        $record->course = $data->courseid;
        $record->enabled = $data->enablerestriction;
        $record->ips = trim($data->whitelistips);
        $record->timemodified = time();

        $this->restriction_upsert($record);

        // Set cache object for restriction.
        $iparray = preg_split("/\r\n|\n|\r/", $record->ips);
        $cache = \cache::make('tool_iprestriction', 'restrictions');
        $cache->set($record->course, $iparray);
    }

    /**
     *
     * @param unknown $courseid
     * @return \stdClass
     */
    public function get_restriction_form($courseid) {
        global $DB;
        $formdata = new \stdClass();
        $record = $DB->get_record('tool_iprestriction', array ('course' => $courseid));

        if ($record) {
            $formdata->courseid = $record->course;
            $formdata->enablerestriction = $record->enabled;
            $formdata->whitelistips = $record->ips;

        }

        return $formdata;
    }

    /**
     *
     * @param unknown $courseid
     * @return \stdClass
     */
    public function get_restriction($courseid, $ignorecache=false) {
        global $DB;

        $cache = \cache::make('tool_nla', 'values');
        $ips = $cache->get($courseid);
        if (!$ips || $ignorecache) {
            $field = $DB->get_field('tool_iprestriction', 'ips', array ('course' => $courseid, 'enabled' => 1));
            if ($field) {
                $ips = trim($field);
                $cache->set($courseid, $ips);
            }
        }

        return $ips;
    }

    /**
     * Provides upsert (insert and/or update) functionality
     * for records into the IP restriction table.
     *
     * @param object $record record to update or insert.
     * @return void
     */
    private function restriction_upsert($record) {
        global $DB;

        // Try Update.
        $id = $DB->get_field('tool_iprestriction', 'id', array ('course' => $record->course));
        if ($id) {
            $record->id = $id;
            $DB->update_record('tool_iprestriction', $record);
        } else {
            // Update failed try insert.
            $DB->insert_record('tool_iprestriction', $record, false);
        }
    }

}