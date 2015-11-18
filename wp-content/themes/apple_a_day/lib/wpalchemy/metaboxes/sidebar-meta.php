<?php
$mb->the_field('sidebar-content');
wp_editor($mb->get_the_value(),$mb->get_the_name(),array());