<?php
/**
 * LGM Theme functions and definitions
 *
 */

// a.l.e
$formidable_lgm_get_mail_done = false;

// Usage: [formidable_lgm_get_mail email=[x] name=[x] title=[x]][/formidable_lgm_get_mail]
// TODO: check if it is possible to avoid the mangling of the last " and of the new lines...
// as it is now, it does not fit our needs.
add_shortcode('formidable_lgm_get_mail', 'formidable_lgm_get_mail');
function formidable_lgm_get_mail($atts, $content="") {
	global $formidable_lgm_get_mail_done;
	extract(shortcode_atts(array('email' => '', 'name' => '', 'title' => ''), $atts));

        $message_template = 
// str_replace("\n", "%%0D%%0A\n", "Dear \$name
// str_replace("\n", "\n", "Dear \$name
// str_replace("\n", "D%%0A\n", "Dear \$name
// str_replace("\n", "D%%0A\n", "Dear \$name
str_replace("\n", "%%0D%%0A\n", "Dear \$name

We are happy to confirm that your proposal

$title

has been accepted and will
be part of the LGM 2015 program. The meeting takes place from

29^th April - 2^nd May in Toronto.

We ask you to confirm by responding to this mail that you are indeed
planning to join us in Toronto. Please do so before Friday 27^th February
so we can finalize the schedule!

If you asked for support from LGM, take into account that
reimbursements happen  after LGM, and cover travel costs only (economy
class, no accommodation etc.).

This year we have received more requests for reimbursement than usual
so we can't promise that we will be able to fully cover your travel
costs, but are working hard to collect the funds needed. For more
information: ".urlencode("http://libregraphicsmeeting.org/2015/travel/reimbursement/")."

If you need an invitation letter (for obtaining a Visa for example),
please read ".urlencode("http://libregraphicsmeeting.org/2015/travel/visas")." and
get in touch with us.

Latest news, the definitive programme, special events etc. will be
published on the LGM website.

We look forward to your contribution and to a great LGM!

For the LGM team,
Larisa Blazic");



	$message = strtr(
	    $message_template,
	    array (
		'$name' => $name,
		'$title' => str_replace('&', '%22%0A', $title),
		'$type' => $type
	    )
	);

	// $message = substr($message, 0, 1150);


        $content = sprintf(
		'{{{<a href="mailto:%s?subject=%s&body=%s&from=Larisa Blazic <lab_web@yahoo.com>">%s</a>}}}',
		$email,
		'LGM: '.str_replace(array('"', '&'), array('', '%26'), substr($title, 0, 50)),
            	$message,
		$content
	);
	if (false && !$formidable_lgm_get_mail_done) {
		echo("<pre>".print_r(debug_backtrace(), 1)."</pre>\n");
	}
	$formidable_lgm_get_mail_done = true;

	return $content;
}

$formidable_lgm_get_schedule_item_date = null;
$formidable_lgm_get_schedule_item_time = null;

add_shortcode('formidable_lgm_get_schedule_item', 'formidable_lgm_get_schedule_item');
/**
 * Usage: [formidable_lgm_get_mail email=[x] name=[x] title=[x]][/formidable_lgm_get_mail]
 * TODO: check if it is possible to avoid the mangling of the last " and of the new lines...
 * as it is now, it does not fit our needs.
 */
function formidable_lgm_get_schedule_item($atts, $content="") {
	global $formidable_lgm_get_schedule_item_date, $formidable_lgm_get_schedule_item_time;
	extract(shortcode_atts(array('start' => null, 'end' => null, 'date' => '', 'time' => '', 'duration' => '', 'speaker' => '', 'title' => '', 'summary' => '', 'type' => '', 'biography' => '', 'website' => ''), $atts));
	remove_filter('the_content', 'wpautop');
	remove_filter('the_content', 'wptexturize');
	// echo("<p>".$title."</p>");
	// echo("<p>".$type."</p>");
	switch ($type) {
		case "Presentation (20 minutes)":
			$type = "presentation";
		break;
		case "Birds of a Feather, discussion meeting, hackathon, etc. (2 hours or more)":
			$type = "meeting";
		break;
		case "BREAK":
			$type = "break";
		break;
		case "Workshop (1 or 2 hours)":
			$type = "workshop";
		break;
		default:
			$type = "other";
		break;
	}
	if ($start) {
		return "";
	}
	if ($end) {
		return "";
	}
	if ($_SERVER['REMOTE_ADDR'] == '178.192.49.222') {
		// echo($_SERVER['REMOTE_ADDR']."<br>");
		// echo("<pre>$label:\n".htmlentities(print_r($value, 1))."</pre>\n");
		// echo("<pre>summary:\n".htmlentities(print_r($summary, 1))."</pre>\n");
	}

	// $content = "{{{";
	$content = "";

	if ($date != $formidable_lgm_get_schedule_item_date) {
		$content .= '<h2 class="schedule_date">'.$date.'</h2>'."\n";
		$formidable_lgm_get_schedule_item_date = $date;
	}

	if ($time != $formidable_lgm_get_schedule_item_time) {
		// $content .= '<p class="schedule_time">'.date('H:i', strtotime($time)).'</p>'."\n";
		$content .= '<p class="schedule_time">'.$time.'</p>'."\n";
		$formidable_lgm_get_schedule_item_time = $time;
	}

	$summary = str_replace("\n", "<br>\n", $summary);
	if ($biography) {
		$biography = str_replace("\n", "<br>\n", $biography);
		$summary .= "<br><br>".$biography;
	}
	if ($website) {
		if (strpos($website, 'http') !== 0) {
			$website = 'http://'.$website;
		}
		$summary .= "<br><br><a href=\"".$website."\">".$website."</a>";
	}

	$schedule_item = "
		<div class='schedule_item schedule_item_$type'>
		<p class=\"schedule_speaker\">\$speaker</p>
		<h3 class=\"schedule_title\">\$title</h3>
		<p class=\"schedule_summary\">\$summary</p>
		</div>
	";

	$content .= strtr(
	    $schedule_item,
	    array (
		'$title' => $title,
		'$time' => $time,
		'$speaker' => $speaker,
		'$summary' => $summary
	    )
	);
	return $content;
}

if (!function_exists('lgm_debug')) {
function lgm_debug($value) {
	// if ($_SERVER['REMOTE_ADDR'] == '178.192.49.222') {
		// echo($_SERVER['REMOTE_ADDR']."<br>");
		// echo("<pre>$label:\n".htmlentities(print_r($value, 1))."</pre>\n");
	// }
}
}

add_shortcode('formidable_lgm_get_test', 'formidable_lgm_get_test');
function formidable_lgm_get_test($atts, $content="") {
	extract(shortcode_atts(array('name' => ''), $atts));
	return $content." (".$name.")\n\n<br>\n";
}
