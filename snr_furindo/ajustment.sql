-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table snr_new.ajs_jurnal
DROP TABLE IF EXISTS `ajs_jurnal`;
CREATE TABLE IF NOT EXISTS `ajs_jurnal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `keterangan` text,
  `status` tinyint(1) NOT NULL,
  `user_created` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table snr_new.ajs_jurnal_detail
DROP TABLE IF EXISTS `ajs_jurnal_detail`;
CREATE TABLE IF NOT EXISTS `ajs_jurnal_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ajs_jurnal` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `akun` varchar(50) NOT NULL,
  `uraian` text NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`),
  KEY `id_ajs_jurnal` (`id_ajs_jurnal`),
  CONSTRAINT `FK_ajs_jurnal_detail_ajs_jurnal` FOREIGN KEY (`id_ajs_jurnal`) REFERENCES `ajs_jurnal` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
