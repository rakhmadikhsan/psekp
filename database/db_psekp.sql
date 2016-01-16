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

-- Dumping database structure for db_psekp
CREATE DATABASE IF NOT EXISTS `db_psekp` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_psekp`;


-- Dumping structure for table db_psekp.pelatihan
CREATE TABLE IF NOT EXISTS `pelatihan` (
  `id_pelatihan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelatihan` text,
  `status` int(11) DEFAULT NULL,
  `datetime_mulai` datetime DEFAULT NULL,
  `datetime_selesai` datetime DEFAULT NULL,
  `quota` int(5) DEFAULT NULL,
  `tempat` tinytext,
  `deskripsi` text,
  PRIMARY KEY (`id_pelatihan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_psekp.pelatihan: ~1 rows (approximately)
/*!40000 ALTER TABLE `pelatihan` DISABLE KEYS */;
INSERT INTO `pelatihan` (`id_pelatihan`, `nama_pelatihan`, `status`, `datetime_mulai`, `datetime_selesai`, `quota`, `tempat`, `deskripsi`) VALUES
	(2, 'Pelatihan 2asdasd', 1, '2016-01-13 08:21:55', '2016-01-13 08:22:55', 200, 'tempat bbb', 'deskripsi 2222');
/*!40000 ALTER TABLE `pelatihan` ENABLE KEYS */;


-- Dumping structure for table db_psekp.pengajar
CREATE TABLE IF NOT EXISTS `pengajar` (
  `id_pengajar` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_pengajar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_psekp.pengajar: ~0 rows (approximately)
/*!40000 ALTER TABLE `pengajar` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengajar` ENABLE KEYS */;


-- Dumping structure for table db_psekp.peserta
CREATE TABLE IF NOT EXISTS `peserta` (
  `id_peserta` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(50) DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `instansi` varchar(50) DEFAULT NULL,
  `img` text,
  `daerah` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `datetime_daftar` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `alamat` tinytext,
  PRIMARY KEY (`id_peserta`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table db_psekp.peserta: ~1 rows (approximately)
/*!40000 ALTER TABLE `peserta` DISABLE KEYS */;
INSERT INTO `peserta` (`id_peserta`, `nip`, `telepon`, `nama`, `instansi`, `img`, `daerah`, `status`, `fax`, `email`, `hp`, `datetime_daftar`, `alamat`) VALUES
	(8, 'asddas', 'gjhg', 'jshsj', 'gjhg', NULL, 'hjg', NULL, 'hj', 'hj', 'hjg', '2016-01-15 10:40:13', 'jhg');
/*!40000 ALTER TABLE `peserta` ENABLE KEYS */;


-- Dumping structure for table db_psekp.peserta_has_pelatihan
CREATE TABLE IF NOT EXISTS `peserta_has_pelatihan` (
  `id_peserta_has_pelatihan` int(11) NOT NULL AUTO_INCREMENT,
  `id_peserta_fk` int(11) DEFAULT NULL,
  `id_pelatihan_fk` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL COMMENT '1: cash; 2:transfer',
  `datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reff` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_peserta_has_pelatihan`),
  KEY `id_peserta_fk` (`id_peserta_fk`),
  KEY `id__pelatihan_fk` (`id_pelatihan_fk`),
  KEY `reff` (`reff`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table db_psekp.peserta_has_pelatihan: ~13 rows (approximately)
/*!40000 ALTER TABLE `peserta_has_pelatihan` DISABLE KEYS */;
INSERT INTO `peserta_has_pelatihan` (`id_peserta_has_pelatihan`, `id_peserta_fk`, `id_pelatihan_fk`, `status`, `payment`, `datetime`, `reff`) VALUES
	(1, 1, 0, NULL, NULL, NULL, NULL),
	(2, 1, 0, NULL, NULL, NULL, NULL),
	(3, 0, 0, NULL, NULL, NULL, NULL),
	(4, 1, 0, NULL, NULL, NULL, NULL),
	(5, 1, 1, NULL, NULL, NULL, NULL),
	(6, 1, 0, NULL, NULL, NULL, NULL),
	(7, 1, 2, NULL, NULL, NULL, NULL),
	(8, 1, 1, 1, 0, '2016-01-13 08:53:49', NULL),
	(9, 1, 2, 1, 1, '2016-01-13 08:57:25', NULL),
	(10, 1, 2, 1, 1, '2016-01-13 09:44:42', NULL),
	(11, 1, 2, 1, 1, '2016-01-13 09:45:12', NULL),
	(12, 1, 2, 1, 1, '2016-01-13 09:46:17', NULL),
	(13, 1, 2, 1, 1, '2016-01-13 09:54:42', NULL);
/*!40000 ALTER TABLE `peserta_has_pelatihan` ENABLE KEYS */;


-- Dumping structure for table db_psekp.upload_excel
CREATE TABLE IF NOT EXISTS `upload_excel` (
  `id_upload_excel` int(11) NOT NULL AUTO_INCREMENT,
  `filename` text,
  `id_peserta_fk` int(11) DEFAULT NULL,
  `id_pelatihan_fk` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_upload_excel`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_psekp.upload_excel: ~3 rows (approximately)
/*!40000 ALTER TABLE `upload_excel` DISABLE KEYS */;
INSERT INTO `upload_excel` (`id_upload_excel`, `filename`, `id_peserta_fk`, `id_pelatihan_fk`, `status`, `datetime`) VALUES
	(1, '04082e71c4e6590849ce481662a9453a.xlsx', 1, 2, 0, NULL),
	(2, 'b76e9d17de1c6db165ff8fa94c4c1795.xls', 1, 1, 0, '2016-01-14 14:32:37'),
	(3, '782a1146e3b954ccfd40229c242af434.xls', 1, 2, 0, '2016-01-14 14:33:30');
/*!40000 ALTER TABLE `upload_excel` ENABLE KEYS */;


-- Dumping structure for table db_psekp.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` int(1) DEFAULT NULL,
  `datetime_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

-- Dumping data for table db_psekp.user: ~3 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `name`, `username`, `password`, `role`, `datetime_create`) VALUES
	(100, '0', 'sd', '23', 2, '2016-01-12 07:33:27'),
	(101, '0', 'as', 'as', 1, '2016-01-12 09:07:29'),
	(104, 'Rakhmad Ikhsanudin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2016-01-12 09:31:00');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
