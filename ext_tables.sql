#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (

	nce_showasnew tinyint(1) unsigned DEFAULT '0' NOT NULL,
	nce_description text NOT NULL,
	nce_start int(11) DEFAULT '0' NOT NULL,
	nce_update int(11) DEFAULT '0' NOT NULL,
	nce_stop int(11) DEFAULT '0' NOT NULL,

);