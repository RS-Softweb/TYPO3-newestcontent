#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
	tx_newestcontent_publishnew tinyint(3) DEFAULT '0' NOT NULL,
	tx_newestcontent_publishdate int(11) DEFAULT '0' NOT NULL,
	tx_newestcontent_shorttext text
);