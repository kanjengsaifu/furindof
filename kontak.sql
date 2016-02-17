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

-- Dumping structure for table kuitansi.mst_kontak
CREATE TABLE IF NOT EXISTS `mst_kontak` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idtipe` int(11) NOT NULL DEFAULT '0',
  `idjenis` int(11) NOT NULL DEFAULT '0',
  `idperusahaan` int(5) DEFAULT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `kodepos` varchar(10) DEFAULT NULL,
  `notelp` varchar(50) DEFAULT NULL,
  `nofax` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(300) DEFAULT NULL,
  `builtin` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ref_16` (`idtipe`),
  KEY `ref_44` (`idjenis`),
  KEY `reffA5` (`idperusahaan`),
  KEY `kode` (`kode`),
  KEY `kode_2` (`kode`),
  KEY `nama` (`nama`),
  CONSTRAINT `ref_16` FOREIGN KEY (`idtipe`) REFERENCES `ref_kontaktipe` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ref_44` FOREIGN KEY (`idjenis`) REFERENCES `mst_kontakjenis` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `reffA5` FOREIGN KEY (`idperusahaan`) REFERENCES `sys_perusahaan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table kuitansi.mst_kontakjenis
CREATE TABLE IF NOT EXISTS `mst_kontakjenis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idperusahaan` int(5) DEFAULT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(300) DEFAULT NULL,
  `builtin` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `reffA6` (`idperusahaan`),
  CONSTRAINT `reffA6` FOREIGN KEY (`idperusahaan`) REFERENCES `sys_perusahaan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
