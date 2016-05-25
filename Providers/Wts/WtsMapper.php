<?php

namespace Oni\TravelPortBundle\Providers\Wts;


final class  WtsMapper {

	const COUNTRIES = array (
		0 =>
			array (
				'code' => 'AF',
				'name' => 'AFGHANISTAN',
			),
		1 =>
			array (
				'code' => '111',
				'name' => 'ALBANIA',
			),
		2 =>
			array (
				'code' => '123',
				'name' => 'ALGERIA',
			),
		3 =>
			array (
				'code' => '108',
				'name' => 'ANDORRA',
			),
		4 =>
			array (
				'code' => '166',
				'name' => 'ANGUILLA',
			),
		5 =>
			array (
				'code' => 'ANT',
				'name' => 'Antartica',
			),
		6 =>
			array (
				'code' => '116',
				'name' => 'ANTIGUA and BARBUDA',
			),
		7 =>
			array (
				'code' => '73',
				'name' => 'ARGENTINA',
			),
		8 =>
			array (
				'code' => '147',
				'name' => 'ARMENIA',
			),
		9 =>
			array (
				'code' => '100',
				'name' => 'ARUBA',
			),
		10 =>
			array (
				'code' => '1',
				'name' => 'AUSTRALIA',
			),
		11 =>
			array (
				'code' => '2',
				'name' => 'AUSTRIA',
			),
		12 =>
			array (
				'code' => '142',
				'name' => 'AZERBAIJAN',
			),
		13 =>
			array (
				'code' => '101',
				'name' => 'BAHAMAS',
			),
		14 =>
			array (
				'code' => '106',
				'name' => 'BAHRAIN',
			),
		15 =>
			array (
				'code' => '3',
				'name' => 'BANGLADESH',
			),
		16 =>
			array (
				'code' => '102',
				'name' => 'BARBADOS',
			),
		17 =>
			array (
				'code' => '141',
				'name' => 'BELARUS',
			),
		18 =>
			array (
				'code' => '4',
				'name' => 'BELGIUM',
			),
		19 =>
			array (
				'code' => '158',
				'name' => 'BELIZE',
			),
		20 =>
			array (
				'code' => '179',
				'name' => 'BENIN',
			),
		21 =>
			array (
				'code' => '169',
				'name' => 'BOLIVIA',
			),
		22 =>
			array (
				'code' => '144',
				'name' => 'BOSNIA and HERZEGOVINA REPUBLIC',
			),
		23 =>
			array (
				'code' => '190',
				'name' => 'BOTSWANA',
			),
		24 =>
			array (
				'code' => '5',
				'name' => 'BRAZIL',
			),
		25 =>
			array (
				'code' => '129',
				'name' => 'BRITISH VIRGIN ISLANDS',
			),
		26 =>
			array (
				'code' => '89',
				'name' => 'BRUNEI DARUSSALAM',
			),
		27 =>
			array (
				'code' => '6',
				'name' => 'BULGARIA',
			),
		28 =>
			array (
				'code' => '178',
				'name' => 'BURKINA FASO',
			),
		29 =>
			array (
				'code' => '180',
				'name' => 'BURUNDI',
			),
		30 =>
			array (
				'code' => '90',
				'name' => 'CAMBODIA',
			),
		31 =>
			array (
				'code' => '160',
				'name' => 'CAMEROON',
			),
		32 =>
			array (
				'code' => '7',
				'name' => 'CANADA',
			),
		33 =>
			array (
				'code' => '139',
				'name' => 'CAPE VERDE',
			),
		34 =>
			array (
				'code' => '105',
				'name' => 'CAYMAN ISLANDS',
			),
		35 =>
			array (
				'code' => '181',
				'name' => 'CHAD',
			),
		36 =>
			array (
				'code' => '9',
				'name' => 'CHILE',
			),
		37 =>
			array (
				'code' => '10',
				'name' => 'CHINA',
			),
		38 =>
			array (
				'code' => '87',
				'name' => 'COLOMBIA',
			),
		39 =>
			array (
				'code' => '777',
				'name' => 'COMOROS',
			),
		40 =>
			array (
				'code' => '203',
				'name' => 'CONGO',
			),
		41 =>
			array (
				'code' => '194',
				'name' => 'COOK ISLANDS',
			),
		42 =>
			array (
				'code' => '150',
				'name' => 'COSTA RICA',
			),
		43 =>
			array (
				'code' => '177',
				'name' => 'COTE D IVOIRE',
			),
		44 =>
			array (
				'code' => '11',
				'name' => 'CROATIA',
			),
		45 =>
			array (
				'code' => '88',
				'name' => 'CUBA',
			),
		46 =>
			array (
				'code' => '12',
				'name' => 'CYPRUS',
			),
		47 =>
			array (
				'code' => '13',
				'name' => 'CZECH REPUBLIC',
			),
		48 =>
			array (
				'code' => 'demoaa',
				'name' => 'demo country',
			),
		49 =>
			array (
				'code' => '14',
				'name' => 'DENMARK',
			),
		50 =>
			array (
				'code' => '156',
				'name' => 'DJIBOUTI',
			),
		51 =>
			array (
				'code' => '91',
				'name' => 'DOMINICAN REPUBLIC',
			),
		52 =>
			array (
				'code' => 'EGY',
				'name' => 'EGYPT',
			),
		53 =>
			array (
				'code' => '157',
				'name' => 'EL SALVADOR',
			),
		54 =>
			array (
				'code' => '16',
				'name' => 'EQUADOR',
			),
		55 =>
			array (
				'code' => '201',
				'name' => 'ERITREA',
			),
		56 =>
			array (
				'code' => '17',
				'name' => 'ESTONIA',
			),
		57 =>
			array (
				'code' => '84',
				'name' => 'ETHIOPIA',
			),
		58 =>
			array (
				'code' => '76',
				'name' => 'FIJI ISLANDS',
			),
		59 =>
			array (
				'code' => '18',
				'name' => 'FINLAND',
			),
		60 =>
			array (
				'code' => '19',
				'name' => 'FRANCE',
			),
		61 =>
			array (
				'code' => '62',
				'name' => 'FRENCH POLYNESIA',
			),
		62 =>
			array (
				'code' => '20',
				'name' => 'FYROM',
			),
		63 =>
			array (
				'code' => '182',
				'name' => 'GABON',
			),
		64 =>
			array (
				'code' => '164',
				'name' => 'GAMBIA',
			),
		65 =>
			array (
				'code' => '118',
				'name' => 'GEORGIA',
			),
		66 =>
			array (
				'code' => '21',
				'name' => 'GERMANY',
			),
		67 =>
			array (
				'code' => '124',
				'name' => 'GHANA',
			),
		68 =>
			array (
				'code' => '77',
				'name' => 'GIBRALTAR',
			),
		69 =>
			array (
				'code' => '22',
				'name' => 'GREECE - ISLANDS',
			),
		70 =>
			array (
				'code' => '23',
				'name' => 'GREECE - MAINLAND',
			),
		71 =>
			array (
				'code' => '191',
				'name' => 'GREENLAND',
			),
		72 =>
			array (
				'code' => '115',
				'name' => 'GRENADA',
			),
		73 =>
			array (
				'code' => '110',
				'name' => 'GUADELOUPE',
			),
		74 =>
			array (
				'code' => '187',
				'name' => 'GUAM',
			),
		75 =>
			array (
				'code' => '119',
				'name' => 'GUATEMALA',
			),
		76 =>
			array (
				'code' => '183',
				'name' => 'GUINEA',
			),
		77 =>
			array (
				'code' => '86',
				'name' => 'HAITI',
			),
		78 =>
			array (
				'code' => '128',
				'name' => 'HONDURAS',
			),
		79 =>
			array (
				'code' => 'HKG',
				'name' => 'HONG KONG',
			),
		80 =>
			array (
				'code' => '26',
				'name' => 'HUNGARY',
			),
		81 =>
			array (
				'code' => '107',
				'name' => 'ICELAND',
			),
		82 =>
			array (
				'code' => '27',
				'name' => 'INDIA',
			),
		83 =>
			array (
				'code' => '28',
				'name' => 'INDONESIA',
			),
		84 =>
			array (
				'code' => '78',
				'name' => 'IRAN',
			),
		85 =>
			array (
				'code' => '79',
				'name' => 'IRAQ',
			),
		86 =>
			array (
				'code' => '29',
				'name' => 'IRELAND',
			),
		87 =>
			array (
				'code' => '30',
				'name' => 'ISRAEL',
			),
		88 =>
			array (
				'code' => '31',
				'name' => 'ITALY',
			),
		89 =>
			array (
				'code' => '32',
				'name' => 'JAMAICA',
			),
		90 =>
			array (
				'code' => '33',
				'name' => 'JAPAN',
			),
		91 =>
			array (
				'code' => '34',
				'name' => 'JORDAN',
			),
		92 =>
			array (
				'code' => '173',
				'name' => 'KAZAKHSTAN',
			),
		93 =>
			array (
				'code' => '80',
				'name' => 'KENYA',
			),
		94 =>
			array (
				'code' => 'KW',
				'name' => 'KUWAIT',
			),
		95 =>
			array (
				'code' => '175',
				'name' => 'KYRGYZSTAN',
			),
		96 =>
			array (
				'code' => '159',
				'name' => 'LAOS',
			),
		97 =>
			array (
				'code' => '36',
				'name' => 'LATVIA',
			),
		98 =>
			array (
				'code' => '37',
				'name' => 'LEBANON',
			),
		99 =>
			array (
				'code' => '192',
				'name' => 'LIBERIA',
			),
		100 =>
			array (
				'code' => '172',
				'name' => 'LIBYA',
			),
		101 =>
			array (
				'code' => '154',
				'name' => 'LIECHTENSTEIN',
			),
		102 =>
			array (
				'code' => '120',
				'name' => 'LITHUANIA',
			),
		103 =>
			array (
				'code' => '38',
				'name' => 'LUXEMBOURG',
			),
		104 =>
			array (
				'code' => 'MO',
				'name' => 'MACAU',
			),
		105 =>
			array (
				'code' => '39',
				'name' => 'MALAYSIA',
			),
		106 =>
			array (
				'code' => '40',
				'name' => 'MALDIVES',
			),
		107 =>
			array (
				'code' => '41',
				'name' => 'MALTA',
			),
		108 =>
			array (
				'code' => '153',
				'name' => 'MARTINIQUE',
			),
		109 =>
			array (
				'code' => '185',
				'name' => 'MAURITANIA',
			),
		110 =>
			array (
				'code' => '42',
				'name' => 'MAURITIUS',
			),
		111 =>
			array (
				'code' => '43',
				'name' => 'MEXICO',
			),
		112 =>
			array (
				'code' => '195',
				'name' => 'MICRONESIA',
			),
		113 =>
			array (
				'code' => '113',
				'name' => 'MOLDOVA',
			),
		114 =>
			array (
				'code' => '85',
				'name' => 'MONACO',
			),
		115 =>
			array (
				'code' => '193',
				'name' => 'MONGOLIA',
			),
		116 =>
			array (
				'code' => '200',
				'name' => 'MONTENEGRO',
			),
		117 =>
			array (
				'code' => '44',
				'name' => 'MOROCCO',
			),
		118 =>
			array (
				'code' => '204',
				'name' => 'MOZAMBIQUE',
			),
		119 =>
			array (
				'code' => '148',
				'name' => 'MYANMAR',
			),
		120 =>
			array (
				'code' => '161',
				'name' => 'NAMIBIA',
			),
		121 =>
			array (
				'code' => '45',
				'name' => 'NEPAL',
			),
		122 =>
			array (
				'code' => '24',
				'name' => 'NETHERLANDS',
			),
		123 =>
			array (
				'code' => '93',
				'name' => 'NETHERLANDS ANTILLES',
			),
		124 =>
			array (
				'code' => '122',
				'name' => 'NEW CALEDONIA',
			),
		125 =>
			array (
				'code' => '46',
				'name' => 'NEW ZEALAND',
			),
		126 =>
			array (
				'code' => '96',
				'name' => 'NICARAGUA',
			),
		127 =>
			array (
				'code' => '152',
				'name' => 'NIGERIA',
			),
		128 =>
			array (
				'code' => '205',
				'name' => 'NORTHERN CYPRUS',
			),
		129 =>
			array (
				'code' => '184',
				'name' => 'NORTHERN MARIANA ISLANDS',
			),
		130 =>
			array (
				'code' => '47',
				'name' => 'NORWAY',
			),
		131 =>
			array (
				'code' => '146',
				'name' => 'OMAN',
			),
		132 =>
			array (
				'code' => '97',
				'name' => 'PAKISTAN',
			),
		133 =>
			array (
				'code' => '196',
				'name' => 'PALAU',
			),
		134 =>
			array (
				'code' => '198',
				'name' => 'PALESTINIAN AUTHORITIES',
			),
		135 =>
			array (
				'code' => '162',
				'name' => 'PANAMA',
			),
		136 =>
			array (
				'code' => '149',
				'name' => 'PARAGUAY',
			),
		137 =>
			array (
				'code' => '98',
				'name' => 'PERU',
			),
		138 =>
			array (
				'code' => '48',
				'name' => 'PHILIPPINES',
			),
		139 =>
			array (
				'code' => '49',
				'name' => 'POLAND',
			),
		140 =>
			array (
				'code' => '50',
				'name' => 'PORTUGAL',
			),
		141 =>
			array (
				'code' => '51',
				'name' => 'PUERTO RICO',
			),
		142 =>
			array (
				'code' => '168',
				'name' => 'QATAR',
			),
		143 =>
			array (
				'code' => '52',
				'name' => 'ROMANIA',
			),
		144 =>
			array (
				'code' => '53',
				'name' => 'RUSSIA',
			),
		145 =>
			array (
				'code' => '186',
				'name' => 'RWANDA',
			),
		146 =>
			array (
				'code' => '202',
				'name' => 'SAINT VINCENT and THE GRENADINES',
			),
		147 =>
			array (
				'code' => '54',
				'name' => 'SAN MARINO',
			),
		148 =>
			array (
				'code' => '176',
				'name' => 'SAO TOME and PRINCIPE',
			),
		149 =>
			array (
				'code' => '95',
				'name' => 'SAUDI ARABIA',
			),
		150 =>
			array (
				'code' => '130',
				'name' => 'SENEGAL',
			),
		151 =>
			array (
				'code' => '109',
				'name' => 'SERBIA',
			),
		152 =>
			array (
				'code' => '81',
				'name' => 'SEYCHELLES',
			),
		153 =>
			array (
				'code' => '55',
				'name' => 'SINGAPORE',
			),
		154 =>
			array (
				'code' => '94',
				'name' => 'SLOVAKIA',
			),
		155 =>
			array (
				'code' => '99',
				'name' => 'SLOVENIA',
			),
		156 =>
			array (
				'code' => '56',
				'name' => 'SOUTH AFRICA',
			),
		157 =>
			array (
				'code' => '57',
				'name' => 'SOUTH KOREA',
			),
		158 =>
			array (
				'code' => '58',
				'name' => 'SPAIN',
			),
		159 =>
			array (
				'code' => '59',
				'name' => 'SRI LANKA',
			),
		160 =>
			array (
				'code' => '167',
				'name' => 'ST. BARTHELEMY',
			),
		161 =>
			array (
				'code' => '114',
				'name' => 'ST. LUCIA',
			),
		162 =>
			array (
				'code' => '145',
				'name' => 'ST. MARTIN (FR)',
			),
		163 =>
			array (
				'code' => '103',
				'name' => 'ST.KITTS and NEVIS',
			),
		164 =>
			array (
				'code' => '151',
				'name' => 'SUDAN',
			),
		165 =>
			array (
				'code' => '188',
				'name' => 'SURINAME',
			),
		166 =>
			array (
				'code' => '199',
				'name' => 'SWAZILAND',
			),
		167 =>
			array (
				'code' => '60',
				'name' => 'SWEDEN',
			),
		168 =>
			array (
				'code' => '61',
				'name' => 'SWITZERLAND',
			),
		169 =>
			array (
				'code' => '74',
				'name' => 'SYRIA',
			),
		170 =>
			array (
				'code' => '63',
				'name' => 'TAIWAN',
			),
		171 =>
			array (
				'code' => '170',
				'name' => 'TAJIKISTAN',
			),
		172 =>
			array (
				'code' => '112',
				'name' => 'TANZANIA',
			),
		173 =>
			array (
				'code' => '64',
				'name' => 'THAILAND',
			),
		174 =>
			array (
				'code' => '163',
				'name' => 'TOGOLESE REPUBLIC',
			),
		175 =>
			array (
				'code' => '82',
				'name' => 'TRINIDAD and TOBAGO',
			),
		176 =>
			array (
				'code' => '75',
				'name' => 'TUNISIA',
			),
		177 =>
			array (
				'code' => '65',
				'name' => 'TURKEY',
			),
		178 =>
			array (
				'code' => '197',
				'name' => 'TURKS and CAICOS ISLAND',
			),
		179 =>
			array (
				'code' => '171',
				'name' => 'UGANDA',
			),
		180 =>
			array (
				'code' => '66',
				'name' => 'UKRAINE',
			),
		181 =>
			array (
				'code' => '67',
				'name' => 'UNITED ARAB EMIRATES',
			),
		182 =>
			array (
				'code' => '68',
				'name' => 'UNITED KINGDOM',
			),
		183 =>
			array (
				'code' => '69',
				'name' => 'UNITED STATES OF AMERICA',
			),
		184 =>
			array (
				'code' => '70',
				'name' => 'URUGUAY',
			),
		185 =>
			array (
				'code' => '104',
				'name' => 'US VIRGIN ISLANDS',
			),
		186 =>
			array (
				'code' => '117',
				'name' => 'UZBEKISTAN',
			),
		187 =>
			array (
				'code' => '155',
				'name' => 'VANUATU',
			),
		188 =>
			array (
				'code' => '71',
				'name' => 'VENEZUELA',
			),
		189 =>
			array (
				'code' => '72',
				'name' => 'VIETNAM',
			),
		190 =>
			array (
				'code' => '83',
				'name' => 'YEMEN',
			),
		191 =>
			array (
				'code' => '189',
				'name' => 'ZAMBIA',
			),
		192 =>
			array (
				'code' => '121',
				'name' => 'ZIMBABWE',
			),
	);

	const CITIES = [];

}