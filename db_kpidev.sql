-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Apr 2024 pada 15.55
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kpidev`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_kpis`
--

CREATE TABLE `admin_kpis` (
  `id` int(11) NOT NULL,
  `periode` varchar(100) NOT NULL,
  `id_kamus` int(11) NOT NULL,
  `aktual_realisasi` varchar(50) NOT NULL,
  `pencapaian_sf` double DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` enum('approve','reject','wait') NOT NULL DEFAULT 'wait',
  `subdivisi` enum('COMBEN','REKRUT','TND','IR') NOT NULL,
  `alasan` text DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin_kpis`
--

INSERT INTO `admin_kpis` (`id`, `periode`, `id_kamus`, `aktual_realisasi`, `pencapaian_sf`, `file`, `status`, `subdivisi`, `alasan`, `id_user`) VALUES
(50, 'Februari 2024', 229, '100%', NULL, 'PtqCbsnzivnRs2BOXCQmbG7UfRPUnBf4LYRLcH1M.pdf', 'approve', 'IR', NULL, 75),
(51, 'Februari 2024', 228, '0', NULL, 'blRqrZWtig4N7KvOIcXlFr0farcpl97U1lL8AtjX.png', 'approve', 'IR', NULL, 75),
(52, 'Februari 2024', 227, '0', NULL, 'R7apKbFJEeT2WzZg0EAIxU8dtzEf5Gno64kTXBPX.jpg', 'approve', 'IR', NULL, 75),
(53, 'Februari 2024', 226, '0', NULL, '4GURlJ7UqzKzMDkB9tPdk0QE8NyE5k1lMa7Wv1fo.pdf', 'approve', 'IR', NULL, 75),
(54, 'Februari 2024', 225, '100%', NULL, 'J0sXPf5SBi7TYkw3I7A9R7rtmt9LqVja7XBtm7aa.pdf', 'approve', 'IR', NULL, 75),
(55, 'Februari 2024', 224, '100%', NULL, 'RaJ82FQ9CoriknjT4NIvQoOJBt5i3PFJ9j5P6kMN.pdf', 'approve', 'IR', NULL, 75),
(56, 'Februari 2024', 223, '100%', NULL, '1Q7pIILuos7VKwD22smVPaBLqdGwimWxsa8J15r7.pdf', 'approve', 'IR', NULL, 75),
(57, 'Februari 2024', 222, '100%', NULL, '8XpnBU0GIptGgi1jXLgzLgKq5KLz8FFBD0eErgdN.pdf', 'approve', 'IR', NULL, 75),
(58, 'Februari 2024', 221, '100%', NULL, 'yTovgd6O0MqugfxOjmBgvRHG91O1U5mfpSsV4JYA.pdf', 'approve', 'IR', NULL, 75),
(59, 'Februari 2024', 220, '100%', NULL, 'Iz3DrEBq31APXigDUy1jk0DR7Mwjnu1xpwqmZaGh.pdf', 'approve', 'IR', NULL, 75),
(60, 'Februari 2024', 209, '100', NULL, 'pzJdFBg7UNtDM5YIQuDw8ZCYDGOymJsbG98FeS6y.pdf', 'approve', 'COMBEN', NULL, 71),
(61, 'Februari 2024', 208, '0', NULL, 'v5dFIz7dBfsTmZ9kuBUC3qTnWhnv8kHV1oyoJ18b.pdf', 'approve', 'COMBEN', NULL, 71),
(62, 'Februari 2024', 207, '0', NULL, '0aXDpFFNxF1Y08qGlXRgZR2WTAgTNXkKfjUZU9nE.pdf', 'approve', 'COMBEN', NULL, 71),
(63, 'Februari 2024', 206, '0', NULL, 'wKZlL63tr488WF2q1A3OQOan2G8utmBngzMgO4dd.pdf', 'approve', 'COMBEN', NULL, 71),
(65, 'Februari 2024', 205, '100', NULL, 'LLnQa1gyDX2W8J2FOM4lTQnOzf2dbR1m73gwew2i.pdf', 'approve', 'COMBEN', NULL, 71),
(66, 'Februari 2024', 204, '100', NULL, 'pXmItdylHHbm0wSibYQvMuYQAfzrORz59LGgaCuq.pdf', 'approve', 'COMBEN', NULL, 71),
(67, 'Februari 2024', 203, '100', NULL, 'ceVo6EhvprYVfBqslKhHeKhEkiz1qvmfZSygjTdf.pdf', 'approve', 'COMBEN', NULL, 71),
(68, 'Februari 2024', 202, '100', NULL, 'NZAlCDZm1UqsN6n0dBKsp016RZI60W5Jf42NzejC.pdf', 'approve', 'COMBEN', NULL, 71),
(69, 'Februari 2024', 201, '100', NULL, 'EONAFqnLOOL0x1v5n6V2r1O5I1INiu4xo6fz1zdM.pdf', 'approve', 'COMBEN', NULL, 71),
(70, 'Februari 2024', 200, '100', NULL, 'tKV4kCMjx6u8JnXCaNtW0EzUcdGkZ73ZiEapmXOg.pdf', 'approve', 'COMBEN', NULL, 71),
(71, 'Februari 2024', 204, '100', NULL, 'EHyM2ycuKgV9nNL1uFiMfTzT91Vsa3m2JRMfuOsy.pdf', 'approve', 'COMBEN', NULL, 71),
(72, 'Januari 2024', 209, '100', NULL, 'VQR1WeguVykIhjJOk7iJJI7la6kuR3zi2XoIXOwk.pdf', 'approve', 'COMBEN', NULL, 71),
(73, 'Januari 2024', 208, '0', NULL, '4riTZLaQroubwOHlre0KKuJSNMAaRHqaJB4iEKvR.pdf', 'approve', 'COMBEN', NULL, 71),
(74, 'Januari 2024', 207, '0', NULL, 'Y5XrZ8Nb6dvKMccrapeHJtiM1nx25YM4n63vuxnQ.pdf', 'approve', 'COMBEN', NULL, 71),
(75, 'Januari 2024', 209, '100', NULL, 'W8lDJBgzT58MBF5LUpVvCeBENCt57fgKbrr3cIf3.pdf', 'approve', 'COMBEN', NULL, 70),
(76, 'Januari 2024', 206, '0', NULL, 'U3nltxwYnhPsS3LPMUELaQXvaC2VJzEzJYu6i6n7.pdf', 'approve', 'COMBEN', NULL, 71),
(77, 'Januari 2024', 205, '100', NULL, 'hMhTQsVKhHsxl6qsG8ZmfvzHjS5y8VgLxoYrvycG.pdf', 'approve', 'COMBEN', NULL, 71),
(78, 'Januari 2024', 204, '100', NULL, '4qu1R98snfXJ1E4dz7ZVxEHgxO80GFGsuAOJeZe2.pdf', 'approve', 'COMBEN', NULL, 71),
(79, 'Januari 2024', 203, '100', NULL, 'QFdu3qmQk69wP88pfcgePvP8H4NyxYVrTQMrUfbi.pdf', 'approve', 'COMBEN', NULL, 71),
(80, 'Januari 2024', 200, '100', NULL, 'Yk9IQ76OQEgVcNP9LOczL7tdyId4CIX0N3EflZL1.pdf', 'approve', 'COMBEN', NULL, 70),
(82, 'Januari 2024', 201, '100', NULL, '3z6xcZru2yW1LTKmwuMXOnsiLSiCdwdnvl1Yzh8j.pdf', 'approve', 'COMBEN', NULL, 71),
(83, 'Januari 2024', 200, '100', NULL, '8UE6542NvQ8wQCI2NL77goSxFxOYwfBuMJ1MTFQx.pdf', 'approve', 'COMBEN', NULL, 71),
(84, 'Januari 2024', 201, '100', NULL, 'UgbzIsBW94APBMcFAicbNTKIjJvOkp0AKSolp67y.pdf', 'approve', 'COMBEN', NULL, 70),
(85, 'Januari 2024', 202, '100', NULL, '15GCwuNvbjiXOlOYH6kgKMtWGk6SvrD0FISmMQHd.pdf', 'approve', 'COMBEN', NULL, 71),
(94, 'Februari 2024', 210, '100', NULL, 'M3P9rPZowBYglwQsR0uBSGaxV5SRtudrE9viS60V.pdf', 'wait', 'REKRUT', NULL, 74),
(95, 'Februari 2024', 211, '100', NULL, 'bP9RZtOoocJeMgry40tMNJCQ45oVkgOqaLF5NKs0.pdf', 'wait', 'REKRUT', NULL, 74),
(96, 'Februari 2024', 212, '100', NULL, 'nMcf6kTA5vEcMykhG8L8RuYHZCdnesiTSWF9lRWd.pdf', 'wait', 'REKRUT', NULL, 74),
(97, 'Februari 2024', 213, '100', NULL, '2k8T5nRwpy6ed18Wxn5yTb9JiJlqSUxiS8FHNdgQ.pdf', 'wait', 'REKRUT', NULL, 74),
(98, 'Februari 2024', 214, '100', NULL, 'SpSLiXiYHHvwF0Yb2AS7NtjwOhWD0Hbyn7YUAu1u.pdf', 'wait', 'REKRUT', NULL, 74),
(99, 'Februari 2024', 215, '100', NULL, '7bKlsFZkWiHmsrtvKUMg1xorfuGOlRguYD1Tkhkb.pdf', 'wait', 'REKRUT', NULL, 74),
(100, 'Februari 2024', 216, '0', NULL, 'j8p2BRrc9KhJuaNvRBMoOw5xqZUtoMNHd3iRanKc.pdf', 'wait', 'REKRUT', NULL, 74),
(101, 'Februari 2024', 217, '0', NULL, 'HIRRPL0H9q5u9rwTgBzYQT7ovdEq5YOM5kOvdWYB.pdf', 'wait', 'REKRUT', NULL, 74),
(102, 'Februari 2024', 218, '0', NULL, '3m6TOysaUnema8Q2akohXOX0xnvJstG0erDskzDr.pdf', 'wait', 'REKRUT', NULL, 74),
(103, 'Februari 2024', 219, '100', NULL, 'AnzJcEWBVbhUwaT9j2XMGL52Lgh7miO0bqEHk0X5.pdf', 'wait', 'REKRUT', NULL, 74),
(104, 'Februari 2024', 209, '100', NULL, '6c941xhX43mWtqxoooYGy2KoKhs9OSQVMXEbbeeP.pdf', 'approve', 'COMBEN', NULL, 77),
(105, 'Februari 2024', 208, '0', NULL, 'Vh7Q1i0ihnt4dUaHYjqCe1mVBtmQGZV0OMWeolgA.pdf', 'approve', 'COMBEN', NULL, 77),
(106, 'Februari 2024', 200, '100', NULL, 'ZxrZa2rIRr5LGiqy770l2tbHJqhc8F3XhYzrRLCu.pdf', 'approve', 'COMBEN', NULL, 77),
(115, 'Februari 2024', 201, '100', NULL, 'GEa5pcHfRu0saGfsFNAnq0xCl5SXGv7IYX0iVrVi.pdf', 'approve', 'COMBEN', NULL, 70),
(116, 'Februari 2024', 200, '98.76', NULL, 'zvQlskejWxpPJTa6ao0IO9xlUrYi2FfWsAiZNiQk.pdf', 'approve', 'COMBEN', NULL, 70),
(118, 'Februari 2024', 204, '100', NULL, 'dlzTFVf6jsg0fe7P49L0gcjsWisY155cEnBOpnwS.pdf', 'approve', 'COMBEN', NULL, 70),
(119, 'Februari 2024', 205, '100', NULL, 'blf9L8U9AlSnzzKTzV2yttBpUXBcEMNmuhc3ZqA7.pdf', 'approve', 'COMBEN', NULL, 70),
(120, 'Februari 2024', 206, '0', NULL, '2HkuslKjLvMcT6N8dU872PClQ98AT0G0ZBAwt2h3.pdf', 'approve', 'COMBEN', NULL, 70),
(121, 'Februari 2024', 207, '0', NULL, 'vnPlE30Zkrr2AUlLrSyBekZWtBuOrNM8ryiZ1u2d.pdf', 'approve', 'COMBEN', NULL, 70),
(122, 'Februari 2024', 208, '0', NULL, '5FWcSdVCc434laLiXreVQ07Nbp84lpPgYfQazmxj.pdf', 'approve', 'COMBEN', NULL, 70),
(123, 'Februari 2024', 209, '100', NULL, 'ZGcSZbj2w7EpOR3dCYJW0ZlzzIIdEQ8N0kYdnQ28.pdf', 'approve', 'COMBEN', NULL, 70),
(124, 'Februari 2024', 200, '100%', NULL, 'RDWuySEyhwcrTEXHwoku0QzzfjD72ry636MRQ3dO.pdf', 'approve', 'COMBEN', NULL, 72),
(125, 'Februari 2024', 201, '100%', NULL, 'mAHiqaUFRA1cExLKW5ASm7tT7bGXm9BeNKDhFAJu.pdf', 'approve', 'COMBEN', NULL, 72),
(126, 'Februari 2024', 202, '100%', NULL, 'h8CM2mkxZ59GUxgsZil5W9PjrFd8jEwUbzvbc3U1.pdf', 'approve', 'COMBEN', NULL, 72),
(128, 'Februari 2024', 203, '100%', NULL, 'xR6kx8XGQBoPjTUOxGpkPt7tdj1tceQcFUIZmEEQ.pdf', 'approve', 'COMBEN', NULL, 72),
(129, 'Februari 2024', 204, '100%', NULL, '3LpGzTqAZH4hXYYcpl4Et2K9nAsGN6nTPOqAmG6m.pdf', 'approve', 'COMBEN', NULL, 72),
(131, 'Februari 2024', 205, '100%', NULL, 'iFNkBB7RO7RFISBQae0wzdpaHaQ2HLFg59TjzVxU.pdf', 'approve', 'COMBEN', NULL, 72),
(132, 'Februari 2024', 206, '0', NULL, 'GkUiYchvlmC5X8vEDP3wOvI9s1mJWmrJHbdRYMnv.pdf', 'approve', 'COMBEN', NULL, 72),
(133, 'Februari 2024', 207, '0', NULL, 'GMzOxEuq7nX3g4lZJXGLdUdlxWYccLEMbDlBB9Vt.pdf', 'approve', 'COMBEN', NULL, 72),
(134, 'Februari 2024', 208, '1', NULL, 'Ov6xiduyxy2hfweZqKVqAl4jcxF277Wx1kyUK3Yo.pdf', 'approve', 'COMBEN', NULL, 72),
(135, 'Februari 2024', 209, '0', NULL, 'y8sKZwQ1oWXPwdepJddyseSc6juGenr1i6ND704y.pdf', 'approve', 'COMBEN', NULL, 72),
(136, 'Februari 2024', 201, '100', NULL, 'xPBPnFAGnwjMjySEpHteicENWHDUaIkJAOqeOCv2.pdf', 'approve', 'COMBEN', NULL, 77),
(137, 'Februari 2024', 202, '100', NULL, 'i9KsLGBtJn1Pby6rE7qBUvVj8EVWT5bVaUarOkKb.pdf', 'approve', 'COMBEN', NULL, 77),
(138, 'Februari 2024', 203, '100', NULL, 'eEkRtKmybpVaoLBuwwtZbtgpwdWr0u0o2maqWJam.pdf', 'approve', 'COMBEN', NULL, 77),
(139, 'Februari 2024', 204, '100', NULL, '1bFOVtfsxqTLA4lF9XpMLBd4IggNDNXCVmw53p7B.pdf', 'approve', 'COMBEN', NULL, 77),
(140, 'Februari 2024', 205, '100', NULL, 'VK7Yb6onAYIDAiIivYbbfZXFGh0mTnxOlWnhUMWm.pdf', 'approve', 'COMBEN', NULL, 77),
(141, 'Februari 2024', 206, '100', NULL, 'RZQQ6nC67k3igWJlRYV7oP2xJRg5nNjFdp9gmemX.pdf', 'approve', 'COMBEN', NULL, 77),
(142, 'Februari 2024', 207, '100', NULL, '5pbdKQkj3zZhdq0ZLBvfXVwqqpWYYDM0cVmCZMbH.pdf', 'approve', 'COMBEN', NULL, 77),
(143, 'Januari 2024', 210, '100', NULL, 'k15RfwXoJ1fX8O0uqoZf8VZFju4EvdMKmYtpucxH.pdf', 'wait', 'REKRUT', NULL, 74),
(144, 'Januari 2024', 211, '100', NULL, 'hnsbZiwFjEVoSwwNc0vxnqeWIHPjpCuh5Ly6zTSg.pdf', 'wait', 'REKRUT', NULL, 74),
(145, 'Januari 2024', 212, '100', NULL, '4aIs9ZmPYwyoT69hPRDsICBwRlOmCx2THnT00Hxr.pdf', 'wait', 'REKRUT', NULL, 74),
(146, 'Januari 2024', 213, '100', NULL, 'KG3GeYDEzVWuo7jTmnMIJnvhaJLLOtG1v9sD5z3w.pdf', 'wait', 'REKRUT', NULL, 74),
(147, 'Januari 2024', 214, '100', NULL, '0RHsIY04XQVuI6MUTTN13IAFzpUL8nWxvVu6Bo0a.pdf', 'wait', 'REKRUT', NULL, 74),
(148, 'Januari 2024', 215, '100', NULL, 'BSqtTrQDmontcWeBTkOH9fY5QCrpgAh51Lp7bQ9q.pdf', 'wait', 'REKRUT', NULL, 74),
(149, 'Januari 2024', 216, '0', NULL, 'spDoV8RjSOy2ZpkVkIJMseIRpcfH1pGBC9QYTIsl.pdf', 'wait', 'REKRUT', NULL, 74),
(150, 'Januari 2024', 217, '0', NULL, 'aQiGOeGV7N87X4xIgUtsb9cs3QGsmYVDYVoSyaJ2.pdf', 'wait', 'REKRUT', NULL, 74),
(151, 'Januari 2024', 218, '0', NULL, 'rOPmcixVuCoQYY4ErSFV3EtKPfVDMX9cLk5MLzyJ.pdf', 'wait', 'REKRUT', NULL, 74),
(152, 'Januari 2024', 219, '100', NULL, '76mWVXleqdhcAel84kCFkv6VB3U9LujvLbin8EwJ.pdf', 'approve', 'REKRUT', NULL, 74),
(154, 'Februari 2024', 210, '100', NULL, 'xsoKjBIHyguXCraz8RLSc86Sx0lKdEIQHjooAQvs.pdf', 'wait', 'REKRUT', NULL, 73),
(155, 'Februari 2024', 211, '100', NULL, 'RnRC2vjOCeIgnb7hDPT2oN4CKAagmC4HVpz5lSrl.pdf', 'wait', 'REKRUT', NULL, 73),
(156, 'Februari 2024', 212, '100', NULL, 'BZzSuH94Eo78osmx87Cfd0TzGnodqahsRxmWstpl.pdf', 'wait', 'REKRUT', NULL, 73),
(157, 'Februari 2024', 213, '100', NULL, 'Xuwte4946zHcwoPczFLgPrXJwIno52DlxmlgG805.pdf', 'wait', 'REKRUT', NULL, 73),
(158, 'Februari 2024', 214, '100', NULL, 'HfDSlD2qOAgdH7qNbmRoJbyYoKCxX2erXimD0pcW.pdf', 'wait', 'REKRUT', NULL, 73),
(159, 'Februari 2024', 215, '100', NULL, 'AaxSJV8Hcrt8HWqUEB0NF9e6dA1kwzMkoKOSj37S.pdf', 'wait', 'REKRUT', NULL, 73),
(160, 'Februari 2024', 216, '0', NULL, 'a7knENwiwOsr4feL6DS9dcO4bGwTr3cAsFtDsiKw.pdf', 'wait', 'REKRUT', NULL, 73),
(161, 'Februari 2024', 217, '0', NULL, 'BLUU1I2r0xDkzMuBP11mnyeDdCyB1zvyMxRz7IH8.pdf', 'wait', 'REKRUT', NULL, 73),
(162, 'Februari 2024', 218, '0', NULL, 'SmtpbmTG4PJIUPWA5rhSp58iCWSDY18hfrS2mYbF.pdf', 'wait', 'REKRUT', NULL, 73),
(163, 'Februari 2024', 219, '100', NULL, '0aBPiXskvi28QAv9EZJwnWmF6YFFvlB1OJgGo3kH.pdf', 'wait', 'REKRUT', NULL, 73),
(164, 'Januari 2024', 210, '100', NULL, 'gsivnACyO05v83j1FB1Ix3hVcVNvwsQaq4PD5gDY.pdf', 'wait', 'REKRUT', NULL, 73),
(165, 'Januari 2024', 211, '100', NULL, 'ZSQeY345ai3j32Ze6gqBhevKJdHAvO24hdrinLKg.pdf', 'wait', 'REKRUT', NULL, 73),
(166, 'Januari 2024', 212, '100', NULL, 'G3fOr52AGwCMfH7K6qEhe4CYqcpNAyp1oiPmbMgf.pdf', 'wait', 'REKRUT', NULL, 73),
(167, 'Januari 2024', 213, '100', NULL, 'OG3Qs5PO6LLBYjEKxPjfBASUrwYPeiRecVQrpswz.pdf', 'wait', 'REKRUT', NULL, 73),
(168, 'Januari 2024', 214, '100', NULL, 'h15FiOBW7pQOtomFMM1HK14EuEKxOjbRJp8VwfDj.pdf', 'approve', 'REKRUT', NULL, 73),
(169, 'Januari 2024', 215, '100', NULL, 'A9zY6QuzT9gemauCfSIPFm8ifJ5rKf8SW783X0XQ.pdf', 'approve', 'REKRUT', NULL, 73),
(170, 'Januari 2024', 216, '0', NULL, '3mfnaKxVcaHlflJP0x8dmSSbHxOJvg5bLoxSEajZ.pdf', 'approve', 'REKRUT', NULL, 73),
(171, 'Januari 2024', 217, '0', NULL, 'bcJzMccSH5D4C7LJpzM0kqqXTk7Uj8hQlqihAFuG.pdf', 'approve', 'REKRUT', NULL, 73),
(172, 'Januari 2024', 218, '0', NULL, 'FON9LP5EmkqaIE8EA53IwyRk8RlvZtwOT9R5aIrU.pdf', 'approve', 'REKRUT', NULL, 73),
(173, 'Januari 2024', 219, '100', NULL, 'wih3axWaTbBt6M6dH8BfYuvRdtUSQhartc50gP44.pdf', 'approve', 'REKRUT', NULL, 73),
(175, 'Februari 2024', 202, '100', NULL, 'a09P7GZlu0v3JN2DQ8vs0klzFoPm8nVTWTC5WURq.pdf', 'approve', 'COMBEN', NULL, 70),
(176, 'Januari 2024', 200, '100', NULL, 'NY86JJ0Xc8D2ql4K9SkmUJTrLDX5WpA6pA82uS7v.pdf', 'approve', 'COMBEN', NULL, 76),
(177, 'Januari 2024', 201, '100', NULL, 'NpAkPa0nDv3MQGujJaKZWPa0xuA4tG1RxFFTKtLv.pdf', 'approve', 'COMBEN', NULL, 76),
(178, 'Januari 2024', 202, '100', NULL, 'oT5C3WNAXdx5DeOGmM3GAMrgihYl6UGETW42Mf8s.pdf', 'approve', 'COMBEN', NULL, 76),
(179, 'Januari 2024', 203, '100', NULL, 'GfT3lhz0VxLgzdk8DFtoktASalWzJjeiwCQbY5MD.pdf', 'approve', 'COMBEN', NULL, 76),
(180, 'Januari 2024', 204, '100', NULL, '220MqTepSvR64O67upEZ9drnO9BfSrXhzk1eMppW.pdf', 'approve', 'COMBEN', NULL, 76),
(181, 'Januari 2024', 205, '100', NULL, 'bqFtGGWV1dhn7RoPNLemuISbRH3B3KUAxyuOOrUM.pdf', 'approve', 'COMBEN', NULL, 76),
(182, 'Januari 2024', 206, '100', NULL, '2UBlZzKby4WnN3Qt6ZeXdIPNQ2ZILv0eyhCMj9xw.pdf', 'approve', 'COMBEN', NULL, 76),
(183, 'Januari 2024', 207, '100', NULL, 'm2HHDwRE7mVhYoqZYdd5RoNgfrkoFugE7pqdjXCa.pdf', 'approve', 'COMBEN', NULL, 76),
(184, 'Januari 2024', 208, '100', NULL, 'fezl5W5lXhHYDmB34iFCyuXcAejxq9ZK6nmEYncq.pdf', 'approve', 'COMBEN', NULL, 76),
(185, 'Januari 2024', 209, '100', NULL, '6dggZzL5Y1ZIIyKEd6k2L1vAsC7ylpz01edXLCm5.pdf', 'approve', 'COMBEN', NULL, 76),
(186, 'Februari 2024', 200, '100', NULL, 'SQyvfi0WGPCXWWNKNuMQf3LIowl8JhlybLYdBd0u.pdf', 'approve', 'COMBEN', NULL, 76),
(187, 'Februari 2024', 201, '100', NULL, '4dKlEbthNMbUz3YFzzZJq3G1gOvngkw62tkt83IQ.pdf', 'approve', 'COMBEN', NULL, 76),
(188, 'Februari 2024', 202, '100', NULL, 'wJMOKK0dP70KJOijlDgxcfavqnTRyREqEzcvBrwQ.pdf', 'approve', 'COMBEN', NULL, 76),
(189, 'Februari 2024', 203, '100', NULL, 'oi27Hv9Ti8dZCLXBRYxdHDcPBzjn80U0Q1RbmVqt.pdf', 'approve', 'COMBEN', NULL, 76),
(190, 'Februari 2024', 204, '100', NULL, '0MfyUvwQ8vWxFuc8kthof5lPcv59tA9bVp6WlEct.pdf', 'approve', 'COMBEN', NULL, 76),
(191, 'Februari 2024', 205, '100', NULL, 'a9moG8YrcK6yLPpomqAS7iOTbsQpJamoTyQJetEJ.pdf', 'approve', 'COMBEN', NULL, 76),
(192, 'Februari 2024', 206, '100', NULL, '426889u21l64QSM61U2UJrepf03OmIfTUtMhgaiq.pdf', 'approve', 'COMBEN', NULL, 76),
(193, 'Februari 2024', 207, '100', NULL, 'W2QMqPzO7PZkgU1KrXH2Cpwk3kc2X7qaSPloqwZb.pdf', 'approve', 'COMBEN', NULL, 76),
(194, 'Februari 2024', 208, '100', NULL, 'Y94eye7cdekn3EPegXyUAICJgahvBS7eTXUxlTMY.pdf', 'approve', 'COMBEN', NULL, 76),
(195, 'Februari 2024', 209, '100', NULL, 'lydPPBoOAr0RdNStjdoH1o3Tc4uvAZ4v0RlWzaAQ.pdf', 'approve', 'COMBEN', NULL, 76),
(196, 'Maret 2024', 209, '100', NULL, 'r2jNSG82W4mCIYYfm0c8sFhZy2VDNHhYnu9jgfed.pdf', 'approve', 'COMBEN', NULL, 71),
(197, 'Maret 2024', 208, '0', NULL, 'QVcmYchwCooWsP22hYas1p5etamGjHFfMN2Wr3Xq.pdf', 'approve', 'COMBEN', NULL, 71),
(198, 'Maret 2024', 207, '0', NULL, 'hlofFqEyCaCyNxkR9Hvoc0xiPF6ghNQa0oz9atGX.pdf', 'approve', 'COMBEN', NULL, 71),
(199, 'Maret 2024', 206, '0', NULL, 'gqnYBTD5aiaDnRtqEFbPS9jf6KVYmEwopKsoaqoW.pdf', 'approve', 'COMBEN', NULL, 71),
(200, 'Maret 2024', 205, '100', NULL, '42ZTqKDRqHBIz6F2BCWReXuI9tPXgLS8g9FZ4LIy.pdf', 'approve', 'COMBEN', NULL, 71),
(201, 'Maret 2024', 204, '100', NULL, '7d5IWQgYlCoioCd920lV7Q9JGkcoHg1ss7Ivkxg4.pdf', 'approve', 'COMBEN', NULL, 71),
(202, 'Maret 2024', 203, '100', NULL, '8X3qiOVwdvXzeeEobt4kMVzkHj7Wz6rbqRZN36VO.pdf', 'approve', 'COMBEN', NULL, 71),
(203, 'Maret 2024', 202, '100', NULL, '7Jqf2CXGXR09ftj6F1eRQpX3M8GWxyFnJTjqCOMz.pdf', 'approve', 'COMBEN', NULL, 71),
(204, 'Maret 2024', 201, '100', NULL, 'RlzXhSSol1Om6BR2y91KLFG2M8AeoYD1yo4xEp5A.pdf', 'approve', 'COMBEN', NULL, 71),
(205, 'Maret 2024', 200, '100', NULL, 'MsWSvHiVkhl5WB29FKqf8M7k7d1ocr1vpn7lcTZe.pdf', 'approve', 'COMBEN', NULL, 71),
(206, 'Maret 2024', 200, '97,49', NULL, 'pENFBPeKiuXC8kKCirekbnz7NYlUiQINFEHlDdlS.pdf', 'approve', 'COMBEN', NULL, 70),
(207, 'Maret 2024', 201, '100', NULL, 'ukQMq0pQmSUfjrAW7Ord1s5g6YTibOIz1hmrlqtR.pdf', 'approve', 'COMBEN', NULL, 70),
(208, 'Maret 2024', 202, '100', NULL, '8hmGaC3cfgGpVuAgkg1j3zM9ljWcasHUXFFhQRCP.pdf', 'approve', 'COMBEN', NULL, 70),
(209, 'Maret 2024', 204, '100', NULL, 'WBMWSXMlZgMy1ogF7EpYV0mpHvSHWzzRpSid3kU3.pdf', 'approve', 'COMBEN', NULL, 70),
(210, 'Maret 2024', 205, '100', NULL, 'opTOOfihdUEbk7C7F3Z5LUAhzEfuQMRg1WWiQ7Rp.pdf', 'approve', 'COMBEN', NULL, 70),
(211, 'Maret 2024', 206, '0', NULL, 'yEFjvn8d0jczky14ItDSsELzNmpqXOEXbfLe6Mjz.pdf', 'approve', 'COMBEN', NULL, 70),
(212, 'Maret 2024', 207, '0', NULL, 'GhK1aGxMK6gK1y5oo0OvvpgJRweG4dvBqZOwn4oM.pdf', 'approve', 'COMBEN', NULL, 70),
(214, 'Maret 2024', 209, '100', NULL, '6bLS9txrOmmYogXzeoWGy3J9EBYejy4YB5HXQTd9.pdf', 'approve', 'COMBEN', NULL, 70),
(215, 'Maret 2024', 208, '0', NULL, 'BICEU6oOtYwzc0dwoeGICIG55f9uTBpFMPDofWS6.pdf', 'approve', 'COMBEN', NULL, 70),
(216, 'Maret 2024', 210, '100', NULL, 'ZgrCJpxk6fQc4aew4n2vt1eTImp2X5Nmfipwa4Fu.pdf', 'wait', 'REKRUT', NULL, 74),
(217, 'Maret 2024', 211, '100', NULL, 'GYL8cgmdedywGN3xZsStF6WDvsv1mCj3ESWup4NO.pdf', 'wait', 'REKRUT', NULL, 74),
(218, 'Maret 2024', 212, '100', NULL, 'ZgUCKQayaZB9SGM4Pkqgc6fSRu9a93MhzsRlFszG.pdf', 'wait', 'REKRUT', NULL, 74),
(219, 'Maret 2024', 213, '100', NULL, '3XCAf3aSp17SyZZomGQFJ5hOUHbM27j8gPmR7s7L.pdf', 'approve', 'REKRUT', NULL, 74),
(220, 'Maret 2024', 214, '100', NULL, '2lgTVQuGRmtIy0iR7b41goyGlmrsPvl0iMVi346Z.pdf', 'approve', 'REKRUT', NULL, 74),
(221, 'Maret 2024', 215, '100', NULL, 'BWF8g0T1u1sI5U9Ulg2Pz84uBKr4jlWaCNml47JN.pdf', 'approve', 'REKRUT', NULL, 74),
(222, 'Maret 2024', 216, '0', NULL, 'QRHSJ2ezxA25O4WvohxJvUBNwFgH0sX5MZMJjGXG.pdf', 'approve', 'REKRUT', NULL, 74),
(223, 'Maret 2024', 217, '0', NULL, 'c4NJcmbYlNkVt4uWBPNJHfoiIwuL4Rxm1I9rrNkq.pdf', 'approve', 'REKRUT', NULL, 74),
(224, 'Maret 2024', 218, '0', NULL, 'o3qAFju99Xo0vgWjTxN4dfpbNKQAWgVj4PS5mKf9.pdf', 'approve', 'REKRUT', NULL, 74),
(225, 'Maret 2024', 219, '100', NULL, 'S0lRqw9e8AMRE8IHLT6wfzb6NJqdewrgCvnXUU6H.pdf', 'approve', 'REKRUT', NULL, 74),
(226, 'Maret 2024', 229, '100%', NULL, 'G5O0SqERny6tmaGZpvC1vd92JDHNpnmCEBUl4CtU.png', 'wait', 'IR', NULL, 75),
(227, 'Maret 2024', 228, '0', NULL, 'fNavJpnfn09pFf3gjV7Y3MzTJXYPsjA43vSwyunI.png', 'wait', 'IR', NULL, 75),
(228, 'Maret 2024', 227, '0', NULL, 'JzmTuU1R5uN3jpKKYQsqtJTIeERRv7r4wNzeNF2H.jpg', 'wait', 'IR', NULL, 75),
(229, 'Maret 2024', 226, '0', NULL, 'mXdF9vD0stVpo3va9EE3OmD0bpT2eNQNcJji4sVV.pdf', 'wait', 'IR', NULL, 75),
(230, 'Maret 2024', 225, '100%', NULL, 'PyW99y3ZoTSNAiuCD3DnugsLCIN9a7rwqgHV5vtl.pdf', 'wait', 'IR', NULL, 75),
(231, 'Maret 2024', 224, '100%', NULL, '1rzjbxcqCR7huBU7EwfWZeJDn6RWjHefeDerQxQq.pdf', 'wait', 'IR', NULL, 75),
(232, 'Maret 2024', 223, '100%', NULL, 'URaqWtYtpcolbCoJKOAXI0gVHojrtttUwtnUpUoA.pdf', 'wait', 'IR', NULL, 75),
(233, 'Maret 2024', 222, '100%', NULL, 'fYm1G8eyTezfsprD9vAztR90ZbURDDMnJeOEMxoe.pdf', 'wait', 'IR', NULL, 75),
(234, 'Maret 2024', 221, '100%', NULL, 'ClnNwZ6HNFrcirIYfDMNewoDTXX8fCCk3qQmHL1W.pdf', 'wait', 'IR', NULL, 75),
(235, 'Maret 2024', 220, '100%', NULL, 'u37Gr2I8wdEkbUe0PHR1jb3PHnaRYZrv4ti5SM7h.pdf', 'wait', 'IR', NULL, 75),
(236, 'Maret 2024', 239, '100', NULL, 'vS3vSlRFfQlk8DcAkFuwBK7b5WTgRDRcEoss7a1S.pdf', 'approve', 'TND', NULL, 78),
(237, 'Maret 2024', 238, '0', NULL, 'cKFF8GjqZdvSVdhcEcmwaJfDMci361dLmBMHDG0s.pdf', 'approve', 'TND', NULL, 78),
(238, 'Maret 2024', 237, '0', NULL, 'AzPNErsDguUDm9D7JL8ewGGQCDhoThR6wDBUgozW.pdf', 'approve', 'TND', NULL, 78),
(239, 'Maret 2024', 236, '0', NULL, 'oM51wZfj4RA6DYQouedlQ9rVf2T9HMKKtqw6BuBV.pdf', 'approve', 'TND', NULL, 78),
(240, 'Maret 2024', 235, '100', NULL, 'z5wvxPzNkZcrBkKVFBULJf7s6q51uOjWxsLYGELk.pdf', 'approve', 'TND', NULL, 78),
(241, 'Maret 2024', 234, '100', NULL, 'WbBKUBYYv2NEzhMnHp8n0cJ3tXlmkSfXakzWzujX.pdf', 'approve', 'TND', NULL, 78),
(242, 'Maret 2024', 233, '100', NULL, 'LcTQXyEtxY1w0uV00yxFSBlWDCtJAn6KQBM6XF96.pdf', 'approve', 'TND', NULL, 78),
(243, 'Maret 2024', 232, '100', NULL, 'vLdTfmBdUagyFnobKBzvQ8TbYvpsGlTRH1gtPPQR.pdf', 'approve', 'TND', NULL, 78),
(244, 'Maret 2024', 231, '100', NULL, 'vaa3n1TjKXTmRt7eB97L5yc76ctweHBjmQqE0k9a.pdf', 'approve', 'TND', NULL, 78),
(246, 'Maret 2024', 230, '100', NULL, '2E1cXOdiWRM3AwMU5VM71mDQJcy0voG3hc1aJm8U.pdf', 'approve', 'TND', NULL, 78),
(247, 'Maret 2024', 200, '100', NULL, 'n30UtTIv9Sor7CfDkaBpSv6MnX0Zf8tCeqRzcRng.pdf', 'approve', 'COMBEN', NULL, 72),
(248, 'Maret 2024', 201, '100', NULL, 'SJiCLrtlDe90Vs8dT2b2bZ2qd36fcCQAcJ8OD46w.pdf', 'approve', 'COMBEN', NULL, 72),
(249, 'Maret 2024', 202, '100', NULL, 'FthUnIVcpi50nfyQ5ZrPP66kAH0Ud06eht612gY1.pdf', 'approve', 'COMBEN', NULL, 72),
(251, 'Maret 2024', 204, '100', NULL, 'b3O3E84LI90t3tE19oT1XHeHpOljwouSfC7GLUvS.pdf', 'approve', 'COMBEN', NULL, 72),
(252, 'Maret 2024', 205, '100', NULL, '2bW43mQh6GXXE8A2qYYDT10ISyuUAlu5uVIQjTjB.pdf', 'approve', 'COMBEN', NULL, 72),
(254, 'Maret 2024', 207, '100', NULL, '1R2L9ceMaOt3HbAMpvpLU6h2yIH3CIckw2i22dWX.pdf', 'approve', 'COMBEN', NULL, 72),
(255, 'Maret 2024', 208, '75', NULL, 'bINbtIu1ZqAQXxuIoMjpHkona94dNOHiOolEpxUw.pdf', 'approve', 'COMBEN', NULL, 72),
(256, 'Maret 2024', 209, '100', NULL, 'JXW6fcXX48kUi2ZwDETylvRZznsflECvNlNL1CPt.pdf', 'approve', 'COMBEN', NULL, 72),
(258, 'Maret 2024', 201, '100', NULL, '9LMghKG7iEALLYfOEb306cw29iz6O7sUqc0ITNve.pdf', 'approve', 'COMBEN', NULL, 77),
(259, 'Maret 2024', 202, '100', NULL, 'Re3R0MdbhMZ1l9x72NiB1nZfvmJYX5jZbokxONJq.pdf', 'approve', 'COMBEN', NULL, 77),
(261, 'Maret 2024', 204, '100', NULL, 'MCpFFROmNqKyonpmS1fKg1p6X2PRLD3TM4zcJV1o.pdf', 'approve', 'COMBEN', NULL, 77),
(262, 'Maret 2024', 205, '100', NULL, 'tdJ32AydO3d8bZXsapapwHHu4V4Kkwp9a7FrzpdG.pdf', 'approve', 'COMBEN', NULL, 77),
(263, 'Maret 2024', 206, '100', NULL, 'QBphpDZOFJ09Y75CAQOC2hQ3ixWzYUs0QIZXU1by.pdf', 'approve', 'COMBEN', NULL, 77),
(264, 'Maret 2024', 207, '100', NULL, 'm8C9hWyuufjqv8gIjfAIXqtirhnppCdasd037Zyc.pdf', 'approve', 'COMBEN', NULL, 77),
(266, 'Maret 2024', 206, '100', NULL, 'oEhPN0YyYKZb5zwVurQI5RvrqjKMxIxGxrZ4nfSB.pdf', 'approve', 'COMBEN', NULL, 72),
(267, 'Maret 2024', 203, '100', NULL, 'xwYUYCYBPU90VxdjDjpHa8pzCYuvmuv0EkmC1MGv.pdf', 'approve', 'COMBEN', NULL, 72),
(270, 'Maret 2024', 200, '100', NULL, 'PfmWdUwNWjkjY39waQOolFgcIBi0K8RVb6ZBxOXn.pdf', 'approve', 'COMBEN', NULL, 76),
(271, 'Maret 2024', 201, '100', NULL, 'LrsXuaHqVdsYExMApgiCr2cXJDj1IdaOOoVEhHzN.pdf', 'approve', 'COMBEN', NULL, 76),
(272, 'Maret 2024', 202, '100', NULL, 'kTwr1Aqg0m4zMlJBEnhpUnDBhMVCIIuDLzARsH2y.pdf', 'approve', 'COMBEN', NULL, 76),
(273, 'Maret 2024', 203, '100', NULL, 'ffyYekjTMVLaXFycMvhLe33Whv5PoURnsb8Q0R3j.pdf', 'approve', 'COMBEN', NULL, 76),
(274, 'Maret 2024', 204, '100', NULL, '8KXtRNQlv34Uhpce0PXnQ5QInROJzv1CWdmnjnMy.pdf', 'approve', 'COMBEN', NULL, 76),
(275, 'Maret 2024', 205, '100', NULL, 'n57UlPzjgdZRc8UkXjPgDbxSdGuHQMU8fB8Q8zQy.pdf', 'approve', 'COMBEN', NULL, 76),
(276, 'Maret 2024', 206, '100', NULL, 'UCkIxo8rZC9sDMuHWNwX1EblMpplPk64bEmvIXwC.pdf', 'approve', 'COMBEN', NULL, 76),
(277, 'Maret 2024', 207, '100', NULL, 'Q9txJONSjliuHkQf5CWoRkpdL7rDJScfsJiGDvv6.pdf', 'approve', 'COMBEN', NULL, 76),
(279, 'Maret 2024', 209, '100', NULL, '2kToIqiDm58gJn7rRjJUOifHdw6jHWe9d7NXpjF5.pdf', 'approve', 'COMBEN', NULL, 76),
(291, 'Maret 2024', 208, '100', NULL, 'BAJcC3WN0HyWFEmDo9tEwGDHDt9d9ziYQ2opU3X1.pdf', 'approve', 'COMBEN', NULL, 76),
(295, 'Maret 2024', 200, '100', NULL, 'pyRFSzumWMuSFDYHjBi8mDgTLrIWReve1WhFoZtn.pdf', 'wait', 'COMBEN', NULL, 77),
(296, 'Maret 2024', 201, '100', NULL, 'eOQ8XWEmEgL1k01gq3F1PCWZAkpLg0jCdUgpfyp7.pdf', 'wait', 'COMBEN', NULL, 77),
(297, 'Maret 2024', 202, '100', NULL, 'MtyPqoOWMuRif6jkTkWQTf0StqcMJbOBGIZjIMIZ.pdf', 'wait', 'COMBEN', NULL, 77),
(298, 'Maret 2024', 203, '100', NULL, '0kR10YE2SzqZtF7kvox55E5XC8YpOoH3yGPNwBXw.pdf', 'wait', 'COMBEN', NULL, 77),
(299, 'Maret 2024', 204, '100', NULL, '1x5rZ3FvxIZ2jtl2sk5xmbTijYK68QwlbDkTodN7.pdf', 'wait', 'COMBEN', NULL, 77),
(300, 'Maret 2024', 205, '100', NULL, '2b7hr43J5GAiRlEu5HWF9Hn2SfhOWWqJoKGYFEeo.pdf', 'wait', 'COMBEN', NULL, 77),
(301, 'Maret 2024', 206, '0', NULL, 'OOmtTGM3F0kONkLp3HA8BL55hElR9MxNRaCUPaHj.pdf', 'wait', 'COMBEN', NULL, 77),
(303, 'Maret 2024', 207, '100', NULL, 'mwehPUwoCuTR01MZpETFqmtsoD2PEraopHpONpBy.pdf', 'wait', 'COMBEN', NULL, 77),
(304, 'Maret 2024', 208, '100', NULL, 'ORxZteKEqAzEObFD1ZnWKcgX4zU0G9jI2RMmNdXB.pdf', 'wait', 'COMBEN', NULL, 77),
(305, 'Maret 2024', 209, '100', NULL, 'yftifqqpP4bQmOTwk7wycjcBLFxgHSlPi1ma0mFd.pdf', 'wait', 'COMBEN', NULL, 77);

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_kpi_generals`
--

CREATE TABLE `admin_kpi_generals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total` double NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `status` enum('wait','reject','approve') NOT NULL DEFAULT 'wait',
  `periode` varchar(50) NOT NULL,
  `subdivisi` enum('COMBEN','REKRUT','TND','IR') NOT NULL,
  `alasan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `id_user_approve` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin_kpi_generals`
--

INSERT INTO `admin_kpi_generals` (`id`, `total`, `id_user`, `status`, `periode`, `subdivisi`, `alasan`, `created_at`, `updated_at`, `file`, `id_user_approve`) VALUES
(62, 105, 56, 'approve', 'Januari 2024', 'TND', NULL, '2024-03-01 07:58:04', '2024-03-01 08:00:36', NULL, 55),
(64, 105, 71, 'approve', 'Februari 2024', 'COMBEN', NULL, '2024-03-06 18:23:19', '2024-03-06 19:01:45', NULL, 66),
(67, 105, 71, 'approve', 'Januari 2024', 'COMBEN', NULL, '2024-03-06 19:09:44', '2024-03-06 19:16:39', NULL, 66),
(68, 102.5, 72, 'wait', 'Februari 2024', 'COMBEN', NULL, '2024-03-07 01:59:31', '2024-03-07 01:59:31', NULL, 66),
(71, 100, 76, 'approve', 'Januari 2024', 'COMBEN', NULL, '2024-03-13 00:13:52', '2024-04-01 20:45:59', NULL, 66),
(72, 100, 76, 'approve', 'Februari 2024', 'COMBEN', NULL, '2024-03-13 00:37:57', '2024-04-01 20:45:54', NULL, 66),
(74, 100, 71, 'approve', 'Maret 2024', 'COMBEN', NULL, '2024-03-29 19:07:55', '2024-04-01 20:46:05', NULL, 66),
(75, 100, 78, 'approve', 'Maret 2024', 'TND', NULL, '2024-04-04 17:18:52', '2024-04-06 00:43:07', NULL, 55),
(78, 100, 76, 'wait', 'Maret 2024', 'COMBEN', NULL, '2024-04-05 01:37:39', '2024-04-05 01:37:39', NULL, 66);

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_kpi_general_items`
--

CREATE TABLE `admin_kpi_general_items` (
  `id` int(11) NOT NULL,
  `id_key_performance_indicator` int(11) NOT NULL,
  `realisasi` text NOT NULL,
  `skor` double NOT NULL,
  `skor_akhir` double NOT NULL,
  `id_kpi_general` bigint(20) UNSIGNED NOT NULL,
  `no_urut` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin_kpi_general_items`
--

INSERT INTO `admin_kpi_general_items` (`id`, `id_key_performance_indicator`, `realisasi`, `skor`, `skor_akhir`, `id_kpi_general`, `no_urut`) VALUES
(342, 38, '-', 100, 15, 62, 1),
(343, 39, '-', 100, 10, 62, 1),
(344, 40, '-', 100, 10, 62, 1),
(345, 41, '-', 100, 10, 62, 1),
(346, 42, '-', 100, 10, 62, 1),
(347, 43, '-', 100, 10, 62, 2),
(348, 44, '-', 100, 10, 62, 2),
(349, 45, '-', 100, 10, 62, 3),
(350, 46, '-', 100, 10, 62, 4),
(351, 47, '-', 100, 5, 62, 5),
(352, 57, '-', 100, 5, 62, 6),
(356, 38, '100', 100, 15, 64, 1),
(357, 39, '100', 100, 10, 64, 1),
(358, 40, '100', 100, 10, 64, 1),
(359, 41, '100', 100, 10, 64, 1),
(360, 42, '100', 100, 10, 64, 1),
(361, 43, '100', 100, 10, 64, 2),
(362, 44, '100', 100, 10, 64, 2),
(363, 45, '100', 100, 10, 64, 3),
(364, 46, '100', 100, 10, 64, 4),
(365, 47, '100%', 100, 5, 64, 5),
(366, 57, '1', 100, 5, 64, 6),
(369, 38, '100', 100, 15, 67, 1),
(370, 39, '100', 100, 10, 67, 1),
(371, 40, '100', 100, 10, 67, 1),
(372, 41, '100', 100, 10, 67, 1),
(373, 42, '100', 100, 10, 67, 1),
(374, 43, '100', 100, 10, 67, 2),
(375, 44, '100', 100, 10, 67, 2),
(376, 45, '100', 100, 10, 67, 3),
(377, 46, '100', 100, 10, 67, 4),
(378, 47, '100', 100, 5, 67, 5),
(379, 57, '1', 100, 5, 67, 6),
(380, 38, '100', 100, 15, 68, 1),
(381, 39, '100', 100, 10, 68, 1),
(382, 40, '100', 100, 10, 68, 1),
(383, 41, '100', 100, 10, 68, 1),
(384, 42, '100', 100, 10, 68, 1),
(385, 43, '100', 100, 10, 68, 2),
(386, 44, '100', 100, 10, 68, 2),
(387, 45, '100', 100, 10, 68, 3),
(388, 46, '75', 75, 7.5, 68, 4),
(389, 47, '100', 100, 5, 68, 5),
(390, 57, '100', 100, 5, 68, 6),
(401, 38, '100', 100, 15, 71, 1),
(402, 39, '100', 100, 10, 71, 1),
(403, 40, '100', 100, 10, 71, 1),
(404, 41, '100', 100, 10, 71, 1),
(405, 42, '100', 100, 10, 71, 1),
(406, 43, '100', 100, 10, 71, 2),
(407, 44, '100', 100, 10, 71, 2),
(408, 45, '100', 100, 5, 71, 3),
(409, 46, '100', 100, 10, 71, 4),
(410, 47, '100', 100, 5, 71, 5),
(411, 57, '100', 100, 5, 71, 6),
(412, 38, '100', 100, 15, 72, 1),
(413, 39, '100', 100, 10, 72, 1),
(414, 40, '100', 100, 10, 72, 1),
(415, 41, '100', 100, 10, 72, 1),
(416, 42, '100', 100, 10, 72, 1),
(417, 43, '100', 100, 10, 72, 2),
(418, 44, '100', 100, 10, 72, 2),
(419, 45, '100', 100, 5, 72, 3),
(420, 46, '100', 100, 10, 72, 4),
(421, 47, '100', 100, 5, 72, 5),
(422, 57, '100', 100, 5, 72, 6),
(434, 38, '100', 100, 15, 74, 1),
(435, 39, '100', 100, 10, 74, 1),
(436, 40, '100', 100, 10, 74, 1),
(437, 41, '100', 100, 10, 74, 1),
(438, 42, '100', 100, 10, 74, 1),
(439, 43, '100', 100, 10, 74, 2),
(440, 44, '0', 100, 10, 74, 2),
(441, 45, '0', 100, 5, 74, 3),
(442, 46, '0', 100, 10, 74, 4),
(443, 47, '100', 100, 5, 74, 5),
(444, 57, '1', 100, 5, 74, 6),
(445, 38, '100', 100, 15, 75, 1),
(446, 39, '100', 100, 10, 75, 1),
(447, 40, '100', 100, 10, 75, 1),
(448, 41, '100', 100, 10, 75, 1),
(449, 42, '100', 100, 10, 75, 1),
(450, 43, '100', 100, 10, 75, 2),
(451, 44, '0', 100, 10, 75, 2),
(452, 45, '0', 100, 5, 75, 3),
(453, 46, '0', 100, 10, 75, 4),
(454, 47, '100', 100, 5, 75, 5),
(455, 57, '2', 100, 5, 75, 6),
(461, 38, '100', 100, 15, 78, 1),
(462, 39, '100', 100, 10, 78, 1),
(463, 40, '100', 100, 10, 78, 1),
(464, 41, '100', 100, 10, 78, 1),
(465, 42, '100', 100, 10, 78, 1),
(466, 43, '100', 100, 10, 78, 2),
(467, 44, '100', 100, 10, 78, 2),
(468, 45, '100', 100, 5, 78, 3),
(469, 46, '100', 100, 10, 78, 4),
(470, 47, '100', 100, 5, 78, 5),
(471, 57, '100', 100, 5, 78, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gl_kpis`
--

CREATE TABLE `gl_kpis` (
  `id` int(11) NOT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `id_kamus` int(11) NOT NULL,
  `realisasi` varchar(100) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` enum('approve','reject','wait') NOT NULL DEFAULT 'wait',
  `subdivisi` enum('COMBEN','REKRUT','TND','IR') NOT NULL,
  `alasan` text DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `pencapaian_sf` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gl_kpis`
--

INSERT INTO `gl_kpis` (`id`, `id_periode`, `id_kamus`, `realisasi`, `file`, `status`, `subdivisi`, `alasan`, `id_user`, `pencapaian_sf`) VALUES
(44, 2, 160, '101', 'vOxclWIWETwwAJO2YoU0nmzWrO7VSEKNPin8b2lJ.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(45, 2, 161, '101', 'WmmwZcRQxH2UMewvA0GktYT2rENFHJtp22boSt7L.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(46, 2, 243, '101', 'xz2t9aiuDWIIyrobPbuXcDIlLAidFxStXfCQMeYK.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(47, 2, 199, '101', 'O0zsg0Xka2dZHZ5RTSX03yznly3YLdTkrfkq94zL.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(49, 2, 164, '101', '0RYI7peUGWRtrsN04aKOjJRk3E7vXS908f1swBDs.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(50, 2, 163, '101', 'S7UaLMae0XDsY5d9fy0zeJsL6XotbuXmWhmeHnYm.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(51, 2, 195, '79', '2oOsLkQ6gAZpc8NmWcrXNEm9Y4UsrkaXdJy0JXhR.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(53, 2, 165, '111', 'I4gAH5ubPiG4FkeWtyZr8gQt7xdOplTWlUXRDliF.pdf', 'approve', 'IR', NULL, 63, 100),
(54, 2, 174, '100', '7d3M9A2UPEGilgOkIdxgI64SoYOEvfTRVAhRYAgh.pdf', 'approve', 'IR', NULL, 63, 100),
(55, 2, 167, '111', '6EyNYS0AKeITT4ZcgOGHMcLCnsteznTDfzj2kdCl.pdf', 'approve', 'IR', NULL, 63, 100),
(56, 2, 173, '111', 'htFVqamvkiSTRNv7pVV0T0NnNvxPUpqNeSAID28O.pdf', 'approve', 'IR', NULL, 63, 100),
(57, 2, 177, '111', '02iTymb41eT18AP86tGI8xpbbxWHiXGpUqYiwAfR.pdf', 'approve', 'IR', NULL, 63, 100),
(58, 2, 176, '111', 'LWoPqfJRgESTavwyGNbnpSLKjuPP5m8BNFpoTWyJ.pdf', 'approve', 'IR', NULL, 63, 100),
(60, 2, 185, '111', 'FXdPgc2NuwWbinGVkUd361zTQ4B1kuKD2l3iQzbl.pdf', 'approve', 'TND', NULL, 55, 100),
(61, 2, 184, '111', 'vNXOjjUwrXPox3TI6lwjeVXZkWqV9FOUqzgiE0DL.pdf', 'approve', 'TND', NULL, 55, 100),
(62, 2, 192, '111', 'hCcE3AQF9qTPI8QyX6L2KAP7Xdj6xZtyFCbcGrbx.pdf', 'approve', 'TND', NULL, 60, 100),
(63, 2, 168, '115', 'd8EbbFpavPtYLtizc9eYmRTtIwqpU4pHZKvruy9t.pdf', 'approve', 'IR', NULL, 64, 100),
(64, 2, 169, '115', '9CK6wDEcz529AfNtWyRhAcybS6P29XPAd4rvUIDc.pdf', 'approve', 'IR', NULL, 64, 100),
(65, 2, 170, '80', 'MMvz7P058JtOoQUcwEWtmp8q6lAaK1ARGw1wmhBT.pdf', 'approve', 'IR', NULL, 64, 100),
(66, 2, 173, '115', '2x8aSqJaDK0HDeeKLJcrmKtlYqXiemjJkZTKjjdE.pdf', 'approve', 'IR', NULL, 64, 100),
(67, 2, 177, '115', 'e4yCubV64OuSmWHepJGyGAIW92zNDOZupeuifWUo.pdf', 'approve', 'IR', NULL, 64, 100),
(68, 2, 176, '115', '74CE7Nvme7qsu3kw9lu5ahlXvzIfqxPxJwXmaIXC.pdf', 'approve', 'IR', NULL, 64, 100),
(69, 2, 197, '115', 'okr9L5DGl2c2oP54ArJljLygGAinBaHPuzqka06h.pdf', 'approve', 'IR', NULL, 64, 100),
(70, 1, 168, '115', 'WrZMMuCwNWNOl8Zls2JgfiFY3p3PmwWPeUijEnCr.pdf', 'approve', 'IR', NULL, 64, 100),
(71, 1, 169, '115', 'vUVG9MkcYMyFlcN1IEGgNdREm2xXc7UY3pXgGDe1.pdf', 'approve', 'IR', NULL, 64, 100),
(72, 1, 170, '80', 'JKtzz2TtYiGQJncMFPkYTSXhmphfWUwIGgOzaPmy.pdf', 'approve', 'IR', NULL, 64, 100),
(73, 1, 173, '115', 'hNtASIVnqzj5ateibyhLsiXSYhGGdm12z9FB9NZL.pdf', 'approve', 'IR', NULL, 64, 100),
(74, 1, 177, '115', 'BmYZnMq03shAA9bGdAhe3UIK0gd8EhmaBJmeVvTl.pdf', 'approve', 'IR', NULL, 64, 100),
(75, 1, 176, '115', NULL, 'reject', 'IR', 'mana attachmennya', 64, 100),
(76, 1, 176, '115', 'yur0ISogtX5AA20Mbu9LM7YBP44vqGK1ri0KmOF8.pdf', 'approve', 'IR', NULL, 64, 100),
(77, 1, 197, '115', '06kTtgQ07N4AaXkAfR4rrFFYoMJHSCfycBoYiNaN.pdf', 'approve', 'IR', NULL, 64, 100),
(78, 2, 185, '111', 'M58h2HwGUjz0d6DK1fbdYXFkTxmtlBsVYno5XUTr.pdf', 'approve', 'TND', NULL, 60, 100),
(79, 2, 197, '101', 'T2E1Jb0UTYAqIIfa0KG35fPbPMenTxE06r96DXx0.pdf', 'approve', 'IR', NULL, 63, 100),
(80, 2, 186, '111', '2eS7lXDy5gyxnYfUH8gZGwYvc7XUgsMnUcuCBGHB.pdf', 'approve', 'TND', NULL, 55, 100),
(81, 2, 187, '100', 'XNrpze6OwMxki6oKf2ZOmZEXpMr1Hp5goQu7TC2V.pdf', 'approve', 'TND', NULL, 55, 100),
(82, 2, 184, '111', 's9mBrz7D5w2HXOBHEr737edHkY02qHnOnivsXAt4.pdf', 'approve', 'TND', NULL, 60, 100),
(83, 2, 193, '79', 'ArnZG3VaDrRwXqbckXRRS9X68i4RyPlZ3KKmOzNm.jpg', 'approve', 'IR', NULL, 63, 100),
(84, 2, 187, '100', 'cpUaadRnYM4u9nDeqtz7X1aXp4flXARSI6Khnx9M.pdf', 'approve', 'TND', NULL, 60, 100),
(85, 2, 186, '111', 'agrz33D7UUlYsZA2qMLRv3u81aSuZb4LNKdA4YuY.pdf', 'approve', 'TND', NULL, 60, 100),
(86, 2, 185, '111', 'b1bJVGEkvuUDwxGbebYMczcIwJMqp1R7jI9T52t1.pdf', 'approve', 'TND', NULL, 59, 100),
(87, 2, 184, '111', 'EI4DKC5ZQZfLg9EUgKSoR6cNF8gS3oFsjo3WUmd1.pdf', 'approve', 'TND', NULL, 59, 100),
(88, 2, 186, '111', '27VBaUqyL7EV92o5BdWRAsIhm0XvXam2jinkqGFc.pdf', 'approve', 'TND', NULL, 59, 100),
(89, 2, 187, '100', 'Qgy7UN3rsoadk8dPIgw2gComL2ZFR3am9CvSbKzo.pdf', 'approve', 'TND', NULL, 59, 100),
(90, 2, 192, '100', '6Zn3g0B3PSloc7QntdsMBzkOtDMQ7NsqrWSrtF2Z.pdf', 'approve', 'TND', NULL, 59, 100),
(91, 2, 241, '111', '3CcvrPWYG0a73KBQM93iHEP4nhRbGzhNxNijQiJk.pdf', 'approve', 'TND', NULL, 60, 100),
(92, 2, 188, '111', 'QtF5fr5ttcZQLEXwR9ri2rWDI8rThy5xeXKT6HmV.pdf', 'approve', 'TND', NULL, 60, 100),
(93, 2, 188, '111', 'z64WFa5G9yqdXLEIuXnnRqGnC4sZM8OY3Bs81WTQ.pdf', 'approve', 'TND', NULL, 59, 100),
(94, 2, 241, '111', 'NavphxDG4rKv8DQVADcKonBj2WWdF3n9NS7dGahL.pdf', 'approve', 'TND', NULL, 59, 100),
(95, 2, 242, '79', 'WGXQPH8ZtrvvpCJmY50zlzHyM8G0PbC9xtNxvqmw.pdf', 'approve', 'TND', NULL, 60, 100),
(96, 2, 191, '100', 'HiiND5aSrBUfdlKER5Rg4xoFfNS1fVxirKIj4GU2.pdf', 'approve', 'TND', NULL, 59, 100),
(97, 2, 191, '111', 'hvEVI7AmOUeWaXwzOYY2oApRIr1sR9Do7JTeu067.pdf', 'approve', 'TND', NULL, 60, 100),
(98, 2, 189, '111', 'CclXx7bgHCddDZypxng70CYLw49ActrPSeFJ2MJ6.png', 'approve', 'TND', NULL, 59, 100),
(99, 2, 189, '111', '9RJxRlln7jTLoyGPcfvD1TR78VTPpWoBYxVTRx8Y.jpg', 'approve', 'TND', NULL, 60, 100),
(100, 2, 190, '111', 'wRQLz17bzPmBB3vCyrOWPB6uQl9Wrs2ar2XCq10T.png', 'approve', 'TND', NULL, 60, 100),
(101, 2, 196, '100', 'eveAsFbxyuckKbSFikA7mwK78fth14XlbqdHjqGR.pdf', 'approve', 'TND', NULL, 60, 100),
(102, 2, 190, '111', 'gLDVLziNpePu86WIUTgMX8q8Xo9KYo85TVeGfbAZ.jpg', 'approve', 'TND', NULL, 59, 100),
(103, 2, 196, '100', 'OmGKUFbpIJv9hXbK5GXb4uTPtG9gkUsfuXtLeLP0.pdf', 'approve', 'TND', NULL, 59, 100),
(104, 2, 242, '79', 'Nl3nDZJrOYtHSW4DK3uQFTsOx04QwrgT9ZsjcnfQ.pdf', 'approve', 'TND', NULL, 59, 100),
(105, 2, 188, '111', 'xgh7Ggul1b0NjcCrHL0USYuqkDpl8IJWtExVvwZQ.pdf', 'approve', 'TND', NULL, 55, 100),
(106, 2, 241, '111', 'gG4gtQdSezS8HlYqYGmAcdq9GMIGl7Z9lYVbf6I5.pdf', 'approve', 'TND', NULL, 55, 100),
(107, 2, 242, '79', 'Gu1m0N9gCrXMtBDd4DBnBMPqNxEHxFmdH0COzDgJ.pdf', 'approve', 'TND', NULL, 55, 100),
(109, 2, 196, '100', '6mcazqO5xhyNy7VmjgSkDvLTuPsmNxny5o9lKfBE.pdf', 'approve', 'TND', NULL, 55, 100),
(110, 2, 189, '111', '4c7cUbXycM2kK4uCwKgFgvPbJF6B8meTFdw8qcfa.png', 'approve', 'TND', NULL, 55, 100),
(111, 2, 191, '111', 'HFPGfOp2RRBgzKx0jbrQxt0FB4fTY6kgD3UbkHwC.pdf', 'approve', 'TND', NULL, 55, 100),
(112, 2, 192, '111', '8GuB4Y4QutmN30ZI2GQjMihToPFXIPGPOg2hdLr3.pdf', 'approve', 'TND', NULL, 55, 100),
(113, 1, 165, '111', '0Pm7ge7v4Z6vcFVYIGcwdYvbeOtuZfpctwveaYtz.pdf', 'approve', 'IR', NULL, 63, 100),
(115, 1, 160, '100', 'sHfKAgQRFxTbuhHvHEhum7i07nWM8grdHuUDXHlG.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(116, 1, 161, '100', 'fuYvzmzJ7lLzxAUu0ySnQ0T6QzJ56kuhCYHd8L9u.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(117, 1, 243, '100', 'svOvTrL2j0d5hSt8j5qE623aWAMsaC8JjUL4p8Cb.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(118, 1, 199, '1', 'vEWMf7717cmYCkryLlEj4SNd3bq6F5U6cqeptGXR.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(119, 1, 162, '0', 'QSyKUq6sCYYRYwv5FDzo6r42ZNaGhtnLiEMcEHLU.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(120, 1, 164, '100', 'uHJiMjZC4JrLSrchObPP4emVpqM3oJldxrMVdJ9r.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(121, 1, 163, '100', '2SMmjV9xW28R9GNiobs3SPhH1QnqntYZ1j8rMbXB.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(122, 1, 195, '0', 'Rm0ld9VDcmPUjHmJ5lby6d2oaPgkoqwdAPHWP0z0.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(123, 1, 171, '115', 'p2Iy5HbOrtpogG0ct6HMqiSmSb0sX9yk8joRt852.pdf', 'approve', 'IR', NULL, 65, 100),
(124, 1, 166, '115', 'yUfa391So3CCM5GtvT7Opq6xEKM3CNp8XNILut5y.pdf', 'approve', 'IR', NULL, 65, 100),
(125, 1, 174, '115', 'LUeUGtnu3Yjo9D8M0xMHURYg0eWBzPlq9Eekhppw.pdf', 'approve', 'IR', NULL, 65, 100),
(126, 1, 172, '115', 'iz59U5sg9fjRsrk8zorSvH2jvZ8A3zABGR6zv0RU.pdf', 'approve', 'IR', NULL, 65, 100),
(127, 1, 173, '115', 'WjeNWG4Cfh1Ijwupx8xIbb54kM9Rr0K1YTC2PsGo.pdf', 'approve', 'IR', NULL, 65, 100),
(128, 1, 177, '115', 'KdNYCS1CEsZrQlUrOeFcjEx3aC93SkpyP8MH5JEv.pdf', 'approve', 'IR', NULL, 65, 100),
(129, 1, 176, '115', '1dPXP19sNWF8jHmEezvuXYg0NyxZ1mea51tE5uar.pdf', 'approve', 'IR', NULL, 65, 100),
(130, 2, 171, '115', 'RtOHwXvQG6YbmsTsa05ysYnlISafnLTfpQcmkmfH.pdf', 'approve', 'IR', NULL, 65, 100),
(131, 2, 166, '115', 'seYgZ4ZFJY6BUJ6oZDRalLFmcfgIgYArPG4ZHj5P.pdf', 'approve', 'IR', NULL, 65, 100),
(132, 2, 174, '115', '15rB6rscbfZxRvwwTjc5UiEThd1jR0TtyOHq8n8U.pdf', 'approve', 'IR', NULL, 65, 100),
(133, 2, 172, '115', 'Ipzj4Gxm2uFB7g6HLCXByN1GHdcoc7otKXyLv5cj.pdf', 'approve', 'IR', NULL, 65, 100),
(134, 2, 173, '115', '2kvQQ6DJUIu7nJ4oyEwZm7XxwVEIWOZO9q8kjZND.pdf', 'approve', 'IR', NULL, 65, 100),
(137, 2, 177, '115', 'H6aa1w2aZeolqFy42HMEZYlcCNcRgsHXaPhNoIY8.pdf', 'approve', 'IR', NULL, 65, 100),
(138, 2, 197, '115', 'AxvgtpUqH8z7wjEdC8lfVpJf9LAae0XoRTiJkkiV.pdf', 'approve', 'IR', NULL, 65, 100),
(139, 1, 197, '115', 'jgf5eqasz2VbtEm0oxPUn2O1sbIKwJAqBPVOWUjn.pdf', 'approve', 'IR', NULL, 65, 100),
(140, 1, 175, '79', NULL, 'approve', 'IR', NULL, 65, 100),
(141, 2, 175, '79', NULL, 'approve', 'IR', NULL, 65, 100),
(142, 2, 193, '111', 'PEMlpB7RJLhMkowTZd5OeCTCtY8UZ5oWAEeWToLU.pdf', 'approve', 'IR', NULL, 65, 100),
(143, 1, 193, '0', NULL, 'approve', 'IR', NULL, 65, 100),
(144, 1, 174, '111', 'Sgw6tG50Na1OvJDSkGVi3qA6eQEbIgsCOAnaAepi.pdf', 'approve', 'IR', NULL, 63, 100),
(145, 1, 167, '111', 'Vb0e1S0bazIgeKqyR9o8UcXLXM0CKrOysfq9eaEg.pdf', 'approve', 'IR', NULL, 63, 100),
(146, 1, 173, '111', 'DCXU3x6VE07aDTyzUTRLtATlu8MkBTmFo7VyKmls.pdf', 'approve', 'IR', NULL, 63, 100),
(147, 1, 177, '111', 'kZKgjHRk2bnlDJTYk6f4uNIZnQl4ddORFYQwrXAN.pdf', 'approve', 'IR', NULL, 63, 100),
(148, 1, 176, '111', 'cKYAXYZ2G9pfjrk1x7YFJZtEgbhNnhjl430QwEvH.pdf', 'approve', 'IR', NULL, 63, 100),
(149, 1, 174, '101', 'vEegxMFTKAIiEITe48R6QmtPxs8JYPCr0VGacJ6n.pdf', 'approve', 'IR', NULL, 64, 100),
(150, 2, 174, '101', 'Vg4cl4ojohMjsIDWHuXXzHnGyKpBr7oo7tiOqSRh.pdf', 'approve', 'IR', NULL, 64, 100),
(151, 2, 175, '79', NULL, 'approve', 'IR', NULL, 64, 100),
(152, 1, 175, '79', NULL, 'approve', 'IR', NULL, 64, 100),
(153, 1, 193, '79', NULL, 'approve', 'IR', NULL, 64, 100),
(154, 2, 193, '115', 'La6RMwkwS5MT845RGkU8KmaUjiL8cxYXtV1eU0Nr.pdf', 'approve', 'IR', NULL, 64, 100),
(155, 2, 178, '111', 'Igra0EkP201GYr5HHKXV8S9hIiqPugekp9LZzf1F.pdf', 'approve', 'REKRUT', NULL, 62, 100),
(156, 2, 179, '101', 'zMwfHwetRfB7DAdnhUEj0Ej67xdfREXpMcCMs3Ij.pdf', 'approve', 'REKRUT', NULL, 62, 100),
(157, 2, 180, '91', 'hLSSKcpzjqiHY8FOsltUAoSjXoOHckPzQerX7heD.pdf', 'approve', 'REKRUT', NULL, 62, 100),
(158, 2, 181, '111', 'Y3qf0iux21Dz5ko4nOH3K4CPKm7zCbcmNIY3ttFB.jpg', 'approve', 'REKRUT', NULL, 62, 100),
(159, 2, 182, '101', 'lzY4AtmA3ePRxziumepyoyM7OIW1YpcDlgmz6Zqo.jpg', 'approve', 'REKRUT', NULL, 62, 100),
(160, 2, 183, '99', 'jOx4oJnb9QzWwLAa6zaxHmoKJRLYwvDO8BWfsjxx.jpg', 'approve', 'REKRUT', NULL, 62, 100),
(161, 2, 198, '79', NULL, 'approve', 'REKRUT', NULL, 62, 100),
(162, 2, 194, '79', NULL, 'approve', 'REKRUT', NULL, 62, 100),
(168, 1, 178, '111', 'BZalN4WwN9kKwRWHM1b3RyiMVonnT4bbUz2ZoQIz.pdf', 'approve', 'REKRUT', NULL, 62, 100),
(169, 1, 179, '101', 'M3AQKitwk0tp104lTeCnuSuZRSDiAIhpQJx3wPPT.pdf', 'approve', 'REKRUT', NULL, 62, 100),
(170, 1, 180, '111', 'uWYlGlF7Tfu7Ziw0BvZmxUaZmVJDTrXTsPWv09zp.pdf', 'approve', 'REKRUT', NULL, 62, 100),
(171, 1, 198, '79', NULL, 'approve', 'REKRUT', NULL, 62, 100),
(172, 1, 181, '111', 'YIqXXhhTU2Nm2M80dAWyiQNgrubwEXTIASce1bTv.jpg', 'approve', 'REKRUT', NULL, 62, 100),
(173, 1, 183, '111', 'EnLeTXmcAjJVSz5Gs5xse9HREyzKmG7Pymr6CdIG.jpg', 'approve', 'REKRUT', NULL, 62, 100),
(174, 1, 182, '101', 'wPDx0TUA8ancQdd0YI1HPhNzfHgefUI7H6TwrVG4.jpg', 'approve', 'REKRUT', NULL, 62, 100),
(175, 1, 194, '111', 'JjgipJHldWQRIk0XiXTcrolDaYQfpZuoOlcUTLOI.pdf', 'approve', 'REKRUT', NULL, 62, 100),
(176, 2, 154, '8', 'lVrmak3AcSPLNJruV37n5roXPzvsaDVU2u3fkeHy.pdf', 'approve', 'COMBEN', NULL, 68, 100),
(177, 2, 155, '1, 4', 'PzF2NRIc08vpRKugqPUQ5NV5Oda8t6l41gBIjbQV.pdf', 'approve', 'COMBEN', NULL, 68, 100),
(178, 2, 156, '3', 'jQ7DdK3ucQMUincdHRKl1QwSiWThQpXxGPuWIFRW.pdf', 'approve', 'COMBEN', NULL, 68, 100),
(179, 2, 199, '1', 'TlPcBsGGq3hewjnEXtRVL1Jl81UJUAoxsvn7nHyr.pdf', 'approve', 'COMBEN', NULL, 68, 100),
(180, 2, 162, '0', 'I4j65zrvxqCPXhJEC9GWrLoYvyk4J48hrEtL3r71.pdf', 'approve', 'COMBEN', NULL, 68, 100),
(181, 2, 164, '100%', 'irIl2fOvgxmN4exOurE40Vy0K0ypEFXxpIxMvH5V.pdf', 'approve', 'COMBEN', NULL, 68, 100),
(182, 2, 163, '100%', 'MumVykf7E342HfUgqruVNeBzlxWA0qiLNlLlGZv5.pdf', 'approve', 'COMBEN', NULL, 68, 100),
(183, 2, 195, '1', 'keUlwIoylkKEkt73xJwSxqHL45VHGdZzg3VRlo4z.pdf', 'approve', 'COMBEN', NULL, 68, 100),
(184, 1, 199, '1', 'MGLknbnKHnBphW5oaYI5A4DuBPjEkpcIJaYWvXAC.pdf', 'approve', 'COMBEN', NULL, 68, 100),
(185, 1, 164, '100%', '7O44kCsPhMKaQzbvL13IqiBvAsBmRZ9bvobEpyap.pdf', 'approve', 'COMBEN', NULL, 68, 100),
(186, 1, 163, '100%', 'SA3r3lfQY7UGCgoBSgBRJND38GnFjlMUkE8zjPx2.pdf', 'approve', 'COMBEN', NULL, 68, 100),
(189, 1, 162, '0', 'EBAigcBHhxRgLJWhzERQpV6M8qPUkWYJnBKfXg9z.pdf', 'approve', 'COMBEN', NULL, 68, 100),
(190, 1, 154, '8', 'qdnWmLKBunfftvk1Xdu7E3hRECGCgvLIS3yNKx7c.pdf', 'approve', 'COMBEN', NULL, 68, 100),
(191, 1, 160, '173%', NULL, 'approve', 'COMBEN', NULL, 68, 100),
(192, 1, 156, '3', 'qDas7Ua7OYFUY2w9fwk3m8pNdt10kvEh2UyFVnTQ.pdf', 'approve', 'COMBEN', NULL, 68, 100),
(193, 1, 178, '111', 'tbY10LBKqMrN2O1Oqdn5wQH0bgwetwZTcLjNyqMF.pdf', 'approve', 'REKRUT', NULL, 61, 100),
(194, 1, 180, '79', 'Cx4BeH2fhI99QpH3vEeU4x3VIHNfuMYdI69RH4hn.pdf', 'approve', 'REKRUT', NULL, 61, 100),
(195, 1, 179, '101', 'DhsDa9VfzETJtq9k3pZZtvD5NVEvP120tkYzaxCo.pdf', 'approve', 'REKRUT', NULL, 61, 100),
(196, 1, 181, '111', 'lcS8W9cu9dwtf82J0YAwb1bFNmbjA5BIOjqhsqlB.jpg', 'approve', 'REKRUT', NULL, 61, 100),
(197, 1, 182, '100', 'jLlP5dGiRRDNGXzRM9bDVjtaiEgH0eyczwUfN23v.jpg', 'approve', 'REKRUT', NULL, 61, 100),
(198, 1, 183, '111', 'EXGIARBFXfBnyidsslswYcxQvp7IO3o0UURkr6ad.jpg', 'approve', 'REKRUT', NULL, 61, 100),
(199, 1, 194, '79', NULL, 'approve', 'REKRUT', NULL, 61, 100),
(200, 1, 198, '79', NULL, 'approve', 'REKRUT', NULL, 61, 100),
(201, 2, 178, '111', 'NUz7HNnRtPqSUeYDQQdPi3C361fs4DSaL6UGW0rf.pdf', 'approve', 'REKRUT', NULL, 61, 100),
(202, 2, 179, '101', 'sZuiniU1b4boCU6NFuBEZmt6YWwfCQY5MClwHqKW.pdf', 'approve', 'REKRUT', NULL, 61, 100),
(203, 2, 180, '79', 'bolwMwpVGgi8vGklW4kHKGhNIHZf8dwiz9bzZZ7u.pdf', 'approve', 'REKRUT', NULL, 61, 100),
(204, 2, 181, '111', 'L1HFtQhnmE4Xlhh7zsPq1T2z7aHY8bH9XxdThAyO.jpg', 'approve', 'REKRUT', NULL, 61, 100),
(205, 2, 182, '111', 'Ktk3TJl9klCahCxm5rvisygiiIeV8inFGVqAceJu.jpg', 'approve', 'REKRUT', NULL, 61, 100),
(206, 1, 194, '111', 'UVy0ztIobuGNHXh6jPETeEO8nwbaRQ3aDp0r1BwM.pdf', 'approve', 'REKRUT', NULL, 61, 100),
(207, 1, 198, '79', NULL, 'approve', 'REKRUT', NULL, 61, 100),
(208, 1, 183, '111', 'LfAgURE0GhxSoJ7s2n2Yu3KHpicyJ8u2p7gH65jX.jpg', 'approve', 'REKRUT', NULL, 61, 100),
(209, 1, 178, '101', 'yR0M1gv15jvpjmJJZW1KaAZiiDFJB5e8I9kl1ts0.pdf', 'approve', 'REKRUT', NULL, 58, 100),
(210, 1, 179, '101', 'qZ4keTRoOq1trmz0YVOzxgS5z8tIw4r46kbRTyXo.pdf', 'approve', 'REKRUT', NULL, 58, 100),
(211, 1, 180, '79', 'c9HygXK6AAY1DnsukyNAWSHwWE3IXIc1SgW0wdu7.pdf', 'approve', 'REKRUT', NULL, 58, 100),
(212, 1, 198, '79', NULL, 'approve', 'REKRUT', NULL, 58, 100),
(213, 1, 181, '111', 'cuRwQXyNMe7p9hI2XnUvWoBYnUZIzjoiYzHuKYMI.jpg', 'approve', 'REKRUT', NULL, 58, 100),
(214, 1, 183, '111', 'O2v9gW5pmH8eeNxICDhR3f4QHPnE38aeUlVW4oNk.jpg', 'approve', 'REKRUT', NULL, 58, 100),
(216, 1, 194, '79', NULL, 'approve', 'REKRUT', NULL, 58, 100),
(217, 2, 178, '111', '5vqskLyAeHrlytxbbUefqj2tMrdP1rkDbESgA2CF.pdf', 'approve', 'REKRUT', NULL, 58, 100),
(218, 2, 179, '101', 'UrFfZMOx8FmOYr2sI4RXuUetxGh5pjhdZ142GsWu.pdf', 'approve', 'REKRUT', NULL, 58, 100),
(219, 2, 180, '111', 'RTbfS69bGIKC8V9n9CeRKnS5ZzBaR9s26e9jYNB5.pdf', 'approve', 'REKRUT', NULL, 58, 100),
(220, 2, 198, '79', NULL, 'approve', 'REKRUT', NULL, 58, 100),
(221, 2, 181, '111', 'uqDkixMxOizMzUALI6gFzu2PPg6xWjSKK8GpLa3w.jpg', 'approve', 'REKRUT', NULL, 58, 100),
(222, 2, 183, '111', 'mit7XxDFzjQOP1wN68KJUX6v3596G7gseG4MwMwN.jpg', 'approve', 'REKRUT', NULL, 58, 100),
(224, 2, 194, '111', '1RqXNW5xqpTTrWXsjLvCvaZRTOkTI6gux8xqExpp.jpg', 'approve', 'REKRUT', NULL, 58, 100),
(225, 1, 184, '111', 'QyAfMhxAd9tMoOgxBg7TT7suW1neJH02uhR2V4SO.pdf', 'approve', 'TND', NULL, 60, 100),
(226, 1, 185, '111', 'Ufc3k6sea1O3948WyMP9jq0B97IEwgxFe66CSvQj.pdf', 'approve', 'TND', NULL, 60, 100),
(227, 2, 162, '111', 'c17szWonv4JGOKSJOlGQUimYJcAZw5m886mW5AvZ.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(228, 1, 186, '111', '2L3DXzUtGfnjYdOvT7S0rBABwCP6birgwDvNBfnS.pdf', 'approve', 'TND', NULL, 60, 100),
(229, 1, 187, '100', 'Bd8BeMobLAAyt0VpYKXo9XwyBLbFKQSSoWuVp6kv.pdf', 'approve', 'TND', NULL, 60, 100),
(230, 1, 188, '111', 'IbyURNHpo2frlpUUgpN8o8HxnCd2SZMmxjvwGuri.pdf', 'approve', 'TND', NULL, 60, 100),
(231, 1, 241, '79', 'MtGwKEWTE8Qke1Fmy7RcrYc38zmsQH9uXi5dMhbO.pdf', 'approve', 'TND', NULL, 60, 100),
(232, 1, 242, '79', 'u6eZTeUPc5JBzaWFq3vV789zRz2Ik6Quhe36ihzL.pdf', 'approve', 'TND', NULL, 60, 100),
(233, 1, 196, '100', '1dSWNnxfDALWbzo1ZvOBUoZgFY12R3bApekkJCiK.pdf', 'approve', 'TND', NULL, 60, 100),
(234, 1, 192, '79', NULL, 'approve', 'TND', NULL, 60, 100),
(235, 1, 191, '111', 'gRJMtYrUtwkgErwfklsSoNDdG8KqaDz35slrtdqR.pdf', 'approve', 'TND', NULL, 60, 100),
(236, 1, 189, '111', 'YIfOl5wnoz7V7wGLn4X132x64SUSES2WA6AAhlyz.jpg', 'approve', 'TND', NULL, 60, 100),
(237, 1, 190, '111', 'BVTmB9HMoKIs9pS8R60TyE7f2tpGhi4xxqRxF1FM.png', 'approve', 'TND', NULL, 60, 100),
(238, 1, 182, '101', '5IDBdFQuzqFy6zV96OmldythxhrZPmOiOKrZaWE7.jpg', 'approve', 'REKRUT', NULL, 58, 100),
(239, 2, 182, '101', 'QkVx5ojGHaWJnOlkDxxhgB63pbOQVqQraP6vWBFQ.jpg', 'approve', 'REKRUT', NULL, 58, 100),
(241, 2, 157, '100', 'LkjjXCym2NmpKDenNWIxWPqWO0DHxlXy9gSmB523.pdf', 'approve', 'COMBEN', NULL, 66, 100),
(242, 2, 158, '100', 'oVZKVc7F0zId7vz1s6Hri9Ua4ZCCaHJOvlkk7iU9.pdf', 'approve', 'COMBEN', NULL, 66, 100),
(243, 2, 159, '80', 'TP832sJiMbERuJYQTqmrH7Qh4avWNKstiNXhemjs.pdf', 'approve', 'COMBEN', NULL, 66, 100),
(244, 2, 199, '0', 'hEzQhU3EE1FF7COywmF0wyeaeErOWgE3xk2d2K8h.pdf', 'approve', 'COMBEN', NULL, 66, 100),
(245, 2, 162, '100', 'XCXn19mFQuLTTbYP546lj0bMvmvuD9Hjms7Uw1NI.pdf', 'approve', 'COMBEN', NULL, 66, 100),
(246, 2, 164, '100', '1aHY79xRNBQIcLutsX3274caWKdWr9RTUlpeuWqU.pdf', 'approve', 'COMBEN', NULL, 66, 100),
(247, 2, 163, '100', 'CJu891VZHZjLChlsdX9f1bdQzNtUUK6dvbz5klvd.pdf', 'approve', 'COMBEN', NULL, 66, 100),
(248, 2, 195, '0', '3cCTiu0vlCmRPcMNbzvMlHJmEuIOSQc8PiRwOc6P.pdf', 'approve', 'COMBEN', NULL, 66, 100),
(249, 4, 160, '100', 'Lv8x7uFzD7ZCrMhrhpRzSglgara6My4j3LuDS8QF.pdf', 'wait', 'COMBEN', NULL, 67, 100),
(250, 4, 161, '100', 'nmX1QuC7jSjzdqLwmY8q5EEG2qMzhnsJy4gKenp6.pdf', 'wait', 'COMBEN', NULL, 67, 100),
(251, 4, 243, '110', 'ZNaNA8bQwFIfOQSTmuKfphV8MZd7SACdpeSM3Sa2.pdf', 'wait', 'COMBEN', NULL, 67, 100),
(252, 4, 199, '100', 'D2LbhVEb0y14sY8EFkj10obfkkGBPucwDtZy0ykg.pdf', 'wait', 'COMBEN', NULL, 67, 100),
(253, 4, 162, '100', 'A3a8sr3DsTcrPSzhJf2uoiczAzDkN36gzJjrxiYH.pdf', 'wait', 'COMBEN', NULL, 67, 100),
(254, 4, 164, '100', '0sEBLHiUe5NbHq27tK3Ov66NAL2dnB9Pn9qv2OJ0.pdf', 'wait', 'COMBEN', NULL, 67, 100),
(255, 4, 163, '100', 'KHftCDsDt8FlHVGArWTPCrIaSuX0JvGzaLcFkEW0.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(256, 4, 195, '100', 'lSCkbnhFUnR0Ya7c0vIXCTFL6xeIcsonUwnzKLN5.pdf', 'approve', 'COMBEN', NULL, 67, 100),
(257, 4, 154, '10', 'UYGhQ401JQE0uT2dSfXO013GeMwAjPjd26T0ODVW.pdf', 'wait', 'COMBEN', NULL, 68, 100),
(258, 4, 155, '1, 4', 'uaUpsDRiQMIj2xt9WJ2Sl9HUA0p4UlUfYYRfz80R.pdf', 'wait', 'COMBEN', NULL, 68, 100),
(259, 4, 156, '3, 1', 'dJpDv7aVBVclau1ulsNP8uaDfStTiOhfl5VeSH2m.pdf', 'wait', 'COMBEN', NULL, 68, 100),
(260, 4, 199, '1', '4F44p0u1CNg2eqhez1eESE09WozDTwyXqFK6YUMN.pdf', 'wait', 'COMBEN', NULL, 68, 100),
(261, 4, 162, '0', 'XzVw76ZzEMx73w4NBGeMHuWoDUDluGbahOJjzoBO.pdf', 'wait', 'COMBEN', NULL, 68, 100),
(262, 4, 164, '100%', '3T2nLu7Pj8ehpSzKsk0XJpyvX3ZFv6snoVukU3EX.pdf', 'wait', 'COMBEN', NULL, 68, 100),
(263, 4, 163, '100%', '02I1KeSqQqOrGtD9tccIgMygk2wOPjdHHAmfU9at.pdf', 'wait', 'COMBEN', NULL, 68, 100),
(264, 4, 195, '1', 'vG8bCAxnZRX1V9tHSIcUhggUFEzH2B7pRAY21njY.pdf', 'wait', 'COMBEN', NULL, 68, 100),
(265, 4, 178, '111', '0tFGDMgO4sGoPAkCBrclaKTMFngY31sIXhpq3ZB7.pdf', 'wait', 'REKRUT', NULL, 62, 100),
(266, 4, 179, '101', 'Ev9SXX9lFvwOUsMsiT32EyMBXDgayN8rUPgtGhWa.pdf', 'wait', 'REKRUT', NULL, 62, 100),
(267, 4, 180, '79', 'dE8BSXOWm6EuD0R32xCCmEV7nJp1dSvbm6oZeUhT.pdf', 'wait', 'REKRUT', NULL, 62, 100),
(268, 4, 198, '79', NULL, 'wait', 'REKRUT', NULL, 62, 100),
(269, 4, 181, '111', 'd9ecwXk3s1gojxcJE8WHHHw7OwJh170sFq8vVmHC.jpg', 'wait', 'REKRUT', NULL, 62, 100),
(270, 4, 183, '99', 'gKFkAxGx9gfYiGlFWX7m0dp5VhrLSMAv6DdhguYT.jpg', 'wait', 'REKRUT', NULL, 62, 100),
(271, 4, 182, '101', 'fTmbove57A75IdDcq183uXmzOBh0EiMEXJophznP.pdf', 'wait', 'REKRUT', NULL, 62, 100),
(272, 4, 194, '111', 'qUNd15BSYMkPyk6323pNB7X0IUCaB2gzT09jnXDN.jpg', 'wait', 'REKRUT', NULL, 62, 100),
(273, 4, 198, '0', NULL, 'wait', 'REKRUT', NULL, 58, 100),
(274, 4, 195, '0', 'M9s5nCborL4MxDIEWt3RRY4tVnZ62B3JBJnJzpcA.pdf', 'wait', 'COMBEN', NULL, 66, 100),
(275, 4, 163, '100', 'tLlwm5TntemGdjJoCxff42zLQvPUSQxLN4XiDdGc.pdf', 'wait', 'COMBEN', NULL, 66, 100),
(276, 4, 164, '100', 'LbHk7mehkxLnIM9WsuHU4TqZ2uhS6NejhiKJZKYQ.pdf', 'wait', 'COMBEN', NULL, 66, 100),
(277, 4, 162, '0', 'dyaulECrNzjTVbXGqHTuS98IRLEyHxiPzsCWenO2.pdf', 'wait', 'COMBEN', NULL, 66, 100),
(278, 4, 199, '1', 'ewXMr0CTJE51n3VwyR9QGBIfWanoC1DTNuBHssCp.pdf', 'wait', 'COMBEN', NULL, 66, 100),
(279, 4, 194, '111', 'a2VmSSJuAufizKe7g0KNizZqzBRRvYCDgqgqUhjx.pdf', 'wait', 'REKRUT', NULL, 58, 100),
(280, 4, 183, '111', 'yOCWxD8e9jKNieQTlSwSBPF1BRjfL57OkMKoao4T.pdf', 'wait', 'REKRUT', NULL, 58, 100),
(281, 4, 182, '111', '7kmYIJ5Vj2bPHUC2oP5S4JhWFWpQvvTW0aOpolhM.png', 'wait', 'REKRUT', NULL, 58, 100),
(282, 4, 181, '111', NULL, 'wait', 'REKRUT', NULL, 58, 100),
(283, 4, 197, '100', 'cQFOp7pzofN1t8WgvL8bTbkPGemY29QHY8OXA7Rd.pdf', 'wait', 'IR', NULL, 63, 100),
(284, 4, 193, '100', 'IMikq9jjr98D15ghj1Rn7ZbQCCaeUp9FQcMyO955.pdf', 'wait', 'IR', NULL, 63, 100),
(285, 4, 177, '100', '1jlI6GQIkIdJs1c6mvgQsx88nll9cJLpZTGFWHIw.pdf', 'wait', 'IR', NULL, 63, 100),
(286, 4, 176, '100', 'E6kGVjaV1sATLk0my2qqgEoDbX9z4D5PDyv4Lldc.pdf', 'wait', 'IR', NULL, 63, 100),
(288, 4, 167, '100', '0fJY0XYRkQHpVMIQCcCpeP8e1VCYFOSVXXEritAW.pdf', 'wait', 'IR', NULL, 63, 100),
(289, 4, 180, '111', 'kEXPTq0s0MB4o2Ztw8tsVnsq9BVhUCF0DutZycmI.png', 'wait', 'REKRUT', NULL, 58, 100),
(290, 4, 179, '111', 'VheJss69wM9qCNkrfHAWEpsvXGnifvbsetUmvVPK.png', 'wait', 'REKRUT', NULL, 58, 100),
(291, 4, 198, '0', NULL, 'wait', 'REKRUT', NULL, 61, 100),
(292, 4, 194, '111', 'hBhOChjjP5Y8CMO5KWIokWG8pLKhTayj4cxOqFPe.pdf', 'wait', 'REKRUT', NULL, 61, 100),
(293, 4, 183, '99', 'B9RFTmPvbTVepA7uJqgCpP48fZK5NWtg3DHFTdPT.png', 'wait', 'REKRUT', NULL, 61, 100),
(294, 4, 182, '101', 'F81w4eVSmiPZi0icBuBmm69KYsSvFM5r6WWgfN5s.pdf', 'wait', 'REKRUT', NULL, 61, 100),
(295, 4, 166, '100', 'k09fDkf3myOWpcVR3ne3h1yFeIXSEjXxruhQXRk3.pdf', 'wait', 'IR', NULL, 63, 100),
(296, 4, 181, '111', 'ebIwZzOsj2vEUt8HDm4ZYmaUeYA5hl2YkUWUevlG.png', 'wait', 'REKRUT', NULL, 61, 100),
(297, 4, 180, '111', '0vxPjBF2OjyDfgs7qVNAoCiW7ZvY1N3a1YqR7BBx.pdf', 'wait', 'REKRUT', NULL, 61, 100),
(298, 4, 179, '101', 'pmuez0swLZiHx1Dag0tikZwUWWfNQcuN4q6gePyP.pdf', 'wait', 'REKRUT', NULL, 61, 100),
(299, 4, 173, '100', 'M8vRE5SP6ShRYEULFAhE7mUb7KcVrVXiWIYDn3ID.pdf', 'wait', 'IR', NULL, 63, 100),
(300, 4, 178, '91', 'MSImEDLdpBOLcvwyKtCFgXf6IZdIDkDLx3mBbQQq.pdf', 'wait', 'REKRUT', NULL, 61, 100),
(301, 4, 178, '111', 'RQ6LxCX34lOCPkLVnah0BPiPBOjKw4q9sWMJiUo8.png', 'wait', 'REKRUT', NULL, 58, 100),
(302, 4, 174, '100', 'YRLtZ3E8TyBVRwkxPCOIDoOq8hO0aLVsxGD5ecbZ.pdf', 'wait', 'IR', NULL, 63, 100),
(303, 4, 165, '100', 'VDijKUkV9sZqyuuR3fsZqQ0E1Rpzq5JAw1Ag8XoG.pdf', 'wait', 'IR', NULL, 63, 100),
(304, 4, 184, '111', 'lAmkZxoME2BOqFchtDURhFwvePJX2GX5esICKjbl.pdf', 'wait', 'TND', NULL, 60, 100),
(305, 4, 185, '111', 'wdAc1dQBfv92sw6gvM54LTWKnA25V7ca83jCm8wF.pdf', 'wait', 'TND', NULL, 60, 100),
(306, 4, 186, '111', 'UTH7sV6wcJphGH3aH9kWYlyk2MSrh5Iox4h2Qn60.pdf', 'wait', 'TND', NULL, 60, 100),
(307, 4, 187, '100', 'bvbsEvGuvF4J53EBKClmJEIpoE9DYDJOzRG9Hla3.pdf', 'wait', 'TND', NULL, 60, 100),
(308, 4, 188, '111', 'QSU1m2Sqx8G3zUCpj4ebhkitqTtIi5K4G4GgRAr7.pdf', 'wait', 'TND', NULL, 60, 100),
(309, 4, 189, '111', NULL, 'wait', 'TND', NULL, 60, 100),
(310, 4, 190, '111', 'SRKrD58hdOLNRnY0Ntp0YH4Wa5C3fMAeA5DKRlJc.png', 'wait', 'TND', NULL, 60, 100),
(311, 4, 191, '111', 'jStvQyBzXEAfO9sBlwh4DruGWcyI4MlxzgMLPinC.pdf', 'wait', 'TND', NULL, 60, 100),
(312, 4, 192, '111', 'fNRo9VLqW8fSaHQPsIWDGTl4m97fXvVZeKA5Z328.pdf', 'wait', 'TND', NULL, 60, 100),
(313, 4, 196, '100', 'KEBdNyIrxQnGgKjtgHZnUURjcOKZQCQeWoN7zcax.pdf', 'wait', 'TND', NULL, 60, 100),
(314, 4, 241, '111', 'mitm9TEGe1Ikb8sCWIjzdrwAAzQAr59RP6GLa1KB.pdf', 'wait', 'TND', NULL, 60, 100),
(315, 4, 242, '79', 'eful4HuamSfFoZKKjcrGjOZGiNM2EDGlBkdCHdYJ.pdf', 'wait', 'TND', NULL, 60, 100),
(316, 4, 184, '111', 'IxY5iFvEaJcIsPENPSsmXHhMKi5nX7OiPfPfeZH9.pdf', 'wait', 'TND', NULL, 55, 100),
(317, 4, 185, '111', 'XUBYCznEwO7wuSl94QlNnEwmnr726t1nilsf8WKo.pdf', 'wait', 'TND', NULL, 55, 100),
(318, 4, 186, '111', 'QP9xHeBMFeHjo6WVLUVQr9NtnRZbner1y63oARCq.pdf', 'wait', 'TND', NULL, 55, 100),
(319, 4, 187, '100', 'pIUxLjVOep53ddcHGbm62Z21fUf7VQOTBtNkA8ZK.pdf', 'wait', 'TND', NULL, 55, 100),
(320, 4, 188, '111', 'Uyet5UJCiO467UORLEKYfafvHQ1yhcMoYapGeBeV.pdf', 'wait', 'TND', NULL, 55, 100),
(321, 4, 189, '111', NULL, 'wait', 'TND', NULL, 55, 100),
(322, 4, 190, '111', '53jAjauJtSzgTxzSvs1MW2ptjj3QVjd6Rt0hX7wt.png', 'wait', 'TND', NULL, 55, 100),
(323, 4, 191, '111', 'bnsLwIBFC6OdIGlqFYv3ZCHgtJMmQAFUxvp4yMfu.pdf', 'approve', 'TND', NULL, 55, 111),
(324, 4, 196, '100', 'tgUr0QCEtixwYtzLOgw1eFZaUljJ0rTQCfyNqAtc.pdf', 'wait', 'TND', NULL, 55, 100),
(325, 4, 241, '111', '3Jqo4VMnKOLxP08YIy26ngJap1fJsi3IjbYZEkh5.pdf', 'wait', 'TND', NULL, 55, 100),
(326, 4, 242, '79', '352zN0zzUwTFj7SJT8IO027gnMVASRfID0lSRPXy.pdf', 'wait', 'TND', NULL, 55, 100),
(327, 4, 192, '111', 'KBlHPutuXH3G995EOTmq8VHLAKBSKvvBDttLbtYI.pdf', 'wait', 'TND', NULL, 55, 100),
(328, 4, 184, '111', 'J3pCfDZyWxigtwFsIM8JKNQEyZrdiNSD7xXkJ6OR.pdf', 'wait', 'TND', NULL, 59, 100),
(329, 4, 185, '111', '2R8IcApRrhMMBkcPIs4mvJ5YWGbjFJbl1XMnUWZh.pdf', 'wait', 'TND', NULL, 59, 100),
(330, 4, 186, '111', 'UCbzgWMw9vUsXXarHNzbPo0CidqYCUrOMMRbECpy.pdf', 'wait', 'TND', NULL, 59, 100),
(331, 4, 187, '100', 'khMnQMYgIjKhqtHDmq9cRURKQbRz7iypLl3ouOiF.pdf', 'wait', 'TND', NULL, 59, 100),
(332, 4, 188, '111', 'D7j3btHWNmPci3qQUfOaGBUbbNF2S23dAc2nd9Xs.pdf', 'wait', 'TND', NULL, 59, 100),
(333, 4, 189, '111', NULL, 'wait', 'TND', NULL, 59, 100),
(334, 4, 190, '111', 'JrUFgCkRlCfzSqmM1QgdbJiNtSUEHinjzYddRQq3.png', 'wait', 'TND', NULL, 59, 100),
(335, 4, 191, '111', '00rsY9iEBJ0ftD6mK6UfycsClyFJimJ05QnM2OnH.pdf', 'wait', 'TND', NULL, 59, 100),
(336, 4, 196, '100', 'ndCJAQIk2vQR2D0WuHTPlCg0xhyJU9Wfh6ADd5K6.pdf', 'wait', 'TND', NULL, 59, 100),
(337, 4, 241, '111', '3DewQVzfceIZ0yAoCyZ1qoUVqCkXK9JaZRRF1Mg3.pdf', 'wait', 'TND', NULL, 59, 100),
(338, 4, 242, '79', '3BEm8iQOJvGsNnKl6eAjGZNj1I99FkUKZSkE1ydH.pdf', 'wait', 'TND', NULL, 59, 100),
(339, 4, 192, '111', 'Ni7ZNR2A1u7W0gdZnQG0pKpAJpYylgKk4Ly4R2wz.pdf', 'wait', 'TND', NULL, 59, 100),
(343, 4, 159, '100', 'DlJ112eohkr6SgYZqHtOj9MmnXCyEMn2r2TCNm6L.pdf', 'wait', 'COMBEN', NULL, 66, 100),
(344, 4, 158, '100', 'qeBjXIxhd95kElh0p8VqzSGgYXLWnSlpIKchC403.pdf', 'wait', 'COMBEN', NULL, 66, 100),
(345, 4, 157, '100', 'hEtEBU26jmiwtmwiYv1P5T89DEe8PbP5fu26rw0y.pdf', 'wait', 'COMBEN', NULL, 66, 100),
(346, 4, 171, '115', 'Z1B0VPtkBxhePFE81ZGw06nC290ke3ipTGZwKxz6.pdf', 'wait', 'IR', NULL, 65, 100),
(347, 4, 174, '115', 'xbDZWrLebhbGkJKkhGXIeIdX4jVRvL7xkColEjsz.pdf', 'wait', 'IR', NULL, 65, 100),
(348, 4, 166, '115', 'CJo5aFHwvmoV35SOnRSdiNXibpqHgWhznjibA9lY.pdf', 'wait', 'IR', NULL, 65, 100),
(349, 4, 172, '115', 'QAS6gFqs3Vae1DV6nSIjFtgLP9RjVPwTebguvoQD.pdf', 'wait', 'IR', NULL, 65, 100),
(350, 4, 197, '101', 'v2cfn4MFBIirM4iD5LigupScZhzpf34ANNYLtMVv.pdf', 'wait', 'IR', NULL, 65, 100),
(351, 4, 173, '115', '5td9nZrYVufki8UpIK6Sp3GSwSk8KUlUha6hyFCG.pdf', 'wait', 'IR', NULL, 65, 100),
(352, 4, 177, '115', 'vPr9BLwV8LUofzbzHgZWOQsLWOD0sIqRFDgeXGj0.pdf', 'wait', 'IR', NULL, 65, 100),
(353, 4, 176, '115', 'SvQnPmk8jRLD6NQ85tUniHZBBOThm0E5NCDSnggl.pdf', 'wait', 'IR', NULL, 65, 100),
(354, 4, 175, '79', NULL, 'wait', 'IR', NULL, 65, 100),
(355, 4, 193, '115', 'F5Pq1YwibM3PnUOQiowfMVWuggouKwQeVBuuNvtW.pdf', 'wait', 'IR', NULL, 65, 100),
(356, 4, 168, '115', 'rRloL0N168mCPwlEJLHR2wwtXmUEublgb88p9Knx.pdf', 'wait', 'IR', NULL, 64, 100),
(357, 4, 169, '115', 'QSYEI7e3XDBV9oFIiUI2uH2b0CMVXXE3RuKvFYsu.pdf', 'wait', 'IR', NULL, 64, 100),
(358, 4, 170, '80', 'Cf9jPLEzHM98AiMhB0LeeAvUnPV4mI3DvhQ5cvew.pdf', 'wait', 'IR', NULL, 64, 100),
(359, 4, 173, '115', 'dmbEZDXqlM759nH2ZZ6vKpZFpqXSifLsT2DQ8681.pdf', 'wait', 'IR', NULL, 64, 100),
(360, 4, 177, '115', 'cJioIP4XlwQVczSGXDNtk0M0kjbcaCtAlkaeEoY7.pdf', 'wait', 'IR', NULL, 64, 100),
(361, 4, 176, '115', 'ZeEDDhNwmQt3g8KYCOo7PjqXEfpnB72wem3uhmrg.pdf', 'wait', 'IR', NULL, 64, 100),
(362, 4, 197, '115', 'Tt1bEPvtz2WLjOcGI6jqxyzgdVsSuGF4DEyXYUgb.pdf', 'wait', 'IR', NULL, 64, 100),
(363, 4, 193, '115', 'yFTX8xjaJ3ItXBuMPm7z1Zb5dQLIO1Vws5VUmbUw.pdf', 'wait', 'IR', NULL, 64, 100),
(364, 4, 175, '79', NULL, 'wait', 'IR', NULL, 64, 100),
(365, 4, 174, '115', '5hoAMyHGXtSrSpSDzfR4uM6zm8cJKt2e6t1onS4N.pdf', 'wait', 'IR', NULL, 64, 100),
(366, 4, 166, '115', 'SAVe0vJqr6m5myXX9oRuMGWfZFABfojHvrLTvPEW.jpg', 'wait', 'IR', NULL, 64, 100),
(372, 5, 191, '111', NULL, 'approve', 'TND', NULL, 55, 111);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gl_kpi_generals`
--

CREATE TABLE `gl_kpi_generals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total` double NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `status` enum('wait','reject','approve') NOT NULL DEFAULT 'wait',
  `id_periode` int(11) NOT NULL,
  `subdivisi` enum('COMBEN','REKRUT','TND','IR') NOT NULL,
  `alasan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gl_kpi_generals`
--

INSERT INTO `gl_kpi_generals` (`id`, `total`, `id_user`, `status`, `id_periode`, `subdivisi`, `alasan`, `created_at`, `updated_at`, `file`) VALUES
(52, 85, 58, 'approve', 1, 'REKRUT', NULL, '2024-03-01 07:47:48', '2024-03-01 07:51:47', NULL),
(53, 90, 55, 'approve', 2, 'TND', NULL, '2024-03-05 23:40:04', '2024-03-15 21:47:06', NULL),
(54, 92, 65, 'approve', 1, 'IR', NULL, '2024-03-06 23:10:25', '2024-03-15 21:47:02', NULL),
(55, 92, 65, 'approve', 2, 'IR', NULL, '2024-03-06 23:27:30', '2024-03-15 21:46:58', NULL),
(60, 77, 62, 'approve', 2, 'REKRUT', NULL, '2024-03-09 01:41:22', '2024-03-15 21:46:55', NULL),
(61, 77, 62, 'approve', 1, 'REKRUT', NULL, '2024-03-09 01:43:22', '2024-03-15 21:46:52', NULL),
(63, 100, 67, 'approve', 2, 'COMBEN', NULL, '2024-03-10 15:05:11', '2024-03-15 21:46:49', NULL),
(64, 100, 67, 'approve', 1, 'COMBEN', NULL, '2024-03-10 15:09:31', '2024-03-15 21:46:43', NULL),
(65, 88, 60, 'approve', 1, 'TND', NULL, '2024-03-16 17:17:49', '2024-03-16 17:20:04', NULL),
(66, 89, 62, 'wait', 4, 'REKRUT', NULL, '2024-04-02 17:28:04', '2024-04-02 17:28:04', NULL),
(67, 96, 60, 'wait', 4, 'TND', NULL, '2024-04-04 17:08:06', '2024-04-04 17:08:06', NULL),
(68, 100, 67, 'wait', 4, 'COMBEN', NULL, '2024-04-04 23:06:34', '2024-04-04 23:06:34', NULL),
(70, 100, 66, 'wait', 4, 'COMBEN', NULL, '2024-04-05 00:01:42', '2024-04-05 00:01:42', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gl_kpi_general_items`
--

CREATE TABLE `gl_kpi_general_items` (
  `id` int(11) NOT NULL,
  `id_key_performance_indicator` int(11) DEFAULT NULL,
  `realisasi` text NOT NULL,
  `skor` double NOT NULL,
  `konversi_sf` varchar(5) NOT NULL,
  `skor_akhir` double NOT NULL,
  `id_kpi_general` bigint(20) UNSIGNED NOT NULL,
  `no_urut` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gl_kpi_general_items`
--

INSERT INTO `gl_kpi_general_items` (`id`, `id_key_performance_indicator`, `realisasi`, `skor`, `konversi_sf`, `skor_akhir`, `id_kpi_general`, `no_urut`) VALUES
(352, 7, '80', 100, '100', 20, 52, 1),
(353, 9, '-', 100, '100', 20, 52, 2),
(354, 10, '-', 100, '100', 20, 52, 3),
(355, 50, '-', 100, '100', 5, 52, 4),
(356, 11, '-', 100, '100', 5, 52, 5),
(357, 12, '100haha', 100, '100', 10, 52, 6),
(358, 13, '10hahaha', 100, '100', 5, 52, 7),
(359, 14, '103%', 100, '101', 15, 53, 1),
(360, 15, '100%', 100, '100', 15, 53, 1),
(361, 18, '100%', 100, '100', 10, 53, 2),
(362, 19, '100%', 100, '100', 10, 53, 3),
(363, 20, '5', 100, '111', 10, 53, 4),
(364, 48, '9,7', 100, '5', 5, 53, 4),
(365, 21, '0', 0, '79', 0, 53, 5),
(366, 49, '1', 100, '100', 5, 53, 6),
(367, 22, '0', 100, '111', 10, 53, 7),
(368, 23, '100', 100, '111', 5, 53, 8),
(369, 24, '100%', 100, '111', 5, 53, 9),
(370, 27, '98.8%', 100, '99', 15, 54, 1),
(371, 28, '0 kasus', 100, '90', 20, 54, 2),
(372, 29, '0.34%', 100, '115', 5, 54, 3),
(373, 30, '0.40%', 100, '115', 5, 54, 3),
(374, 31, '0%', 100, '115', 5, 54, 3),
(375, 33, '0', 0, '0', 0, 54, 4),
(376, 54, '2', 100, '100', 5, 54, 4),
(377, 32, '100%', 80, '80', 16, 54, 5),
(378, 55, '0', 0, '0', 0, 54, 6),
(379, 56, '1', 100, '115', 1, 54, 7),
(380, 36, '100%', 100, '115', 5, 54, 8),
(381, 35, '100%', 100, '115', 10, 54, 9),
(382, 34, '100%', 100, '100', 5, 54, 10),
(383, 27, '99.1%', 100, '100', 15, 55, 1),
(384, 28, '0', 100, '90', 20, 55, 2),
(385, 29, '0.34%', 100, '115', 5, 55, 3),
(386, 30, '0.25%', 100, '115', 5, 55, 3),
(387, 31, '0', 100, '115', 5, 55, 3),
(388, 33, '0', 0, '0', 0, 55, 4),
(389, 54, '2', 100, '100', 5, 55, 4),
(390, 32, '100%', 80, '80', 16, 55, 5),
(391, 55, '0', 0, '0', 0, 55, 6),
(392, 56, '1', 100, '101', 1, 55, 7),
(393, 36, '100%', 100, '115', 5, 55, 8),
(394, 35, '100%', 100, '115', 10, 55, 9),
(395, 34, '100%', 100, '115', 5, 55, 10),
(424, 7, '27', 100, '111', 30, 60, 1),
(425, 9, '96', 90, '101', 27, 60, 2),
(426, 10, '45', 0, '79', 0, 60, 3),
(427, 50, '0', 0, '79', 0, 60, 4),
(428, 11, '0', 100, '111', 10, 60, 5),
(429, 12, '100', 100, '99', 5, 60, 6),
(430, 13, '100', 100, '101', 5, 60, 7),
(431, 7, '38', 100, '111', 30, 61, 1),
(432, 9, '96', 90, '101', 27, 61, 2),
(433, 10, '33', 0, '79', 0, 61, 3),
(434, 50, '0', 0, '79', 0, 61, 4),
(435, 11, '0', 100, '111', 10, 61, 5),
(436, 12, '100', 100, '99', 5, 61, 6),
(437, 13, '100', 100, '101', 5, 61, 7),
(440, 1, 'Rawat Jalan 8\r\nRawat Inap 8\r\nPerjalanan Dinas 4', 100, '4', 20, 63, 1),
(441, 2, 'New Hire 1 hari\r\nTerminasi 1 hari', 100, '4', 15, 63, 2),
(442, 3, '100% lengkap', 100, '4', 20, 63, 3),
(443, 52, 'Rata-rata Index (PPA, AMM, HAMARA) - 249 Jam', 100, '3', 20, 63, 4),
(444, 51, 'HCGA Squad', 100, '4', 5, 63, 5),
(445, 4, 'Tidak ada', 100, '4', 10, 63, 6),
(446, 5, '100%', 100, '4', 5, 63, 7),
(447, 6, '100%', 100, '4', 5, 63, 8),
(448, 1, 'Rawat Jalan 8 hari\r\nRawat Inap 8 hari\r\nPerjalanan Dinas 4 hari', 100, '4', 20, 64, 1),
(449, 2, 'New Hire 1 hari\r\nTerminasi 1 hari', 100, '4', 15, 64, 2),
(450, 3, '100 % lengkap', 100, '4', 20, 64, 3),
(451, 52, 'Rata-rata Index Januari (PPA, AMM, HAMARA) 224 Jam', 100, '4', 20, 64, 4),
(452, 51, 'HCGA Squad', 100, '4', 5, 64, 5),
(453, 4, 'Tidak ada', 100, '4', 10, 64, 6),
(454, 5, '100 %', 100, '4', 5, 64, 7),
(455, 6, '100%', 100, '4', 5, 64, 8),
(456, 14, '131%', 100, '111', 15, 65, 1),
(457, 15, '133%', 100, '111', 15, 65, 1),
(458, 18, '111%', 100, '111', 10, 65, 2),
(459, 19, '100%', 100, '100', 10, 65, 3),
(460, 20, '6', 100, '111', 10, 65, 4),
(461, 48, '0,92', 60, '79', 3, 65, 4),
(462, 21, '0', 0, '79', 0, 65, 5),
(463, 49, '1', 100, '100', 5, 65, 6),
(464, 22, '0', 100, '111', 10, 65, 7),
(465, 23, '100%', 100, '111', 5, 65, 8),
(466, 24, '100%', 100, '111', 5, 65, 9),
(467, 7, '43 hari', 90, '101', 27, 66, 1),
(468, 9, '97%', 90, '101', 27, 66, 2),
(469, 10, '9 hari', 100, '111', 15, 66, 3),
(470, 50, '0', 0, '79', 0, 66, 4),
(471, 11, '0', 100, '111', 10, 66, 5),
(472, 12, '100%', 100, '99', 5, 66, 6),
(473, 13, '100%', 100, '101', 5, 66, 7),
(474, 14, '117%', 100, '111', 15, 67, 1),
(475, 15, '180%', 100, '111', 15, 67, 1),
(476, 18, '120%', 100, '111', 10, 67, 2),
(477, 19, '100%', 100, '100', 10, 67, 3),
(478, 20, '10', 100, '111', 10, 67, 4),
(479, 48, '20,3', 100, '111', 5, 67, 4),
(480, 21, '18%', 60, '79', 6, 67, 5),
(481, 49, '2', 100, '100', 5, 67, 6),
(482, 22, '0', 100, '111', 10, 67, 7),
(483, 23, '100%', 100, '111', 5, 67, 8),
(484, 24, '100%', 100, '111', 5, 67, 9),
(485, 1, 'Rawat Jalan = 9 hari\r\nRawat Inap = 10 hari', 100, '4', 20, 68, 1),
(486, 2, '100%', 100, '4', 15, 68, 2),
(487, 3, 'Data null atasan 100% lengkap yang terlihat di lampiran KPI adalah karyawan mutasi yang efektif bulan April', 100, '4', 20, 68, 3),
(488, 52, 'RATA-RATA 199 Jam - Scala : 1.16\r\nRATA-RATA INDEX HAMARA 184 Jam - Scala : 1.07\r\nRATA-RATA INDEX AMM 211 Jam - Scala : 1.23\r\nRATA-RATA INDEX PPA 202 Jam - Scala : 1.17', 100, '5', 20, 68, 4),
(489, 51, 'HCGA Squad', 100, '4', 5, 68, 5),
(490, 4, '0', 100, '5', 10, 68, 6),
(491, 5, '100%', 100, '5', 5, 68, 7),
(492, 6, '100%', 100, '5', 5, 68, 8),
(493, 1, 'Rawat Jalan : 9 Hari\r\nRawat Inap : 10 Hari\r\nPerjalanan Dinas : 1 Hari', 100, '4', 20, 70, 1),
(494, 2, 'New Hire : 1 Hari\r\nTerminasi : 1 Hari', 100, '4', 15, 70, 2),
(495, 3, '100% Lengkap', 100, '4', 20, 70, 3),
(496, 52, 'Rata - rata index PPA - 199 Jam - Skala 1.16\r\nRata - rata index HAMARA - 184 Jam - Skala 10.07\r\nRata -rata index AMM -  211 Jam - Skala : 1.17', 100, '5', 20, 70, 4),
(497, 51, 'HCGA Squad', 100, '4', 5, 70, 5),
(498, 4, 'Tidak Ada', 100, '5', 10, 70, 6),
(499, 5, '100%', 100, '5', 5, 70, 7),
(500, 6, '100%', 100, '5', 5, 70, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamuskpis`
--

CREATE TABLE `kamuskpis` (
  `id` int(11) NOT NULL,
  `pointkpi` varchar(255) NOT NULL,
  `subdivisi` enum('COMBEN','REKRUT','TND','IR') NOT NULL DEFAULT 'COMBEN',
  `target` varchar(50) NOT NULL,
  `unit_target` varchar(50) NOT NULL,
  `kategori` enum('ADMIN','GROUP LEADER') DEFAULT 'ADMIN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kamuskpis`
--

INSERT INTO `kamuskpis` (`id`, `pointkpi`, `subdivisi`, `target`, `unit_target`, `kategori`) VALUES
(154, 'Leadtime Employee Claim (Rawat Jalan & Rawat Inap)', 'COMBEN', '10', 'Hari', 'GROUP LEADER'),
(155, 'Leadtime Personal Administrasi (BPJS Kesehatan, Allianz, ESG, Surat Keputusan)', 'COMBEN', 'BPJS Kes-Allianz (7), ESG-SK (3)', 'Hari', 'GROUP LEADER'),
(156, 'Kelengkapan dan Keakuratan Data (Invoice BPJS, Skema Insentif)', 'COMBEN', '5', 'Hari', 'GROUP LEADER'),
(157, 'Leadtime Perjalanan dinas, deklarasi, invoice MCU', 'COMBEN', 'Perjalanan Dinas-Deklarasi (7), Invoice MCU (5)', 'Hari', 'GROUP LEADER'),
(158, 'Tiketing (Pengajuan tiket all departemen, pemotongan gaji, dan cuti tahunan karyawan)', 'COMBEN', '0', 'Kesalahan', 'GROUP LEADER'),
(159, 'Personal data SS6', 'COMBEN', '100%', 'Pencapaian', 'GROUP LEADER'),
(160, 'Leadtime Personal Administrasi (BPJS TK dan BPJS Kesehatan)', 'COMBEN', '100%', 'Pencapaian', 'GROUP LEADER'),
(161, 'Kelengkapan dan keakuratan Data (OM & PA SAP HCM)', 'COMBEN', '100%', 'Pencapaian', 'GROUP LEADER'),
(162, 'Surat Peringatan/Surat Teguran', 'COMBEN', '0', 'Peringatan/Teguran', 'GROUP LEADER'),
(163, 'SAP', 'COMBEN', '100%', 'Pencapaian', 'GROUP LEADER'),
(164, 'ATR', 'COMBEN', '100%', 'ATR', 'GROUP LEADER'),
(165, 'Kehadiran Jumlah Kasus Indisipliner (Investigasi dan Penindakan)', 'IR', '100%', 'Pelaporan/Bulan', 'GROUP LEADER'),
(166, 'Employee Gathering Program', 'IR', '2', 'Pelaksanaan/Tahun', 'GROUP LEADER'),
(167, 'Monitoring SIA', 'IR', '98,5%', 'Pelaporan/Bulan', 'GROUP LEADER'),
(168, 'Terminated Karyawan', 'IR', '100%', 'Pelaporan/Bulan', 'GROUP LEADER'),
(169, 'Turn Over Staff/Non Staff', 'IR', '2%', 'Turn Over', 'GROUP LEADER'),
(170, 'Administrasi Kontrak Karyawan', 'IR', '100%', 'Akurat & Tepat Waktu', 'GROUP LEADER'),
(171, 'Monitoring Absensi Tidak Sesuai Device', 'IR', '100%', 'Pelaporan/Bulan', 'GROUP LEADER'),
(172, 'Monitoring Karyawan Dirumahkan', 'IR', '100%', 'Pelaporan/Bulan', 'GROUP LEADER'),
(173, 'Surat Peringatan/Surat Teguran', 'IR', '0', 'Peringatan/Teguran', 'GROUP LEADER'),
(174, 'Sosialisasi Peraturan Perusahaan', 'IR', '2', 'Pelaksanaan/Tahun', 'GROUP LEADER'),
(175, 'Engagement Survey', 'IR', '1', 'Pelaksanaan/Tahun', 'GROUP LEADER'),
(176, 'SAP', 'IR', '100%', 'Pencapaian', 'GROUP LEADER'),
(177, 'ATR', 'IR', '100%', 'ATR', 'GROUP LEADER'),
(178, 'Pemenuhan Kebutuhan Karyawan', 'REKRUT', 'Freshgraduate (4), Experience (6)', 'Minggu', 'GROUP LEADER'),
(179, 'Manpower Planning', 'REKRUT', '100%', 'Ketercapaian', 'GROUP LEADER'),
(180, 'Karyawan Mutasi Out/In', 'REKRUT', '15', 'Hari', 'GROUP LEADER'),
(181, 'Surat Peringatan/Surat Teguran', 'REKRUT', '0', 'Peringatan/Teguran', 'GROUP LEADER'),
(182, 'SAP', 'REKRUT', '100%', 'Pencapaian', 'GROUP LEADER'),
(183, 'ATR', 'REKRUT', '100%', 'ATR', 'GROUP LEADER'),
(184, 'Program Pelatihan TSP, Unscheduled & K3PLM', 'TND', '90%', 'Pencapaian', 'GROUP LEADER'),
(185, 'Peserta Pelatihan TSP, Unscheduled & K3PLM', 'TND', '90%', 'Pencapaian', 'GROUP LEADER'),
(186, 'Evaluasi Atasan', 'TND', '90%', 'Pencapaian', 'GROUP LEADER'),
(187, 'Pembinaan dan Pengembangan PLDP', 'TND', '90%', 'Kelulusan', 'GROUP LEADER'),
(188, 'Manhours Training Staff', 'TND', '3,5', 'Jam/Bulan', 'GROUP LEADER'),
(189, 'Surat Peringatan/Surat Teguran', 'TND', '0', 'Peringatan/Teguran', 'GROUP LEADER'),
(190, 'SAP', 'TND', '100%', 'Pencapaian', 'GROUP LEADER'),
(191, 'ATR', 'TND', '100%', 'ATR', 'GROUP LEADER'),
(192, 'Pelatihan Internal K3PLM Staff HCGA', 'TND', '1', 'Pelatihan', 'GROUP LEADER'),
(193, 'Pelatihan Internal K3PLM Staff HCGA', 'IR', '1', 'Pelatihan', 'GROUP LEADER'),
(194, 'Pelatihan Internal K3PLM Staff HCGA', 'REKRUT', '1', 'Pelatihan', 'GROUP LEADER'),
(195, 'Pelatihan Internal K3PLM Staff HCGA', 'COMBEN', '1', 'Pelatihan', 'GROUP LEADER'),
(196, 'Improvement dan Inovasi', 'TND', '1', 'QCP', 'GROUP LEADER'),
(197, 'Improvement dan Inovasi', 'IR', '1', 'QCP', 'GROUP LEADER'),
(198, 'Improvement dan Inovasi', 'REKRUT', '1', 'QCP', 'GROUP LEADER'),
(199, 'Improvement dan Inovasi', 'COMBEN', '1', 'QCP', 'GROUP LEADER'),
(200, '1.1 Melakukan input data sesuai dengan peruntukan data tersebut', 'COMBEN', '100%', 'Pencapaian', 'ADMIN'),
(201, '1.2 Memeriksa Apakah Data yang Didapat Sudah Sesuai', 'COMBEN', '100%', 'Pencapaian', 'ADMIN'),
(202, '1.3 Penyimpanan berkas sesuai dengan aturan yang di tentukan', 'COMBEN', '100%', 'Pencapaian', 'ADMIN'),
(203, '1.4 Dapat memberikan data yang diminta oleh atasan dengan tepat', 'COMBEN', '100%', 'Pencapaian', 'ADMIN'),
(204, '1.5 Melakukan pembaharuan data setiap harinya', 'COMBEN', '100%', 'Pencapaian', 'ADMIN'),
(205, '1.6 Memberikan informasi yang benar kepada karyawan terkait data yang diminta', 'COMBEN', '100%', 'Pencapaian', 'ADMIN'),
(206, '1.7 Menjaga kerahasiaan data sensitif karyawan', 'COMBEN', '0', 'Data Tersebar', 'ADMIN'),
(207, '1.8 Menjaga kebersihan wilayah kerjanya', 'COMBEN', '0', 'Temuan', 'ADMIN'),
(208, '1.9 ST / SP adalah surat yang diberikan perusahaan kepada karyawan yang melakukan pelanggaran', 'COMBEN', '0', 'Peringatan/Teguran', 'ADMIN'),
(209, '1.10 Attendence Ratio adalah persentase kehadiran dengan minimal 98,5%', 'COMBEN', '98,5%', 'ATR', 'ADMIN'),
(210, '1.1 Melakukan input data sesuai dengan peruntukan data tersebut', 'REKRUT', '100%', 'Pencapaian', 'ADMIN'),
(211, '1.2 Memeriksa Apakah Data yang Didapat Sudah Sesuai', 'REKRUT', '100%', 'Pencapaian', 'ADMIN'),
(212, '1.3 Penyimpanan berkas sesuai dengan aturan yang di tentukan', 'REKRUT', '100%', 'Pencapaian', 'ADMIN'),
(213, '1.4 Dapat memberikan data yang diminta oleh atasan dengan tepat', 'REKRUT', '100%', 'Pencapaian', 'ADMIN'),
(214, '1.5 Melakukan pembaharuan data setiap harinya', 'REKRUT', '100%', 'Pencapaian', 'ADMIN'),
(215, '1.6 Memberikan informasi yang benar kepada karyawan terkait data yang diminta', 'REKRUT', '100%', 'Pencapaian', 'ADMIN'),
(216, '1.7 Menjaga kerahasiaan data sensitif karyawan', 'REKRUT', '0', 'Data Tersebar', 'ADMIN'),
(217, '1.8 Menjaga kebersihan wilayah kerjanya', 'REKRUT', '0', 'Temuan', 'ADMIN'),
(218, '1.9 ST / SP adalah surat yang diberikan perusahaan kepada karyawan yang melakukan pelanggaran', 'REKRUT', '0', 'Peringatan/Teguran', 'ADMIN'),
(219, '1.10 Attendence Ratio adalah persentase kehadiran dengan minimal 98,5%', 'REKRUT', '98,5%', 'ATR', 'ADMIN'),
(220, '1.1 Melakukan input data sesuai dengan peruntukan data tersebut', 'IR', '100%', 'Pencapaian', 'ADMIN'),
(221, '1.2 Memeriksa Apakah Data yang Didapat Sudah Sesuai', 'IR', '100%', 'Pencapaian', 'ADMIN'),
(222, '1.3 Penyimpanan berkas sesuai dengan aturan yang di tentukan', 'IR', '100%', 'Pencapaian', 'ADMIN'),
(223, '1.4 Dapat memberikan data yang diminta oleh atasan dengan tepat', 'IR', '100%', 'Pencapaian', 'ADMIN'),
(224, '1.5 Melakukan pembaharuan data setiap harinya', 'IR', '100%', 'Pencapaian', 'ADMIN'),
(225, '1.6 Memberikan informasi yang benar kepada karyawan terkait data yang diminta', 'IR', '100%', 'Pencapaian', 'ADMIN'),
(226, '1.7 Menjaga kerahasiaan data sensitif karyawan', 'IR', '0', 'Data Tersebar', 'ADMIN'),
(227, '1.8 Menjaga kebersihan wilayah kerjanya', 'IR', '0', 'Temuan', 'ADMIN'),
(228, '1.9 ST / SP adalah surat yang diberikan perusahaan kepada karyawan yang melakukan pelanggaran', 'IR', '0', 'Peringatan/Teguran', 'ADMIN'),
(229, '1.10 Attendence Ratio adalah persentase kehadiran dengan minimal 98,5%', 'IR', '98,5%', 'ATR', 'ADMIN'),
(230, '1.1 Melakukan input data sesuai dengan peruntukan data tersebut', 'TND', '100%', 'Pencapaian', 'ADMIN'),
(231, '1.2 Membantu persiapan agenda kegiatan', 'TND', '100%', 'Pencapaian', 'ADMIN'),
(232, '1.3 Penyimpanan berkas sesuai dengan aturan yang di tentukan', 'TND', '100%', 'Pencapaian', 'ADMIN'),
(233, '1.4 Dapat memberikan data yang diminta oleh atasan dengan tepat', 'TND', '100%', 'Pencapaian', 'ADMIN'),
(234, '1.5 Melakukan pembaharuan data setiap harinya', 'TND', '100%', 'Pencapaian', 'ADMIN'),
(235, '1.6 Memberikan informasi yang benar kepada karyawan terkait data yang diminta', 'TND', '100%', 'Pencapaian', 'ADMIN'),
(236, '1.7 Menjaga kerahasiaan data sensitif karyawan', 'TND', '0', 'Data Tersebar', 'ADMIN'),
(237, '1.8 Menjaga kebersihan wilayah kerjanya', 'TND', '0', 'Temuan', 'ADMIN'),
(238, '1.9 ST / SP adalah surat yang diberikan perusahaan kepada karyawan yang melakukan pelanggaran', 'TND', '0', 'Peringatan/Teguran', 'ADMIN'),
(239, '1.10 Attendence Ratio adalah persentase kehadiran dengan minimal 98,5%', 'TND', '98,5%', 'ATR', 'ADMIN'),
(241, 'Manhours Training Staff HC', 'TND', '3,5', 'Jam/Bulan', 'GROUP LEADER'),
(242, 'Pemenuhan Sertifikasi MSDM HC (MK > 1 TH)', 'TND', '1', 'Pencapaian', 'GROUP LEADER'),
(243, 'Overtime Rasio (OTR)  PPA & Labour Supply', 'COMBEN', '100%', 'Pelaporan', 'GROUP LEADER');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamuskpi_generals`
--

CREATE TABLE `kamuskpi_generals` (
  `id` int(11) NOT NULL,
  `area_kinerja_utama` varchar(255) NOT NULL,
  `subdivisi` enum('COMBEN','REKRUT','TND','IR','ALL') NOT NULL,
  `baris` int(11) DEFAULT NULL,
  `kategori` enum('GROUP LEADER','ADMIN') NOT NULL DEFAULT 'GROUP LEADER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kamuskpi_generals`
--

INSERT INTO `kamuskpi_generals` (`id`, `area_kinerja_utama`, `subdivisi`, `baris`, `kategori`) VALUES
(1, 'Reimbursement', 'COMBEN', 1, 'GROUP LEADER'),
(2, 'Personal Administrasi', 'COMBEN', 2, 'GROUP LEADER'),
(3, 'Data OM & PA SAP HCM', 'COMBEN', 3, 'GROUP LEADER'),
(4, 'Surat Peringatan', 'COMBEN', 6, 'GROUP LEADER'),
(5, 'Attendence Ratio', 'COMBEN', 7, 'GROUP LEADER'),
(6, 'Safety Accuntability Program', 'COMBEN', 8, 'GROUP LEADER'),
(15, 'Pemenuhan kebutuhan karyawan', 'REKRUT', 1, 'GROUP LEADER'),
(16, 'Manpower Planning', 'REKRUT', 2, 'GROUP LEADER'),
(17, 'Leadtime Employee Transfer', 'REKRUT', 3, 'GROUP LEADER'),
(18, 'Surat Peringatan (SP)', 'REKRUT', 5, 'GROUP LEADER'),
(19, 'Attendence Ratio (ATR)', 'REKRUT', 6, 'GROUP LEADER'),
(20, 'Safety Accuntability Program (SAP)', 'REKRUT', 7, 'GROUP LEADER'),
(21, 'Training Master Plan', 'TND', 1, 'GROUP LEADER'),
(23, 'Evaluasi training', 'TND', 2, 'GROUP LEADER'),
(24, 'Pembinaan dan  pengembangan PLDP', 'TND', 3, 'GROUP LEADER'),
(25, 'Pemenuhan Training  Man Hour', 'TND', 4, 'GROUP LEADER'),
(26, 'Development', 'TND', 5, 'GROUP LEADER'),
(27, 'Surat Peringatan', 'TND', 7, 'GROUP LEADER'),
(28, 'Attendence Ratio', 'TND', 8, 'GROUP LEADER'),
(29, 'Safety Accuntability Program', 'TND', 9, 'GROUP LEADER'),
(36, 'Disiplin Karyawan', 'IR', 1, 'GROUP LEADER'),
(37, 'Penyelesaian kasus  kedisiplinan', 'IR', 2, 'GROUP LEADER'),
(38, 'Turn Over', 'IR', 3, 'GROUP LEADER'),
(39, 'Administrasi kontrak karyawan', 'IR', 5, 'GROUP LEADER'),
(40, 'Pengelolaan Hubungan  Industrial', 'IR', 4, 'GROUP LEADER'),
(41, 'Safety Accuntability Program', 'IR', 10, 'GROUP LEADER'),
(42, 'Attendence Ratio', 'IR', 9, 'GROUP LEADER'),
(43, 'Surat Peringatan', 'IR', 8, 'GROUP LEADER'),
(45, 'Administration Melakukan proses administrasi atau pengiputan data yang diberikan', 'ALL', 1, 'ADMIN'),
(46, 'Information Memberikan karyawan informasi yang di butuhkan dan menjaga kerahasiaan informasi', 'ALL', 2, 'ADMIN'),
(47, '5R Penerapan 5R dalam kegiatan administrasi', 'ALL', 3, 'ADMIN'),
(48, 'Surat Peringatan (SP)', 'ALL', 4, 'ADMIN'),
(49, 'Attendence Ratio (ATR)', 'ALL', 5, 'ADMIN'),
(50, 'Improvement dan Innovasi', 'TND', 6, 'GROUP LEADER'),
(51, 'Improvement dan Innovasi', 'REKRUT', 4, 'GROUP LEADER'),
(53, 'Improvement dan Innovasi', 'COMBEN', 5, 'GROUP LEADER'),
(54, 'Overtime Rasio (OTR)  PPA & Labour Supply', 'COMBEN', 4, 'GROUP LEADER'),
(56, 'Engagement Survey', 'IR', 6, 'GROUP LEADER'),
(57, 'Improvement dan Innovasi', 'IR', 7, 'GROUP LEADER'),
(58, 'Pelatihan Karyawan', 'ALL', 6, 'ADMIN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `key_performance_indicator_items`
--

CREATE TABLE `key_performance_indicator_items` (
  `id` int(11) NOT NULL,
  `id_kamus_general` int(11) NOT NULL,
  `indicator` text NOT NULL,
  `bobot` int(11) NOT NULL,
  `target` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `key_performance_indicator_items`
--

INSERT INTO `key_performance_indicator_items` (`id`, `id_kamus_general`, `indicator`, `bobot`, `target`) VALUES
(1, 1, '- Rawat Jalan = 10 hari kalender@\r\n- Rawat Inap (reimbursement) = 30 hari kalender@\r\n- Perjalanan dinas & deklarasi = 7 hari kalender', 20, '- 10 hari@\r\n- 30 hari@\r\n- 7 hari@'),
(2, 2, '- Dokumen untuk karyawan new hire H-7@\r\n- Dokumen untuk karyawan terminasi H+1', 15, 'H-7 hari - Karyawan baru@\r\nH+1 hari - Terminasi'),
(3, 3, '- 100% Lengkap@\r\n- Laporan kelengkapan dan keakuratan OM &@\r\nPA ke HCGA HO (monthly)', 20, '100%'),
(4, 4, '0', 10, '0%'),
(5, 5, 'Minimal 98,5%', 5, '98,50%'),
(6, 6, 'Minimal 95%', 5, '95%'),
(7, 15, 'Jumlah hari rata-rata pemenuhan kebutuhan karyawan@\r\nmulai dari tanggal permintaan sampai dengan tandatangan kontrak', 30, 'Bintang 1: rata-rata >90 hari@\r\nBintang 2: rata-rata 61 - 90 hari@\r\nBintang 3: rata-rata 50 - 60 hari@\r\nBintang 4: rata-rata 40 - 49 hari@\r\nBintang 5: rata-rata <40 hari'),
(9, 16, 'Deviasi realisasi manpower terhadap Q-plan (average)', 30, 'Bintang 1: penyimpangan +/- >20%@\r\nBintang 2: penyimpangan +/- 11% -20%@\r\nBintang 3: penyimpangan +/- 6% - 10%@\r\nBintang 4: penyimpangan +/- 2.6% - 5.9%@\r\nBintang 5: penyimpangan +/- 0% - 2.5%'),
(10, 17, 'Jumlah rata-rata penyelesaian mutasi setelah karyawan@\r\nonsite pasca permintaan mutasi melalui email', 15, '15 hari calender (setelah karyawan onsite pasca permintaan mutasi melalui email)'),
(11, 18, 'Surat Peringatan', 10, '0%'),
(12, 19, 'Persentase ATR', 5, '98,50%'),
(13, 20, 'Pencapaian SAP', 5, '95%'),
(14, 21, 'Annual Training Master Plan - Peserta', 15, '90% Terealisasi'),
(15, 21, 'Annual Training Master Plan - Program', 15, '90% Terealisasi'),
(18, 23, 'Efektivitas Pelatihan', 10, '90% Terealisasi'),
(19, 24, 'Monitoring pembinaan dan pengembangan \r\nPLDP', 10, '- Kelulusan kurang dari 90% : Bintang 1/60%@\r\n- Kelulusan 90% s/d 99%: Bintang 2/70%@\r\n- Kelulusan 100% dalam maksimal 12 bulan : Bintang 3/80%@ \r\n- Kelulusan 100% dalam maksimal 10 bulan : Bintang 4/90%@ \r\n- Kelulusan 100% dalam maksimal 8 bulan : Bintang 5/100%'),
(20, 25, 'Jumlah Jam Pemenuhan Pelatihan Staff keatas', 10, '\'<30 jam : Bintang 1/79%@\r\n30 s/d 39 jam : Bintang 2/ 80%@\r\n40 s/d 50 jam : Bintang 3/91%@\r\n51 s/d 60 jam : Bintang 4/101%@\r\n>60 jam : Bintang 5/111%'),
(21, 26, 'Pemenuhan Sertifikasi MSDM HC (MK > 1 TH)', 10, '<60% : Bintang 1/79%@\r\n60% s/d 69% : Bintang 2/ 80%@\r\n70% s/d 79% : Bintang 3/91%@\r\n80% s/d 99% : Bintang 4/101%@\r\n100% : Bintang 5/111%'),
(22, 27, 'Surat Peringatan', 10, '0'),
(23, 28, 'Persentase ATR', 5, '98,50%'),
(24, 29, 'Pencapaian SAP', 5, '95%'),
(27, 36, 'Tingkat kehadiran karyawan/ ATR', 10, 'Bintang 1: <95%@\r\nBintang 2: 95.0% - 96.9%@\r\nBintang 3: 97.0% - 98.4%@\r\nBintang 4: 98.5% - 99.0%@\r\nBintang 5: >99.0%'),
(28, 37, 'Dispute Management', 15, '0 Kasus'),
(29, 38, 'Trun Over Karyawan staff resign', 5, '2%'),
(30, 38, 'Trun Over Karyawan staff under performed', 5, '2%'),
(31, 38, 'Trun Over Karyawan Non staff resign', 5, '2%'),
(32, 39, 'Leadtime employee contract admin', 10, '100% akurat dan tepat waktu'),
(33, 40, 'Employee Gathering Program', 10, '1/tahun'),
(34, 41, 'Pencapaian SAP', 5, '95%'),
(35, 42, 'Persentase ATR', 5, '98,5%'),
(36, 43, 'Surat Peringatan', 10, '0'),
(38, 45, 'Melakukan input data sesuai dengan peruntukan data tersebut', 15, '100'),
(39, 45, 'Memeriksa apakah data yang di dapat sudah sesuai dengan ketentuan yang ada', 10, '100'),
(40, 45, 'Penyimpanan berkas sesuai dengan aturan yang di tentukan', 10, '100'),
(41, 45, 'Dapat memberikan data yang diminta oleh atasan dengan tepat', 10, '100'),
(42, 45, 'Melakukan pembaharuan data setiap harinya', 10, '100'),
(43, 46, 'Memberikan informasi yang benar kepada \r\nkaryawan terkait data yang diminta', 10, '100'),
(44, 46, 'Menjaga kerahasiaan data sensitif karyawan', 10, '0'),
(45, 47, 'Menjaga kebersihan wilayah kerjanya', 5, '0'),
(46, 48, 'SP adalah surat yang diberikan perusahaan kepada karyawan yang melakukan pelanggaran', 10, '0'),
(47, 49, 'Attendence Ratio adalah persentase kehadiran dengan minimal 98,5%', 5, '98,50%'),
(48, 25, 'Jumlah Jam Pemenuhan Pelatihan Staff HC  keatas', 5, '\'<30 jam : Bintang 1/79%@\r\n30 s/d 39 jam : Bintang 2/ 80%@\r\n40 s/d 50 jam : Bintang 3/91%@\r\n51 s/d 60 jam : Bintang 4/101%@\r\n>60 jam : Bintang 5/111%'),
(49, 50, 'Melaksanakan improvement dan invoasi di Area Kerja (QCP)', 5, '1 QCP/Tahun'),
(50, 51, 'Melaksanakan improvement dan invoasi di Area Kerja (QCP)', 5, '1 QCP/Tahun'),
(51, 53, 'Melaksanakan improvement dan invoasi di Area Kerja (QCP)', 5, '1 QCP/Tahun'),
(52, 54, 'Rasio perbandingan antara upah lembur dibanding upah pokok (rata-rata per bulan)', 20, 'Bintang 1: >1.73@\r\nBintang 2: 1.59 - 1.73@\r\nBintang 3: 1.30 - 1.58@\r\nBintang 4: 1.16 - 1.29@\r\nBintang 5: <1.16'),
(54, 40, 'Sosialisasi Peraturan Perusahaan', 8, '2/tahun'),
(55, 56, 'Pelaksanaan Engagement Survey', 8, '1/tahun (Maksimal bulan Mei tiap tahun)'),
(56, 57, 'Melaksanakan improvement dan invoasi di Area Kerja (QCP)', 5, '1 QCP/Tahun'),
(57, 58, 'Mengikuti pelatihan karyawan untuk non staff', 5, '1/Bulan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2024_01_14_091610_create_kamuskpi_table', 2),
(10, '2024_01_16_030352_create_kpicombens_table', 3),
(11, '2024_01_17_132715_add_userid_to_kamuskpi_table', 4),
(12, '2024_01_17_144303_add_column_to_kpicombens', 5),
(13, '2024_01_17_150825_create_periodes_table', 6),
(14, '2024_01_18_145419_create_kpicombens_table', 7),
(15, '2024_01_22_123744_create_laporankpis_table', 8),
(16, '2024_01_31_014025_create_kpirekrut_table', 9),
(19, '2024_01_31_033158_create_kpitnd_table', 10),
(22, '2024_02_01_053255_create_kpiir_table', 11),
(23, '2024_02_05_003913_create_laporankpirekruts_table', 12),
(24, '2024_02_05_012759_create_laporankpiirs_table', 13),
(25, '2024_02_05_012805_create_laporankpitnds_table', 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `periodes`
--

CREATE TABLE `periodes` (
  `id` int(11) NOT NULL,
  `periode` varchar(255) NOT NULL,
  `tanggal` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `periodes`
--

INSERT INTO `periodes` (`id`, `periode`, `tanggal`) VALUES
(1, 'Januari 2024', '2024-01-01'),
(2, 'Februari 2024', '2024-02-01'),
(4, 'Maret 2024', '2024-03-01'),
(5, 'April 2024', '2024-04-01'),
(8, 'Mei 2024', '2024-05-01'),
(9, 'Juni 2024', '2024-06-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_pencapaian_sf_gl_kpi_individu`
--

CREATE TABLE `rekap_pencapaian_sf_gl_kpi_individu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_kamus` int(11) DEFAULT NULL,
  `point_kpi` text NOT NULL,
  `periode` varchar(100) NOT NULL,
  `rata_rata_pencapaian_sf` double NOT NULL,
  `konversi_bintang` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekap_pencapaian_sf_gl_kpi_individu`
--

INSERT INTO `rekap_pencapaian_sf_gl_kpi_individu` (`id`, `id_user`, `id_kamus`, `point_kpi`, `periode`, `rata_rata_pencapaian_sf`, `konversi_bintang`) VALUES
(21, 67, 160, 'Leadtime Personal Administrasi (BPJS TK dan BPJS Kesehatan)', 'Januari 2024 - Juni 2024', 100, 'Bintang 3'),
(22, 67, 161, 'Kelengkapan dan keakuratan Data (OM & PA SAP HCM)', 'Januari 2024 - Juni 2024', 100, 'Bintang 3'),
(23, 67, 243, 'Overtime Rasio (OTR)  PPA & Labour Supply', 'Januari 2024 - Juni 2024', 100, 'Bintang 3'),
(44, 55, 242, 'Pemenuhan Sertifikasi MSDM HC (MK > 1 TH)', 'Januari 2024 - Juni 2024', 100, 'Bintang 3'),
(45, 55, 196, 'Improvement dan Inovasi', 'Januari 2024 - Juni 2024', 100, 'Bintang 3'),
(46, 55, 189, 'Surat Peringatan/Surat Teguran', 'Januari 2024 - Juni 2024', 100, 'Bintang 3'),
(47, 55, 191, 'ATR', 'Januari 2024 - Juni 2024', 107.33, 'Bintang 4'),
(48, 55, 192, 'Pelatihan Internal K3PLM Staff HCGA', 'Januari 2024 - Juni 2024', 100, 'Bintang 3'),
(49, 55, 191, 'ATR', 'Februari 2024 - April 2024', 107.33, 'Bintang 4'),
(50, 55, 191, 'ATR', 'Februari 2024 - Maret 2024', 105.5, 'Bintang 4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `section_kpi_generals`
--

CREATE TABLE `section_kpi_generals` (
  `id` int(11) NOT NULL,
  `total` double NOT NULL,
  `periode` varchar(100) NOT NULL,
  `periode_awal` varchar(100) DEFAULT NULL,
  `periode_akhir` varchar(100) DEFAULT NULL,
  `parameter` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `section_kpi_general_category_goal_items`
--

CREATE TABLE `section_kpi_general_category_goal_items` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `goal_name` varchar(255) NOT NULL,
  `metric_description` text NOT NULL,
  `metric_scale` text NOT NULL,
  `weight` double NOT NULL,
  `nilai_pencapaian_sf` double NOT NULL,
  `konversi_bintang` varchar(100) DEFAULT NULL,
  `filters` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `section_kpi_general_category_goal_items`
--

INSERT INTO `section_kpi_general_category_goal_items` (`id`, `id_category`, `goal_name`, `metric_description`, `metric_scale`, `weight`, `nilai_pencapaian_sf`, `konversi_bintang`, `filters`) VALUES
(243, 369, 'Sas', 'Sas', 'Sas', 2, 4, 'Bintang 1', '[[\"COMBEN\",[1],\"undefined\"]]'),
(244, 370, '', '', '', 0, 0, 'Bintang 1', '[[\"REKRUT\",[1],\"undefined\"]]'),
(245, 371, '', '', '', 0, 76.67, 'Bintang 1', '[[\"ALL TEAM\",[0],\"Surat Peringatan\"]]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `section_kpi_general_category_items`
--

CREATE TABLE `section_kpi_general_category_items` (
  `id` int(11) NOT NULL,
  `id_section_kpi` int(11) NOT NULL,
  `bsc_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `section_kpi_general_category_items`
--

INSERT INTO `section_kpi_general_category_items` (`id`, `id_section_kpi`, `bsc_category`) VALUES
(369, 242, 'Sas'),
(370, 243, ''),
(371, 244, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nrp` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `subdivisi` enum('COMBEN','REKRUT','TND','IR') DEFAULT NULL,
  `kategori` enum('MASTER','SECTION','GROUP LEADER','ADMIN') NOT NULL DEFAULT 'ADMIN',
  `foto_profil` varchar(255) NOT NULL DEFAULT 'default.png',
  `ttd` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `nrp`, `password`, `subdivisi`, `kategori`, `foto_profil`, `ttd`) VALUES
(1, 'MR.D', 'masterdev', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'MASTER', 'ZN9rGMJ1afnSbdFsG9bNK6YkEj4Q9WVeuYSaMft2.png', '7WQ2swKwxfPkwg9ABVWCeNxHAiLD1Pl9DQZi2eTj.png'),
(55, 'MUHAMMAD RAMADANI', '24000570', '$2y$12$Mb3/CqdMNBIdPXJmkA/FweluiMdM1WjZ.ZZYtZ8gjsRhCRELDPkFK', 'TND', 'GROUP LEADER', 'x6bWzrBaCZFRMwIx0Cu7eX53V6ulxgiYWo2jPMc3.png', '0zB7hAaBKGr73Bf6qFgMwfsR4LonlX9w2xhcMtxp.png'),
(56, 'Dhani', '42220743', '$2y$12$p.pnbjLleF.pchV5arCMTea0A0a6hkDBx/PjmnqfltZHUipRZXDde', 'TND', 'ADMIN', 'default.png', 'default.png'),
(57, 'NOVAN HERDIANTO', '21002274', '$2y$12$bSnXY3VdpYHvMjq5S6B7COUB3H1Slz4GuOVpf77OW83QQBEq7PEaG', NULL, 'SECTION', 'OjUArz2zZUo2CtBTNoNaYmEJ6TJvm0HzmwOKQn21.png', '3VlQX2lyxVgizOqjqPskvEIlt7E2Vndt6ObuCXTJ.jpg'),
(58, 'ALDE KRISDIANTO', '13030420', '$2y$12$wwlo.oLWdCWs8T.8tFglOucRPSib9TAVAFkKYZYtmDheX7y5VQhVK', 'REKRUT', 'GROUP LEADER', 'Llcw5gVedrwpHM7W0I81RZ2c14fhwyh25C8zpq6t.png', 'default.png'),
(59, 'NOOR THOYIBAH APRILIANA', '22002821', '$2y$12$4td4haWfEe2Tiu9cyaEce./dXMXzaigMB7yO8eINVE8yBRVjCsEqK', 'TND', 'GROUP LEADER', '3XQmtq1njbOgIIIJC6XJoUTQHD88vukNlOM9uGoh.jpg', 'default.png'),
(60, 'EGI FARHAN NUGRAHA', '22001013', '$2y$12$aMTU6.pzNGOlB9cuFYJ1debFDElan/1ea053Ejbja6NjHgi5uI496', 'TND', 'GROUP LEADER', 'mOJNR9kV8CVHDhhj2pFjPdRXpi3LkDU1cO42TTxA.png', 'R2SHkDkHpMEHT6IRht53TbByD1h2lk2PpCVObeNM.png'),
(61, 'NOVIA SATYA ARIYANTI', '22002798', '$2y$12$sjj6tEDrLtHIPxvzl.QGDeY7Qmyg4OsOw1Yve2GyB3DofKmIrOWQ6', 'REKRUT', 'GROUP LEADER', 'yvPvenDOagvohRuWCeUyNtoPHuBkfK3CGRycHIfB.jpg', 'default.png'),
(62, 'FARAH AULIA DAMAYANTI', '23003062', '$2y$12$c5S5C103ZROP6.vlJ3XWCeUc8eT01kzrGfhODI9lkX3QYAbZU0svC', 'REKRUT', 'GROUP LEADER', 'lZjhHp60k5ZHYkSwafIPLl2LkMSspYiRySGcKzRN.jpg', 'gdXMmE5IDY3OcHSR77XDb11sDJgo0JgLOluphDiN.png'),
(63, 'AMELIA RACHMAN', '21002598', '$2y$12$m5IWCFiqTKM.al0SpsISTul.33oZQVj2NPnxAz67d1kVlT5/rLfPu', 'IR', 'GROUP LEADER', 'INM0TOcpt0Z1ipTYmZaXwmbybyZ4hgpDOcrKhBko.jpg', 'default.png'),
(64, 'RIKI WIRANTO', '22000383', '$2y$12$5rSLVXyTKUkQ66zfhB13v.ptTHPjsmQgwI4muv5DP5G17tGRn.pK2', 'IR', 'GROUP LEADER', 't91KQ2p4sVhqSyb1ABnnVCxLGxzn3U41UUSb73gD.png', 'default.png'),
(65, 'ILHAM ZULCHOIRI. S', '22001052', '$2y$12$joop2dBNqOqkoJUhXFsp3uwizsnLC/Bst1CpKsdY.PcKp58W825EC', 'IR', 'GROUP LEADER', 'O4xVLvlIMSxvJynLzvGdWUACArTv8nRFn9EfwJmZ.png', 'default.png'),
(66, 'BENEDICTUS ADITYA G.', '21001933', '$2y$12$tGNi8TwpnCF6KGd4NkeHBeELInCpN9oYXa4rbAxvFxXuLAVSDpC1O', 'COMBEN', 'GROUP LEADER', '9SpOgzGpyncuOHqtxkPjRBz2p4zw8zJc0f50L2ou.png', 'default.png'),
(67, 'AGUS SETYONO', '18064303', '$2y$12$2FlfPAt1zkcvVQs2MyrXE.Swz3Ck0TjjldsGZUN0ml8HpqOvWFa0C', 'COMBEN', 'GROUP LEADER', '6cC2lSvgqLL8n9TGWNu2jkKt6gFWOeb5jwfuJQwT.png', '9YR8cgkr4hAydWtnJ4UoJl9yN0RQR7c3mI2ZBbDO.jpg'),
(68, 'YUNI ARIFIANI', '22002270', '$2y$12$UiG6yzEyKJ2kl2jgvalUzOYDRAY1PpYsP11StZbA6zCC8Iph7k45e', 'COMBEN', 'GROUP LEADER', 'WJEpii8CoWoxYDS4BwgnB2qNjW7bF7yPgpsvSQ95.jpg', 'default.png'),
(69, 'SOPIA FAUZIA', '23002571', '$2y$12$ABQDh19lfDhQ5ApH8cSYFu5PEmdpP2CQAwlk8AXZpSOJXyM2a/OKe', 'COMBEN', 'GROUP LEADER', 'wLULXmVQCNUqcpcSChvkqGxYv4Hpdh7VXgX63ckd.jpg', 'default.png'),
(70, 'LOOKMAN ADIYANTO', '16081485', '$2y$12$Vr8iokV410BuZuaxdzV0ZOR17/ZxoWjLMcQeN8pfLgMfRB9CNKKsm', 'COMBEN', 'ADMIN', 'njR79CAtgFVDleHpfJC44uJHFnOcJ6UZBDOk4dye.png', 'default.png'),
(71, 'ILHAM NUARI', '210129', '$2y$12$002FZXZaM2Oznnuf/Tr9Je75nb3S96C9omFwBO8VOp3yazAx6uAmK', 'COMBEN', 'ADMIN', 'UpVtETtOhVYtAnxgyCbxDWH0GUWcetLclSYJ5Y2l.png', 'Q0oQcwMhKDm1uLzRuQL1aujxelJUxaORdJjDiGvf.jpg'),
(72, 'ANDRI ANDIKA FAIZA A.', '42221220', '$2y$12$9q54sYO3xxCmAil/RYBVtu5/K0yANTgOtA0zUvMAqy3q7D4scJi/G', 'COMBEN', 'ADMIN', 'DrxPa4IjqE6TZJtju7OnTusLljeiCLK7x85zrPEJ.jpg', 'I7xcCI6NuiSFoxBGhvxZfgYdXCGzsJygYTWzWqhe.png'),
(73, 'TRI YANTI', '42241513', '$2y$12$BNVB.Fd8IewsTGgqg1lvVO/47lerRcNpo6DICeLySvXV11NXM53Vq', 'REKRUT', 'ADMIN', 'wuadUk750cf4PvpncbLAK2MBAp3mfJa3dMwsj0Px.jpg', 'default.png'),
(74, 'APRILIA WULANDARI', '42221258', '$2y$12$RmpDpQgmX97dwG50Z/NI9eWbxw6T7lfkcJ8rE32nwqlt6heO8AasS', 'REKRUT', 'ADMIN', 'RZXoHVK3etEoGyybRaoXtXx3iBNKq0l1Yqjz0bgL.jpg', 'vuPYA4IEF7Mbfk1CD4UDwtRdAs0zdf6OiJIVTjPQ.jpg'),
(75, 'KIKI FATMAWATI', '42221234', '$2y$12$HXBpO1SJX0qEuvQ1G3mSZuKRAE.pkt5BM3rxLY0yn/Un6CBZghBuu', 'IR', 'ADMIN', '4vXA6wMLCOkBy76xh1czHl8JP5OEKgQxUttzJwct.jpg', '1DTpSxpCVTxQ3RITJC5IdBcE3Xmo8mdl6xgGy3ur.png'),
(76, 'MAHDALENA PRATIWI', '42220733', '$2y$12$wQEeZnRL6g0CPfjXng2L6u41njz8zfMNKXqC10sgaxpSEnUgD68b.', 'COMBEN', 'ADMIN', 'rUMomZuBsMlVfaFj6sGyw9Cmn0uRVXnApd8ds4w4.png', 'default.png'),
(77, 'LINDA MARLINA', '42220449', '$2y$12$DNX0HMaroTZxxERcGVJ7deb3NQnEF6J5yteuXeFM/p4nuRlOxuwvu', 'COMBEN', 'ADMIN', 'e7bG84PAxRZIxXjyv3vODCmVXMjlKR7vrTlYWkZJ.jpg', 'default.png'),
(78, 'ANGGI SURYA NATA', '42241540', '$2y$12$BarFnFxBw.PdvuufCCO8R.lhUkCLjs1tqIpujadBMQyq0lS7OZBHS', 'TND', 'ADMIN', 'kJFvLaYUrv6Jp0nVQWiUGk6kDJKIhutzKEs1sGqB.png', '2tVDFEMIkJ2ZAj7E1PzhiDJzNNujNMsHDRSzqAbL.png'),
(79, 'SYSTEM', 'systemhcga', '$2y$12$skZjaa8YkwFEAGc5s1mEHe3YjFzRSVTWEMtqh/ELSI5CUBFOphqdW', NULL, 'SECTION', 'default.png', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_kpis`
--
ALTER TABLE `admin_kpis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kamus` (`id_kamus`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `admin_kpi_generals`
--
ALTER TABLE `admin_kpi_generals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_user_approve` (`id_user_approve`);

--
-- Indeks untuk tabel `admin_kpi_general_items`
--
ALTER TABLE `admin_kpi_general_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kpi_general` (`id_kpi_general`),
  ADD KEY `id_key_performance_indicator` (`id_key_performance_indicator`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `gl_kpis`
--
ALTER TABLE `gl_kpis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kamus` (`id_kamus`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indeks untuk tabel `gl_kpi_generals`
--
ALTER TABLE `gl_kpi_generals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indeks untuk tabel `gl_kpi_general_items`
--
ALTER TABLE `gl_kpi_general_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kpi_general` (`id_kpi_general`),
  ADD KEY `id_key_performance_indicator` (`id_key_performance_indicator`);

--
-- Indeks untuk tabel `kamuskpis`
--
ALTER TABLE `kamuskpis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kamuskpi_generals`
--
ALTER TABLE `kamuskpi_generals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `key_performance_indicator_items`
--
ALTER TABLE `key_performance_indicator_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kamus_general` (`id_kamus_general`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `periodes`
--
ALTER TABLE `periodes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `periode` (`periode`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `rekap_pencapaian_sf_gl_kpi_individu`
--
ALTER TABLE `rekap_pencapaian_sf_gl_kpi_individu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rekap` (`id_user`),
  ADD KEY `id_kamus` (`id_kamus`);

--
-- Indeks untuk tabel `section_kpi_generals`
--
ALTER TABLE `section_kpi_generals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `section_kpi_general_category_goal_items`
--
ALTER TABLE `section_kpi_general_category_goal_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Indeks untuk tabel `section_kpi_general_category_items`
--
ALTER TABLE `section_kpi_general_category_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_section_kpi` (`id_section_kpi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_kpis`
--
ALTER TABLE `admin_kpis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT untuk tabel `admin_kpi_generals`
--
ALTER TABLE `admin_kpi_generals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT untuk tabel `admin_kpi_general_items`
--
ALTER TABLE `admin_kpi_general_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=483;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gl_kpis`
--
ALTER TABLE `gl_kpis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;

--
-- AUTO_INCREMENT untuk tabel `gl_kpi_generals`
--
ALTER TABLE `gl_kpi_generals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT untuk tabel `gl_kpi_general_items`
--
ALTER TABLE `gl_kpi_general_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=548;

--
-- AUTO_INCREMENT untuk tabel `kamuskpis`
--
ALTER TABLE `kamuskpis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT untuk tabel `kamuskpi_generals`
--
ALTER TABLE `kamuskpi_generals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `key_performance_indicator_items`
--
ALTER TABLE `key_performance_indicator_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `periodes`
--
ALTER TABLE `periodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rekap_pencapaian_sf_gl_kpi_individu`
--
ALTER TABLE `rekap_pencapaian_sf_gl_kpi_individu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `section_kpi_generals`
--
ALTER TABLE `section_kpi_generals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT untuk tabel `section_kpi_general_category_goal_items`
--
ALTER TABLE `section_kpi_general_category_goal_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT untuk tabel `section_kpi_general_category_items`
--
ALTER TABLE `section_kpi_general_category_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=372;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin_kpis`
--
ALTER TABLE `admin_kpis`
  ADD CONSTRAINT `admin_kpis_ibfk_1` FOREIGN KEY (`id_kamus`) REFERENCES `kamuskpis` (`id`),
  ADD CONSTRAINT `admin_kpis_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `admin_kpi_generals`
--
ALTER TABLE `admin_kpi_generals`
  ADD CONSTRAINT `admin_kpi_generals_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `admin_kpi_generals_ibfk_2` FOREIGN KEY (`id_user_approve`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `admin_kpi_general_items`
--
ALTER TABLE `admin_kpi_general_items`
  ADD CONSTRAINT `admin_kpi_general_items_ibfk_1` FOREIGN KEY (`id_key_performance_indicator`) REFERENCES `key_performance_indicator_items` (`id`),
  ADD CONSTRAINT `admin_kpi_general_items_ibfk_2` FOREIGN KEY (`id_kpi_general`) REFERENCES `admin_kpi_generals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `gl_kpis`
--
ALTER TABLE `gl_kpis`
  ADD CONSTRAINT `gl_kpis_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periodes` (`id`),
  ADD CONSTRAINT `gl_kpis_ibfk_2` FOREIGN KEY (`id_kamus`) REFERENCES `kamuskpis` (`id`),
  ADD CONSTRAINT `gl_kpis_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `gl_kpi_generals`
--
ALTER TABLE `gl_kpi_generals`
  ADD CONSTRAINT `gl_kpi_generals_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periodes` (`id`),
  ADD CONSTRAINT `gl_kpi_generals_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `gl_kpi_general_items`
--
ALTER TABLE `gl_kpi_general_items`
  ADD CONSTRAINT `gl_kpi_general_items_ibfk_1` FOREIGN KEY (`id_kpi_general`) REFERENCES `gl_kpi_generals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gl_kpi_general_items_ibfk_2` FOREIGN KEY (`id_key_performance_indicator`) REFERENCES `key_performance_indicator_items` (`id`);

--
-- Ketidakleluasaan untuk tabel `key_performance_indicator_items`
--
ALTER TABLE `key_performance_indicator_items`
  ADD CONSTRAINT `key_performance_indicator_items_ibfk_1` FOREIGN KEY (`id_kamus_general`) REFERENCES `kamuskpi_generals` (`id`);

--
-- Ketidakleluasaan untuk tabel `rekap_pencapaian_sf_gl_kpi_individu`
--
ALTER TABLE `rekap_pencapaian_sf_gl_kpi_individu`
  ADD CONSTRAINT `rekap_pencapaian_sf_gl_kpi_individu_ibfk_1` FOREIGN KEY (`id_kamus`) REFERENCES `kamuskpis` (`id`),
  ADD CONSTRAINT `rekap_pencapaian_sf_gl_kpi_individu_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
