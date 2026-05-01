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

namespace block_library\output;
defined('MOODLE_INTERNAL') || die();

use renderable;
use renderer_base;
use templatable;

require_once($CFG->dirroot."/local/library/classes/library.php");

class main implements renderable, templatable {
    public function __construct(){
        
    }
    public function export_for_template(renderer_base $output){
	    global $CFG, $COURSE, $cm;
		$library = new \library("", null, 'post', '', null, true, null);
		$books_library = $library->nav_incourse();
		$html = '';
		
		if($books_library != "" || is_siteadmin()){
			$html .= '<link rel="stylesheet" type="text/css" href="'.$CFG->wwwroot.'/local/library/style.css?v='.time().'" />';
			$html .= '<link rel="stylesheet" type="text/css" href="'.$CFG->wwwroot.'/blocks/library/style.css?v='.time().'" />';
			$html .= '<nav class="library-nav-group">';
				$html .= '<div class="library-nav-header">'.get_string('pluginname', 'local_library').'</div>';
				$html .= '<div class="library-nav-body">';
					$html .= $library->nav_incourse();
				$html .= '</div>';
				if(is_siteadmin()){
					$html .= '<div class="library-nav-footer">';
						$html .= '<a href="'.$CFG->wwwroot.'/local/library/editcourse.php?idcourse='.$COURSE->id.'&idcm='.$cm->id.'" class="btn btn-primary" title="Configurar">Configurar</a>';
					$html .= '</div>';
				}
			$html .= '</nav>';
		}
        $defaultvariables = array(
            'nav_incourse' => $html
        );
        return $defaultvariables;

    }
}