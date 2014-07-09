-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-07-2014 a las 12:43:37
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cts`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bus_uni`
--

CREATE TABLE IF NOT EXISTS `bus_uni` (
  `per` varchar(7) NOT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `busUni` varchar(50) DEFAULT NULL,
  KEY `sku` (`sku`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cos_alm`
--

CREATE TABLE IF NOT EXISTS `cos_alm` (
  `per` varchar(7) NOT NULL,
  `shiPoi` int(5) NOT NULL,
  `sku` bigint(14) DEFAULT NULL,
  `pro` double(20,10) DEFAULT NULL,
  `ven` varchar(12) DEFAULT NULL,
  `diaInv` double(20,10) DEFAULT NULL,
  `estIba` int(2) DEFAULT NULL,
  `estAnd` int(3) DEFAULT NULL,
  `cosCaj` double(20,10) DEFAULT NULL,
  `cosAlm` double(20,10) DEFAULT NULL,
  KEY `sku` (`sku`),
  KEY `sku_2` (`sku`),
  KEY `shiPoi` (`shiPoi`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cos_alm_fac`
--

CREATE TABLE IF NOT EXISTS `cos_alm_fac` (
  `per` varchar(7) NOT NULL,
  `shiPoi` varchar(5) DEFAULT NULL,
  `cosRen` double(20,10) DEFAULT NULL,
  `facOcu` double(20,10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cos_alm_sku`
--

CREATE TABLE IF NOT EXISTS `cos_alm_sku` (
  `sku` varchar(12) DEFAULT NULL,
  `cosAlmRea` double(20,10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cos_alm_ven_sku`
--

CREATE TABLE IF NOT EXISTS `cos_alm_ven_sku` (
  `per` varchar(7) NOT NULL,
  `shiPoi` int(6) DEFAULT NULL,
  `sku` bigint(14) DEFAULT NULL,
  `ven` double(20,10) DEFAULT NULL,
  KEY `sku` (`sku`),
  KEY `shiPoi` (`shiPoi`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cta_esp`
--

CREATE TABLE IF NOT EXISTS `cta_esp` (
  `cta` int(9) DEFAULT NULL,
  `pay` int(9) DEFAULT NULL,
  `payNam` varchar(100) DEFAULT NULL,
  `por` varchar(20) DEFAULT NULL,
  KEY `pay` (`pay`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cts_com`
--

CREATE TABLE IF NOT EXISTS `cts_com` (
  `per` varchar(7) DEFAULT NULL,
  `modulo` varchar(3) DEFAULT NULL,
  `com` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `del_cub_met`
--

CREATE TABLE IF NOT EXISTS `del_cub_met` (
  `per` varchar(7) NOT NULL,
  `del` int(12) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  KEY `del` (`del`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dxdgen`
--

CREATE TABLE IF NOT EXISTS `dxdgen` (
  `payNam` varchar(500) DEFAULT NULL,
  `payint` int(10) DEFAULT NULL,
  `dxdKel` double(20,10) DEFAULT NULL,
  `dxdLog` double(20,10) DEFAULT NULL,
  `dxdRec` double(20,10) DEFAULT NULL,
  `tip` int(2) DEFAULT NULL,
  `fac` double(20,10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dxd_liz`
--

CREATE TABLE IF NOT EXISTS `dxd_liz` (
  `per` varchar(7) NOT NULL,
  `pay` int(10) DEFAULT NULL,
  `solToNam` varchar(500) DEFAULT NULL,
  `solToPar` int(10) DEFAULT NULL,
  `groSal` double(20,10) DEFAULT NULL,
  `shiKil` double(20,10) DEFAULT NULL,
  `por` varchar(500) DEFAULT NULL,
  `dxd` double(20,10) DEFAULT NULL,
  `fac` int(3) DEFAULT NULL,
  `totMet` double(20,10) DEFAULT NULL,
  `dxdMet` double(20,10) DEFAULT NULL,
  `enc` int(1) DEFAULT NULL,
  KEY `solToPar` (`solToPar`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dxd_liz_pay`
--

CREATE TABLE IF NOT EXISTS `dxd_liz_pay` (
  `per` varchar(7) NOT NULL,
  `pay` int(10) DEFAULT NULL,
  `dxd` double(20,10) DEFAULT NULL,
  `totMet` double(20,10) DEFAULT NULL,
  `dxdMet` double(20,10) DEFAULT NULL,
  `tip` int(3) DEFAULT NULL,
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dxd_log`
--

CREATE TABLE IF NOT EXISTS `dxd_log` (
  `shiToPar` int(10) DEFAULT NULL,
  `cub` int(3) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  `fleCubMet` double(20,10) NOT NULL,
  `dxdLog` double(20,10) DEFAULT NULL,
  `fle` int(3) DEFAULT NULL,
  `groSal` double(20,10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dxd_rec_liz`
--

CREATE TABLE IF NOT EXISTS `dxd_rec_liz` (
  `per` varchar(7) NOT NULL,
  `pay` int(10) DEFAULT NULL,
  `solToNam` varchar(500) NOT NULL DEFAULT '',
  `solToPar` int(10) DEFAULT NULL,
  `tra` int(10) DEFAULT NULL,
  `faiVal` double(20,10) DEFAULT NULL,
  `tot` double(20,10) DEFAULT NULL,
  `allo` double(20,10) DEFAULT NULL,
  `tip` double(20,10) DEFAULT NULL,
  `totMet` double(20,10) DEFAULT NULL,
  `allMet` double(20,10) DEFAULT NULL,
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dxd_rec_liz_pay`
--

CREATE TABLE IF NOT EXISTS `dxd_rec_liz_pay` (
  `per` varchar(7) NOT NULL,
  `pay` int(10) DEFAULT NULL,
  `allo` double(20,10) DEFAULT NULL,
  `tip` int(3) DEFAULT NULL,
  `totMet` double(20,10) DEFAULT NULL,
  `allMet` double(20,10) DEFAULT NULL,
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fac_dxd`
--

CREATE TABLE IF NOT EXISTS `fac_dxd` (
  `shiToPar` varchar(10) DEFAULT NULL,
  `pay` int(9) DEFAULT NULL,
  `nomUno` varchar(500) NOT NULL,
  `nomDos` varchar(500) NOT NULL,
  `dxd` int(1) DEFAULT NULL,
  `tip` int(1) DEFAULT NULL,
  `fac` varchar(100) DEFAULT NULL,
  `desFac` varchar(200) DEFAULT NULL,
  `com` varchar(500) DEFAULT NULL,
  `cub` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fletes`
--

CREATE TABLE IF NOT EXISTS `fletes` (
  `per` varchar(7) DEFAULT NULL,
  `shiDocNum` int(10) DEFAULT NULL,
  `cos` double(20,10) DEFAULT NULL,
  `cubMet` double(20,10) DEFAULT NULL,
  KEY `shiDocNum` (`shiDocNum`),
  KEY `per` (`per`),
  KEY `per_2` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fle_com`
--

CREATE TABLE IF NOT EXISTS `fle_com` (
  `shiDocNum` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fle_cub_met`
--

CREATE TABLE IF NOT EXISTS `fle_cub_met` (
  `per` varchar(7) DEFAULT NULL,
  `shiDocNum` int(9) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  KEY `shiDocNum` (`shiDocNum`),
  KEY `shiDocNum_2` (`shiDocNum`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fle_del`
--

CREATE TABLE IF NOT EXISTS `fle_del` (
  `per` varchar(7) NOT NULL,
  `salOrg` int(6) DEFAULT NULL,
  `fisYeaPer` varchar(9) DEFAULT NULL,
  `fisWee` varchar(9) DEFAULT NULL,
  `shiPoi` int(5) DEFAULT NULL,
  `solToCha` int(10) DEFAULT NULL,
  `solToChaNam` varchar(100) DEFAULT NULL,
  `solToPar` int(10) DEFAULT NULL,
  `solToParNam` varchar(100) DEFAULT NULL,
  `shiToPar` int(10) DEFAULT NULL,
  `shiToNam` varchar(100) DEFAULT NULL,
  `loc` varchar(100) DEFAULT NULL,
  `shiDocNum` int(10) DEFAULT NULL,
  `shiDate` varchar(50) DEFAULT NULL,
  `apoMns` varchar(10) DEFAULT NULL,
  `del` int(12) DEFAULT NULL,
  `bwDoc` int(10) DEFAULT NULL,
  `mat` bigint(14) DEFAULT NULL,
  `matDes` varchar(200) DEFAULT NULL,
  `shiKil` double(12,3) DEFAULT NULL,
  `shiCubMet` double(12,3) DEFAULT NULL,
  `delQua` double(12,3) DEFAULT NULL,
  `netKil` double(20,10) NOT NULL,
  `groSal` double(20,10) NOT NULL,
  `netSal` double(20,10) NOT NULL,
  `cosDel` double(12,3) DEFAULT NULL,
  `porParKil` double(20,10) DEFAULT NULL,
  `ovhDel` double(20,10) DEFAULT NULL,
  `pay` int(9) DEFAULT NULL,
  `payNam` varchar(100) DEFAULT NULL,
  `payNamCon` varchar(500) DEFAULT NULL,
  `ovhCtaEsp` double(20,10) DEFAULT NULL,
  `dxd` int(1) DEFAULT NULL,
  `plaSku` int(10) DEFAULT NULL,
  `inbOri` double(20,10) DEFAULT NULL,
  `inbDes` double(20,10) DEFAULT NULL,
  `inbRec` double(20,10) DEFAULT NULL,
  `dxdCla` double(20,10) DEFAULT NULL,
  `gasEve` double(20,10) DEFAULT NULL,
  `tplInb` double(20,10) DEFAULT NULL,
  `tplFij` double(20,10) DEFAULT NULL,
  `mfmDxd` double(20,10) DEFAULT NULL,
  `fijOutBou` double(20,10) DEFAULT NULL,
  `ren` double(20,10) DEFAULT NULL,
  `tplCosCar` double(20,10) DEFAULT NULL,
  `tplFijRec` double(20,10) DEFAULT NULL,
  `dxdLog` double(20,10) DEFAULT NULL,
  `renCapOpe` double(20,10) DEFAULT NULL,
  `outMan` double(20,10) DEFAULT NULL,
  `dxdTotAux` double(20,10) DEFAULT NULL,
  `dxdRecAux` double(20,10) DEFAULT NULL,
  `dxdLOgAux` double(20,10) DEFAULT NULL,
  `busUni` varchar(50) DEFAULT NULL,
  `act` int(1) DEFAULT NULL,
  `varTplInb` double(20,10) DEFAULT NULL,
  `renImpBen` double(20,10) DEFAULT NULL,
  KEY `shiToPar` (`shiToPar`),
  KEY `shiDocNum` (`shiDocNum`),
  KEY `del` (`del`),
  KEY `mat` (`mat`),
  KEY `pay` (`pay`),
  KEY `solToPar` (`solToPar`),
  KEY `solToPar_2` (`solToPar`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fle_del_his`
--

CREATE TABLE IF NOT EXISTS `fle_del_his` (
  `salOrg` int(6) DEFAULT NULL,
  `fisYeaPer` varchar(9) DEFAULT NULL,
  `fisWee` varchar(9) DEFAULT NULL,
  `shiPoi` int(5) DEFAULT NULL,
  `solToCha` int(10) DEFAULT NULL,
  `solToChaNam` varchar(100) DEFAULT NULL,
  `solToPar` int(10) DEFAULT NULL,
  `solToParNam` varchar(100) DEFAULT NULL,
  `shiToPar` int(10) DEFAULT NULL,
  `shiToNam` varchar(100) DEFAULT NULL,
  `loc` varchar(100) DEFAULT NULL,
  `shiDocNum` int(10) DEFAULT NULL,
  `shiDate` varchar(50) DEFAULT NULL,
  `apoMns` varchar(10) DEFAULT NULL,
  `del` int(12) DEFAULT NULL,
  `bwDoc` int(10) DEFAULT NULL,
  `mat` bigint(14) DEFAULT NULL,
  `matDes` varchar(200) DEFAULT NULL,
  `shiKil` double(12,3) DEFAULT NULL,
  `shiCubMet` double(12,3) DEFAULT NULL,
  `delQua` double(12,3) DEFAULT NULL,
  `netKil` double(20,10) NOT NULL,
  `groSal` double(20,10) NOT NULL,
  `netSal` double(20,10) NOT NULL,
  `cosDel` double(12,3) DEFAULT NULL,
  `porParKil` double(20,10) DEFAULT NULL,
  `ovhDel` double(20,10) DEFAULT NULL,
  `pay` int(9) DEFAULT NULL,
  `payNam` varchar(100) DEFAULT NULL,
  `ovhCtaEsp` double(20,10) DEFAULT NULL,
  `dxd` int(1) DEFAULT NULL,
  `plaSku` int(10) DEFAULT NULL,
  `inbOri` double(20,10) DEFAULT NULL,
  `inbDes` double(20,10) DEFAULT NULL,
  `inbRec` double(20,10) DEFAULT NULL,
  `dxdCla` double(20,10) DEFAULT NULL,
  `gasEve` double(20,10) DEFAULT NULL,
  `tplInb` double(20,10) DEFAULT NULL,
  `tplFij` double(20,10) DEFAULT NULL,
  `mfmDxd` double(20,10) DEFAULT NULL,
  `fijOutBou` double(20,10) DEFAULT NULL,
  `ren` double(20,10) DEFAULT NULL,
  `tplCosCar` double(20,10) DEFAULT NULL,
  `tplFijRec` double(20,10) DEFAULT NULL,
  `dxdLog` double(20,10) DEFAULT NULL,
  `renCapOpe` double(20,10) DEFAULT NULL,
  `outMan` double(20,10) DEFAULT NULL,
  `dxdTotAux` double(20,10) DEFAULT NULL,
  `dxdRecAux` double(20,10) DEFAULT NULL,
  `dxdLOgAux` double(20,10) DEFAULT NULL,
  KEY `shiToPar` (`shiToPar`),
  KEY `shiDocNum` (`shiDocNum`),
  KEY `del` (`del`),
  KEY `mat` (`mat`),
  KEY `pay` (`pay`),
  KEY `solToPar` (`solToPar`),
  KEY `solToPar_2` (`solToPar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fle_del_pru`
--

CREATE TABLE IF NOT EXISTS `fle_del_pru` (
  `shiPoi` int(5) DEFAULT NULL,
  `fisYeaPer` varchar(9) DEFAULT NULL,
  `solToCha` varchar(100) DEFAULT NULL,
  `shiToPar` int(10) DEFAULT NULL,
  `shiToNam` varchar(100) DEFAULT NULL,
  `loc` varchar(100) DEFAULT NULL,
  `reg` varchar(10) DEFAULT NULL,
  `est` varchar(15) DEFAULT NULL,
  `shiDocNum` int(10) DEFAULT NULL,
  `del` int(12) DEFAULT NULL,
  `shiDate` date DEFAULT NULL,
  `salOrg` int(6) DEFAULT NULL,
  `kel` varchar(50) DEFAULT NULL,
  `mat` bigint(14) DEFAULT NULL,
  `matDes` varchar(200) DEFAULT NULL,
  `apoMns` varchar(10) DEFAULT NULL,
  `solToPar` varchar(12) DEFAULT NULL,
  `solToParNam` varchar(100) DEFAULT NULL,
  `shiKil` double(12,3) DEFAULT NULL,
  `shiCubMet` double(12,3) DEFAULT NULL,
  `delQua` double(12,3) DEFAULT NULL,
  `netKil` double(20,10) NOT NULL,
  `groSal` double(20,10) NOT NULL,
  `netSal` double(20,10) NOT NULL,
  `cosDel` double(12,3) DEFAULT NULL,
  `porParKil` double(20,10) DEFAULT NULL,
  `ovhDel` double(20,10) DEFAULT NULL,
  `pay` int(9) DEFAULT NULL,
  `payNam` varchar(100) DEFAULT NULL,
  `ovhCtaEsp` double(20,10) DEFAULT NULL,
  `dxd` int(1) DEFAULT NULL,
  `plaSku` int(10) DEFAULT NULL,
  `inbOri` double(20,10) DEFAULT NULL,
  `inbDes` double(20,10) DEFAULT NULL,
  `inbRec` double(20,10) DEFAULT NULL,
  `dxdCla` double(20,10) DEFAULT NULL,
  `gasEve` double(20,10) DEFAULT NULL,
  `tplInb` double(20,10) DEFAULT NULL,
  `tplFij` double(20,10) DEFAULT NULL,
  `mfmDxd` double(20,10) DEFAULT NULL,
  `fijOutBou` double(20,10) DEFAULT NULL,
  `ren` double(20,10) DEFAULT NULL,
  `tplCosCar` double(20,10) DEFAULT NULL,
  `tplFijRec` double(20,10) DEFAULT NULL,
  `dxdLog` double(20,10) DEFAULT NULL,
  `renCapOpe` double(20,10) DEFAULT NULL,
  KEY `shiToPar` (`shiToPar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fle_del_qua`
--

CREATE TABLE IF NOT EXISTS `fle_del_qua` (
  `per` varchar(7) NOT NULL,
  `shiDocNum` int(9) DEFAULT NULL,
  `delQua` double(20,10) DEFAULT NULL,
  KEY `shiDocNum` (`shiDocNum`),
  KEY `shiDocNum_2` (`shiDocNum`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fle_del_res`
--

CREATE TABLE IF NOT EXISTS `fle_del_res` (
  `shiPoi` int(5) DEFAULT NULL,
  `fisYeaPer` varchar(9) DEFAULT NULL,
  `solToCha` varchar(100) DEFAULT NULL,
  `shiToPar` int(10) DEFAULT NULL,
  `shiToNam` varchar(100) DEFAULT NULL,
  `loc` varchar(100) DEFAULT NULL,
  `reg` varchar(10) DEFAULT NULL,
  `est` varchar(15) DEFAULT NULL,
  `shiDocNum` int(10) DEFAULT NULL,
  `del` int(12) DEFAULT NULL,
  `shiDate` date DEFAULT NULL,
  `salOrg` int(6) DEFAULT NULL,
  `kel` varchar(50) DEFAULT NULL,
  `mat` bigint(14) DEFAULT NULL,
  `matDes` varchar(200) DEFAULT NULL,
  `apoMns` varchar(10) DEFAULT NULL,
  `solToPar` varchar(12) DEFAULT NULL,
  `solToParNam` varchar(100) DEFAULT NULL,
  `shiKil` double(12,3) DEFAULT NULL,
  `shiCubMet` double(12,3) DEFAULT NULL,
  `delQua` double(12,3) DEFAULT NULL,
  `netKil` double(20,10) NOT NULL,
  `groSal` double(20,10) NOT NULL,
  `netSal` double(20,10) NOT NULL,
  `cosDel` double(12,3) DEFAULT NULL,
  `porParKil` double(20,10) DEFAULT NULL,
  `ovhDel` double(20,10) DEFAULT NULL,
  `pay` int(9) DEFAULT NULL,
  `payNam` varchar(100) DEFAULT NULL,
  `ovhCtaEsp` double(20,10) DEFAULT NULL,
  `dxd` int(1) DEFAULT NULL,
  `plaSku` int(10) DEFAULT NULL,
  `inbOri` double(20,10) DEFAULT NULL,
  `inbDes` double(20,10) DEFAULT NULL,
  `inbRec` double(20,10) DEFAULT NULL,
  `dxdCla` double(20,10) DEFAULT NULL,
  `gasEve` double(20,10) DEFAULT NULL,
  `tplInb` double(20,10) DEFAULT NULL,
  `tplFij` double(20,10) DEFAULT NULL,
  `mfmDxd` double(20,10) DEFAULT NULL,
  `fijOutBou` double(20,10) DEFAULT NULL,
  `ren` double(20,10) DEFAULT NULL,
  `tplCosCar` double(20,10) DEFAULT NULL,
  `tplFijRec` double(20,10) DEFAULT NULL,
  `dxdLog` double(20,10) DEFAULT NULL,
  `renCapOpe` double(20,10) DEFAULT NULL,
  `outMan` double(20,10) DEFAULT NULL,
  `dxdTotAux` double(20,10) DEFAULT NULL,
  `dxdRecAux` double(20,10) DEFAULT NULL,
  `dxdLogAux` double(20,10) DEFAULT NULL,
  KEY `shiToPar` (`shiToPar`),
  KEY `shiDocNum` (`shiDocNum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fle_del_tem`
--

CREATE TABLE IF NOT EXISTS `fle_del_tem` (
  `salOrg` int(6) DEFAULT NULL,
  `fisYeaPer` varchar(9) DEFAULT NULL,
  `fisWee` varchar(9) DEFAULT NULL,
  `shiPoi` int(5) DEFAULT NULL,
  `solToCha` int(10) DEFAULT NULL,
  `solToChaNam` varchar(100) DEFAULT NULL,
  `solToPar` varchar(12) DEFAULT NULL,
  `solToParNam` varchar(100) DEFAULT NULL,
  `shiToPar` int(10) DEFAULT NULL,
  `shiToNam` varchar(100) DEFAULT NULL,
  `loc` varchar(100) DEFAULT NULL,
  `shiDocNum` int(10) DEFAULT NULL,
  `shiDate` varchar(50) DEFAULT NULL,
  `apoMns` varchar(10) DEFAULT NULL,
  `del` int(12) DEFAULT NULL,
  `bwDoc` int(10) DEFAULT NULL,
  `mat` bigint(14) DEFAULT NULL,
  `matDes` varchar(200) DEFAULT NULL,
  `shiKil` double(12,3) DEFAULT NULL,
  `shiCubMet` double(12,3) DEFAULT NULL,
  `delQua` double(12,3) DEFAULT NULL,
  `netKil` double(20,10) NOT NULL,
  `groSal` double(20,10) NOT NULL,
  `netSal` double(20,10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fle_pic`
--

CREATE TABLE IF NOT EXISTS `fle_pic` (
  `per` varchar(7) NOT NULL,
  `shiDocNum` int(9) DEFAULT NULL,
  `delQua` int(12) DEFAULT NULL,
  `picQua` int(12) DEFAULT NULL,
  `porPic` double(20,10) DEFAULT NULL,
  `shiToPar` int(9) DEFAULT NULL,
  `shiDelQua` int(12) DEFAULT NULL,
  `pay` int(9) DEFAULT NULL,
  `cosCaj` double(20,10) DEFAULT NULL,
  `cosMatFle` double(20,10) DEFAULT NULL,
  `cosTotCaj` double(20,10) DEFAULT NULL,
  `cosCar` double(20,10) DEFAULT NULL,
  `cosCarCaj` double(20,10) DEFAULT NULL,
  `cosMatCaj` double(20,10) DEFAULT NULL,
  KEY `shiToPar` (`shiToPar`),
  KEY `shiDocNum` (`shiDocNum`),
  KEY `shiToPar_2` (`shiToPar`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fle_pic_dep`
--

CREATE TABLE IF NOT EXISTS `fle_pic_dep` (
  `per` varchar(7) NOT NULL,
  `shiDocNum` int(9) DEFAULT NULL,
  `porPic` double(20,10) DEFAULT NULL,
  `cosCaj` double(20,10) DEFAULT NULL,
  `cosMatFle` double(20,10) DEFAULT NULL,
  `delQua` int(12) DEFAULT NULL,
  `cosTotCaj` double(20,10) DEFAULT NULL,
  `cosCar` double(20,10) DEFAULT NULL,
  `cosCarCaj` double(20,10) DEFAULT NULL,
  KEY `shiDocNum` (`shiDocNum`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fr_cas_fil`
--

CREATE TABLE IF NOT EXISTS `fr_cas_fil` (
  `c1` int(10) DEFAULT NULL,
  `c2` int(10) DEFAULT NULL,
  `c3` int(10) DEFAULT NULL,
  `c4` int(10) DEFAULT NULL,
  `c5` int(10) DEFAULT NULL,
  `c6` varchar(200) DEFAULT NULL,
  `c7` int(10) DEFAULT NULL,
  `c8` varchar(200) DEFAULT NULL,
  `c9` varchar(50) DEFAULT NULL,
  `c10` int(10) DEFAULT NULL,
  `c11` int(10) DEFAULT NULL,
  `c12` varchar(200) DEFAULT NULL,
  `c13` varchar(50) DEFAULT NULL,
  `c14` varchar(200) DEFAULT NULL,
  `c15` double(20,10) DEFAULT NULL,
  `c16` double(20,10) DEFAULT NULL,
  `c17` double(20,10) DEFAULT NULL,
  `c18` varchar(10) DEFAULT NULL,
  `cor` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fr_cas_fil_res`
--

CREATE TABLE IF NOT EXISTS `fr_cas_fil_res` (
  `p` int(2) DEFAULT NULL,
  `c1` int(10) DEFAULT NULL,
  `c2` int(10) DEFAULT NULL,
  `c3` int(10) DEFAULT NULL,
  `c4` int(10) DEFAULT NULL,
  `c5` int(10) DEFAULT NULL,
  `c6` varchar(200) DEFAULT NULL,
  `c7` int(10) DEFAULT NULL,
  `c8` varchar(200) DEFAULT NULL,
  `c9` varchar(50) DEFAULT NULL,
  `c10` int(10) DEFAULT NULL,
  `c11` int(10) DEFAULT NULL,
  `c12` varchar(200) DEFAULT NULL,
  `c13` varchar(50) DEFAULT NULL,
  `c14` varchar(200) DEFAULT NULL,
  `c15` double(20,10) DEFAULT NULL,
  `c16` double(20,10) DEFAULT NULL,
  `c17` double(20,10) DEFAULT NULL,
  `c18` double(20,10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fr_con`
--

CREATE TABLE IF NOT EXISTS `fr_con` (
  `per` varchar(7) NOT NULL,
  `c0` varchar(50) NOT NULL,
  `c1` int(10) DEFAULT NULL,
  `c2` int(10) DEFAULT NULL,
  `c3` int(10) DEFAULT NULL,
  `c4` int(10) DEFAULT NULL,
  `c5` int(10) DEFAULT NULL,
  `c6` varchar(200) DEFAULT NULL,
  `c7` int(10) DEFAULT NULL,
  `c8` varchar(200) DEFAULT NULL,
  `c9` varchar(50) DEFAULT NULL,
  `c10` int(10) DEFAULT NULL,
  `c11` int(10) DEFAULT NULL,
  `c12` varchar(200) DEFAULT NULL,
  `c13` varchar(50) DEFAULT NULL,
  `c14` varchar(200) DEFAULT NULL,
  `c15` double(20,10) DEFAULT NULL,
  `c16` double(20,10) DEFAULT NULL,
  `c17` double(20,10) DEFAULT NULL,
  `c18` varchar(50) DEFAULT NULL,
  `c19` varchar(500) DEFAULT NULL,
  `c20` varchar(500) DEFAULT NULL,
  `c21` varchar(500) DEFAULT NULL,
  `c22` varchar(500) DEFAULT NULL,
  `c23` varchar(500) DEFAULT NULL,
  `c24` varchar(500) DEFAULT NULL,
  `matGro5` int(6) DEFAULT NULL,
  `matGro5Des` varchar(500) DEFAULT NULL,
  `porEjeOm` double(12,10) DEFAULT NULL,
  `porEjeTra` double(12,10) DEFAULT NULL,
  `porCooOpe` double(12,10) DEFAULT NULL,
  `porCalCen` double(12,10) DEFAULT NULL,
  `porCooTra` double(12,10) DEFAULT NULL,
  `porEjeCpf` double(12,10) DEFAULT NULL,
  `porEjeRep` double(12,10) DEFAULT NULL,
  `porDemPla` double(12,10) DEFAULT NULL,
  `porLidCal` double(12,10) DEFAULT NULL,
  `ejeOm` varchar(500) DEFAULT NULL,
  `ejeTra` varchar(500) DEFAULT NULL,
  `cooOpe` varchar(500) DEFAULT NULL,
  `calCen` varchar(500) DEFAULT NULL,
  `cooTra` varchar(500) DEFAULT NULL,
  `ejeCpf` varchar(500) DEFAULT NULL,
  `ejeRep` varchar(500) DEFAULT NULL,
  `demPla` varchar(500) DEFAULT NULL,
  `lidCal` varchar(500) DEFAULT NULL,
  KEY `c14` (`c14`),
  KEY `c5` (`c5`),
  KEY `per` (`per`),
  KEY `c0` (`c0`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fr_con_agr`
--

CREATE TABLE IF NOT EXISTS `fr_con_agr` (
  `per` varchar(7) COLLATE utf8_bin NOT NULL,
  `c4` int(10) NOT NULL,
  `c21` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `c20` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `c19` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `c18` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `c24` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `c22` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `c23` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `c15` double(20,10) DEFAULT NULL,
  `c16` double(20,10) DEFAULT NULL,
  `c17` double(20,10) DEFAULT NULL,
  `matGro5` int(6) DEFAULT NULL,
  `matGro5Des` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `porEjeOm` double(12,10) DEFAULT NULL,
  `porEjeTra` double(12,10) DEFAULT NULL,
  `porCooOpe` double(12,10) DEFAULT NULL,
  `porCalCen` double(12,10) DEFAULT NULL,
  `porCooTra` double(12,10) DEFAULT NULL,
  `porEjeCpf` double(12,10) DEFAULT NULL,
  `porEjeRep` double(12,10) DEFAULT NULL,
  `porDemPla` double(12,10) DEFAULT NULL,
  `porLidCal` double(12,10) DEFAULT NULL,
  `ejeOm` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `ejeTra` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `cooOpe` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `calCen` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `cooTra` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `ejeCpf` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `ejeRep` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `demPla` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `lidCal` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  KEY `per` (`per`),
  KEY `c4` (`c4`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fr_con_mod`
--

CREATE TABLE IF NOT EXISTS `fr_con_mod` (
  `per` varchar(7) NOT NULL,
  `c0` varchar(50) NOT NULL,
  `c1` int(10) DEFAULT NULL,
  `c2` int(10) DEFAULT NULL,
  `c3` int(10) DEFAULT NULL,
  `c4` int(10) DEFAULT NULL,
  `c5` int(10) DEFAULT NULL,
  `c6` varchar(200) DEFAULT NULL,
  `c7` int(10) DEFAULT NULL,
  `c8` varchar(200) DEFAULT NULL,
  `c9` varchar(50) DEFAULT NULL,
  `c10` int(10) DEFAULT NULL,
  `c11` int(10) DEFAULT NULL,
  `c12` varchar(200) DEFAULT NULL,
  `c13` varchar(50) DEFAULT NULL,
  `c14` varchar(200) DEFAULT NULL,
  `c15` double(20,10) DEFAULT NULL,
  `c16` double(20,10) DEFAULT NULL,
  `c17` double(20,10) DEFAULT NULL,
  `c18` varchar(50) DEFAULT NULL,
  `c19` varchar(500) DEFAULT NULL,
  `c20` varchar(500) DEFAULT NULL,
  `c21` varchar(500) DEFAULT NULL,
  `c22` varchar(500) DEFAULT NULL,
  `c23` varchar(500) DEFAULT NULL,
  `c24` varchar(500) DEFAULT NULL,
  `corte` varchar(10) DEFAULT NULL,
  KEY `c14` (`c14`),
  KEY `c14_2` (`c14`),
  KEY `c5` (`c5`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fr_mae_cau`
--

CREATE TABLE IF NOT EXISTS `fr_mae_cau` (
  `ordRea` varchar(50) NOT NULL DEFAULT '',
  `cau` varchar(500) DEFAULT NULL,
  `afe` varchar(500) DEFAULT NULL,
  `afeFR` varchar(50) DEFAULT NULL,
  `pes` double(12,10) DEFAULT NULL,
  `porPar` double(12,10) DEFAULT NULL,
  `porEjeOm` double(12,10) DEFAULT NULL,
  `porEjeTra` double(12,10) DEFAULT NULL,
  `porCooOpe` double(12,10) DEFAULT NULL,
  `porCalCen` double(12,10) DEFAULT NULL,
  `porCooTra` double(12,10) DEFAULT NULL,
  `porEjeCpf` double(12,10) DEFAULT NULL,
  `porEjeRep` double(12,10) DEFAULT NULL,
  `porDemPla` double(12,10) DEFAULT NULL,
  `porLidCal` double(12,10) DEFAULT NULL,
  `porTot` double(12,10) DEFAULT NULL,
  `tot` double(12,10) DEFAULT NULL,
  PRIMARY KEY (`ordRea`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fr_mae_cli`
--

CREATE TABLE IF NOT EXISTS `fr_mae_cli` (
  `solToPar` int(10) DEFAULT NULL,
  `con` varchar(500) DEFAULT NULL,
  `can` varchar(500) DEFAULT NULL,
  `cad` varchar(500) DEFAULT NULL,
  `corte` int(1) NOT NULL,
  KEY `solToPar` (`solToPar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fr_mae_gro5`
--

CREATE TABLE IF NOT EXISTS `fr_mae_gro5` (
  `matGro5` int(10) DEFAULT NULL,
  `matGroDes` varchar(500) DEFAULT NULL,
  `demPla` varchar(500) DEFAULT NULL,
  KEY `matGro5` (`matGro5`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fr_mae_mat`
--

CREATE TABLE IF NOT EXISTS `fr_mae_mat` (
  `sku` bigint(15) DEFAULT NULL,
  `des` varchar(500) NOT NULL,
  `e13` bigint(17) DEFAULT NULL,
  `d14` bigint(17) DEFAULT NULL,
  `matGro` int(10) DEFAULT NULL,
  `matGroDes` varchar(50) DEFAULT NULL,
  `matGro5` int(10) DEFAULT NULL,
  `matGro5Des` varchar(500) DEFAULT NULL,
  KEY `sku` (`sku`),
  KEY `e13` (`e13`),
  KEY `e13_2` (`e13`),
  KEY `d14` (`d14`),
  KEY `d14_2` (`d14`),
  KEY `sku_2` (`sku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fr_mae_pla`
--

CREATE TABLE IF NOT EXISTS `fr_mae_pla` (
  `pla` int(10) DEFAULT NULL,
  `edo` varchar(500) DEFAULT NULL,
  `cooOpe` varchar(500) DEFAULT NULL,
  `jefOpe` varchar(500) DEFAULT NULL,
  `calCen` varchar(500) DEFAULT NULL,
  `cooTra` varchar(500) DEFAULT NULL,
  `ejeRep` varchar(500) DEFAULT NULL,
  `lidCal` varchar(500) DEFAULT NULL,
  `jefRep` varchar(500) DEFAULT NULL,
  `gerOpe` varchar(500) DEFAULT NULL,
  `gerSc` varchar(500) DEFAULT NULL,
  `gerOm` varchar(500) DEFAULT NULL,
  `jefCal` varchar(500) DEFAULT NULL,
  KEY `pla` (`pla`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fr_mae_shi`
--

CREATE TABLE IF NOT EXISTS `fr_mae_shi` (
  `dvn` int(4) DEFAULT NULL,
  `solToCha` int(10) DEFAULT NULL,
  `shiToPar` int(10) DEFAULT NULL,
  `shiToNam` varchar(500) DEFAULT NULL,
  `reg` varchar(500) DEFAULT NULL,
  `traZon` varchar(50) DEFAULT NULL,
  `ejeOm` varchar(500) DEFAULT NULL,
  `ejeTra` varchar(500) DEFAULT NULL,
  `jefOm` varchar(500) DEFAULT NULL,
  `ejeCpf` varchar(500) DEFAULT NULL,
  KEY `dvn` (`dvn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fr_zro`
--

CREATE TABLE IF NOT EXISTS `fr_zro` (
  `c1` varchar(50) DEFAULT NULL,
  `c2` bigint(14) DEFAULT NULL,
  `c3` int(10) DEFAULT NULL,
  `c4` varchar(200) DEFAULT NULL,
  `c5` bigint(10) DEFAULT NULL,
  `c6` varchar(200) DEFAULT NULL,
  `c7` int(10) DEFAULT NULL,
  `c8` double(20,10) DEFAULT NULL,
  `c9` varchar(50) DEFAULT NULL,
  `c10` int(10) DEFAULT NULL,
  `c11` int(10) DEFAULT NULL,
  `c12` int(10) DEFAULT NULL,
  `c13` int(10) DEFAULT NULL,
  `c14` varchar(50) DEFAULT NULL,
  `c15` varchar(200) DEFAULT NULL,
  `c16` varchar(50) DEFAULT NULL,
  `c17` varchar(200) DEFAULT NULL,
  `c18` varchar(200) DEFAULT NULL,
  `c19` double(20,10) DEFAULT NULL,
  `c20` varchar(50) DEFAULT NULL,
  `c21` double(20,10) DEFAULT NULL,
  `c22` double(20,10) DEFAULT NULL,
  `c23` varchar(50) DEFAULT NULL,
  `c24` bigint(14) DEFAULT NULL,
  `c25` bigint(14) DEFAULT NULL,
  `c26` double(20,10) DEFAULT NULL,
  `c27` varchar(50) DEFAULT NULL,
  `c28` bigint(10) DEFAULT NULL,
  `c29` varchar(50) DEFAULT NULL,
  `c30` double(20,10) DEFAULT NULL,
  `c31` double(20,10) DEFAULT NULL,
  `c32` int(12) DEFAULT NULL,
  `c33` double(20,10) DEFAULT NULL,
  `c34` varchar(200) DEFAULT NULL,
  `cor` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gas_eve`
--

CREATE TABLE IF NOT EXISTS `gas_eve` (
  `per` varchar(7) NOT NULL,
  `ter` varchar(100) DEFAULT NULL,
  `peri` varchar(10) DEFAULT NULL,
  `sem` varchar(10) DEFAULT NULL,
  `ced` varchar(100) DEFAULT NULL,
  `dir` varchar(500) DEFAULT NULL,
  `dia` varchar(10) DEFAULT NULL,
  `hor` varchar(10) DEFAULT NULL,
  `del` int(12) DEFAULT NULL,
  `shiToPar` varchar(10) DEFAULT NULL,
  `ciu` varchar(100) DEFAULT NULL,
  `shiToNam` varchar(100) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  `delQua` double(20,10) DEFAULT NULL,
  `shiKil` double(20,10) DEFAULT NULL,
  `citDia` varchar(10) DEFAULT NULL,
  `citHor` varchar(10) DEFAULT NULL,
  `codCon` varchar(10) DEFAULT NULL,
  `ven` varchar(10) DEFAULT NULL,
  `venNam` varchar(500) NOT NULL,
  `shiDocNum` varchar(10) DEFAULT NULL,
  `uni` varchar(50) DEFAULT NULL,
  `tc` varchar(10) DEFAULT NULL,
  `com` varchar(100) DEFAULT NULL,
  `c1` varchar(10) DEFAULT NULL,
  `c2` varchar(10) DEFAULT NULL,
  `c3` varchar(10) DEFAULT NULL,
  `c4` varchar(10) DEFAULT NULL,
  `c5` varchar(10) DEFAULT NULL,
  `c6` varchar(10) DEFAULT NULL,
  `c7` varchar(10) DEFAULT NULL,
  `c8` varchar(10) DEFAULT NULL,
  `c9` varchar(10) DEFAULT NULL,
  `c10` varchar(10) DEFAULT NULL,
  `c11` varchar(10) DEFAULT NULL,
  `c12` varchar(10) DEFAULT NULL,
  `c13` varchar(10) DEFAULT NULL,
  `c14` varchar(10) DEFAULT NULL,
  `c15` varchar(10) DEFAULT NULL,
  `c16` varchar(10) DEFAULT NULL,
  `c17` varchar(10) DEFAULT NULL,
  `c18` varchar(10) DEFAULT NULL,
  `c19` varchar(10) DEFAULT NULL,
  `c20` varchar(10) DEFAULT NULL,
  `c21` varchar(10) DEFAULT NULL,
  `c22` varchar(10) DEFAULT NULL,
  `c23` varchar(10) DEFAULT NULL,
  `c24` varchar(10) DEFAULT NULL,
  `c25` varchar(10) DEFAULT NULL,
  `c26` varchar(10) DEFAULT NULL,
  `c27` varchar(10) DEFAULT NULL,
  `c28` varchar(10) DEFAULT NULL,
  `c29` varchar(10) DEFAULT NULL,
  `c30` varchar(10) DEFAULT NULL,
  `c31` varchar(10) DEFAULT NULL,
  `c32` varchar(10) DEFAULT NULL,
  `tot` double(20,10) DEFAULT NULL,
  `fol` varchar(10) DEFAULT NULL,
  `con` varchar(10) DEFAULT NULL,
  KEY `del` (`del`),
  KEY `del_2` (`del`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gas_eve_piv`
--

CREATE TABLE IF NOT EXISTS `gas_eve_piv` (
  `per` varchar(7) NOT NULL,
  `del` int(12) DEFAULT NULL,
  `tot` double(20,10) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  KEY `del` (`del`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gas_tot_inb_des`
--

CREATE TABLE IF NOT EXISTS `gas_tot_inb_des` (
  `per` varchar(7) NOT NULL,
  `shiPoi` int(10) DEFAULT NULL,
  `gasTot` double(20,10) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  `gasCubMet` double(20,10) DEFAULT NULL,
  KEY `shiPoi` (`shiPoi`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gas_tot_inb_ori`
--

CREATE TABLE IF NOT EXISTS `gas_tot_inb_ori` (
  `per` varchar(7) NOT NULL,
  `pla` int(10) DEFAULT NULL,
  `gasTot` double(20,10) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  `gasCubMet` double(20,10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inp_3pl`
--

CREATE TABLE IF NOT EXISTS `inp_3pl` (
  `per` varchar(7) NOT NULL,
  `shiPoi` varchar(50) DEFAULT NULL,
  `shiNam` varchar(100) DEFAULT NULL,
  `cajDes` int(10) DEFAULT NULL,
  `inb` double(20,10) DEFAULT NULL,
  `fij` double(20,10) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  `inbCaj` double(20,10) DEFAULT NULL,
  `fijCubMet` double(20,10) DEFAULT NULL,
  KEY `per` (`per`),
  KEY `per_2` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inp_dxd_mfm`
--

CREATE TABLE IF NOT EXISTS `inp_dxd_mfm` (
  `per` varchar(7) NOT NULL,
  `payNam` varchar(100) DEFAULT NULL,
  `pay` int(10) DEFAULT NULL,
  `shiToPar` varchar(10) DEFAULT NULL,
  `man` double(20,10) DEFAULT NULL,
  `filRat` double(20,10) DEFAULT NULL,
  `mer` double(20,10) DEFAULT NULL,
  `groSal` double(20,10) DEFAULT NULL,
  `netSal` double(20,10) DEFAULT NULL,
  `pro` double(20,10) DEFAULT NULL,
  `benImp` double(20,10) DEFAULT NULL,
  `citPer` double(20,10) DEFAULT NULL,
  `por` double(20,10) DEFAULT NULL,
  `ajuCubMet` double(20,10) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  `mfmCubMet` double(20,10) DEFAULT NULL,
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inp_fij_out_bou`
--

CREATE TABLE IF NOT EXISTS `inp_fij_out_bou` (
  `per` varchar(7) NOT NULL,
  `shiToPar` varchar(100) DEFAULT NULL,
  `mon` double(20,10) DEFAULT NULL,
  `pue` varchar(200) DEFAULT NULL,
  `cooCru` varchar(500) DEFAULT NULL,
  `cue` varchar(100) DEFAULT NULL,
  `des` varchar(100) DEFAULT NULL,
  `con` varchar(100) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  `fijCubMet` double(20,10) DEFAULT NULL,
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inp_inb`
--

CREATE TABLE IF NOT EXISTS `inp_inb` (
  `per` varchar(7) NOT NULL,
  `dep` varchar(10) DEFAULT NULL,
  `sem` int(2) DEFAULT NULL,
  `pla` int(10) DEFAULT NULL,
  `ori` varchar(100) DEFAULT NULL,
  `cor` double(20,10) DEFAULT NULL,
  `shiDocNum` int(10) DEFAULT NULL,
  `eje` varchar(100) DEFAULT NULL,
  `shiPoi` int(10) DEFAULT NULL,
  `des` varchar(100) DEFAULT NULL,
  `tipFle` varchar(100) DEFAULT NULL,
  `ret` varchar(100) DEFAULT NULL,
  `lin` varchar(500) DEFAULT NULL,
  `uni` varchar(100) DEFAULT NULL,
  `volTot` varchar(100) DEFAULT NULL,
  `volCed` varchar(100) DEFAULT NULL,
  `porCed` varchar(100) DEFAULT NULL,
  `arr` varchar(100) DEFAULT NULL,
  `con` varchar(100) DEFAULT NULL,
  `fac` varchar(100) DEFAULT NULL,
  `tot` varchar(100) DEFAULT NULL,
  `retras` varchar(100) DEFAULT NULL,
  `com` varchar(500) DEFAULT NULL,
  `cosPac` varchar(100) DEFAULT NULL,
  `concat` varchar(500) DEFAULT NULL,
  `sto` varchar(100) DEFAULT NULL,
  `del` varchar(100) DEFAULT NULL,
  `fle` varchar(100) DEFAULT NULL,
  `gasAdi` varchar(100) DEFAULT NULL,
  `comGasAdi` varchar(500) DEFAULT NULL,
  `sol` varchar(100) DEFAULT NULL,
  `fol` varchar(100) DEFAULT NULL,
  `gasTot` double(20,10) DEFAULT NULL,
  `pagFle` double(20,10) DEFAULT NULL,
  `pagSto` double(20,10) DEFAULT NULL,
  `pag` double(20,10) DEFAULT NULL,
  `pro` double(20,10) DEFAULT NULL,
  `typ` varchar(100) DEFAULT NULL,
  `subTyp` varchar(500) DEFAULT NULL,
  `desDos` varchar(100) DEFAULT NULL,
  `desTres` varchar(500) DEFAULT NULL,
  `cedDes` varchar(500) DEFAULT NULL,
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inp_ovh`
--

CREATE TABLE IF NOT EXISTS `inp_ovh` (
  `per` varchar(7) NOT NULL,
  `cosEle` varchar(200) DEFAULT NULL,
  `actCur` double(11,2) DEFAULT NULL,
  `plaCur` double(11,2) DEFAULT NULL,
  `varCur` double(11,2) DEFAULT NULL,
  `actCum` double(11,2) DEFAULT NULL,
  `plaCum` double(11,2) DEFAULT NULL,
  `varCum` double(11,2) DEFAULT NULL,
  `cal` varchar(100) DEFAULT NULL,
  `sum` double(11,2) DEFAULT NULL,
  `cta` int(10) DEFAULT NULL,
  `por` double(2,1) DEFAULT NULL,
  `com` varchar(200) DEFAULT NULL,
  `totCta` double(11,2) DEFAULT NULL,
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_exi_cit`
--

CREATE TABLE IF NOT EXISTS `inv_exi_cit` (
  `per` varchar(7) DEFAULT NULL,
  `can` int(10) DEFAULT NULL,
  `sku` bigint(14) DEFAULT NULL,
  `des` varchar(100) DEFAULT NULL,
  `est` varchar(10) DEFAULT NULL,
  `alm` int(9) DEFAULT NULL,
  `ubi` varchar(10) DEFAULT NULL,
  `are` varchar(50) DEFAULT NULL,
  `batLot` varchar(10) DEFAULT NULL,
  `fecCad` int(11) DEFAULT NULL,
  `ori` varchar(50) DEFAULT NULL,
  `var` int(10) DEFAULT NULL,
  `uniMed` varchar(10) DEFAULT NULL,
  `idEnt` int(9) DEFAULT NULL,
  `lpn` varchar(50) DEFAULT NULL,
  `con` varchar(50) DEFAULT NULL,
  `tip` int(9) DEFAULT NULL,
  `cla2` int(9) DEFAULT NULL,
  `cla3` int(9) DEFAULT NULL,
  `acoRec` varchar(10) DEFAULT NULL,
  `surEmb` varchar(10) DEFAULT NULL,
  `surPic` varchar(10) DEFAULT NULL,
  `estFin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kvc_mod`
--

CREATE TABLE IF NOT EXISTS `kvc_mod` (
  `per` varchar(7) DEFAULT NULL,
  `usuario` varchar(500) DEFAULT NULL,
  `fecha` varchar(100) DEFAULT NULL,
  `modulo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kvc_use`
--

CREATE TABLE IF NOT EXISTS `kvc_use` (
  `mxk` varchar(20) DEFAULT NULL,
  `con` blob,
  `modulos` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `met_tab`
--

CREATE TABLE IF NOT EXISTS `met_tab` (
  `nom` varchar(20) DEFAULT NULL,
  `col` varchar(100) DEFAULT NULL,
  `tab` varchar(50) DEFAULT NULL,
  `com` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `p`
--

CREATE TABLE IF NOT EXISTS `p` (
  `shiToPar` int(10) DEFAULT NULL,
  `shiToNam` varchar(50) DEFAULT NULL,
  `shiKil` double(20,10) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  `delQua` double(20,10) DEFAULT NULL,
  `shiCubMetTot` double(20,10) DEFAULT NULL,
  `fle` int(5) DEFAULT NULL,
  `dxdTot` double(20,10) DEFAULT NULL,
  `mfm` double(20,10) DEFAULT NULL,
  `dxdLog` double(20,10) DEFAULT NULL,
  `tot` double(20,10) DEFAULT NULL,
  `recAll` double(20,10) DEFAULT NULL,
  `groSal` double(20,10) DEFAULT NULL,
  KEY `shiToPar` (`shiToPar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pal_caj`
--

CREATE TABLE IF NOT EXISTS `pal_caj` (
  `per` varchar(7) NOT NULL,
  `sku` bigint(14) DEFAULT NULL,
  `bisUni` varchar(10) DEFAULT NULL,
  `caj` int(6) DEFAULT NULL,
  KEY `sku` (`sku`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pay_dxd`
--

CREATE TABLE IF NOT EXISTS `pay_dxd` (
  `pay` int(9) DEFAULT NULL,
  `dxd` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pay_mae`
--

CREATE TABLE IF NOT EXISTS `pay_mae` (
  `pay` int(9) DEFAULT NULL,
  `kil` double(20,10) DEFAULT NULL,
  `cubMet` double(20,10) DEFAULT NULL,
  `delQua` double(20,10) DEFAULT NULL,
  `groSal` double(20,10) DEFAULT NULL,
  `netSal` double(20,10) DEFAULT NULL,
  `fle` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pay_shi`
--

CREATE TABLE IF NOT EXISTS `pay_shi` (
  `shiToPar` int(10) DEFAULT NULL,
  `pay` int(9) DEFAULT NULL,
  KEY `shiToPar` (`shiToPar`),
  KEY `shiToPar_2` (`shiToPar`),
  KEY `shiToPar_3` (`shiToPar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pay_shi_ovh`
--

CREATE TABLE IF NOT EXISTS `pay_shi_ovh` (
  `shiToPar` varchar(10) DEFAULT NULL,
  `pay` int(9) DEFAULT NULL,
  `payNam` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pay_shi_sol`
--

CREATE TABLE IF NOT EXISTS `pay_shi_sol` (
  `per` varchar(7) NOT NULL,
  `pay` int(9) DEFAULT NULL,
  `payNam` varchar(500) DEFAULT NULL,
  `shiToPar` int(10) DEFAULT NULL,
  `solToPar` int(10) DEFAULT NULL,
  KEY `solToPar` (`solToPar`),
  KEY `solToPar_2` (`solToPar`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pay_sol`
--

CREATE TABLE IF NOT EXISTS `pay_sol` (
  `pay` int(9) DEFAULT NULL,
  `payNam` varchar(100) DEFAULT NULL,
  `solToPar` int(12) DEFAULT NULL,
  `solToParNam` varchar(100) DEFAULT NULL,
  `cal` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pay_sol_enc`
--

CREATE TABLE IF NOT EXISTS `pay_sol_enc` (
  `per` varchar(7) NOT NULL,
  `pay` int(10) DEFAULT NULL,
  `solToPar` int(10) DEFAULT NULL,
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pay_sol_rev`
--

CREATE TABLE IF NOT EXISTS `pay_sol_rev` (
  `pay` int(10) DEFAULT NULL,
  `payNam` varchar(100) DEFAULT NULL,
  `solToPar` int(10) DEFAULT NULL,
  `solToParNam` varchar(100) DEFAULT NULL,
  `dxd` int(1) DEFAULT NULL,
  `fac` varchar(10) DEFAULT NULL,
  `cal` int(1) DEFAULT NULL,
  `bas` varchar(200) DEFAULT NULL,
  `com` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE IF NOT EXISTS `periodos` (
  `per` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pla_sku`
--

CREATE TABLE IF NOT EXISTS `pla_sku` (
  `per` varchar(7) NOT NULL,
  `sku` bigint(20) DEFAULT NULL,
  `pla` int(4) DEFAULT NULL,
  KEY `sku` (`sku`),
  KEY `sku_2` (`sku`),
  KEY `per` (`per`),
  KEY `sku_3` (`sku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_kil_cta_esp`
--

CREATE TABLE IF NOT EXISTS `pre_kil_cta_esp` (
  `per` varchar(7) NOT NULL,
  `payNam` varchar(100) DEFAULT NULL,
  `kil` varchar(100) DEFAULT NULL,
  `porCtaEsp` double(20,10) DEFAULT NULL,
  `cosKil` double(20,10) DEFAULT NULL,
  KEY `payNam` (`payNam`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ren_cub_met`
--

CREATE TABLE IF NOT EXISTS `ren_cub_met` (
  `per` varchar(7) DEFAULT NULL,
  `shiPoi` int(10) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ren_imp_ben`
--

CREATE TABLE IF NOT EXISTS `ren_imp_ben` (
  `per` varchar(7) DEFAULT NULL,
  `shiPoi` int(10) NOT NULL,
  `val` double(20,10) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  `impBenCubMet` double(20,10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revenue`
--

CREATE TABLE IF NOT EXISTS `revenue` (
  `c1` varchar(10) DEFAULT NULL,
  `solToPar` varchar(10) DEFAULT NULL,
  `c3` varchar(100) DEFAULT NULL,
  `c4` varchar(100) DEFAULT NULL,
  `c5` varchar(100) DEFAULT NULL,
  `c6` varchar(100) DEFAULT NULL,
  `c7` varchar(100) DEFAULT NULL,
  `c8` varchar(100) DEFAULT NULL,
  `c9` varchar(100) DEFAULT NULL,
  `c10` varchar(100) DEFAULT NULL,
  `c11` varchar(100) DEFAULT NULL,
  `c12` varchar(100) DEFAULT NULL,
  `c13` varchar(100) DEFAULT NULL,
  `c14` varchar(100) DEFAULT NULL,
  `c15` varchar(100) DEFAULT NULL,
  `c16` varchar(100) DEFAULT NULL,
  `c17` varchar(100) DEFAULT NULL,
  `netKil` varchar(100) DEFAULT NULL,
  `c19` varchar(100) DEFAULT NULL,
  `c20` varchar(100) DEFAULT NULL,
  `c21` varchar(100) DEFAULT NULL,
  `groSal` varchar(100) DEFAULT NULL,
  `c23` varchar(100) DEFAULT NULL,
  `c24` varchar(100) DEFAULT NULL,
  `c25` varchar(100) DEFAULT NULL,
  `c26` varchar(100) DEFAULT NULL,
  `c27` varchar(100) DEFAULT NULL,
  `c28` varchar(100) DEFAULT NULL,
  `c29` varchar(100) DEFAULT NULL,
  `c30` varchar(100) DEFAULT NULL,
  `c31` varchar(100) DEFAULT NULL,
  `netSal` varchar(100) DEFAULT NULL,
  `c33` varchar(100) DEFAULT NULL,
  `c34` varchar(100) DEFAULT NULL,
  `c35` varchar(100) DEFAULT NULL,
  `c36` varchar(100) DEFAULT NULL,
  `c37` varchar(100) DEFAULT NULL,
  `c38` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rev_sol`
--

CREATE TABLE IF NOT EXISTS `rev_sol` (
  `solToPar` varchar(10) DEFAULT NULL,
  `netKil` double(12,3) DEFAULT NULL,
  `groSal` double(12,3) DEFAULT NULL,
  `netSal` double(12,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `se_ejemplo`
--

CREATE TABLE IF NOT EXISTS `se_ejemplo` (
  `per` varchar(7) NOT NULL,
  `a` varchar(10) DEFAULT NULL,
  `b` varchar(10) DEFAULT NULL,
  `c` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shi_dxd`
--

CREATE TABLE IF NOT EXISTS `shi_dxd` (
  `shiToPar` varchar(10) DEFAULT NULL,
  `pay` int(9) DEFAULT NULL,
  `tip` int(2) DEFAULT NULL,
  `fac` varchar(100) DEFAULT NULL,
  `shiKil` double(20,10) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  `delQua` double(20,10) DEFAULT NULL,
  `groSal` double(20,10) DEFAULT NULL,
  `netSal` double(20,10) DEFAULT NULL,
  `fle` int(9) DEFAULT NULL,
  `dxd` double(20,10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shi_dxd_aux`
--

CREATE TABLE IF NOT EXISTS `shi_dxd_aux` (
  `per` varchar(7) NOT NULL,
  `solToPar` varchar(10) DEFAULT NULL,
  `pay` int(9) DEFAULT NULL,
  `tip` int(2) DEFAULT NULL,
  `fac` varchar(100) DEFAULT NULL,
  `shiKil` double(20,10) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  `delQua` double(20,10) DEFAULT NULL,
  `groSal` double(20,10) DEFAULT NULL,
  `netSal` double(20,10) DEFAULT NULL,
  `fle` int(9) DEFAULT NULL,
  `dxd` double(20,10) DEFAULT NULL,
  KEY `solToPar` (`solToPar`),
  KEY `solToPar_2` (`solToPar`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shi_dxd_fle`
--

CREATE TABLE IF NOT EXISTS `shi_dxd_fle` (
  `shiToPar` varchar(10) DEFAULT NULL,
  `pay` int(9) DEFAULT NULL,
  `shiDocNum` int(10) DEFAULT NULL,
  `apoMns` varchar(10) DEFAULT NULL,
  `shiKil` double(20,10) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  `delQua` double(20,10) DEFAULT NULL,
  `groSal` double(20,10) DEFAULT NULL,
  `netSal` double(20,10) DEFAULT NULL,
  `tip` int(2) DEFAULT NULL,
  `fac` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shi_dxd_fle_aux`
--

CREATE TABLE IF NOT EXISTS `shi_dxd_fle_aux` (
  `per` varchar(7) NOT NULL,
  `solToPar` varchar(10) DEFAULT NULL,
  `pay` int(9) DEFAULT NULL,
  `shiDocNum` int(10) DEFAULT NULL,
  `apoMns` varchar(10) DEFAULT NULL,
  `shiKil` double(20,10) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  `delQua` double(20,10) DEFAULT NULL,
  `groSal` double(20,10) DEFAULT NULL,
  `netSal` double(20,10) DEFAULT NULL,
  `tip` int(2) DEFAULT NULL,
  `fac` varchar(100) DEFAULT NULL,
  KEY `solToPar` (`solToPar`),
  KEY `solToPar_2` (`solToPar`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shi_dxd_fle_cum`
--

CREATE TABLE IF NOT EXISTS `shi_dxd_fle_cum` (
  `shiToPar` int(10) DEFAULT NULL,
  `shiDocNum` int(10) DEFAULT NULL,
  `dxdCubMet` double(20,10) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  `groSal` double(20,10) DEFAULT NULL,
  `dxdLogGroSal` double(20,10) DEFAULT NULL,
  KEY `shiToPar` (`shiToPar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shi_dxd_fle_cum_aux`
--

CREATE TABLE IF NOT EXISTS `shi_dxd_fle_cum_aux` (
  `per` varchar(7) NOT NULL,
  `pay` int(10) DEFAULT NULL,
  `solToPar` int(10) DEFAULT NULL,
  `shiDocNum` int(10) DEFAULT NULL,
  `dxdCubMet` double(20,10) DEFAULT NULL,
  `shiCubMet` double(20,10) DEFAULT NULL,
  `groSal` double(20,10) DEFAULT NULL,
  `netSal` double(20,10) DEFAULT NULL,
  `dxdMet` double(20,10) DEFAULT NULL,
  `tip` int(3) DEFAULT NULL,
  KEY `shiToPar` (`solToPar`),
  KEY `solToPar` (`solToPar`),
  KEY `shiDocNum` (`shiDocNum`),
  KEY `solToPar_2` (`solToPar`),
  KEY `pay` (`pay`),
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sku_ren`
--

CREATE TABLE IF NOT EXISTS `sku_ren` (
  `per` varchar(7) NOT NULL,
  `sku` bigint(14) DEFAULT NULL,
  `des` varchar(500) DEFAULT NULL,
  `estIba` int(2) DEFAULT NULL,
  `estAnd` int(3) DEFAULT NULL,
  KEY `sku` (`sku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sol_gro_net_kil`
--

CREATE TABLE IF NOT EXISTS `sol_gro_net_kil` (
  `solToPar` varchar(10) DEFAULT NULL,
  `totKil` double(12,3) DEFAULT NULL,
  `groSal` double(12,3) DEFAULT NULL,
  `netSal` double(12,3) DEFAULT NULL,
  `groSalKil` double(12,3) DEFAULT NULL,
  `netSalKil` double(12,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_por`
--

CREATE TABLE IF NOT EXISTS `tab_por` (
  `pay` int(9) DEFAULT NULL,
  `val0019` double(20,10) DEFAULT NULL,
  `val2029` double(20,10) DEFAULT NULL,
  `val3039` double(20,10) DEFAULT NULL,
  `val4059` double(20,10) DEFAULT NULL,
  `val6079` double(20,10) DEFAULT NULL,
  `val80100` double(20,10) DEFAULT NULL,
  `cosMat` double(20,10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tar_fle`
--

CREATE TABLE IF NOT EXISTS `tar_fle` (
  `per` varchar(7) NOT NULL,
  `fiscalWeek` varchar(7) DEFAULT NULL,
  `shiDocNum` int(8) DEFAULT NULL,
  `shiCosNum` int(12) DEFAULT NULL,
  `forAge` int(8) DEFAULT NULL,
  `linea` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `shiLoc` int(6) DEFAULT NULL,
  `shiToPar` int(8) DEFAULT NULL,
  `cliente` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `staTra` varchar(50) DEFAULT NULL,
  `conTyp` varchar(10) DEFAULT NULL,
  `nomCon` varchar(50) DEFAULT NULL,
  `conVal` double(12,3) DEFAULT NULL,
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `var_ent`
--

CREATE TABLE IF NOT EXISTS `var_ent` (
  `per` varchar(7) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `val` varchar(50) DEFAULT NULL,
  `pro` varchar(50) DEFAULT NULL,
  KEY `per` (`per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
