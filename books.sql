-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2025 at 11:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `cover`, `price`, `category`, `discount_price`) VALUES
(1, 'The Great Gatsby', 'A story of the fabulously wealthy Jay Gatsby and his love for Daisy Buchanan.', 'https://picsum.photos/200/300?random=1', 10.99, 'Fiction', NULL),
(2, 'To Kill a Mockingbird', 'A novel about the serious issues of race, class, and morality in the Deep South.', 'https://picsum.photos/200/300?random=2', 8.99, 'Fiction', 7.59),
(3, 'Jane Eyre', 'A tale of a young woman\'s struggles, independence, and resilience in Victorian England.', 'https://picsum.photos/200/300?random=4', 7.99, 'Fiction', 6.99),
(4, 'The Catcher in the Rye', 'A story about teenage rebellion, self-discovery, and alienation in mid-20th-century America.', 'https://picsum.photos/200/300?random=5', 11.99, 'Fiction', 10.99),
(5, 'Beloved', 'A haunting exploration of slavery\'s emotional and psychological scars through the story of Sethe, a former enslaved woman.', 'https://picsum.photos/200/300?random=6', 12.99, 'Fiction', NULL),
(6, 'The Book Thief', 'The tale of a young girl, her love for books, and her experiences during World War II in Nazi Germany.', 'https://picsum.photos/200/300?random=7', 13.49, 'Fiction', 12.49),
(7, 'Atonement', 'A gripping story of love, betrayal, and the consequences of a single lie during World War II.', 'https://picsum.photos/200/300?random=8', 14.99, 'Fiction', NULL),
(8, 'The Road', 'A deeply moving story of a father and son traveling through a bleak and desolate post-apocalyptic world.', 'https://picsum.photos/200/300?random=9', 14.49, 'Fiction', 12.49),
(9, 'Of Mice and Men', 'A moving story of friendship and dreams during the Great Depression.', 'https://picsum.photos/200/300?random=10', 9.49, 'Fiction', 8.49),
(10, 'The Grapes of Wrath', 'A powerful story of a family\'s struggles during the Great Depression.', 'https://picsum.photos/200/300?random=11', 13.99, 'Fiction', NULL),
(11, 'The Gruffalo', 'A fun and imaginative story about a mouse and his imaginary friend, the Gruffalo.', 'https://picsum.photos/200/300?random=1', 7.50, 'Children', NULL),
(12, 'Charlotte\'s Web', 'A heartwarming story about friendship and life on a farm.', 'https://picsum.photos/200/300?random=2', 8.99, 'Children', 7.49),
(13, 'Matilda', 'A story of a brilliant little girl with extraordinary powers.', 'https://picsum.photos/200/300?random=3', 10.99, 'Children', 9.99),
(14, 'Harry Potter and the Sorcerer\'s Stone', 'The beginning of Harry Potter\'s magical adventures at Hogwarts.', 'https://picsum.photos/200/300?random=4', 12.99, 'Children', NULL),
(15, 'The Cat in the Hat', 'Dr. Seuss\'s whimsical tale of a mischievous cat.', 'https://picsum.photos/200/300?random=5', 6.99, 'Children', NULL),
(16, 'Where the Wild Things Are', 'A story about a boy\'s adventure to an island of wild creatures.', 'https://picsum.photos/200/300?random=6', 8.49, 'Children', NULL),
(17, 'The Tale of Peter Rabbit', 'The classic tale of a mischievous rabbit and his adventures.', 'https://picsum.photos/200/300?random=7', 5.99, 'Children', NULL),
(18, 'The Giving Tree', 'A touching story about generosity and selflessness.', 'https://picsum.photos/200/300?random=8', 9.49, 'Children', 7.99),
(19, 'Goodnight Moon', 'A gentle bedtime story that has comforted generations of children.', 'https://picsum.photos/200/300?random=9', 6.49, 'Children', NULL),
(20, 'The Very Hungry Caterpillar', 'A colorful and fun story about a caterpillar\'s journey to becoming a butterfly.', 'https://picsum.photos/200/300?random=10', 5.99, 'Children', 4.99),
(21, 'Dune', 'A sweeping tale of politics, religion, and survival on the desert planet of Arrakis.', 'https://picsum.photos/200/300?random=1', 15.99, 'Science Fiction', 12.99),
(22, 'Ender\'s Game', 'A story of a young boy\'s journey to become Earth\'s greatest military commander.', 'https://picsum.photos/200/300?random=2', 11.99, 'Science Fiction', NULL),
(23, 'The Hitchhiker\'s Guide to the Galaxy', 'A hilarious adventure across the universe with Arthur Dent.', 'https://picsum.photos/200/300?random=3', 9.99, 'Science Fiction', NULL),
(24, 'Foundation', 'Isaac Asimov\'s epic tale of a galactic empire and the science of psychohistory.', 'https://picsum.photos/200/300?random=4', 13.99, 'Science Fiction', 11.99),
(25, 'Neuromancer', 'A cyberpunk classic about a washed-up computer hacker hired for a final mission.', 'https://picsum.photos/200/300?random=5', 10.49, 'Science Fiction', NULL),
(26, 'Snow Crash', 'A speculative future filled with virtual reality, hackers, and corporate-controlled societies.', 'https://picsum.photos/200/300?random=6', 12.49, 'Science Fiction', 10.49),
(27, 'The War of the Worlds', 'H.G. Wells\' classic tale of humanity\'s battle against Martian invaders.', 'https://picsum.photos/200/300?random=7', 8.99, 'Science Fiction', 7.49),
(28, '2001: A Space Odyssey', 'A journey through time and space, exploring humanity\'s place in the universe.', 'https://picsum.photos/200/300?random=8', 13.49, 'Science Fiction', NULL),
(29, 'Brave New World', 'A dystopian future exploring the dangers of technology and societal control.', 'https://picsum.photos/200/300?random=9', 15.99, 'Science Fiction', NULL),
(30, 'Hyperion', 'A sweeping tale of intergalactic pilgrimage, mystery, and ancient beings.', 'https://picsum.photos/200/300?random=10', 14.99, 'Science Fiction', 12.99),
(31, 'Pride and Prejudice', 'A romantic novel about manners, upbringing, and marriage in Regency-era England.', 'https://picsum.photos/200/300?random=1', 9.99, 'Romance', NULL),
(32, 'The Notebook', 'A heartwarming story of a couple\'s lifelong romance despite challenges and separation.', 'https://picsum.photos/200/300?random=2', 8.99, 'Romance', 7.99),
(33, 'Me Before You', 'A touching story of an unexpected romance between a caregiver and her patient.', 'https://picsum.photos/200/300?random=3', 12.49, 'Romance', 10.99),
(34, 'Outlander', 'A historical romance involving time travel and a sweeping love story.', 'https://picsum.photos/200/300?random=4', 14.99, 'Romance', NULL),
(35, 'The Time Traveler\'s Wife', 'A unique love story between a woman and a man who involuntarily travels through time.', 'https://picsum.photos/200/300?random=5', 11.99, 'Romance', NULL),
(36, 'The Fault in Our Stars', 'A tear-jerking romance about two teenagers battling illness and finding love.', 'https://picsum.photos/200/300?random=6', 10.99, 'Romance', 9.49),
(37, 'Gone with the Wind', 'A historical romance set during the American Civil War.', 'https://picsum.photos/200/300?random=7', 15.99, 'Romance', 13.99),
(38, 'Eleanor & Park', 'A bittersweet young adult romance about two misfit teenagers.', 'https://picsum.photos/200/300?random=8', 9.49, 'Romance', NULL),
(39, 'The Rosie Project', 'A quirky romantic comedy about a genetics professor searching for love.', 'https://picsum.photos/200/300?random=9', 11.49, 'Romance', 10.49),
(40, 'Love in the Time of Cholera', 'A sweeping tale of unrequited love that spans decades.', 'https://picsum.photos/200/300?random=10', 13.99, 'Romance', NULL),
(41, 'The Girl with the Dragon Tattoo', 'A gripping mystery about a journalist and a hacker investigating a decades-old disappearance.', 'https://picsum.photos/200/300?random=1', 13.99, 'Mystery', 11.99),
(42, 'Gone Girl', 'A psychological thriller about a wife\'s disappearance and her husband’s secrets.', 'https://picsum.photos/200/300?random=2', 14.99, 'Mystery', NULL),
(43, 'The Da Vinci Code', 'A fast-paced mystery involving secret societies, hidden codes, and religious conspiracies.', 'https://picsum.photos/200/300?random=3', 12.49, 'Mystery', 10.49),
(44, 'Sherlock Holmes: The Hound of the Baskervilles', 'One of Sherlock Holmes\' most famous cases, involving a mysterious curse and a family estate.', 'https://picsum.photos/200/300?random=4', 9.99, 'Mystery', 8.99),
(45, 'Big Little Lies', 'A tale of secrets and lies unraveling among a group of suburban women.', 'https://picsum.photos/200/300?random=5', 11.99, 'Mystery', NULL),
(46, 'In the Woods', 'A chilling mystery of a detective investigating a murder linked to his own past.', 'https://picsum.photos/200/300?random=6', 13.49, 'Mystery', NULL),
(47, 'The Silent Patient', 'A psychological thriller about a woman who stops speaking after being accused of murder.', 'https://picsum.photos/200/300?random=7', 14.99, 'Mystery', 12.99),
(48, 'The Woman in the Window', 'A suspenseful mystery about a woman who witnesses a crime while spying on her neighbors.', 'https://picsum.photos/200/300?random=8', 12.99, 'Mystery', 10.99),
(49, 'And Then There Were None', 'A classic Agatha Christie mystery about strangers invited to an island, each meeting a mysterious end.', 'https://picsum.photos/200/300?random=9', 9.49, 'Mystery', NULL),
(50, 'The Couple Next Door', 'A gripping tale of lies and secrets between neighbors after a baby goes missing.', 'https://picsum.photos/200/300?random=10', 10.99, 'Mystery', 9.49),
(51, 'The Diary of a Young Girl', 'The inspiring and heart-wrenching diary of Anne Frank during World War II.', 'https://picsum.photos/200/300?random=1', 9.99, 'Biography', NULL),
(52, 'Steve Jobs', 'The riveting biography of the Apple co-founder by Walter Isaacson.', 'https://picsum.photos/200/300?random=2', 14.99, 'Biography', 12.99),
(53, 'Long Walk to Freedom', 'The autobiography of Nelson Mandela, chronicling his life and fight for freedom.', 'https://picsum.photos/200/300?random=3', 13.49, 'Biography', NULL),
(54, 'Becoming', 'Michelle Obama\'s intimate and inspiring memoir.', 'https://picsum.photos/200/300?random=4', 15.99, 'Biography', 13.99),
(55, 'The Story of My Life', 'The inspiring autobiography of Helen Keller, who overcame immense challenges.', 'https://picsum.photos/200/300?random=5', 8.99, 'Biography', NULL),
(56, 'Educated', 'A memoir by Tara Westover about growing up in a survivalist family and seeking education.', 'https://picsum.photos/200/300?random=6', 12.99, 'Biography', 10.99),
(57, 'I Am Malala', 'The story of Malala Yousafzai\'s fight for education and women\'s rights.', 'https://picsum.photos/200/300?random=7', 10.99, 'Biography', 9.49),
(58, 'The Wright Brothers', 'David McCullough\'s biography of the pioneers of aviation, Orville and Wilbur Wright.', 'https://picsum.photos/200/300?random=8', 13.99, 'Biography', NULL),
(59, 'Alexander Hamilton', 'The biography of one of America\'s Founding Fathers by Ron Chernow.', 'https://picsum.photos/200/300?random=9', 14.49, 'Biography', NULL),
(60, 'Einstein: His Life and Universe', 'Walter Isaacson\'s compelling biography of the great physicist Albert Einstein.', 'https://picsum.photos/200/300?random=10', 15.49, 'Biography', 13.49),
(61, 'The Hobbit', 'A fantastical adventure in Middle-earth following Bilbo Baggins\' journey.', 'https://picsum.photos/200/300?random=1', 13.99, 'Fantasy', 12.59),
(62, 'Harry Potter and the Sorcerer\'s Stone', 'The beginning of Harry Potter\'s magical journey at Hogwarts.', 'https://picsum.photos/200/300?random=2', 12.99, 'Fantasy', NULL),
(63, 'A Game of Thrones', 'The first book in the epic fantasy series \'A Song of Ice and Fire\' by George R.R. Martin.', 'https://picsum.photos/200/300?random=3', 15.99, 'Fantasy', NULL),
(64, 'The Name of the Wind', 'The tale of Kvothe, a gifted musician and magician, in a richly imagined world.', 'https://picsum.photos/200/300?random=4', 14.49, 'Fantasy', 13.49),
(65, 'The Fellowship of the Ring', 'The first part of Tolkien\'s epic trilogy, \'The Lord of the Rings.\'', 'https://picsum.photos/200/300?random=5', 13.99, 'Fantasy', NULL),
(66, 'The Chronicles of Narnia: The Lion, the Witch and the Wardrobe', 'A magical tale of four siblings who discover a secret world through a wardrobe.', 'https://picsum.photos/200/300?random=6', 11.99, 'Fantasy', 10.99),
(67, 'Eragon', 'The story of a farm boy who discovers a dragon egg and embarks on a magical adventure.', 'https://picsum.photos/200/300?random=7', 12.49, 'Fantasy', NULL),
(68, 'The Golden Compass', 'An imaginative tale of a young girl named Lyra and her quest through parallel worlds.', 'https://picsum.photos/200/300?random=8', 10.99, 'Fantasy', 9.49),
(69, 'Mistborn: The Final Empire', 'A thrilling tale of rebellion and magic in a dystopian fantasy world.', 'https://picsum.photos/200/300?random=9', 14.99, 'Fantasy', 12.99),
(70, 'The Priory of the Orange Tree', 'An epic feminist fantasy tale featuring dragons and a divided world.', 'https://picsum.photos/200/300?random=10', 16.99, 'Fantasy', NULL),
(71, 'Sapiens: A Brief History of Humankind', 'A sweeping narrative of human history, from the Stone Age to the present.', 'https://picsum.photos/200/300?random=1', 14.99, 'History', 13.49),
(72, 'The History of the Ancient World', 'A detailed history of the early civilizations from Mesopotamia to the fall of Rome.', 'https://picsum.photos/200/300?random=2', 15.49, 'History', NULL),
(73, 'Guns, Germs, and Steel', 'An exploration of how geography and environment shaped human societies.', 'https://picsum.photos/200/300?random=3', 13.99, 'History', 12.49),
(74, 'A People\'s History of the United States', 'A compelling narrative of American history from the perspective of marginalized groups.', 'https://picsum.photos/200/300?random=4', 12.99, 'History', NULL),
(75, 'The Silk Roads: A New History of the World', 'A fresh look at the history of the world, focusing on the importance of the Silk Road.', 'https://picsum.photos/200/300?random=5', 14.49, 'History', 12.99),
(76, 'The Wright Brothers', 'David McCullough’s biography of Orville and Wilbur Wright and their contributions to aviation history.', 'https://picsum.photos/200/300?random=6', 13.99, 'History', NULL),
(77, 'The Rise and Fall of the Third Reich', 'An exhaustive history of Nazi Germany and World War II.', 'https://picsum.photos/200/300?random=7', 16.99, 'History', NULL),
(78, '1776', 'David McCullough’s vivid account of America’s fight for independence.', 'https://picsum.photos/200/300?random=8', 12.49, 'History', 10.99),
(79, 'Team of Rivals', 'Doris Kearns Goodwin’s history of Abraham Lincoln\'s leadership during the Civil War.', 'https://picsum.photos/200/300?random=9', 14.99, 'History', 13.49),
(80, 'The Crusades: The Authoritative History of the War for the Holy Land', 'A gripping account of one of the most controversial and complex series of wars in history.', 'https://picsum.photos/200/300?random=10', 15.99, 'History', NULL),
(81, 'Meditations', 'The personal writings of Roman Emperor Marcus Aurelius on Stoic philosophy.', 'https://picsum.photos/200/300?random=1', 9.99, 'Philosophy', 8.99),
(82, 'The Republic', 'Plato\'s seminal work on justice, politics, and the ideal society.', 'https://picsum.photos/200/300?random=2', 11.99, 'Philosophy', 10.99),
(83, 'Nicomachean Ethics', 'Aristotle\'s exploration of virtue and the path to a good life.', 'https://picsum.photos/200/300?random=3', 10.49, 'Philosophy', NULL),
(84, 'Being and Time', 'Martin Heidegger\'s influential work on existence and ontology.', 'https://picsum.photos/200/300?random=4', 14.99, 'Philosophy', 12.99),
(85, 'Critique of Pure Reason', 'Immanuel Kant\'s groundbreaking work on reason, experience, and metaphysics.', 'https://picsum.photos/200/300?random=5', 15.99, 'Philosophy', NULL),
(86, 'The Art of War', 'Sun Tzu\'s classic work on strategy, philosophy, and leadership.', 'https://picsum.photos/200/300?random=6', 8.49, 'Philosophy', 7.49),
(87, 'Beyond Good and Evil', 'Friedrich Nietzsche\'s provocative exploration of morality and human values.', 'https://picsum.photos/200/300?random=7', 9.99, 'Philosophy', NULL),
(88, 'The Myth of Sisyphus', 'Albert Camus\' philosophical essay on the absurd and the meaning of life.', 'https://picsum.photos/200/300?random=8', 10.99, 'Philosophy', 9.49),
(89, 'The Prince', 'Niccolò Machiavelli\'s timeless treatise on power, politics, and leadership.', 'https://picsum.photos/200/300?random=9', 9.49, 'Philosophy', 8.49),
(90, 'The Tao Te Ching', 'Lao Tzu\'s classic text on Taoist philosophy and the nature of existence.', 'https://picsum.photos/200/300?random=10', 8.99, 'Philosophy', NULL),
(91, '1984', 'A dystopian novel set in a totalitarian society ruled by Big Brother.', 'https://picsum.photos/200/300?random=1', 14.99, 'Dystopian', 13.49),
(92, 'Brave New World', 'A dystopian future exploring the dangers of technology and societal control.', 'https://picsum.photos/200/300?random=2', 15.99, 'Dystopian', NULL),
(93, 'The Handmaid\'s Tale', 'A chilling story about a totalitarian society where women are stripped of their rights.', 'https://picsum.photos/200/300?random=3', 13.99, 'Dystopian', 12.49),
(94, 'Fahrenheit 451', 'A story of a future where books are banned and burned to control knowledge.', 'https://picsum.photos/200/300?random=4', 12.99, 'Dystopian', 10.99),
(95, 'The Hunger Games', 'A thrilling tale of survival and rebellion in a dystopian world.', 'https://picsum.photos/200/300?random=5', 11.99, 'Dystopian', NULL),
(96, 'The Road', 'A deeply moving story of a father and son traveling through a bleak, post-apocalyptic world.', 'https://picsum.photos/200/300?random=6', 14.49, 'Dystopian', 12.49),
(97, 'Divergent', 'A story about a society divided into factions and a girl who doesn’t fit in.', 'https://picsum.photos/200/300?random=7', 10.99, 'Dystopian', 9.49),
(98, 'The Maze Runner', 'A group of boys trapped in a mysterious maze struggle to find freedom.', 'https://picsum.photos/200/300?random=8', 11.49, 'Dystopian', NULL),
(99, 'Station Eleven', 'A haunting story of life after a devastating flu pandemic collapses civilization.', 'https://picsum.photos/200/300?random=9', 13.49, 'Dystopian', NULL),
(100, 'We', 'A dystopian classic about a futuristic society under constant surveillance.', 'https://picsum.photos/200/300?random=10', 9.99, 'Dystopian', 8.99),
(101, 'Moby Dick', 'An epic tale of Captain Ahab\'s obsession with hunting the white whale.', 'https://picsum.photos/200/300?random=1', 12.99, 'Adventure', 11.69),
(102, 'Treasure Island', 'A classic tale of pirates, treasure maps, and high-seas adventure.', 'https://picsum.photos/200/300?random=2', 9.99, 'Adventure', 8.99),
(103, 'Into the Wild', 'The true story of Christopher McCandless\' journey into the Alaskan wilderness.', 'https://picsum.photos/200/300?random=3', 11.99, 'Adventure', NULL),
(104, 'The Call of the Wild', 'Jack London\'s classic novel about a sled dog\'s survival and transformation in the Yukon.', 'https://picsum.photos/200/300?random=4', 8.99, 'Adventure', 7.99),
(105, 'Around the World in Eighty Days', 'Jules Verne\'s tale of a gentleman\'s daring attempt to circumnavigate the globe.', 'https://picsum.photos/200/300?random=5', 10.99, 'Adventure', NULL),
(106, 'The Adventures of Huckleberry Finn', 'Mark Twain\'s story of a young boy\'s journey down the Mississippi River.', 'https://picsum.photos/200/300?random=6', 9.49, 'Adventure', NULL),
(107, 'Life of Pi', 'The extraordinary tale of a boy stranded at sea with a Bengal tiger.', 'https://picsum.photos/200/300?random=7', 12.49, 'Adventure', 10.99),
(108, 'The Lost City of Z', 'The incredible true story of the search for a lost civilization in the Amazon.', 'https://picsum.photos/200/300?random=8', 13.99, 'Adventure', NULL),
(109, 'Robinson Crusoe', 'Daniel Defoe\'s classic tale of survival on a desert island.', 'https://picsum.photos/200/300?random=9', 10.99, 'Adventure', 9.99),
(110, 'Hatchet', 'A young boy\'s survival story in the Canadian wilderness after a plane crash.', 'https://picsum.photos/200/300?random=10', 8.99, 'Adventure', 7.49);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
