-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2019 at 12:49 PM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 7.2.15-1+0~20190209065041.16+jessie~1.gbp3ad8c0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebDiP2018x093`
--

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik_rada`
--

CREATE TABLE `dnevnik_rada` (
  `id_dnevnik_rada` int(11) NOT NULL,
  `opis_zahtjeva` varchar(400) NOT NULL,
  `datum_unosa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategorije_licenca`
--

CREATE TABLE `kategorije_licenca` (
  `id_kategorije_licenca` int(11) NOT NULL,
  `naziv_kategorije` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id_korisnik` int(11) NOT NULL,
  `uloga_korisnika_id_uloga` int(11) NOT NULL,
  `dnevnik_rada_id_dnevnik_rada` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `korisnicko_ime` varchar(45) NOT NULL,
  `lozinka` varchar(45) NOT NULL,
  `email` text NOT NULL,
  `datum_vrijeme_uvjeta` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik_has_licence`
--

CREATE TABLE `korisnik_has_licence` (
  `korisnik_id_korisnik` int(11) NOT NULL,
  `licence_id_licence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `licence`
--

CREATE TABLE `licence` (
  `id_licence` int(11) NOT NULL,
  `kategorije_licenca_id_kategorije_licenca` int(11) NOT NULL,
  `zahtjev_odobrenje_id_zahtjev_odobrenje` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL,
  `slika_licence` varchar(45) DEFAULT NULL,
  `kolicina` int(11) NOT NULL,
  `iznos` decimal(10,0) NOT NULL,
  `datum_stvaranja` date NOT NULL,
  `datum_isteka` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uloga_korisnika`
--

CREATE TABLE `uloga_korisnika` (
  `id_uloga` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uloga_korisnika`
--

INSERT INTO `uloga_korisnika` (`id_uloga`, `naziv`) VALUES
(1, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `zahtjev_odobrenje`
--

CREATE TABLE `zahtjev_odobrenje` (
  `id_zahtjev_odobrenje` int(11) NOT NULL,
  `status_zahtjeva` char(1) NOT NULL,
  `datum_odobrenja_odbijanja` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dnevnik_rada`
--
ALTER TABLE `dnevnik_rada`
  ADD PRIMARY KEY (`id_dnevnik_rada`);

--
-- Indexes for table `kategorije_licenca`
--
ALTER TABLE `kategorije_licenca`
  ADD PRIMARY KEY (`id_kategorije_licenca`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id_korisnik`),
  ADD KEY `fk_korisnik_uloga_idx` (`uloga_korisnika_id_uloga`),
  ADD KEY `fk_korisnik_dnevnik_rada1_idx` (`dnevnik_rada_id_dnevnik_rada`);

--
-- Indexes for table `korisnik_has_licence`
--
ALTER TABLE `korisnik_has_licence`
  ADD KEY `fk_korisnik_has_licence_licence1_idx` (`licence_id_licence`),
  ADD KEY `fk_korisnik_has_licence_korisnik1_idx` (`korisnik_id_korisnik`);

--
-- Indexes for table `licence`
--
ALTER TABLE `licence`
  ADD PRIMARY KEY (`id_licence`),
  ADD KEY `fk_licence_kategorije_licenca1_idx` (`kategorije_licenca_id_kategorije_licenca`),
  ADD KEY `fk_licence_zahtjev_odobrenje1_idx` (`zahtjev_odobrenje_id_zahtjev_odobrenje`);

--
-- Indexes for table `uloga_korisnika`
--
ALTER TABLE `uloga_korisnika`
  ADD PRIMARY KEY (`id_uloga`);

--
-- Indexes for table `zahtjev_odobrenje`
--
ALTER TABLE `zahtjev_odobrenje`
  ADD PRIMARY KEY (`id_zahtjev_odobrenje`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dnevnik_rada`
--
ALTER TABLE `dnevnik_rada`
  MODIFY `id_dnevnik_rada` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kategorije_licenca`
--
ALTER TABLE `kategorije_licenca`
  MODIFY `id_kategorije_licenca` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id_korisnik` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `licence`
--
ALTER TABLE `licence`
  MODIFY `id_licence` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uloga_korisnika`
--
ALTER TABLE `uloga_korisnika`
  MODIFY `id_uloga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `zahtjev_odobrenje`
--
ALTER TABLE `zahtjev_odobrenje`
  MODIFY `id_zahtjev_odobrenje` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `fk_korisnik_uloga` FOREIGN KEY (`uloga_korisnika_id_uloga`) REFERENCES `uloga_korisnika` (`id_uloga`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_korisnik_dnevnik_rada1` FOREIGN KEY (`dnevnik_rada_id_dnevnik_rada`) REFERENCES `dnevnik_rada` (`id_dnevnik_rada`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `korisnik_has_licence`
--
ALTER TABLE `korisnik_has_licence`
  ADD CONSTRAINT `fk_korisnik_has_licence_korisnik1` FOREIGN KEY (`korisnik_id_korisnik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_korisnik_has_licence_licence1` FOREIGN KEY (`licence_id_licence`) REFERENCES `licence` (`id_licence`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `licence`
--
ALTER TABLE `licence`
  ADD CONSTRAINT `fk_licence_kategorije_licenca1` FOREIGN KEY (`kategorije_licenca_id_kategorije_licenca`) REFERENCES `kategorije_licenca` (`id_kategorije_licenca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_licence_zahtjev_odobrenje1` FOREIGN KEY (`zahtjev_odobrenje_id_zahtjev_odobrenje`) REFERENCES `zahtjev_odobrenje` (`id_zahtjev_odobrenje`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
