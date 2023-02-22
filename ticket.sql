-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Lut 2023, 19:05
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ticket`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `films`
--

CREATE TABLE `films` (
  `IDFilmu` int(11) NOT NULL,
  `Nazwa` text NOT NULL,
  `Opis` text NOT NULL,
  `imgUrl` text NOT NULL,
  `Data` date NOT NULL,
  `Godziny` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `films`
--

INSERT INTO `films` (`IDFilmu`, `Nazwa`, `Opis`, `imgUrl`, `Data`, `Godziny`) VALUES
(2, 'Avatar: Istota wody', 'Pandorę znów napada wroga korporacja w poszukiwaniu cennych minerałów. Jack i Neytiri wraz z rodziną zmuszeni są opuścić wioskę i szukać pomocy u innych plemion zamieszkujących planetę.', 'https://fwcdn.pl/fpo/81/78/558178/8047434.3.jpg', '2023-02-03', '12:00,12:45'),
(3, 'James Bond: skyfall', 'Lojalność agenta 007 wobec M zostaje wystawiona na próbę po ataku na siedzibę MI6 i kradzieży tajnych danych. Trop wiedzie do osoby z przeszłości szefowej brytyjskiego wywiadu.', 'https://fwcdn.pl/fpo/12/44/451244/7494882.3.jpg', '2023-02-01', '11:00,15:00'),
(4, 'Minionki', 'Minionki Kevin, Stuart, Bob oraz Otto muszą ratować młodego Gru, który popadł w konflikt z grupą super złoczyńców znaną jako Vicious 6.', 'https://as.repertuary.pl/images/dbimages/film_21702_original_1.jpg', '2023-02-03', '11:00,15:00'),
(5, 'Pulp Fiction', 'Przemoc i odkupienie w opowieści o dwóch płatnych mordercach pracujących na zlecenie mafii, żonie gangstera, bokserze i parze okradającej ludzi w restauracji.', 'https://static.posters.cz/image/750/plakaty/pulp-fiction-cover-i1288.jpg', '2023-02-01', '09:00,11:00'),
(6, 'Dunkierka', 'Wojska alianckie zostają przyparte do morza pod Dunkierką. Bitwa staje się sprawdzianem dla młodych żołnierzy, pilota RAF-u oraz załogi cywilnej łodzi płynącej przez Kanał La Manche.', 'https://fwcdn.pl/fpo/11/41/681141/7797814.3.jpg', '2023-02-10', '14:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacje`
--

CREATE TABLE `rezerwacje` (
  `IDRezerwacji` int(11) NOT NULL,
  `IDSeansu` int(11) NOT NULL,
  `Godzina` text NOT NULL,
  `Data` text NOT NULL,
  `Miejsca` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `rezerwacje`
--

INSERT INTO `rezerwacje` (`IDRezerwacji`, `IDSeansu`, `Godzina`, `Data`, `Miejsca`) VALUES
(6, 3, '15:00', '2023-02-01', '191,171'),
(7, 3, '15:00', '2023-02-01', '189,209,208'),
(8, 4, '11:00', '2023-02-01', '192,191'),
(9, 4, '11:00', '2023-02-01', '249,248,247');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `seanse`
--

CREATE TABLE `seanse` (
  `IDSeansu` int(11) NOT NULL,
  `IDFilmu` int(11) NOT NULL,
  `Godzina` text NOT NULL,
  `Data` date DEFAULT NULL,
  `miejsca` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `seanse`
--

INSERT INTO `seanse` (`IDSeansu`, `IDFilmu`, `Godzina`, `Data`, `miejsca`) VALUES
(1, 2, '12:00', '2023-02-03', '1,2,6,10'),
(2, 2, '12:45', '2023-02-03', ''),
(3, 3, '15:00', '2023-02-01', '292,291,290'),
(4, 3, '11:00', '2023-02-01', '300,299,192,191,249,248,247');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `LogIn` text NOT NULL,
  `Password` text NOT NULL,
  `Number` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`ID`, `LogIn`, `Password`, `Number`) VALUES
(1, 'admin', 'admin', '123123123'),
(2, 'admin2', 'admin2', '123123123');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`IDFilmu`);

--
-- Indeksy dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD PRIMARY KEY (`IDRezerwacji`),
  ADD KEY `IDFilmu` (`IDSeansu`),
  ADD KEY `IDSeansu` (`IDSeansu`);

--
-- Indeksy dla tabeli `seanse`
--
ALTER TABLE `seanse`
  ADD PRIMARY KEY (`IDSeansu`),
  ADD KEY `IDFilmu` (`IDFilmu`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `films`
--
ALTER TABLE `films`
  MODIFY `IDFilmu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  MODIFY `IDRezerwacji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `seanse`
--
ALTER TABLE `seanse`
  MODIFY `IDSeansu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD CONSTRAINT `rezerwacje_ibfk_1` FOREIGN KEY (`IDSeansu`) REFERENCES `seanse` (`IDSeansu`);

--
-- Ograniczenia dla tabeli `seanse`
--
ALTER TABLE `seanse`
  ADD CONSTRAINT `seanse_ibfk_1` FOREIGN KEY (`IDFilmu`) REFERENCES `films` (`IDFilmu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
