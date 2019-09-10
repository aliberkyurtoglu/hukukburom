-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 10 Eyl 2019, 20:15:21
-- Sunucu sürümü: 5.7.17-log
-- PHP Sürümü: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `hukukburom`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `avukat`
--

CREATE TABLE `avukat` (
  `ID` int(11) NOT NULL,
  `adSoyad` varchar(50) NOT NULL,
  `kullaniciAdi` varchar(25) NOT NULL,
  `sifre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `avukat`
--

INSERT INTO `avukat` (`ID`, `adSoyad`, `kullaniciAdi`, `sifre`) VALUES
(1, 'Demo Avukat', 'demo-avukat', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dava`
--

CREATE TABLE `dava` (
  `ID` int(3) NOT NULL,
  `muvekkil_id` int(3) NOT NULL,
  `davaAdi` varchar(250) NOT NULL,
  `dava_aciklama` text NOT NULL,
  `dava_durum` enum('0','1') NOT NULL,
  `dava_zaman` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `dava`
--

INSERT INTO `dava` (`ID`, `muvekkil_id`, `davaAdi`, `dava_aciklama`, `dava_durum`, `dava_zaman`) VALUES
(4, 4, 'Cinayete Teşebbüs', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam bibendum, dui in luctus lacinia, arcu arcu ultrices metus, vitae porta odio odio in lorem. Maecenas hendrerit facilisis nisi, eu mattis mi pellentesque id. Etiam iaculis vestibulum laoreet. Donec lobortis bibendum arcu, in ullamcorper ligula. Nullam fermentum lectus lacus, eu lobortis turpis posuere at. Duis at laoreet nibh. Nullam nec augue venenatis, facilisis leo eget, fringilla ipsum. Vivamus gravida varius facilisis. Integer porta fermentum lorem, ut porta nibh molestie sed. Donec et laoreet leo, eget fermentum justo. Vestibulum vitae posuere ipsum. Pellentesque feugiat a purus vitae aliquet. Maecenas tempor quam eu velit accumsan, sed ultrices neque luctus. Donec eget sollicitudin sapien.</p>\r\n\r\n<p>Cras cursus facilisis suscipit. Sed ultrices mauris vel volutpat finibus. Donec vel erat ultricies, porttitor ligula in, commodo est. Mauris gravida varius eros, et fermentum mauris molestie placerat. In hac habitasse platea dictumst. Pellentesque nulla nibh, iaculis non fringilla ac, volutpat nec velit. Proin nulla nulla, molestie tristique laoreet bibendum, euismod in magna. Nulla facilisi. Nullam eget suscipit metus. Phasellus eleifend sem a est placerat posuere. In hac habitasse platea dictumst. Proin interdum nec quam nec maximus. In lacinia mollis elit, in maximus diam.</p>\r\n\r\n<p>Phasellus rutrum, purus at finibus aliquam, erat nisl fringilla ex, ut commodo velit dolor et felis. Phasellus suscipit neque vitae ipsum laoreet, nec tempor metus posuere. Phasellus sit amet tellus quam. Etiam lobortis mauris non enim lobortis, et viverra nunc convallis. Suspendisse sollicitudin maximus mattis. Sed eget nulla vitae magna bibendum vestibulum consequat non ipsum. Pellentesque vel facilisis urna. Morbi quis hendrerit felis, eu pellentesque enim. Duis congue luctus purus, quis dictum ipsum gravida a. Vestibulum odio urna, rhoncus nec bibendum id, vehicula efficitur dui. Proin quis congue est. Sed non lacus ac libero dapibus aliquam ut eget ligula. Aenean eget erat tellus. Sed pulvinar iaculis leo, et vehicula mauris interdum bibendum. Donec feugiat congue porttitor.</p>\r\n\r\n<p>Vestibulum in volutpat purus. Fusce ut ipsum mauris. Etiam bibendum, purus pellentesque semper bibendum, ex turpis dignissim ipsum, at laoreet enim mi at nisi. Aenean fringilla bibendum diam eu aliquam. Fusce a tincidunt lacus, ac mollis ante. Praesent rutrum tellus id metus posuere, ac viverra nulla dapibus. Quisque eu nulla rutrum, semper felis id, sollicitudin arcu. Vestibulum malesuada felis id ex maximus vestibulum. Nullam mi lectus, convallis sit amet auctor id, mollis ut magna. Morbi ac ultricies elit. Fusce dignissim et quam ac convallis. Vestibulum scelerisque tortor vitae eros dignissim, at cursus velit congue. Sed eget tempus lacus, et malesuada nisl. Donec quis augue tristique neque sollicitudin ullamcorper. Proin laoreet tincidunt iaculis.</p>\r\n\r\n<p>Vivamus sed lobortis odio, id laoreet sapien. Nunc laoreet volutpat quam, condimentum convallis metus semper mattis. Donec aliquet massa sed commodo vulputate. Cras et ligula congue, venenatis ex sed, scelerisque felis. Sed nec eros nec erat vulputate consectetur nec a nisl. Etiam bibendum sapien aliquet nisl semper lobortis. Proin commodo nibh nec sapien pharetra, quis tempus mi posuere. Integer in tempor urna.</p>\r\n', '1', '2019-09-10 23:09:03');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `muvekkil`
--

CREATE TABLE `muvekkil` (
  `ID` int(3) NOT NULL,
  `adSoyad` varchar(50) NOT NULL,
  `kullaniciAdi` varchar(30) NOT NULL,
  `sifre` varchar(100) NOT NULL,
  `ePosta` varchar(30) NOT NULL,
  `durum` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `muvekkil`
--

INSERT INTO `muvekkil` (`ID`, `adSoyad`, `kullaniciAdi`, `sifre`, `ePosta`, `durum`) VALUES
(4, 'Demo Müvekkil', 'demo-muvekkil', 'e10adc3949ba59abbe56e057f20f883e', 'demo@muvekkil.com', '1');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `avukat`
--
ALTER TABLE `avukat`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `dava`
--
ALTER TABLE `dava`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `muvekkil`
--
ALTER TABLE `muvekkil`
  ADD PRIMARY KEY (`ID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `avukat`
--
ALTER TABLE `avukat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `dava`
--
ALTER TABLE `dava`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `muvekkil`
--
ALTER TABLE `muvekkil`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
