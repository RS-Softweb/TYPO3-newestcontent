#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (

	tx_newestcontent_showasnew tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_newestcontent_start int(11) unsigned DEFAULT '0' NOT NULL,
	tx_newestcontent_update int(11) unsigned DEFAULT '0' NOT NULL,
	tx_newestcontent_stop int(11) unsigned DEFAULT '0' NOT NULL,
	tx_newestcontent_teaser text NOT NULL,
	
);