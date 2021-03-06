<?php 

class Instagramflickr_Install {

	/**
	 * Initialize the shared database library
	 */
	public function __construct() 
	{
		$this->db = Database::instance();
	}

	/**
	 * Install the database
	 * 
	 */
	public function run_install() 
	{

		// Create the database tables.
		// Also include table_prefix in name
		$this->db->query('CREATE TABLE IF NOT EXISTS `'.Kohana::config('database.default.table_prefix'). 'instgramflickr` (
		  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		  `parent_id` bigint(20) DEFAULT \'0\',
		  `incident_id` bigint(20) unsigned DEFAULT \'0\',
		  `user_id` int(11) unsigned DEFAULT \'0\',
		  `reporter_id` bigint(20) unsigned DEFAULT NULL,
		  `service_messageid` varchar(100) DEFAULT NULL,
		  `photo_from` varchar(100) DEFAULT NULL,
		  `photo_to` varchar(100) DEFAULT NULL,
		  `photo_title` text,
		  `photo_description` text,
		  `photo_type` tinyint(4) DEFAULT \'1\' COMMENT \'1 - INBOX, 2 - OUTBOX (From Admin), 3 - DELETED\',
		  `photo_date` datetime DEFAULT NULL,
		  `photo_level` tinyint(4) DEFAULT \'0\' COMMENT \'0 - UNREAD, 1 - READ, 99 - SPAM\',
		  `latitude` double DEFAULT NULL,
		  `longitude` double DEFAULT NULL,
		  PRIMARY KEY (`id`),
		  KEY `user_id` (`user_id`),
		  KEY `incident_id` (`incident_id`),
		  KEY `reporter_id` (`reporter_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT=\'Stores instagram and flickr photo details\' AUTO_INCREMENT=1 ;');

		// Create the settings tables.
		// Also include table_prefix in name
		$this->db->query('CREATE TABLE IF NOT EXISTS `'.Kohana::config('database.default.table_prefix').'instagramflickr_settings` (
			`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  			`flickr_tag` varchar(255) DEFAULT NULL,
  			`flickr_id` varchar(15) DEFAULT NULL,
  			`num_of_photos` tinyint(4) NOT NULL DEFAULT \'0\',
  			`image_width` int(11) NOT NULL DEFAULT \'500\',
  			`image_height` int(11) NOT NULL DEFAULT \'375\',
  			`block_position` varchar(15) DEFAULT NULL,
  			`enable_cache` int(5) NOT NULL,
  			`block_no_photos` int(5) NOT NULL,
  			PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');

	}

	/**
	 * Deletes the database tables for the actionable module
	 */
	public function uninstall()
	{
		$this->db->query('DROP TABLE `'.Kohana::config('database.default.table_prefix').'instgramflickr');

		$this->db->query('DROP TABLE `'.Kohana::config('database.default.table_prefix').'instgramflickr_settings');
	}
}