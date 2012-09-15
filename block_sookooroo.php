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
 * @package block
 * $subpackage sookooroo
 * @copyright 2012 Itamar Tzadok
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 *
 */
class block_sookooroo extends block_base {

    /**
     *
     */
    function init() {
        $this->title = get_string('pluginname','block_sookooroo');
    }

    /**
     *
     */
    function specialization() {
        global $CFG;

        $this->course = $this->page->course;

        // load userdefined title and make sure it's never empty
        if (empty($this->config->title)) {
            $this->title = get_string('pluginname','block_sookooroo');
        } else {
            $this->title = $this->config->title;
        }

        if (empty($this->config->websiteid)) {
            if (!empty($this->config->room)) {
                $this->config->websiteid = null;
                $this->config->room = null;
            }
            return false;
        }

        if (empty($this->config->room)) {
            return false;
        }
    }

    /**
     *
     */
    function instance_allow_multiple() {
        return true;
    }

    /**
     *
     */
    function get_content() {
        global $USER;

        if (empty($this->config->websiteid) or empty($this->config->room)) {
            return null;
        }

        $websiteid = $this->config->websiteid;
        $room = $this->config->room;
        $btntext = $this->config->btn;

        $page = $this->page;

        // Add the javascript
        $jsinclude = new moodle_url('http://api.sookooroo.com/Api/Vc', array('WebsiteId' => $websiteid));
        $page->requires->js($jsinclude);

        // Generate user pic
        $userpic = new user_picture($USER);

        $userid = isguestuser() ? '' : $USER->id;

        // Add the container
        $params = array(
            'class' => "Skr-room",
            'data-room' => $room,
            'data-cid' => $userid,
            'data-cname' => fullname($USER),
            'data-cpic' => $userpic->get_url($page),
            'data-iscidadmin' => has_capability('block/sookooroo:moderator', $this->context),
            'data-source' => 'moodle',
            'data-showfaces' => true,
            'data-width' => "180",
            'data-btn' => !empty($btntext) ? $btntext: '',
        );

        $content = html_writer::tag(
            'div',
            null,
            $params
        );

        $this->content = new object;
        $this->content->text = $content;
        $this->content->footer = '';

        return $this->content;
    }

    /**
     *
     */
    function hide_header() {
        if (isset($this->config->title) and empty($this->config->title)) {
            return true;
        }
        return false;
    }

}
