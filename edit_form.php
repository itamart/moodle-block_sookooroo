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

class block_sookooroo_edit_form extends block_edit_form {

    protected function specific_definition($mform) {
        global $DB, $SITE, $CFG, $PAGE;

        // buttons
        //-------------------------------------------------------------------------------
    	$this->add_action_buttons();

        // Fields for editing HTML block title and contents.
        //--------------------------------------------------------------
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        //title
        $mform->addElement('text', 'config_title', get_string('title', 'block_sookooroo'));
        $mform->setDefault('config_title', get_string('pluginname','block_sookooroo'));
        $mform->setType('config_title', PARAM_MULTILANG);

        // Website id
        $mform->addElement('text', 'config_websiteid', get_string('websiteid', 'sookooroo'));
        $mform->setType('config_websiteid', PARAM_TEXT);
        $mform->addRule('config_websiteid', null, 'maxlength', 20, 'client');
        $mform->addHelpButton('config_websiteid', 'websiteid', 'sookooroo');

        // Room name
        $mform->addElement('text', 'config_room', get_string('room', 'sookooroo'));
        $mform->setType('config_room', PARAM_TEXT);
        $mform->addRule('config_room', null, 'maxlength', 30, 'client');
        $mform->addHelpButton('config_room', 'room', 'sookooroo');

        // Button text
        $mform->addElement('text', 'config_btn', get_string('btn', 'sookooroo'));
        $mform->setType('config_btn', PARAM_TEXT);
        $mform->addRule('config_btn', null, 'maxlength', 256, 'client');
        $mform->addHelpButton('config_btn', 'btn', 'sookooroo');


    }
}
