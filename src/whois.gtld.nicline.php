<?php

/*
  Whois2.php	PHP classes to conduct whois queries
  
  Copyright (C)1999,2000 easyDNS Technologies Inc. & Mark Jeftovic 
  
  Maintained by Mark Jeftovic <markjr@easydns.com>
  
  For the most recent version of this package: 
  
  http://www.easydns.com/~markjr/whois2/
  
  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.
  
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
  
  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/

/* NICLINE.whois 1.0	Carlos Galvez <cgalvez@espaciowww.com> */
/* NICLINE.whois 1.1	David Saez */
/* Example "niclide.com" */

if(!defined("__NICLINE_HANDLER__")) define("__NICLINE_HANDLER__",1);

require_once('whois.parser.php');

class nicline_handler {

	function parse ($data_str,$query) {

               $items = array( "owner" => "Registrant:",
                                "admin" => "Administrative contact:",
                                "tech" => "Technical contact:",
                                //"zone" => "Zone Contact",
                                "domain.name" => "Domain name:",
				"domain.nserver." => "Domain servers in listed order:",
                                "domain.created" => "Created:",
                                "domain.expires" => "Expires:",
                                "domain.changed" => "Last updated:"
                              );

                $r = get_blocks($data_str,$items);
                $r["owner"] = get_contact($r["owner"]);
                $r["admin"] = get_contact($r["admin"]);
                $r["tech"] = get_contact($r["tech"]);
                //$r["zone"] = get_contact($r["zone"]);
		$r=format_dates($r,'dmy');
                return($r);
	}
}
?>
