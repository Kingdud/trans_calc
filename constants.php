<?php

$HP_SCALE_BASE = 1.145;
$HP_SCALE_INCREMENT = 0.005;

$HERO_NAMES = array("Cid","Treebeast","Ivan, the Drunken Brawler","Brittany, Beach Princess",
	"The Wandering Fisherman","Betty Clicker","The Masked Samurai","Leon","The Great Forest Seer",
	"Alexa, Assassin","Natalia, Ice Apprentice","Mercedes, Duchess of Blades",
	"Bobby, Bounty Hunter","Broyle Lindeoven, Fire Mage","Sir George II, King's Guard",
	"King Midas","Referi Jerator, Ice Wizard","Abaddon","Ma Zhu","Amenhotep","Beastlord",
	"Athena, Goddess of War","Aphrodite, Goddess of Love","Shinatobe, Wind Deity",
	"Grant, The General","Frostleaf","Dread Knight","Atlas","Terra","Phthalo",
	"Orntchya Gladeye, Didensy Banana","Lilin","Cadmia","Alabastar","Astraea","Chiron","Moloch",
	"Bomber Max","Gog","Wepwawet","Tsuchi","Skogur","Moeru","Zilar","Madzi");

$HERO_BASE_COST = array(
	5,		50,		250,		1E3,		4E3,		2E4,
	1E5,		4E5,		2.5E6,		1.5E7,		1E8,		8E8,
	6.5E9,		5E10,		4.5E11,		4E12,		3.6E13,		3.2E14,
	2.7E15,		2.4E16,		3E17,		9E18,		3.5E20,		1.4E22,
	4.199E24,	2.1E27,		1E40,		1E55,		1E70,		1E85,
	1E100,		1E115,		1E130,		1E145,		1E160,		8.376E174,
	1E190,		1E205,		1E220,		1E235,		1E500,		1E1000,
	1E2000,		1E4000,		1E8000);

$HERO_BASE_DPS = array(
	0,		5,		22,		74,		245,		976,
	3725,		10859,		47143,		1.86E5,		7.82E5,		3.721E6,
	1.7010E7,	6.906E7,	4.6E8,		3.017E9,	2.000E10,	1.31E11,
	8.14E11,	5.335E12,	4.914E13,	1.086E15,	3.112E16,	9.17E17,
	2.02E20,	7.4698E22,	1.31E32,	9.66E44,	7.113E59,	5.24E70,
	3.861E83,	2.845E96,	2.096E109,	1.544E122,	1.137E135,	8.376E147,
	6.171E160,	4.546E173,	3.349E186,	1.137E200,	1.820E425,	1.341E846,
	9.885E1678,	7.283E3333,	5.366E6630);

$HERO_PERSONAL_DPS_BONUS = array(
	209,		19,		19,		19,		7,		0,
	19,		7,		19,		4.0625,		19,		19,
	19,		9,		19,		0,		19,		10.390625,
	19,		1,		7,		15,		15,		7,
	3,		3,		19,		19,		19,		19,
	19,		19,		19,		19,		19,		19,
	19,		13,		13,		9.5,		14,		19,
	15,		10,		52.5);

$HERO_GROUP_DPS_BONUS = array(
	0,		0,		0,		0,		0.25,		1.0736,
	0,		0.25,		0,		0,		0,		0,
	0,		0.25,		0,		0,		0,		0,
	0,		0.44,		0.1,		0,		0,		0.1,
	0.5625,		0.25,		0,		0,		0,		0,
	0,		0,		0,		0,		0,		0,
	0,		0,		0.5,		0,		0,		0,
	0.5,		1.3438,		0);

$HERO_GOLD_BONUS = array(
	0,		0,		0,		0,		0,		0,
	0,		0,		0,		0,		0,		0,
	0,		0,		0,		1.93,		0,		0,
	0,		0,		0,		0,		0,		0,
	0,		0,		0,		0,		0,		0,
	0,		0,		0,		0,		0,		0,
	0,		0.5,		0,		0,		3,		0,
	0,		0,		0);

$ANCIENT_ID_TO_POS = array(
	0,	0,	0,	27,	19,
	25,	16,	28,	20,	21,
	23,	8,	11,	2,	9,
	4,	22,	7,	5,	12,
	29,	18,	6,	13,	3,
	26,	17,	10,	1,	15,
	14,	24,	30);

$ANCIENT_NAMES = array("null",
	"Argaiv","Atman","Berserker","Bhall","Bubos","Chawedo","Chronos",
	"Dogcog","Dora","Energon","Fortuna","Fragsworth","Hectatoncheir","Iris",
	"Juggernaut","Khrysos","Kleptos","Kumawakamaru","Libertas","Mammon","Mimzee",
	"Morgulis","Pluto","Revolc","Siyalatas","Sniperino","Solomon","Thusia",
	"Vaguur","Nogardnit");

$ANCIENT_COST = array(1,2,4,8,16,35,70,125,250,500,800,1200,1700,2200,2750,3400,4100,5000,6000,7500,10000,12500,16000,25000,35000,50000,70000,100000,150000,250000,400000,750000,1400000,2700000,5200000);

$OUTSIDER_NAMES = array("Xyliqil","Chor'gorloth","Phandoryss","Borb","Ponyboy");

$ANTI_CHEAT_CODE = "Fe12NAfA3R6z4k0z";
$SALT = "af0ik392jrmt0nsfdghy0";
?>
