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

-- Dumping structure for table timesheet_syncore.ref_jabatan
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table timesheet_syncore.ref_jabatan: ~16 rows (approximately)
/*!40000 ALTER TABLE `ref_jabatan` DISABLE KEYS */;
INSERT INTO `ref_jabatan` (`id_jabatan`, `kode_jabatan`, `nama_jabatan`, `deskripsi`, `date_entry`, `user_entry`, `last_update`, `user_update`) VALUES
	(1, 'ADMS', 'Admininistrator', '', NULL, NULL, '2015-05-24 17:29:14', 1),
	(2, 'PRG1', 'Senior Programmer', '', '2015-05-21 17:53:29', 1, '2015-05-24 17:26:13', 1),
	(3, 'PRG2', 'Programmer', '', '2015-05-21 17:54:01', 1, '2015-05-24 17:26:27', 1),
	(4, 'DRK', 'Direktur', '', '2015-05-21 17:54:30', 1, '0000-00-00 00:00:00', 0),
	(5, 'MDA', 'Media', '', '2015-05-21 17:55:20', 1, '0000-00-00 00:00:00', 0),
	(6, 'TRN', 'Training', '', '2015-05-21 17:55:28', 1, '0000-00-00 00:00:00', 0),
	(7, 'KNS', 'Konsultan', '', '2015-05-21 17:55:41', 1, '0000-00-00 00:00:00', 0),
	(8, 'STMG', 'Staff Magang', '', '2015-05-21 17:55:50', 1, '2015-05-24 17:30:43', 1),
	(9, 'CRP', 'Corporate', '', '2015-05-21 18:02:19', 1, '0000-00-00 00:00:00', 0),
	(10, 'AMK', 'Asisten Manager Div. Konsultan', '', '2015-05-24 17:28:11', 1, '0000-00-00 00:00:00', 0),
	(11, 'ADM', 'Administrasi', '', '2015-05-24 17:29:48', 1, '0000-00-00 00:00:00', 0),
	(12, 'STU', 'Staff Umum', '', '2015-05-24 17:30:17', 1, '0000-00-00 00:00:00', 0),
	(13, 'WPM', 'Web Programmer', '', '2015-05-24 17:32:15', 1, '0000-00-00 00:00:00', 0),
	(14, 'REDT', 'Redaktur/Editor', '', '2015-05-24 17:32:34', 1, '0000-00-00 00:00:00', 0),
	(15, 'ASYS', 'Analis System', '', '2015-05-24 17:33:05', 1, '0000-00-00 00:00:00', 0),
	(16, 'TS', 'Technical Support', '', '2015-05-24 17:33:27', 1, '0000-00-00 00:00:00', 0);
/*!40000 ALTER TABLE `ref_jabatan` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
