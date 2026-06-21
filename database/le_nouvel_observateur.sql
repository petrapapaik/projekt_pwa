-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2026 at 10:12 PM
-- Server version: 8.0.45
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `le_nouvel_observateur`
--

-- --------------------------------------------------------

--
-- Table structure for table `admini`
--

CREATE TABLE `admini` (
  `id_admin` int NOT NULL,
  `ime` varchar(50) COLLATE utf8mb4_croatian_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8mb4_croatian_ci NOT NULL,
  `korisnicko_ime` varchar(50) COLLATE utf8mb4_croatian_ci NOT NULL,
  `lozinka` varchar(255) COLLATE utf8mb4_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `admini`
--

INSERT INTO `admini` (`id_admin`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`) VALUES
(1, 'Petra', 'Papaik', 'admin', '$2y$12$EQ9O/J6Obyl7LmXpDqISIONB5wEjPr79CxdixiQLOOOF4h2J0FNIa'),
(2, 'Ivan', 'Horvat', 'urednik', '$2y$12$weI1hYuMu803Z/GDkm35Meb6KARDELbmE0Bau4PZQxdcd/8Vp34Lq');

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `id_kategorija` int NOT NULL,
  `naziv` varchar(100) COLLATE utf8mb4_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id_kategorija`, `naziv`) VALUES
(3, 'Glazba'),
(1, 'Politika'),
(2, 'Sport'),
(5, 'Tehnologija'),
(4, 'Umjetnost');

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id_vijest` int NOT NULL,
  `naslov` varchar(255) COLLATE utf8mb4_croatian_ci NOT NULL,
  `sazetak` text COLLATE utf8mb4_croatian_ci NOT NULL,
  `tekst` longtext COLLATE utf8mb4_croatian_ci NOT NULL,
  `slika` varchar(255) COLLATE utf8mb4_croatian_ci NOT NULL,
  `datum_objave` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_kategorija` int NOT NULL,
  `id_admin` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id_vijest`, `naslov`, `sazetak`, `tekst`, `slika`, `datum_objave`, `id_kategorija`, `id_admin`) VALUES
(1, 'Vlada predstavila novi paket mjera za stanovanje', 'Novi paket mjera trebao bi olakšati najam i kupnju prve nekretnine mladim obiteljima.', 'Vlada je predstavila novi paket mjera usmjeren na dostupnije stanovanje i stabilnije tržište najma. Program uključuje poticaje za izgradnju stanova, bolju regulaciju dugoročnog najma i posebne uvjete za mlade obitelji. Predstavnici ministarstva istaknuli su da je cilj smanjiti pritisak na velike gradove i potaknuti obnovu zapuštenih nekretnina u manjim sredinama. Stručnjaci upozoravaju da će rezultati ovisiti o brzini provedbe, ali se slažu da je tema stanovanja postala jedno od ključnih društvenih pitanja.', 'politika.jpg', '2026-06-11 09:15:00', 1, 1),
(2, 'Sabor raspravlja o reformi lokalne uprave', 'Zastupnici raspravljaju o prijedlogu kojim bi se pojednostavili postupci u općinama i gradovima.', 'U Saboru je otvorena rasprava o reformi lokalne uprave kojom se želi ubrzati rad javnih službi i smanjiti administrativno opterećenje građana. Prijedlog predviđa digitalizaciju dijela postupaka, jasnije rokove za odgovore tijela javne vlasti i veću transparentnost proračuna. Oporba traži dodatna jamstva da promjene neće ostati samo na formalnim odredbama, dok vladajući tvrde da reforma predstavlja važan korak prema učinkovitijoj državi.', 'politika2.jpg', '2026-06-10 14:30:00', 1, 2),
(3, 'Europski čelnici dogovorili zajednički energetski plan', 'Plan uključuje veća ulaganja u infrastrukturu i koordinaciju cijena energenata.', 'Nakon višesatnih pregovora europski čelnici usuglasili su okvir zajedničkog energetskog plana. Dokument naglašava potrebu za stabilnim opskrbnim pravcima, ulaganjem u obnovljive izvore energije i jačanjem međusobne solidarnosti u kriznim razdobljima. Analitičari smatraju da će provedba plana biti zahtjevna, ali važna za dugoročnu otpornost europskog gospodarstva.', 'politika3.jpg', '2026-06-09 18:05:00', 1, 1),
(4, 'Hrvatska reprezentacija ostvarila važnu pobjedu', 'Nogometaši Hrvatske slavili su u napetoj kvalifikacijskoj utakmici.', 'Hrvatska reprezentacija ostvarila je važnu pobjedu rezultatom 2:1 nakon utakmice pune preokreta i visokog ritma. Izbornik je nakon susreta posebno istaknuo disciplinu momčadi i reakciju igrača nakon primljenog pogotka. Navijači su ispunili stadion do posljednjeg mjesta, a atmosfera je, prema riječima igrača, bila jedan od ključnih razloga za energičnu završnicu.', 'sport.jpg', '2026-06-12 21:45:00', 2, 1),
(5, 'Košarkaški klub predstavio nova pojačanja', 'U klub su stigla tri nova igrača koji bi trebali ojačati rotaciju u novoj sezoni.', 'Košarkaški klub predstavio je tri nova pojačanja za nadolazeću sezonu. Uprava vjeruje da će dolasci donijeti potrebnu širinu i stabilnost u igri, osobito u završnicama utakmica. Trener je naglasio kako se momčad gradi planski, s naglaskom na brzu tranziciju i snažniju obranu. Navijači očekuju iskorak u domaćem prvenstvu i bolji rezultat u regionalnom natjecanju.', 'sport2.jpg', '2026-06-07 11:00:00', 2, 2),
(6, 'Tenisačica izborila finale turnira u Berlinu', 'Sjajnom igrom na travi stigla je do najvećeg rezultata sezone.', 'Hrvatska tenisačica izborila je finale turnira u Berlinu nakon uvjerljive pobjede u dva seta. Tijekom cijelog meča nametnula je agresivan ritam, dobro koristila prvi servis i preciznim izlascima na mrežu skraćivala poene. Finale će igrati protiv prve nositeljice, a stručnjaci ističu da je ovo njezin najbolji tjedan sezone.', 'sport3.jpg', '2026-06-06 17:20:00', 2, 1),
(7, 'Najavljen veliki ljetni glazbeni festival', 'Organizatori očekuju više od pedeset tisuća posjetitelja i nastupe poznatih izvođača.', 'Ovog ljeta održat će se jedan od najvećih glazbenih festivala u regiji. Program uključuje više pozornica, dnevne radionice i večernje koncerte domaćih i stranih izvođača. Organizatori najavljuju poseban naglasak na kvalitetu produkcije i sigurnost posjetitelja. Turistički sektor očekuje da će festival značajno pridonijeti predsezonskoj ponudi grada.', 'glazba.jpg', '2026-06-08 12:15:00', 3, 2),
(8, 'Mladi bend objavio album koji spaja pop i jazz', 'Debitantski album privukao je pažnju kritike zbog toplog zvuka i promišljenih aranžmana.', 'Mladi domaći bend objavio je debitantski album koji spaja pop melodije, jazz harmonije i intimne tekstove. Kritičari ističu da album zvuči zrelo i zaokruženo, a publika je posebno dobro prihvatila singl koji govori o odrastanju u gradu. Bend najavljuje jesensku koncertnu turneju po klubovima.', 'glazba2.jpg', '2026-06-05 10:40:00', 3, 1),
(9, 'Simfonijski orkestar otvara sezonu djelima hrvatskih skladatelja', 'Nova koncertna sezona počinje programom koji povezuje klasiku i suvremeni izraz.', 'Simfonijski orkestar novu sezonu otvara koncertom posvećenim hrvatskim skladateljima. Program povezuje poznata djela nacionalne glazbene baštine i nove skladbe mlađih autora. Ravnatelj orkestra istaknuo je da je cilj publici približiti širinu domaće glazbene scene i potaknuti interes za suvremenu ozbiljnu glazbu.', 'glazba3.jpg', '2026-06-04 19:00:00', 3, 2),
(10, 'Nova izložba suvremene umjetnosti otvorena u Zagrebu', 'Umjetnici iz cijele Europe predstavili su radove koji istražuju odnos prostora i identiteta.', 'U zagrebačkoj galeriji otvorena je nova izložba suvremene umjetnosti koja okuplja autore iz nekoliko europskih zemalja. Radovi se bave odnosom prostora, sjećanja i identiteta, a postav kombinira slike, skulpture i multimedijalne instalacije. Kustosica izložbe istaknula je da projekt poziva posjetitelje na sporije promatranje i osobnu interpretaciju izloženih radova.', 'umjetnost.jpg', '2026-06-10 16:10:00', 4, 2),
(11, 'Restaurirana povijesna palača ponovno otvorena za javnost', 'Obnova je trajala tri godine, a prostor će služiti za izložbe i kulturne programe.', 'Nakon opsežne restauracije javnosti je ponovno otvorena povijesna palača u središtu grada. Obnovljeni su zidni oslici, drveni podovi i reprezentativna dvorana, a prostor će se koristiti za izložbe, predavanja i komorne koncerte. Konzervatori naglašavaju da je projekt proveden s pažnjom prema izvornim materijalima i arhitektonskim detaljima.', 'umjetnost2.jpg', '2026-06-03 13:25:00', 4, 1),
(12, 'Ulični mural postao novo mjesto okupljanja građana', 'Veliki mural na pročelju škole privukao je pažnju prolaznika i lokalne zajednice.', 'Novi mural na pročelju škole pretvorio je zaboravljeni gradski kutak u mjesto susreta. Autorica rada kaže da je inspiraciju pronašla u svakodnevici kvarta i razgovorima s učenicima. Stanari ističu da je prostor postao ugodniji, a gradske službe najavljuju nastavak sličnih projekata u drugim četvrtima.', 'umjetnost3.jpg', '2026-06-01 08:50:00', 4, 2),
(13, 'Predstavljen novi električni automobil domaće proizvodnje', 'Tvrtka očekuje početak serijske proizvodnje sljedeće godine.', 'Domaća tehnološka tvrtka predstavila je novi električni automobil namijenjen gradskoj i međugradskoj vožnji. Vozilo donosi moderan dizajn, poboljšanu bateriju i napredne sustave pomoći vozaču. Predstavnici tvrtke ističu da je velik dio razvoja obavljen u Hrvatskoj, a početak serijske proizvodnje planiran je za sljedeću godinu.', 'teh.jpg', '2026-06-11 08:20:00', 5, 1),
(14, 'Digitalne usluge postaju prioritet javne uprave', 'Građanima će uskoro biti dostupne nove online usluge za svakodnevne administrativne postupke.', 'Javna uprava nastavlja proces digitalizacije uvođenjem novih online usluga. Građani će putem portala moći brže predavati zahtjeve, pratiti status predmeta i dobivati obavijesti bez dolaska na šaltere. Stručnjaci smatraju da je ključ uspjeha jednostavno korisničko sučelje i jasna podrška za građane koji se slabije snalaze u digitalnim alatima.', 'teh2.jpg', '2026-06-07 08:45:00', 5, 2),
(15, 'Startup iz Rijeke razvio sustav za pametno upravljanje energijom', 'Rješenje pomaže zgradama smanjiti potrošnju i bolje planirati troškove.', 'Riječki startup predstavio je sustav za pametno upravljanje energijom u poslovnim i stambenim zgradama. Platforma prikuplja podatke o potrošnji, predlaže optimizaciju i upozorava na neuobičajena odstupanja. Osnivači tvrde da korisnici već u prvim mjesecima mogu ostvariti značajne uštede, posebno u većim objektima s promjenjivim režimom korištenja.', 'teh3.jpg', '2026-06-02 09:10:00', 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admini`
--
ALTER TABLE `admini`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`id_kategorija`),
  ADD UNIQUE KEY `naziv` (`naziv`);

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`id_vijest`),
  ADD KEY `fk_vijesti_kategorije` (`id_kategorija`),
  ADD KEY `fk_vijesti_admini` (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admini`
--
ALTER TABLE `admini`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `id_kategorija` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id_vijest` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD CONSTRAINT `fk_vijesti_admini` FOREIGN KEY (`id_admin`) REFERENCES `admini` (`id_admin`),
  ADD CONSTRAINT `fk_vijesti_kategorije` FOREIGN KEY (`id_kategorija`) REFERENCES `kategorije` (`id_kategorija`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
