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

-- Dumping structure for table kuitansi.mst_dept
DROP TABLE IF EXISTS `mst_dept`;
CREATE TABLE IF NOT EXISTS `mst_dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idperusahaan` int(5) DEFAULT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(300) DEFAULT NULL,
  `builtin` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `reffA1` (`idperusahaan`),
  CONSTRAINT `reffA1` FOREIGN KEY (`idperusahaan`) REFERENCES `sys_perusahaan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table kuitansi.mst_kasbank
DROP TABLE IF EXISTS `mst_kasbank`;
CREATE TABLE IF NOT EXISTS `mst_kasbank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idperusahaan` int(5) DEFAULT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `norekbank` varchar(20) DEFAULT NULL,
  `namabank` varchar(50) DEFAULT NULL,
  `idmatauang` int(11) NOT NULL DEFAULT '0',
  `notaktif` tinyint(4) DEFAULT '0',
  `deskripsi` varchar(300) DEFAULT NULL,
  `builtin` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ref_14` (`idmatauang`),
  KEY `reffA2` (`idperusahaan`),
  CONSTRAINT `ref_14` FOREIGN KEY (`idmatauang`) REFERENCES `mst_matauang` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `reffA2` FOREIGN KEY (`idperusahaan`) REFERENCES `sys_perusahaan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table kuitansi.mst_kegiatan
DROP TABLE IF EXISTS `mst_kegiatan`;
CREATE TABLE IF NOT EXISTS `mst_kegiatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idperusahaan` int(5) DEFAULT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(300) DEFAULT NULL,
  `builtin` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `reffA4` (`idperusahaan`),
  CONSTRAINT `reffA4` FOREIGN KEY (`idperusahaan`) REFERENCES `sys_perusahaan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table kuitansi.mst_pemasukan
DROP TABLE IF EXISTS `mst_pemasukan`;
CREATE TABLE IF NOT EXISTS `mst_pemasukan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idperusahaan` int(5) DEFAULT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `builtin` int(1) DEFAULT '0',
  `jenis` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `reffA8` (`idperusahaan`),
  CONSTRAINT `reffA8` FOREIGN KEY (`idperusahaan`) REFERENCES `sys_perusahaan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table kuitansi.mst_pengeluaran
DROP TABLE IF EXISTS `mst_pengeluaran`;
CREATE TABLE IF NOT EXISTS `mst_pengeluaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idperusahaan` int(5) DEFAULT NULL,
  `kode` varchar(50) NOT NULL DEFAULT '0',
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `builtin` int(1) DEFAULT '0',
  `jenis` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reffA9` (`idperusahaan`),
  CONSTRAINT `reffA9` FOREIGN KEY (`idperusahaan`) REFERENCES `sys_perusahaan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table kuitansi.mst_sumberdana
DROP TABLE IF EXISTS `mst_sumberdana`;
CREATE TABLE IF NOT EXISTS `mst_sumberdana` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idperusahaan` int(5) DEFAULT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(300) DEFAULT NULL,
  `builtin` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `reffA10` (`idperusahaan`),
  CONSTRAINT `reffA10` FOREIGN KEY (`idperusahaan`) REFERENCES `sys_perusahaan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table kuitansi.trx_angg
DROP TABLE IF EXISTS `trx_angg`;
CREATE TABLE IF NOT EXISTS `trx_angg` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `idperusahaan` int(11) DEFAULT NULL,
  `idkategori` int(11) DEFAULT NULL,
  `datentry` datetime DEFAULT NULL,
  `userentry` int(11) DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `userupdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reffA17` (`idperusahaan`),
  CONSTRAINT `reffA17` FOREIGN KEY (`idperusahaan`) REFERENCES `sys_perusahaan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table kuitansi.trx_anggdet
