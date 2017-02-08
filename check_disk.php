<?php

	#
	# USED SIZE
	#

	
	$filesystem_name = explode("-", $servicedesc);
	$filesystem_name = str_replace("_","/",substr($filesystem_name[1],1));
	$ds_name[1] = $filesystem_name;

	$opt[1] = "--vertical-label \"Bytes\" -l0 -b 1024 --title \"Filesystem: $filesystem_name usage for $hostname\" ";

	# BTOTAL
        $def[1] = "DEF:bytes_total=$RRDFILE[1]:$DS[1]:AVERAGE " ;
        # BUSED
        $def[1] .= "DEF:used_size=$RRDFILE[1]:$DS[2]:AVERAGE " ;

	# Filesystem used
	$def[1] .= rrd::gradient("used_size", "#4c9a00", "#85a600", "Used Size" );
        #$def[1] .= rrd::area("used_size", "#3E606F", "Bytes Used");

        $def[1] .= "GPRINT:used_size:LAST:\"%3.2lf %sB LAST \" ";
        $def[1] .= "GPRINT:used_size:MAX:\"%3.2lf %sB MAX \" ";
        $def[1] .= "GPRINT:used_size" . ':AVERAGE:"%3.2lf %sB AVERAGE \j" ';

        # Filesystem total
        $def[1] .= rrd::line1("bytes_total", "#000000", "Total Size");

        $def[1] .= "GPRINT:bytes_total:LAST:\"%3.2lf %sB LAST \" ";
        $def[1] .= "GPRINT:bytes_total:MAX:\"%3.2lf %sB MAX \" ";
        $def[1] .= "GPRINT:bytes_total" . ':AVERAGE:"%3.2lf %sB AVERAGE \j" ';

	$ds_name[3] = $filesystem_name;
        $opt[2] = "--vertical-label \"# inodes\" -l0 -b 1000 --title \"Filesystem: $filesystem_name inode usage for $hostname\" ";

	# ITOTAL
        $def[2] = "DEF:total_inodes=$RRDFILE[1]:$DS[3]:AVERAGE " ;
        # IUSED
        $def[2] .= "DEF:used_inodes=$RRDFILE[1]:$DS[4]:AVERAGE " ;
        
	# Used inodes
        $def[2] .= rrd::area("used_inodes", "#3E606F", "Used inodes");

        $def[2] .= "GPRINT:used_inodes:LAST:\"%.0lf LAST \" ";
        $def[2] .= "GPRINT:used_inodes:MAX:\"%.0lf MAX \" ";
        $def[2] .= "GPRINT:used_inodes" . ':AVERAGE:"%.0lf AVERAGE \j" ';

        # Total Inodes
        $def[2] .= rrd::line1("total_inodes", "#000000", "Total inodes");

        $def[2] .= "GPRINT:total_inodes:LAST:\"%.0lf LAST \" ";
        $def[2] .= "GPRINT:total_inodes:MAX:\"%.0lf MAX \" ";
        $def[2] .= "GPRINT:total_inodes" . ':AVERAGE:"%.0lf AVERAGE \j" ';	

?>
