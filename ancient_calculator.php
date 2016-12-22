<?php

function debugResult($choosable_ancients)
{
//	var_dump($choosable_ancients);
	print("---\n");
	foreach($choosable_ancients as $val)
	{
		var_dump(get_ancient_name($val));
	}
}

function get_ancient_name($id)
{
	global $ANCIENT_ID_TO_POS;
	global $ANCIENT_NAMES;

	return $ANCIENT_NAMES[$ANCIENT_ID_TO_POS[$id]];
}

function getAncientIDFromName($name)
{
	global $ANCIENT_ID_TO_POS;
	global $ANCIENT_NAMES;

	$offset = array_search($name,$ANCIENT_NAMES);
	$ancient_id = array_search($offset,$ANCIENT_ID_TO_POS);
	return $ancient_id;
}

function getRerollCost($num_purchased)
{
	global $ANCIENT_COST;
	return ceil($ANCIENT_COST[$num_purchased] / 3);
}

function purchaseAncient(&$num_purchased,$souls_spent,&$saved_seed)
{
	global $ANCIENT_COST;
	my_rand();
	my_rand();
	my_rand();
	$souls_spent += $ANCIENT_COST[$num_purchased];
	++$num_purchased;
	$saved_seed = getSeed();
	return $souls_spent;
}

function rerollAncientHelper($choosable_ancients,$new_ancients)
{
	$counter = 0;
	foreach($choosable_ancients as $choice)
	{
		foreach($new_ancients as $new)
		{
			if($choice == $new)
			{
				++$counter;
			}
		}
	}
	return $counter;
}

function rerollAncient($choosable_ancients,$seed_ancients,$possible_ancients,$chosen_ancients,$rerolls,$player_has_transcended)
{
	$num_same = 4;
	$new_ancients = NULL;
	while($num_same > 0)
	{
		my_rand();
		my_rand();
		my_rand();
		my_rand();
		$new_ancients =	computeNextAncients_helper($seed_ancients,$possible_ancients,$chosen_ancients,$rerolls,$player_has_transcended,getSeed());
		$num_same = rerollAncientHelper($choosable_ancients,$new_ancients);
	}
	return $new_ancients;
}

function checkDesired($choosable_ancients,&$chosen_ancients,&$num_purchased,&$souls_spent,&$saved_seed)
{
	global $ANCIENT_ID_TO_POS;

	foreach($choosable_ancients as $ancient)
	{
		if($ancient == getAncientIDFromName("Libertas") ||
			$ancient == getAncientIDFromName("Solomon") || 
			$ancient == getAncientIDFromName("Siyalatas"))
		{
			$souls_spent = purchaseAncient($num_purchased,$souls_spent,$saved_seed);
			$chosen_ancients[$ancient] = 1;
			return 0;
		}
	}
	return 1;
}

function computeNextAncients($json)
{
	$seed_ancients = array(29,5,19,4,15,8,3,9,14,13,28);
	$possible_ancients = array(3,4,5,6,7,
		8,9,10,11,12,
		13,14,15,16,17,
		18,19,20,21,22,
		23,24,25,26,27,
		28,29,30,31,32);
	$non_trans_ancients = array(30,10,7,6);
	$MAX_SOULS_TO_SPEND = 14;
	$chosen_ancients = array();
	$num_purchased = 0;
	$souls_spent = 0;
	$trans_count = 0;

	//remove ancients that become unavailable post-trans
	foreach($non_trans_ancients as $ancient_id)
	{
		$counter = 0;
		foreach($possible_ancients as $cur)
		{
			if($ancient_id == $cur)
			{
				array_splice($possible_ancients,$counter,1);
				--$counter;
			}
			++$counter;
		}
	}

	//initialize array
	foreach($possible_ancients as $ancient_id)
	{
		$chosen_ancients[$ancient_id] = 0;
	}


	$the_seed = $json->ancients->ancientsRoller->seed;
	if($the_seed === NULL)
	{
		$the_seed = floor($json->creationTimestamp * $json->numberOfTranscensions % 2147483646);
		#$the_seed = floor($json->creationTimestamp * $json->numberOfTranscensions % getrandmax());
	}
	$saved_seed = $the_seed;

	$rerolls = $json->ancients->numRerolls;
	$player_has_transcended = $json->transcendent;
	my_srand($the_seed);

	$choosable_ancients = computeNextAncients_helper($seed_ancients,$possible_ancients,$chosen_ancients,$rerolls,$player_has_transcended,$saved_seed);
	while(true)
	{
		while($num_purchased < 3 && $souls_spent < $MAX_SOULS_TO_SPEND)
		{
			if(checkDesired($choosable_ancients,$chosen_ancients,$num_purchased,$souls_spent,$saved_seed))
			{
				$choosable_ancients = rerollAncient($choosable_ancients,$seed_ancients,$possible_ancients,$chosen_ancients,$rerolls,$player_has_transcended);
				$souls_spent = $souls_spent + getRerollCost($num_purchased);
			} else {
				$choosable_ancients = computeNextAncients_helper($seed_ancients,$possible_ancients,$chosen_ancients,$rerolls,$player_has_transcended,$saved_seed);
			}
		}

		if($num_purchased == 3 && $souls_spent <= $MAX_SOULS_TO_SPEND)
		{
			print "You need to transcend $trans_count times.";
			break;
		} else {
			++$trans_count;
			$choosable_ancients = array();
			foreach($possible_ancients as $ancient_id)
			{
				$chosen_ancients[$ancient_id] = 0;
			}
			$num_purchased = 0;
			$souls_spent = 0;
			$the_seed = floor($json->creationTimestamp * ($json->numberOfTranscensions + $trans_count) % 2147483646);
			my_srand($the_seed);
		}

		if($trans_count > 100) { print "Error computing."; break; }
	}
}	

function computeNextAncients_helper($seed_ancients,$possible_ancients,$chosen_ancients,$rerolls,$player_has_transcended,$saved_seed)
{
	$presented_ancients = array();

	#Remove any ancients which have already been chosen.
	$counter = 0;
	while($counter < count($seed_ancients))
	{
		$ancient_id = $seed_ancients[$counter];
		if($chosen_ancients[$ancient_id] == 1)
		{
			array_splice($seed_ancients,$counter,1);
			--$counter;
		}
		++$counter;
	}

	#My code -- not from game, remove already-chosen ancients
	foreach($possible_ancients as $ancient)
	{
		if($chosen_ancients[$ancient] == 1)
		{
			array_splice($possible_ancients,array_search($ancient,$possible_ancients),1);
		}
	}

	//populate parts of the list.
	if($rerolls == 0 && !$player_has_transcended)
	{
		while(count($presented_ancients) < 4 && count($seed_ancients) > 0)
		{
			$ancient_id = 0;
			$ancient_id = array_shift($seed_ancients);
			$presented_ancients[$ancient_id] = $ancient_id;

			$counter = 0;
			while($counter < count($presented_ancients))
			{
				if($presented_ancients[$counter] == $ancient_id)
				{
					array_splice($presented_ancients,$counter,1);
					break;
				}
				++$counter;
			}
		}
	}

	//populate the rest of the list
	while(count($presented_ancients) < 4 && count($possible_ancients) > 0)
	{
		$rnd_ancient = my_range(0,count($possible_ancients) - 1);
		$ancient_id = $possible_ancients[$rnd_ancient];
		$presented_ancients[$ancient_id] = $ancient_id;
		array_splice($possible_ancients,$rnd_ancient,1);
	}

	my_srand($saved_seed);
	return $presented_ancients;
}

?>

