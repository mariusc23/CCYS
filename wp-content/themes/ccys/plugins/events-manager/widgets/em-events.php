widgets/em-events.php
echo '<ul class="events-list">';
$li_wrap = !preg_match('/^<li>/i', trim($instance['format']));
if ( count($events) > 0 ){
	foreach($events as $event){				
		if( $li_wrap ){
			echo '<li class="widget-event-li cf">'. $event->output($instance['format']) .'</li>';
		}else{
			echo $event->output($instance['format']);
		}
	}
}else{
