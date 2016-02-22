-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.32 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table snr_new.mst_bom
DROP TABLE IF EXISTS `mst_bom`;
CREATE TABLE IF NOT EXISTS `mst_bom` (
  `bom_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `bom_qty` int(11) NOT NULL,
  `bom_log` longtext NOT NULL,
  PRIMARY KEY (`bom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table snr_new.mst_bom: ~0 rows (approximately)
/*!40000 ALTER TABLE `mst_bom` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_bom` ENABLE KEYS */;


-- Dumping structure for table snr_new.mst_bom_lain
DROP TABLE IF EXISTS `mst_bom_lain`;
CREATE TABLE IF NOT EXISTS `mst_bom_lain` (
  `bom_lain_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `bom_lain_code` varchar(200) NOT NULL,
  `bom_lain_name` varchar(200) NOT NULL,
  `bom_lain_price` int(11) NOT NULL,
  `bom_lain_qty` int(11) NOT NULL,
  `bom_lain_total_price` int(11) NOT NULL,
  `bom_lain_log` varchar(200) NOT NULL,
  PRIMARY KEY (`bom_lain_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.mst_bom_lain: ~0 rows (approximately)
/*!40000 ALTER TABLE `mst_bom_lain` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_bom_lain` ENABLE KEYS */;


-- Dumping structure for table snr_new.mst_bom_liquid
DROP TABLE IF EXISTS `mst_bom_liquid`;
CREATE TABLE IF NOT EXISTS `mst_bom_liquid` (
  `bom_liquid_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `bom_liquid_qty` float NOT NULL,
  `bom_liquid_log` longtext NOT NULL,
  PRIMARY KEY (`bom_liquid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table snr_new.mst_bom_liquid: ~0 rows (approximately)
/*!40000 ALTER TABLE `mst_bom_liquid` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_bom_liquid` ENABLE KEYS */;


-- Dumping structure for table snr_new.mst_costumer
DROP TABLE IF EXISTS `mst_costumer`;
CREATE TABLE IF NOT EXISTS `mst_costumer` (
  `costumer_id` int(11) NOT NULL AUTO_INCREMENT,
  `costumer_code` varchar(200) NOT NULL,
  `costumer_name` longtext NOT NULL,
  `costumer_description` longtext NOT NULL,
  `costumer_photo` varchar(200) NOT NULL,
  `costumer_contact_person` varchar(200) NOT NULL,
  `costumer_phone` varchar(100) NOT NULL,
  `costumer_phone2` varchar(100) NOT NULL,
  `costumer_fax` varchar(100) NOT NULL,
  `costumer_email` varchar(200) NOT NULL,
  `costumer_city` varchar(200) NOT NULL,
  `costumer_postal_code` varchar(100) NOT NULL,
  `costumer_address` text NOT NULL,
  `costumer_keyword` varchar(200) NOT NULL,
  `costumer_date_created` datetime NOT NULL,
  `costumer_last_updated` datetime NOT NULL,
  `costumer_log` longtext NOT NULL,
  `costumer_deposit` decimal(60,2) NOT NULL,
  PRIMARY KEY (`costumer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.mst_costumer: 0 rows
/*!40000 ALTER TABLE `mst_costumer` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_costumer` ENABLE KEYS */;


-- Dumping structure for table snr_new.mst_karyawan
DROP TABLE IF EXISTS `mst_karyawan`;
CREATE TABLE IF NOT EXISTS `mst_karyawan` (
  `id_karyawan` int(5) NOT NULL AUTO_INCREMENT,
  `id_jabatan` int(2) DEFAULT '0',
  `id_group` int(1) DEFAULT '0',
  `kode_karyawan` varchar(10) DEFAULT NULL,
  `nama_karyawan` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `kata_sandi` varchar(32) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `aktif` int(1) DEFAULT '1',
  `date_entry` datetime DEFAULT NULL,
  `user_entry` int(5) DEFAULT '0',
  `user_update` datetime DEFAULT NULL,
  `last_update` int(5) DEFAULT '0',
  PRIMARY KEY (`id_karyawan`),
  KEY `id_jabatan` (`id_jabatan`),
  KEY `id_group` (`id_group`),
  CONSTRAINT `FK_mst_karyawan_ref_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `ref_jabatan` (`id_jabatan`) ON UPDATE CASCADE,
  CONSTRAINT `FK_mst_karyawan_sys_group` FOREIGN KEY (`id_group`) REFERENCES `sys_group` (`id_group`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.mst_karyawan: ~0 rows (approximately)
/*!40000 ALTER TABLE `mst_karyawan` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_karyawan` ENABLE KEYS */;


-- Dumping structure for table snr_new.mst_material
DROP TABLE IF EXISTS `mst_material`;
CREATE TABLE IF NOT EXISTS `mst_material` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_categories_id` int(11) NOT NULL,
  `material_categories_group_id` int(11) DEFAULT NULL,
  `provider_id` int(11) NOT NULL,
  `material_code` varchar(200) NOT NULL,
  `material_name` varchar(200) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `material_currency` varchar(200) NOT NULL,
  `material_price_usd` decimal(60,2) NOT NULL,
  `material_price` float NOT NULL,
  `material_cbm` float NOT NULL,
  `material_date_created` datetime NOT NULL,
  `material_last_updated` datetime NOT NULL,
  `material_log` longtext NOT NULL,
  `material_minimal_stock` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table snr_new.mst_material: ~0 rows (approximately)
/*!40000 ALTER TABLE `mst_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_material` ENABLE KEYS */;


-- Dumping structure for table snr_new.mst_material_categories
DROP TABLE IF EXISTS `mst_material_categories`;
CREATE TABLE IF NOT EXISTS `mst_material_categories` (
  `material_categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `provider_categories_id` int(11) NOT NULL,
  `material_categories_name` varchar(200) NOT NULL,
  `material_categories_date_created` datetime NOT NULL,
  `material_categories_last_updated` datetime NOT NULL,
  `material_categories_log` longtext NOT NULL,
  PRIMARY KEY (`material_categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table snr_new.mst_material_categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `mst_material_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_material_categories` ENABLE KEYS */;


-- Dumping structure for table snr_new.mst_product
DROP TABLE IF EXISTS `mst_product`;
CREATE TABLE IF NOT EXISTS `mst_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(200) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_cost` int(11) NOT NULL,
  `product_price` varchar(200) NOT NULL,
  `product_price_usd` decimal(60,2) NOT NULL,
  `product_currency` varchar(200) NOT NULL,
  `product_photo` varchar(200) NOT NULL,
  `product_cbm` float NOT NULL,
  `product_weight` float NOT NULL,
  `product_bundle` int(11) NOT NULL,
  `product_description` longtext NOT NULL,
  `product_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_last_updated` datetime NOT NULL,
  `product_log` longtext NOT NULL,
  `product_labor` int(11) DEFAULT '0',
  `product_overhead` int(11) DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table snr_new.mst_product: ~0 rows (approximately)
/*!40000 ALTER TABLE `mst_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_product` ENABLE KEYS */;


-- Dumping structure for table snr_new.mst_provider
DROP TABLE IF EXISTS `mst_provider`;
CREATE TABLE IF NOT EXISTS `mst_provider` (
  `provider_id` int(11) NOT NULL AUTO_INCREMENT,
  `provider_categories_id` int(11) NOT NULL DEFAULT '2',
  `provider_code` varchar(200) NOT NULL,
  `provider_name` longtext NOT NULL,
  `provider_description` longtext NOT NULL,
  `provider_photo` varchar(200) NOT NULL,
  `provider_contact_person` varchar(200) NOT NULL,
  `provider_phone` varchar(100) NOT NULL,
  `provider_phone2` varchar(100) NOT NULL,
  `provider_fax` varchar(100) NOT NULL,
  `provider_email` varchar(200) NOT NULL,
  `provider_city` varchar(200) NOT NULL,
  `provider_postal_code` varchar(100) NOT NULL,
  `provider_address` text NOT NULL,
  `provider_keyword` varchar(200) NOT NULL,
  `provider_date_created` datetime NOT NULL,
  `provider_last_updated` datetime NOT NULL,
  `provider_log` longtext NOT NULL,
  `provider_deposit` int(11) DEFAULT '0',
  `provider_hutang` int(11) DEFAULT '0',
  PRIMARY KEY (`provider_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.mst_provider: 0 rows
/*!40000 ALTER TABLE `mst_provider` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_provider` ENABLE KEYS */;


-- Dumping structure for table snr_new.mst_provider_categories
DROP TABLE IF EXISTS `mst_provider_categories`;
CREATE TABLE IF NOT EXISTS `mst_provider_categories` (
  `provider_categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `provider_categories_code` varchar(100) NOT NULL,
  `provider_categories_name` varchar(200) NOT NULL,
  `provider_categories_date_created` datetime NOT NULL,
  `provider_categories_last_updated` datetime NOT NULL,
  `provider_categories_log` longtext NOT NULL,
  PRIMARY KEY (`provider_categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.mst_provider_categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `mst_provider_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_provider_categories` ENABLE KEYS */;


-- Dumping structure for table snr_new.mst_warehouse
DROP TABLE IF EXISTS `mst_warehouse`;
CREATE TABLE IF NOT EXISTS `mst_warehouse` (
  `warehouse_id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse_code` varchar(200) NOT NULL,
  `warehouse_name` varchar(200) NOT NULL,
  `warehouse_location` longtext NOT NULL,
  `warehouse_date_created` datetime NOT NULL,
  `warehouse_last_updated` datetime NOT NULL,
  `warehouse_log` longtext NOT NULL,
  PRIMARY KEY (`warehouse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table snr_new.mst_warehouse: ~0 rows (approximately)
/*!40000 ALTER TABLE `mst_warehouse` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_warehouse` ENABLE KEYS */;


-- Dumping structure for table snr_new.ref_currency
DROP TABLE IF EXISTS `ref_currency`;
CREATE TABLE IF NOT EXISTS `ref_currency` (
  `currency_id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_date` datetime NOT NULL,
  `currency_rate` varchar(200) NOT NULL,
  `currency_description` longtext NOT NULL,
  `currency_date_created` datetime NOT NULL,
  `currency_last_updated` datetime NOT NULL,
  `currency_log` longtext NOT NULL,
  PRIMARY KEY (`currency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table snr_new.ref_currency: ~0 rows (approximately)
/*!40000 ALTER TABLE `ref_currency` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_currency` ENABLE KEYS */;


-- Dumping structure for table snr_new.ref_jabatan
DROP TABLE IF EXISTS `ref_jabatan`;
CREATE TABLE IF NOT EXISTS `ref_jabatan` (
  `id_jabatan` int(2) NOT NULL AUTO_INCREMENT,
  `kode_jabatan` varchar(5) DEFAULT NULL,
  `nama_jabatan` varchar(75) DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `date_entry` datetime DEFAULT NULL,
  `user_entry` int(5) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `user_update` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.ref_jabatan: ~0 rows (approximately)
/*!40000 ALTER TABLE `ref_jabatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_jabatan` ENABLE KEYS */;


-- Dumping structure for table snr_new.ref_material_categories_group
DROP TABLE IF EXISTS `ref_material_categories_group`;
CREATE TABLE IF NOT EXISTS `ref_material_categories_group` (
  `material_categories_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_categories_group_name` varchar(200) NOT NULL,
  `material_categories_group_date_created` datetime NOT NULL,
  `material_categories_group_last_updated` datetime NOT NULL,
  `material_categories_group_log` longtext NOT NULL,
  PRIMARY KEY (`material_categories_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.ref_material_categories_group: ~0 rows (approximately)
/*!40000 ALTER TABLE `ref_material_categories_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_material_categories_group` ENABLE KEYS */;


-- Dumping structure for table snr_new.ref_unit
DROP TABLE IF EXISTS `ref_unit`;
CREATE TABLE IF NOT EXISTS `ref_unit` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(200) NOT NULL,
  `unit_date_created` datetime NOT NULL,
  `unit_last_updated` datetime NOT NULL,
  `unit_log` longtext NOT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table snr_new.ref_unit: ~0 rows (approximately)
/*!40000 ALTER TABLE `ref_unit` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_unit` ENABLE KEYS */;


-- Dumping structure for table snr_new.sys_group
DROP TABLE IF EXISTS `sys_group`;
CREATE TABLE IF NOT EXISTS `sys_group` (
  `id_group` int(2) NOT NULL AUTO_INCREMENT,
  `nama_group` varchar(15) DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `date_entry` datetime DEFAULT NULL,
  `user_entry` int(5) DEFAULT '0',
  `last_update` datetime DEFAULT NULL,
  `user_update` int(5) DEFAULT '0',
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.sys_group: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_group` ENABLE KEYS */;


-- Dumping structure for table snr_new.sys_group_modul
DROP TABLE IF EXISTS `sys_group_modul`;
CREATE TABLE IF NOT EXISTS `sys_group_modul` (
  `id_group_modul` int(5) NOT NULL AUTO_INCREMENT,
  `id_group` int(5) DEFAULT '0',
  `id_modul` int(2) DEFAULT '0',
  `menu_input` int(1) DEFAULT '0',
  `menu_edit` int(1) DEFAULT '0',
  `menu_delete` int(1) DEFAULT '0',
  `tipe_modul` varchar(10) DEFAULT '0',
  `date_entry` datetime DEFAULT NULL,
  `user_entry` int(5) DEFAULT '0',
  `last_update` datetime DEFAULT NULL,
  `user_update` int(5) DEFAULT '0',
  PRIMARY KEY (`id_group_modul`),
  KEY `id_group` (`id_group`),
  KEY `id_modul` (`id_modul`),
  CONSTRAINT `FK_sys_group_modul_sys_group` FOREIGN KEY (`id_group`) REFERENCES `sys_group` (`id_group`) ON UPDATE CASCADE,
  CONSTRAINT `FK_sys_group_modul_sys_modul` FOREIGN KEY (`id_modul`) REFERENCES `sys_modul` (`id_modul`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.sys_group_modul: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_group_modul` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_group_modul` ENABLE KEYS */;


-- Dumping structure for table snr_new.sys_modul
DROP TABLE IF EXISTS `sys_modul`;
CREATE TABLE IF NOT EXISTS `sys_modul` (
  `id_modul` int(2) NOT NULL AUTO_INCREMENT,
  `kode_modul` varchar(20) DEFAULT NULL,
  `nama_modul` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(254) DEFAULT NULL,
  `induk` varchar(20) DEFAULT NULL,
  `induk_menu` int(2) DEFAULT NULL,
  `level_id` smallint(2) DEFAULT NULL,
  `header` smallint(6) DEFAULT NULL,
  `link_modul` varchar(200) DEFAULT NULL,
  `modul_report` tinyint(1) DEFAULT NULL,
  `aktif` int(1) DEFAULT '1',
  `date_entry` datetime DEFAULT NULL,
  `user_entry` int(5) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_modul`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.sys_modul: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_modul` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_modul` ENABLE KEYS */;


-- Dumping structure for table snr_new.sys_session
DROP TABLE IF EXISTS `sys_session`;
CREATE TABLE IF NOT EXISTS `sys_session` (
  `id_session` varchar(40) NOT NULL DEFAULT '0',
  `id_user` int(5) NOT NULL,
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.sys_session: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_session` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_arsip
DROP TABLE IF EXISTS `trx_arsip`;
CREATE TABLE IF NOT EXISTS `trx_arsip` (
  `id_arsip` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_arsip` char(11) NOT NULL DEFAULT '0',
  `nama_file` varchar(300) NOT NULL DEFAULT '0',
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`id_arsip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_arsip: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_arsip` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_arsip` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_inventory
DROP TABLE IF EXISTS `trx_inventory`;
CREATE TABLE IF NOT EXISTS `trx_inventory` (
  `inventory_id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse_id` int(11) NOT NULL,
  `inventory_categories` enum('undefined','stock','buffer','booked','incoming','wip','packed','ready','sample','not_good','pinjam') NOT NULL,
  `material_id` int(11) NOT NULL,
  `inventory_item_categories` enum('material','product') NOT NULL,
  `inventory_item_name` varchar(200) NOT NULL,
  `inventory_operator` varchar(50) NOT NULL,
  `inventory_jumlah_item` int(11) NOT NULL,
  `inventory_jumlah_nominal` float NOT NULL,
  `inventory_nominal_per_item` float NOT NULL,
  `inventory_stock_awal` int(11) NOT NULL,
  `inventory_stock_akhir` int(11) NOT NULL,
  `inventory_date_transaction` datetime NOT NULL,
  `inventory_date_created` datetime NOT NULL,
  `inventory_description` longtext NOT NULL,
  `inventory_log` longtext NOT NULL,
  PRIMARY KEY (`inventory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table snr_new.trx_inventory: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_inventory` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_issued
DROP TABLE IF EXISTS `trx_issued`;
CREATE TABLE IF NOT EXISTS `trx_issued` (
  `issued_id` int(11) NOT NULL AUTO_INCREMENT,
  `issued_code` varchar(200) NOT NULL,
  `issued_date` date NOT NULL,
  `issued_status` enum('draft','close') DEFAULT 'draft',
  `karyawan_id` int(11) DEFAULT NULL,
  `issued_date_created` datetime DEFAULT NULL,
  `issued_last_updated` datetime DEFAULT NULL,
  `issued_log` longtext,
  PRIMARY KEY (`issued_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_issued: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_issued` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_issued` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_issued_detail
DROP TABLE IF EXISTS `trx_issued_detail`;
CREATE TABLE IF NOT EXISTS `trx_issued_detail` (
  `issued_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `issued_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `issued_detail_qty` float DEFAULT NULL,
  `issued_detail_status` enum('draft','close','request_edit','edit') DEFAULT 'draft',
  `issued_detail_date_created` datetime DEFAULT NULL,
  `issued_detail_last_updated` datetime DEFAULT NULL,
  `issued_detail_log` longtext,
  PRIMARY KEY (`issued_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_issued_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_issued_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_issued_detail` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_lpb
DROP TABLE IF EXISTS `trx_lpb`;
CREATE TABLE IF NOT EXISTS `trx_lpb` (
  `lpb_id` int(11) NOT NULL AUTO_INCREMENT,
  `provider_id` int(11) DEFAULT NULL,
  `sales_order_id` int(11) DEFAULT NULL,
  `lpb_code` varchar(200) NOT NULL,
  `lpb_date` date DEFAULT NULL,
  `lpb_status` enum('draft','close') DEFAULT NULL,
  `lpb_date_created` datetime DEFAULT NULL,
  `lpb_last_updated` datetime DEFAULT NULL,
  `lpb_log` longtext,
  `lpb_hutang` int(11) DEFAULT '0',
  PRIMARY KEY (`lpb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_lpb: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_lpb` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_lpb` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_lpb_detail
DROP TABLE IF EXISTS `trx_lpb_detail`;
CREATE TABLE IF NOT EXISTS `trx_lpb_detail` (
  `lpb_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `lpb_id` int(11) DEFAULT NULL,
  `purchase_order_detail_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `lpb_detail_status` enum('draft','close') DEFAULT NULL,
  `lpb_detail_qty` int(11) DEFAULT NULL,
  `lpb_detail_price` int(11) DEFAULT NULL,
  `lpb_detail_price_total` int(11) DEFAULT NULL,
  `lpb_detail_description` longtext,
  `lpb_detail_note` longtext,
  `lpb_detail_date_created` datetime DEFAULT NULL,
  `lpb_detail_last_updated` datetime DEFAULT NULL,
  `lpb_detail_log` longtext,
  `lpb_detail_hutang` int(11) DEFAULT '0',
  PRIMARY KEY (`lpb_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_lpb_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_lpb_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_lpb_detail` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_lpb_liquid
DROP TABLE IF EXISTS `trx_lpb_liquid`;
CREATE TABLE IF NOT EXISTS `trx_lpb_liquid` (
  `lpb_liquid_id` int(11) NOT NULL AUTO_INCREMENT,
  `provider_id` int(11) DEFAULT NULL,
  `sales_order_id` int(11) DEFAULT NULL,
  `lpb_liquid_code` varchar(200) NOT NULL,
  `lpb_liquid_date` datetime DEFAULT NULL,
  `lpb_liquid_status` enum('draft','close') DEFAULT 'draft',
  `lpb_liquid_date_create` datetime DEFAULT NULL,
  `lpb_liquid_date_updated` datetime DEFAULT NULL,
  `lpb_liquid_log` longtext,
  `lpb_liquid_hutang` int(11) DEFAULT '0',
  PRIMARY KEY (`lpb_liquid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_lpb_liquid: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_lpb_liquid` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_lpb_liquid` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_lpb_liquid_detail
DROP TABLE IF EXISTS `trx_lpb_liquid_detail`;
CREATE TABLE IF NOT EXISTS `trx_lpb_liquid_detail` (
  `lpb_liquid_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `lpb_liquid_id` int(11) DEFAULT NULL,
  `purchase_order_liquid_detail_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `lpb_liquid_detail_status` enum('draft','close') DEFAULT 'draft',
  `lpb_liquid_detail_qty` int(11) DEFAULT NULL,
  `lpb_liquid_detail_price` int(11) DEFAULT NULL,
  `lpb_liquid_detail_price_total` int(11) DEFAULT NULL,
  `lpb_liquid_detail_description` longtext,
  `lpb_liquid_detail_note` longtext,
  `lpb_liquid_detail_date_created` datetime DEFAULT NULL,
  `lpb_liquid_detail_last_updated` datetime DEFAULT NULL,
  `lpb_liquid_detail_log` longtext,
  `lpb_liquid_detail_hutang` int(11) DEFAULT '0',
  PRIMARY KEY (`lpb_liquid_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_lpb_liquid_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_lpb_liquid_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_lpb_liquid_detail` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_packing
DROP TABLE IF EXISTS `trx_packing`;
CREATE TABLE IF NOT EXISTS `trx_packing` (
  `packing_id` int(11) NOT NULL AUTO_INCREMENT,
  `packing_code` varchar(100) NOT NULL,
  `packing_date_create` datetime NOT NULL,
  `packing_status` enum('packing','packed','all_done','revisi') NOT NULL DEFAULT 'packing',
  PRIMARY KEY (`packing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_packing: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_packing` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_packing` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_packing_detail
DROP TABLE IF EXISTS `trx_packing_detail`;
CREATE TABLE IF NOT EXISTS `trx_packing_detail` (
  `packing_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `packing_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `packing_detail_date_create` datetime NOT NULL,
  `packing_detail_qty` int(11) NOT NULL,
  `packing_detail_qty_revisi` int(11) DEFAULT '0',
  PRIMARY KEY (`packing_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_packing_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_packing_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_packing_detail` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_purchase_order
DROP TABLE IF EXISTS `trx_purchase_order`;
CREATE TABLE IF NOT EXISTS `trx_purchase_order` (
  `purchase_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `provider_id` int(11) NOT NULL,
  `sales_order_id` int(11) NOT NULL,
  `purchase_order_jenis` enum('sales','buffer','sample') NOT NULL,
  `purchase_order_code` varchar(200) NOT NULL,
  `purchase_order_date` date NOT NULL,
  `purchase_order_delivery_date` date NOT NULL,
  `purchase_order_note` longtext NOT NULL,
  `purchase_order_date_created` datetime NOT NULL,
  `purchase_order_last_updated` datetime NOT NULL,
  `purchase_order_log` longtext NOT NULL,
  `purchase_order_deposit` int(11) DEFAULT '0',
  PRIMARY KEY (`purchase_order_id`),
  KEY `provider_id` (`provider_id`),
  KEY `sales_order_id` (`sales_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_purchase_order: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_purchase_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_purchase_order` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_purchase_order_detail
DROP TABLE IF EXISTS `trx_purchase_order_detail`;
CREATE TABLE IF NOT EXISTS `trx_purchase_order_detail` (
  `purchase_order_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_order_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `sales_order_id` int(11) NOT NULL,
  `purchase_order_detail_qty` int(11) NOT NULL,
  `purchase_order_detail_price` int(11) DEFAULT NULL,
  `purchase_order_detail_desc` longtext NOT NULL,
  `purchase_order_detail_remax` longtext,
  `purchase_order_detail_date_created` datetime NOT NULL,
  `purchase_order_detail_last_updated` datetime NOT NULL,
  `purchase_order_detail_log` longtext NOT NULL,
  PRIMARY KEY (`purchase_order_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_purchase_order_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_purchase_order_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_purchase_order_detail` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_purchase_order_liquid
DROP TABLE IF EXISTS `trx_purchase_order_liquid`;
CREATE TABLE IF NOT EXISTS `trx_purchase_order_liquid` (
  `purchase_order_liquid_id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_order_id` int(11) NOT NULL DEFAULT '0',
  `purchase_order_liquid_code` varchar(200) NOT NULL,
  `purchase_order_liquid_status` enum('draft','progress','all_receipt_and_close') NOT NULL DEFAULT 'draft',
  `purchase_order_liquid_date_created` datetime NOT NULL,
  `purchase_order_liquid_last_update` datetime NOT NULL,
  `purchase_order_liquid_log` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`purchase_order_liquid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_purchase_order_liquid: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_purchase_order_liquid` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_purchase_order_liquid` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_purchase_order_liquid_detail
DROP TABLE IF EXISTS `trx_purchase_order_liquid_detail`;
CREATE TABLE IF NOT EXISTS `trx_purchase_order_liquid_detail` (
  `purchase_order_liquid_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_order_liquid_id` int(11) NOT NULL,
  `purchase_order_liquid_detail_code` text,
  `material_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_order_liquid_detail_delivery_date` date NOT NULL,
  `purchase_order_liquid_detail_note` longtext,
  `purchase_order_liquid_detail_status` enum('draft','progress','all_receipt_and_close') NOT NULL DEFAULT 'draft',
  `purchase_order_liquid_detail_qty` int(11) NOT NULL,
  `purchase_order_liquid_detail_price` int(11) NOT NULL,
  `purchase_order_liquid_detail_price_total` int(11) DEFAULT '0',
  `purchase_order_liquid_detail_desc` longtext,
  `purchase_order_liquid_detail_date_created` datetime NOT NULL,
  `purchase_order_liquid_detail_last_update` datetime DEFAULT NULL,
  `purchase_order_liquid_detail_log` varchar(200) DEFAULT NULL,
  `purchase_order_liquid_detail_deposit` int(11) DEFAULT '0',
  PRIMARY KEY (`purchase_order_liquid_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_purchase_order_liquid_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_purchase_order_liquid_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_purchase_order_liquid_detail` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_sales_order
DROP TABLE IF EXISTS `trx_sales_order`;
CREATE TABLE IF NOT EXISTS `trx_sales_order` (
  `sales_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_order_categories` enum('buffer','sales') DEFAULT NULL,
  `costumer_id` int(11) NOT NULL,
  `sales_order_ref_no` varchar(200) NOT NULL,
  `sales_order_status` enum('draft','purchasing','purchasing_sm','material_issued','production','all_complete_and_shipping','close') NOT NULL,
  `sales_order_address` longtext NOT NULL,
  `sales_order_date` date NOT NULL,
  `sales_order_shipped_date` datetime NOT NULL,
  `sales_order_date_created` datetime NOT NULL,
  `sales_order_last_updated` datetime NOT NULL,
  `sales_order_log` longtext NOT NULL,
  `sales_order_piutang` decimal(60,2) NOT NULL,
  `sales_order_total` decimal(60,2) NOT NULL,
  PRIMARY KEY (`sales_order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_sales_order: 0 rows
/*!40000 ALTER TABLE `trx_sales_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_sales_order` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_sales_order_detail
DROP TABLE IF EXISTS `trx_sales_order_detail`;
CREATE TABLE IF NOT EXISTS `trx_sales_order_detail` (
  `sales_order_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sales_order_detail_price` decimal(60,2) NOT NULL,
  `sales_order_detail_qty` int(11) NOT NULL,
  `sales_order_detail_date_created` datetime NOT NULL,
  `sales_order_detail_last_updated` datetime NOT NULL,
  `sales_order_detail_log` longtext NOT NULL,
  `sales_order_detail_status` enum('reguler','rush') NOT NULL DEFAULT 'reguler',
  PRIMARY KEY (`sales_order_detail_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_sales_order_detail: 0 rows
/*!40000 ALTER TABLE `trx_sales_order_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_sales_order_detail` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_shipment
DROP TABLE IF EXISTS `trx_shipment`;
CREATE TABLE IF NOT EXISTS `trx_shipment` (
  `shipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `shipment_code` varchar(100) NOT NULL,
  `shipment_container_code` varchar(100) NOT NULL,
  `shipment_truck_code` varchar(100) NOT NULL,
  `shipment_diver` varchar(100) NOT NULL,
  `shipment_seal_code` varchar(100) NOT NULL,
  `shipment_date` date NOT NULL,
  `shipment_loading_date` date NOT NULL,
  `shipment_status` enum('draft','open','close') NOT NULL DEFAULT 'draft',
  `shipment_date_created` datetime NOT NULL,
  `shipment_last_updated` longtext NOT NULL,
  `shipment_log` longtext NOT NULL,
  `shipment_rate_currency` int(11) DEFAULT NULL,
  KEY `shipment_id` (`shipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_shipment: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_shipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_shipment` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_shipment_detail
DROP TABLE IF EXISTS `trx_shipment_detail`;
CREATE TABLE IF NOT EXISTS `trx_shipment_detail` (
  `shipment_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_order_id` int(11) NOT NULL,
  `shipment_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `shipment_detail_product_name` varchar(100) NOT NULL,
  `shipment_detail_qty` int(11) NOT NULL,
  `shipment_detail_kg` varchar(100) NOT NULL,
  `shipment_detail_cmb` int(11) NOT NULL,
  `shipment_detail_total_volume` int(11) NOT NULL,
  `shipment_detail_date_created` datetime NOT NULL,
  `shipment_detail_last_updated` datetime NOT NULL,
  `shipment_detail_log` longtext NOT NULL,
  `shipment_detail_piutang` decimal(60,2) NOT NULL,
  `shipment_detail_total` decimal(60,2) NOT NULL,
  PRIMARY KEY (`shipment_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_shipment_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_shipment_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_shipment_detail` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_surat_jalan
DROP TABLE IF EXISTS `trx_surat_jalan`;
CREATE TABLE IF NOT EXISTS `trx_surat_jalan` (
  `surat_jalan_id` int(11) NOT NULL AUTO_INCREMENT,
  `provider_id` int(11) DEFAULT NULL,
  `surat_jalan_code` varchar(200) DEFAULT NULL,
  `surat_jalan_status` enum('draft','close') DEFAULT NULL,
  `surat_jalan_date` date DEFAULT NULL,
  `surat_jalan_dikirim_dari` varchar(200) DEFAULT NULL,
  `surat_jalan_diangkut_melalui` varchar(200) DEFAULT NULL,
  `surat_jalan_nomor_kendaraan` varchar(200) DEFAULT NULL,
  `surat_jalan_date_created` datetime DEFAULT NULL,
  `surat_jalan_last_updated` datetime DEFAULT NULL,
  `surat_jalan_log` longtext,
  PRIMARY KEY (`surat_jalan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_surat_jalan: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_surat_jalan` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_surat_jalan` ENABLE KEYS */;


-- Dumping structure for table snr_new.trx_surat_jalan_detail
DROP TABLE IF EXISTS `trx_surat_jalan_detail`;
CREATE TABLE IF NOT EXISTS `trx_surat_jalan_detail` (
  `surat_jalan_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `surat_jalan_id` int(11) DEFAULT NULL,
  `sales_order_id` int(11) DEFAULT NULL,
  `purchase_order_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `surat_jalan_detail_qty` int(11) DEFAULT NULL,
  `surat_jalan_detail_keterangan` longtext,
  `surat_jalan_detail_date_created` datetime DEFAULT NULL,
  `surat_jalan_detail_last_updated` datetime DEFAULT NULL,
  `surat_jalan_detail_log` longtext,
  PRIMARY KEY (`surat_jalan_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snr_new.trx_surat_jalan_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `trx_surat_jalan_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `trx_surat_jalan_detail` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
