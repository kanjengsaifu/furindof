-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 5.6.21 - MySQL Community Server (GPL)
-- OS Server:                    Win32
-- HeidiSQL Versi:               9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table binasejahtera.mst_karyawan
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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

-- Dumping data for table binasejahtera.mst_karyawan: ~4 rows (approximately)
/*!40000 ALTER TABLE `mst_karyawan` DISABLE KEYS */;
INSERT INTO `mst_karyawan` (`id_karyawan`, `id_jabatan`, `id_group`, `kode_karyawan`, `nama_karyawan`, `email`, `kata_sandi`, `telp`, `alamat`, `deskripsi`, `aktif`, `date_entry`, `user_entry`, `user_update`, `last_update`) VALUES
	(1, 1, 1, 'A0001', 'Administrator', 'root@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '(0274) 5557352', 'Jogotirto Berbah Sleman DIY', '-', 1, '2015-05-24 12:00:12', 0, '0000-00-00 00:00:00', 2015),
	(52, 2, 2, 'A0002', 'seno', 'seno@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '085729615832', 'Plembangan Jogotirto Berbah Sleman Yogyakarta', '-', 1, '2015-11-12 10:03:12', 1, '0000-00-00 00:00:00', 2016),
	(53, 4, 3, 'A0003', 'harpawan', 'harpawan@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '085729615832', 'plembangan', '-', 1, '2015-12-12 07:43:18', 1, '0000-00-00 00:00:00', 2016),
	(54, 3, 4, 'A0004', 'anggi', 'anggi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '089637366222', 'plembangan jogotirto berbah sleman yogyakarta', '-', 1, '2016-01-05 04:35:46', 1, '0000-00-00 00:00:00', 2016);
/*!40000 ALTER TABLE `mst_karyawan` ENABLE KEYS */;


-- Dumping structure for table binasejahtera.ref_jabatan
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table binasejahtera.ref_jabatan: ~3 rows (approximately)
/*!40000 ALTER TABLE `ref_jabatan` DISABLE KEYS */;
INSERT INTO `ref_jabatan` (`id_jabatan`, `kode_jabatan`, `nama_jabatan`, `deskripsi`, `date_entry`, `user_entry`, `last_update`, `user_update`) VALUES
	(1, 'K0001', 'Kepala Koperasi', '', '2015-11-12 09:38:37', 1, '2016-01-13 20:21:57', 1),
	(2, 'K0002', 'Sekretaris', '', '2016-01-13 20:20:59', 1, '0000-00-00 00:00:00', 0),
	(3, 'K0003', 'Kasir', '', '2016-01-13 20:21:16', 1, '0000-00-00 00:00:00', 0),
	(4, 'K0004', 'Bendahara', '', '2016-01-13 20:21:30', 1, '0000-00-00 00:00:00', 0);
/*!40000 ALTER TABLE `ref_jabatan` ENABLE KEYS */;


-- Dumping structure for table binasejahtera.sys_group
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table binasejahtera.sys_group: ~5 rows (approximately)
/*!40000 ALTER TABLE `sys_group` DISABLE KEYS */;
INSERT INTO `sys_group` (`id_group`, `nama_group`, `deskripsi`, `date_entry`, `user_entry`, `last_update`, `user_update`) VALUES
	(1, 'Administrator', 'Builtin User Administrator', '2015-03-11 21:10:17', 1, '2015-03-28 17:51:18', 1),
	(2, 'Sekretaris', '', '2015-03-11 21:10:23', 1, '2015-11-12 09:41:09', 1),
	(3, 'Bendahara', 'Bendahara keuangan', '2015-05-24 20:13:40', 1, '2015-11-12 09:40:27', 1),
	(4, 'casier', '', '2015-05-27 13:42:34', 9, '2015-11-12 09:40:00', 1),
	(5, 'admin', '', '2015-05-28 16:47:19', 5, '2015-05-28 16:48:25', 5);
/*!40000 ALTER TABLE `sys_group` ENABLE KEYS */;


-- Dumping structure for table binasejahtera.sys_group_modul
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
) ENGINE=InnoDB AUTO_INCREMENT=873 DEFAULT CHARSET=latin1;

-- Dumping data for table binasejahtera.sys_group_modul: ~77 rows (approximately)
/*!40000 ALTER TABLE `sys_group_modul` DISABLE KEYS */;
INSERT INTO `sys_group_modul` (`id_group_modul`, `id_group`, `id_modul`, `menu_input`, `menu_edit`, `menu_delete`, `tipe_modul`, `date_entry`, `user_entry`, `last_update`, `user_update`) VALUES
	(733, 1, 1, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(734, 1, 2, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(735, 1, 3, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(736, 1, 4, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(737, 1, 5, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(738, 1, 6, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(739, 1, 7, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(740, 1, 8, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(741, 1, 9, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(742, 1, 10, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(743, 1, 17, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(744, 1, 11, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(745, 1, 12, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(746, 1, 13, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(747, 1, 14, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(748, 1, 15, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(749, 1, 16, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(750, 1, 21, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(751, 1, 25, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(752, 1, 22, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(753, 1, 23, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(754, 1, 24, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(755, 1, 18, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(756, 1, 19, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(757, 1, 20, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(786, 1, 26, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(787, 1, 27, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(788, 1, 28, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(789, 1, 29, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(794, 1, 30, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(795, 1, 31, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(796, 1, 32, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(797, 1, 33, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(798, 1, 34, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(799, 2, 1, 0, 0, 0, '0', '2016-01-05 04:31:54', 1, '0000-00-00 00:00:00', 0),
	(800, 2, 2, 0, 0, 0, '0', '2016-01-05 04:31:54', 1, '0000-00-00 00:00:00', 0),
	(801, 2, 3, 0, 0, 0, '0', '2016-01-05 04:31:54', 1, '0000-00-00 00:00:00', 0),
	(802, 2, 4, 0, 0, 0, '0', '2016-01-05 04:31:54', 1, '0000-00-00 00:00:00', 0),
	(803, 2, 5, 0, 0, 0, '0', '2016-01-05 04:31:54', 1, '0000-00-00 00:00:00', 0),
	(804, 2, 6, 0, 0, 0, '0', '2016-01-05 04:31:54', 1, '0000-00-00 00:00:00', 0),
	(805, 2, 7, 0, 0, 0, '0', '2016-01-05 04:31:54', 1, '0000-00-00 00:00:00', 0),
	(806, 2, 8, 0, 0, 0, '0', '2016-01-05 04:31:54', 1, '0000-00-00 00:00:00', 0),
	(807, 2, 9, 0, 0, 0, '0', '2016-01-05 04:31:54', 1, '0000-00-00 00:00:00', 0),
	(839, 1, 35, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(840, 1, 36, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(841, 1, 37, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(842, 1, 38, 0, 0, 0, '0', '2015-06-17 15:36:25', 5, '0000-00-00 00:00:00', 0),
	(843, 4, 1, 0, 0, 0, '0', '2016-02-03 20:28:36', 1, '0000-00-00 00:00:00', 0),
	(844, 4, 2, 0, 0, 0, '0', '2016-02-03 20:28:36', 1, '0000-00-00 00:00:00', 0),
	(845, 4, 3, 0, 0, 0, '0', '2016-02-03 20:28:36', 1, '0000-00-00 00:00:00', 0),
	(846, 4, 5, 0, 0, 0, '0', '2016-02-03 20:28:36', 1, '0000-00-00 00:00:00', 0),
	(847, 4, 6, 0, 0, 0, '0', '2016-02-03 20:28:36', 1, '0000-00-00 00:00:00', 0),
	(848, 4, 9, 0, 0, 0, '0', '2016-02-03 20:28:36', 1, '0000-00-00 00:00:00', 0),
	(849, 4, 30, 0, 0, 0, '0', '2016-02-03 20:28:36', 1, '0000-00-00 00:00:00', 0),
	(850, 4, 31, 0, 0, 0, '0', '2016-02-03 20:28:36', 1, '0000-00-00 00:00:00', 0),
	(851, 4, 32, 0, 0, 0, '0', '2016-02-03 20:28:36', 1, '0000-00-00 00:00:00', 0),
	(852, 4, 33, 0, 0, 0, '0', '2016-02-03 20:28:36', 1, '0000-00-00 00:00:00', 0),
	(853, 4, 34, 0, 0, 0, '0', '2016-02-03 20:28:36', 1, '0000-00-00 00:00:00', 0),
	(854, 3, 1, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(855, 3, 2, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(856, 3, 5, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(857, 3, 6, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(858, 3, 9, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(859, 3, 11, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(860, 3, 12, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(861, 3, 13, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(862, 3, 14, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(863, 3, 15, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(864, 3, 18, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(865, 3, 19, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(866, 3, 20, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(867, 3, 21, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(868, 3, 22, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(869, 3, 30, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(870, 3, 31, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(871, 3, 35, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0),
	(872, 3, 36, 0, 0, 0, '0', '2016-02-03 22:19:22', 1, '0000-00-00 00:00:00', 0);
/*!40000 ALTER TABLE `sys_group_modul` ENABLE KEYS */;


-- Dumping structure for table binasejahtera.sys_modul
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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- Dumping data for table binasejahtera.sys_modul: ~28 rows (approximately)
/*!40000 ALTER TABLE `sys_modul` DISABLE KEYS */;
INSERT INTO `sys_modul` (`id_modul`, `kode_modul`, `nama_modul`, `deskripsi`, `induk`, `induk_menu`, `level_id`, `header`, `link_modul`, `modul_report`, `aktif`, `date_entry`, `user_entry`, `last_update`, `user_update`) VALUES
	(1, '1', 'Admin', '', '', 0, 0, 1, 'admin', 0, 1, NULL, NULL, NULL, NULL),
	(2, '1.1', 'Master Data', '', '1', 1, 1, 1, '', 0, 1, NULL, NULL, NULL, NULL),
	(3, '1.1.1', 'Karyawan', '', '1.1', 2, 2, 0, 'admin/Karyawan', 0, 1, NULL, NULL, NULL, NULL),
	(4, '1.1.2', 'Jabatan', '', '1.1', 2, 2, 0, 'admin/Jabatan', 0, 1, NULL, NULL, NULL, NULL),
	(5, '1.1.3', 'Ksm', '', '1.1', 2, 2, 0, 'admin/Ksm', 0, 1, NULL, NULL, NULL, NULL),
	(6, '1.1.4', 'Nasabah', '', '1.1', 2, 2, 0, 'admin/Nasabah', 0, 1, NULL, NULL, NULL, NULL),
	(7, '1.1.5', 'Departermen', '', '1.1', 2, 2, 0, 'admin/Departemen', 0, 1, NULL, NULL, NULL, NULL),
	(8, '1.1.6', 'Kegiatan', '', '1.1', 2, 2, 0, 'admin/Kegiatan', 0, 1, NULL, NULL, NULL, NULL),
	(9, '1.1.7', 'Kontak', '', '1.1', 2, 2, 0, 'admin/Kontak', 0, 1, NULL, NULL, NULL, NULL),
	(11, '2', 'Akuntansi', '', '', 0, 0, 1, 'akuntansi', 0, 1, NULL, NULL, NULL, NULL),
	(12, '2.1', 'Master Akun', '', '2', 11, 1, 1, '', 0, 1, NULL, NULL, NULL, NULL),
	(13, '2.1.1', 'Kas Bank', '', '2.1', 12, 2, 0, 'admin/KasBank', 0, 1, NULL, NULL, NULL, NULL),
	(14, '2.1.2', 'Pemasukan', '', '2.1', 12, 2, 0, 'admin/Pemasukan', 0, 1, NULL, NULL, NULL, NULL),
	(15, '2.1.3', 'Pengeluaran', '', '2.1', 12, 2, 0, 'admin/Pengeluaran', 0, 1, NULL, NULL, NULL, NULL),
	(18, '3', 'Laporan', '', '', 0, 0, 1, 'laporan', 0, 1, NULL, NULL, NULL, NULL),
	(19, '3.1', 'Pelaporan', '', '3', 18, 1, 1, '', 0, 1, NULL, NULL, NULL, NULL),
	(20, '3.1.1', 'Rugi Laba', '', '3.1', 19, 2, 0, 'laporan/Rugilaba', 0, 1, NULL, NULL, NULL, NULL),
	(21, '3.1.2', 'Aktiva Pasiva', '', '3.1', 19, 2, 0, 'laporan/Neraca', 0, 1, NULL, NULL, NULL, NULL),
	(22, '3.1.3', 'Buku Besar', '', '3.1', 19, 2, 0, 'laporan/Bukubesar', 0, 0, NULL, NULL, NULL, NULL),
	(25, '4', 'Setup', '', '', 0, 0, 1, 'setup', 0, 1, NULL, NULL, NULL, NULL),
	(26, '4.1', 'Pengaturan', '', '4', 25, 1, 1, '', 0, 1, NULL, NULL, NULL, NULL),
	(27, '4.1.1', 'Pengguna', '', '4.1', 26, 2, 0, 'admin/Karyawan', 0, 1, NULL, NULL, NULL, NULL),
	(28, '4.1.2', 'Group Pengguna', '', '4.1', 26, 2, 0, 'setup/GroupUser', 0, 1, NULL, NULL, NULL, NULL),
	(29, '4.1.3', 'Akses Modul Pengguna', '', '4.1', 26, 2, 0, 'setup/UserModul', 0, 1, NULL, NULL, NULL, NULL),
	(30, '5', 'Transaksi', '', '', 0, 0, 1, 'transaksi', 0, 1, NULL, NULL, NULL, NULL),
	(31, '5.1', 'Simpan pinjam', '', '5', 30, 1, 1, '', 0, 1, NULL, NULL, NULL, NULL),
	(32, '5.1.1', 'Pinjaman', '', '5.1', 31, 2, 0, 'transaksi/Pinjaman', 0, 1, NULL, NULL, NULL, NULL),
	(33, '5.1.2', 'Angsuran', '', '5.1', 31, 2, 0, 'transaksi/Angsuran', 0, 1, NULL, NULL, NULL, NULL),
	(34, '5.1.3', 'Simpanan', '', '5.1', 31, 2, 0, 'transaksi/Simpanan', 0, 1, NULL, NULL, NULL, NULL),
	(35, '5.1.4', 'BKK', '', '5.1', 31, 2, 0, 'transaksi/Bkk', 0, 1, NULL, NULL, NULL, NULL),
	(36, '5.1.5', 'BKM', '', '5.1', 31, 2, 0, 'transaksi/Bkm', 0, 1, NULL, NULL, NULL, NULL),
	(37, '2.2', 'Jurnal', '', '2', 11, 1, 1, '', 0, 1, NULL, NULL, NULL, NULL),
	(38, '2.2.1', 'Jurnal Penyesuaian', '', '2.2', 37, 2, 0, 'akuntansi/Penyesuaian', 0, 1, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `sys_modul` ENABLE KEYS */;


-- Dumping structure for table binasejahtera.sys_session
DROP TABLE IF EXISTS `sys_session`;
CREATE TABLE IF NOT EXISTS `sys_session` (
  `id_session` varchar(40) NOT NULL DEFAULT '0',
  `id_user` int(5) NOT NULL,
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table binasejahtera.sys_session: ~75 rows (approximately)
/*!40000 ALTER TABLE `sys_session` DISABLE KEYS */;
INSERT INTO `sys_session` (`id_session`, `id_user`, `ip_address`, `user_agent`) VALUES
	('3feebc69c8ad6862288f57a318a0d52e', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('1b115052d411ebd2e39e58fdfacef462', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('f7b479190a2b824479c45a1b9ae1500b', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('ce71028ccc3458d6edee2bb68648df2a', 1, '192.168.0.27', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('8c7114e711c838d8e69add824034e61f', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('3f2dbdab1e5ed79a6ecf3ea1fe929ac3', 1, '192.168.0.27', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('97db6835516872fa7b056de05a31a049', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('b079f2bec24c764961eccdf0f16e0d0f', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('8be16304ffcfae2c86cedc4311768d4c', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:42.0) Gecko/20100101 Firefox/42.0'),
	('fe002f0a158374880f54f8d6384c1a1c', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('af1e2ae681d1614b007092fcd39a68e7', 1, '10.208.202.217', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('235497e416b037151a575c67bbfd55ff', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('f5d220e4683f64f8705a3a69fdcc34d6', 1, '192.168.0.27', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('97c3fa4d24828a3209214c7b651e9128', 1, '192.168.0.27', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('9cf2bb5c517dec89cd88d18a05390854', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('47616d87a045eb98a88d57d5994dd1f2', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('5ac1b9c2be8370f1690f2d1f1c6bf656', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('72ebba89ec058e33868dcff8b7e9924e', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('2cb132591c80fd95016cfb5c0b634597', 1, 'fe80::5495:7593:ed6c:ec27', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36'),
	('f3d5a47fc4a40543eeeef5fcd494557a', 1, 'fe80::5495:7593:ed6c:ec27', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36'),
	('d800712784e05b67e0fdb4f0b0d40716', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.73 Safari/537.36'),
	('6d9815448e4a7152ffc33762542cc54e', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36'),
	('6cd686e5026a572ef2a6d7851f2bf26b', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36'),
	('ca04e739599f8d96d389670abc12362d', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36'),
	('735e2e3f2919cf57484882d9ebd65baf', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36'),
	('bcb32f3d1f4266504d244f5493bc2518', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('eca0cd800dab5b43902aba0e053c91fb', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('38aab25dc3fc16d01e8d589c7dbee32c', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('fb794b12117b568a4bc23e08c949a973', 1, '192.168.169.2', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('7398787f0017750c9a778a854387bfa4', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('cde72b2fbeb0ed688cf7994d02fbe0ee', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('ffdc0f2f3c72057f3b625e02fb814fb5', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('64f6767e98835ac77b88fc1b1b8b033b', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('f47e52719c1821adb5760ffbc745f145', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('1c72643a8572544a607d1c0be68f2a61', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('b25f563ae6132e57798f8688bcc6c74a', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('3a6ef35a53895833d15fede027a17f3c', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('ab220e4b72f48aedde7f1fc3838cc722', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('fdc9d9a2018a8a5bd716f466b64d149d', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('323c5f8497749073c7ccb272289fd156', 1, '192.168.169.6', 'Mozilla/5.0 (Linux; Android 4.2.2; C2105 Build/15.3.A.1.14) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.109 '),
	('ded5951583be0cdf3856a76596836034', 1, '192.168.169.5', 'Mozilla/5.0 (Linux; Android 4.4.2; Smartfren Andromax AD6B1H Build/KVT49L) AppleWebKit/537.36 (KHTML, like Gecko) Chrome'),
	('106f3721d862484168aeefd08ab5cebb', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('08d888ffd48cca32b2b93176e64028f4', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('934a8e589d5dc0f0634b3e00bd78c2dd', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('e2750f00872d196a2070c01ac2168132', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('e1b67831716a150fa7eaae8f87431b2c', 52, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('a9501e09a4e50ddc46a253dc26a0cbcb', 53, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('963f23edf4fe2536d92c4a326a0bc4a7', 54, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('4a249c5cf3480a594f01f6c8478aed90', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('a9b5e6e80d745786738278e6d2354c26', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('b74b77f5eff78e93cee4c48a0f93fa0a', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('4f3903c000eab203aabd19b0e6a0ba75', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('37a392eca6fe90d2c64157c8e2f726e0', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36'),
	('d93e5258b822c4c6c7a6a1b5d45fb098', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36'),
	('47dbd76f4cd0b9fbb31bac60bd2438b2', 52, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0'),
	('e724ad9b41301992622e50f8b29d5ea2', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36'),
	('3c3a611d4a0fba6e699959237e07d724', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36'),
	('af892177dd6620fcbc710973ce972140', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36'),
	('9cccb432d2b2c4aa49b767a5eadd4575', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36'),
	('fb1cd46fad4540e8d900dc43ebd1f0a0', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36'),
	('249ee50340e35f2d1c4c31b51d5ee92b', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36'),
	('edf012f952c02391f1fa70f6b97599ef', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36'),
	('174ec2d25027ac82f6c5243b29b87603', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36'),
	('ea5c26750466788700e19c1f57b41cdb', 1, '192.168.169.2', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36'),
	('10bcbb238c3193b2c928e63e36522eeb', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36'),
	('de7fe40d18c18378719783db16090c1f', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36'),
	('915b60e2233f4a7a9505514acb73048e', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36'),
	('32cfa7fc8361dbfd195e16781f33f07c', 1, '192.168.169.3', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36'),
	('316ad6fcbd83e3b8d82e845c1e0bcfac', 1, '192.168.43.174', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'),
	('2e6e4756bbad20e607e24ba4252eb3fa', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.97 Safari/537.36'),
	('7f792149735f608372edb32f340cfebc', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.97 Safari/537.36'),
	('fd1bad9ede8a2df30f48532c7ebab70b', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.97 Safari/537.36'),
	('3d755d43752b44a0167a35e005c0be28', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.97 Safari/537.36'),
	('013eeb7566fc4e9cb13cc2bd6ce67381', 53, '192.168.169.2', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.97 Safari/537.36'),
	('11bd05d92edc67cbebc2ca9bb63e7974', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36'),
	('a901f7531dd6ac05693ea799e82a9488', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.103 Safari/537.36');
/*!40000 ALTER TABLE `sys_session` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