DROP TABLE IF EXISTS `trx_anggdet`;
CREATE TABLE IF NOT EXISTS `trx_anggdet` (
  `idanggdet` int(20) NOT NULL AUTO_INCREMENT,
  `idangg` int(20) DEFAULT NULL,
  `idsumberdana` int(11) DEFAULT NULL,
  `iddept` int(11) DEFAULT NULL,
  `idkegiatan` int(11) DEFAULT NULL,
  `uraian` varchar(300) DEFAULT NULL,
  `memo` varchar(300) DEFAULT NULL,
  `nominalawal` double(18,3) DEFAULT NULL,
  `nilaitukar` double(18,3) DEFAULT '1.000',
  PRIMARY KEY (`idanggdet`),
  KEY `reff_43` (`idangg`),
  KEY `reff_44` (`idsumberdana`),
  KEY `reff_45` (`idkegiatan`),
  KEY `reff_46` (`iddept`),
  CONSTRAINT `reff_43` FOREIGN KEY (`idangg`) REFERENCES `trx_angg` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `reff_44` FOREIGN KEY (`idsumberdana`) REFERENCES `mst_sumberdana` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `reff_45` FOREIGN KEY (`idkegiatan`) REFERENCES `mst_sumberdana` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `reff_46` FOREIGN KEY (`iddept`) REFERENCES `mst_dept` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table kuitansi.trx_ju
DROP TABLE IF EXISTS `trx_ju`;
CREATE TABLE IF NOT EXISTS `trx_ju` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idperusahaan` int(5) DEFAULT NULL,
  `nomor` varchar(50) NOT NULL,
  `tgl` date DEFAULT NULL,
  `uraian` varchar(300) DEFAULT NULL,
  `nobukti` varchar(50) DEFAULT NULL,
  `idkategori` int(11) DEFAULT NULL,
  `idposting` varchar(20) DEFAULT NULL,
  `dateentry` datetime DEFAULT NULL,
  `userentry` int(11) DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `userupdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_nomor` (`nomor`),
  UNIQUE KEY `idx_idposting` (`idposting`),
  KEY `ref_09` (`idkategori`),
  KEY `reffA18` (`idperusahaan`),
  CONSTRAINT `ref_09` FOREIGN KEY (`idkategori`) REFERENCES `mst_kategori` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `reffA18` FOREIGN KEY (`idperusahaan`) REFERENCES `sys_perusahaan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table kuitansi.trx_judet
DROP TABLE IF EXISTS `trx_judet`;
CREATE TABLE IF NOT EXISTS `trx_judet` (
  `idjudet` int(20) NOT NULL AUTO_INCREMENT,
  `idju` bigint(20) NOT NULL,
  `uraian` varchar(300) DEFAULT NULL,
  `memo` varchar(300) DEFAULT NULL,
  `nominalawal` double(18,3) DEFAULT NULL,
  `nilaitukar` double(18,3) DEFAULT NULL,
  `iddept` int(11) DEFAULT NULL,
  `idkegiatan` int(11) DEFAULT NULL,
  `idsumberdana` int(11) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  PRIMARY KEY (`idjudet`),
  KEY `ref_08` (`idju`),
  KEY `ref_10` (`iddept`),
  KEY `ref_11` (`idkegiatan`),
  KEY `ref_12` (`idsumberdana`),
  CONSTRAINT `ref_08` FOREIGN KEY (`idju`) REFERENCES `trx_ju` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ref_10` FOREIGN KEY (`iddept`) REFERENCES `mst_dept` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ref_11` FOREIGN KEY (`idkegiatan`) REFERENCES `mst_kegiatan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ref_12` FOREIGN KEY (`idsumberdana`) REFERENCES `mst_sumberdana` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table kuitansi.trx_kas
DROP TABLE IF EXISTS `trx_kas`;
CREATE TABLE IF NOT EXISTS `trx_kas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idperusahaan` int(5) DEFAULT NULL,
  `nomor` varchar(50) NOT NULL,
  `tgl` date DEFAULT NULL,
  `uraian` varchar(300) DEFAULT NULL,
  `nobukti` varchar(50) DEFAULT NULL,
  `idkasbank` int(11) NOT NULL,
  `idkontak` bigint(20) NOT NULL,
  `idkategori` int(11) DEFAULT NULL,
  `jenis` varchar(2) DEFAULT 'um' COMMENT 'um atau uk',
  `sumber` varchar(50) NOT NULL,
  `idposting` varchar(20) DEFAULT NULL,
  `dateentry` datetime DEFAULT NULL,
  `userentry` int(11) DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `userupdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_03` (`idkategori`),
  KEY `ref_15` (`idkasbank`),
  KEY `ref_18` (`idkontak`),
  KEY `reffA19` (`idperusahaan`),
  CONSTRAINT `ref_03` FOREIGN KEY (`idkategori`) REFERENCES `mst_kategori` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ref_15` FOREIGN KEY (`idkasbank`) REFERENCES `mst_kasbank` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ref_18` FOREIGN KEY (`idkontak`) REFERENCES `mst_kontak` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `reffA19` FOREIGN KEY (`idperusahaan`) REFERENCES `sys_perusahaan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table kuitansi.trx_kasdet
DROP TABLE IF EXISTS `trx_kasdet`;
CREATE TABLE IF NOT EXISTS `trx_kasdet` (
  `idkasdet` int(20) NOT NULL AUTO_INCREMENT,
  `idkas` bigint(20) NOT NULL,
  `idspm` bigint(20) DEFAULT NULL,
  `kode` varchar(25) DEFAULT NULL,
  `uraian` varchar(300) DEFAULT NULL,
  `memo` varchar(300) DEFAULT NULL,
  `nominalawal` double(18,3) DEFAULT NULL,
  `nilaitukar` double(18,3) DEFAULT NULL,
  `iddept` int(11) DEFAULT NULL,
  `idkegiatan` int(11) DEFAULT NULL,
  `idsumberdana` int(11) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  PRIMARY KEY (`idkasdet`),
  KEY `idx_idspm` (`idspm`),
  KEY `ref_01` (`idkas`),
  KEY `ref_04` (`iddept`),
  KEY `ref_05` (`idkegiatan`),
  KEY `ref_06` (`idsumberdana`),
  CONSTRAINT `ref_01` FOREIGN KEY (`idkas`) REFERENCES `trx_kas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ref_04` FOREIGN KEY (`iddept`) REFERENCES `mst_dept` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ref_05` FOREIGN KEY (`idkegiatan`) REFERENCES `mst_kegiatan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ref_06` FOREIGN KEY (`idsumberdana`) REFERENCES `mst_sumberdana` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ref_34` FOREIGN KEY (`idspm`) REFERENCES `trx_spm` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
