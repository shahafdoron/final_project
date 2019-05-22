-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2019 at 11:47 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `cat_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `cat_name`, `description`) VALUES
(1, 'History', 'some desc'),
(2, 'Tree', 'some desc'),
(3, 'Gate', 'some desc'),
(4, 'Sculptures', 'some desc'),
(6, 'Attraction', 'some desc'),
(7, 'Resturants', 'some desc');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(10) UNSIGNED NOT NULL,
  `tour_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `tour_id`, `user_id`) VALUES
(4, 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `guide`
--

CREATE TABLE `guide` (
  `guide_id` int(10) NOT NULL,
  `experience` int(2) NOT NULL,
  `category_expertise` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `guide`
--

INSERT INTO `guide` (`guide_id`, `experience`, `category_expertise`) VALUES
(2, 10, 'History');

-- --------------------------------------------------------

--
-- Table structure for table `guided_tour`
--

CREATE TABLE `guided_tour` (
  `guided_tour_id` int(10) UNSIGNED NOT NULL,
  `guide_id` int(10) UNSIGNED NOT NULL,
  `group_size` int(3) UNSIGNED NOT NULL,
  `registration_deadline` datetime NOT NULL,
  `tour_cost` int(6) UNSIGNED NOT NULL,
  `short_desc` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `guided_tour`
--

INSERT INTO `guided_tour` (`guided_tour_id`, `guide_id`, `group_size`, `registration_deadline`, `tour_cost`, `short_desc`, `description`) VALUES
(2, 2, 15, '2019-05-24 00:00:00', 15, 'short desc', 'long desc');

-- --------------------------------------------------------

--
-- Table structure for table `guided_tour_registration`
--

CREATE TABLE `guided_tour_registration` (
  `guided_tour_id` int(10) UNSIGNED NOT NULL,
  `registered_tourist_id` int(10) UNSIGNED NOT NULL,
  `subscribers` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `independent_tour`
--

CREATE TABLE `independent_tour` (
  `independent_tour_id` int(10) UNSIGNED NOT NULL,
  `independent_tourist_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `independent_tour`
--

INSERT INTO `independent_tour` (`independent_tour_id`, `independent_tourist_id`) VALUES
(21, 1),
(22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `point_feedback`
--

CREATE TABLE `point_feedback` (
  `feedback_id` int(10) UNSIGNED NOT NULL,
  `point_id` int(10) UNSIGNED NOT NULL,
  `point_ranking` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `point_feedback`
--

INSERT INTO `point_feedback` (`feedback_id`, `point_id`, `point_ranking`) VALUES
(2, 38, 5),
(2, 36, 5),
(2, 26, 5),
(2, 1, 5),
(2, 44, 5),
(3, 28, 4),
(3, 67, 4),
(4, 71, 4);

-- --------------------------------------------------------

--
-- Table structure for table `point_of_interest`
--

CREATE TABLE `point_of_interest` (
  `point_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `average_time_minutes` float UNSIGNED NOT NULL DEFAULT '0',
  `average_ranking` float UNSIGNED NOT NULL DEFAULT '0',
  `is_accessible` tinyint(1) DEFAULT '0',
  `point_description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `point_of_interest`
--

INSERT INTO `point_of_interest` (`point_id`, `category_id`, `name`, `longitude`, `latitude`, `average_time_minutes`, `average_ranking`, `is_accessible`, `point_description`) VALUES
(1, 4, 'Memorial to the Victims of the Holocaust', 34.8191, 31.9082, 27, 4.9, 1, 'Memorial to the Victims of the Holocaust, made of bronze and stone, depicts a Torah scroll, split in half along its length and bathed in light. The scroll is tilted diagonally on a white stone cube, its central axis cut through. Some common names of Jews who perished in the Holocaust, as well as the numbers tattooed on their arms, are burnt and engraved on the body of the scroll. The scroll is perched on a stone base at a precarious angle, hovering between taking off and crashing. The sculpture is designed to incorporate fire and water, which trickles down the two inner sides of the stone, like tears. Encircling the base of the sculpture are the words of President Chaim Weizmann, in Yiddish, spoken at a Zionist Congress. Dani Karavan was born in Tel Aviv in 1930. He studied art with Aharon Avni, Avigdor Stematsky, Yehezkel Streichman, and Marcel Janco. He continued his studies at the Bezalel Academy of Art and Design in Jerusalem with Mordechai Ardon, and at the Academy of Fine Arts in Florence. He has represented Israel at numerous international exhibitions, among them the Venice Biennale, the Kassel Documenta, and the Sao Paulo Biennale, and has been named a UNESCO Artist for Peace. Karavan divides his time between Israel, France, and Italy.'),
(2, 4, 'The Inner Light', 34.8102, 31.906, 20, 3.9, 1, 'The Inner Light, built as a winding spiral that expands in a flowing upward movement, suggests the human spirit striving toward an experience beyond material reality. The majority of Graetz’s sculptures are made of stainless steel and bronze and designed in aerodynamic shapes. This sculpture faithfully represents the artist, who formulated an abstract but understandable artistic language that is neither provocative nor aggressive but, rather, elegant and somewhat sterile – in keeping with cultural progress. The sculpture’s metallic sheen gives it an inner radiance. The work was donated to the Weizmann Institute by the sculptor in memory of his late father, Heinz R. Graetz, one of the pioneers of Israeli navigation and a founder of the Dizengoff shipping company. Gidon Graetz was born in Tel Aviv in 1929. He grew up on Kibbutz Beit-Alpha and fought in the Palmach in battles over Jerusalem. He studied at the Florence Academy of Art and the Ecole des Beaux-Arts in Paris. Since 1965 Graetz has been living in Florence. Weizmann Institute Board member Ayala Zacks-Abramov is the artist’s aunt.'),
(3, 2, 'Mount Tabor Oak', 34.8141, 31.9078, 23, 3.8, 1, 'A broad, deciduous or semi-deciduous tree. Its primary branches wind upward and out from the wide, short trunk. The leaves have serrated edges and small hairs sprouting from their undersides. The Mount Tabor oak sheds its leaves late in the winter and sprouts new growth early in the spring; some specimens may not shed their leaves at all. The Mount Tabor oak is at its most beautiful when in bud, covered with a greenish-gold coat of new leaves and flowers. The acorns, which develop out of the flowers, are larger than those of other oak species, and the large cupules (cups) that hold them have long, curly protrusions. When roasted, the acorns can be used to make a coffee-like beverage, and the cupules are used for decoration. There are approximately 600 species of oak. Most of these are native to temperate regions of the northern hemisphere, but the Mount Tabor oak (or as it is called in the Bible, alon habashan) grows wild only in Israel and in Syria, on both sides of the Syrian-African rift. In the past, it covered vast portions of the Land of Israel. Ancient specimens, hundreds of years old, are scattered from the Golan Heights to the Sharon. Mount Tabor oaks have been planted at different times along the Institute’s Marcus Sieff Boulevard; future plans include creating a continuous strip of them along this route.'),
(4, 1, 'Kimmel Center for Archaeological Science', 34.8099, 31.9077, 41, 4.3, 1, 'The Helen and Martin Kimmel Center for Archaeological Science was designed by Erich Mendelsohn in 1939 and renovated according to the design of the architect Dagan Mochly in 1998. It belongs to the complex of buildings by Mendelsohn in this part of the campus. Located on the northern side, it, together with the Daniel Wolf Building across the walkway, creates an entrance gate to the Mendelsohn complex. While a certain symmetry of size exists in their façades, producing the impression of a gateway, the two buildings are opposed in the design of their windows. The windows of the Daniel Wolf Building that face the road are rectangular, although one large window on the side is round, in line with the “inverted ship” design. In contrast, the front windows of the Helen and Martin Kimmel Center for Archaeological Science facing the road are round, while those that face the adjacent building are square.'),
(5, 2, 'Indian Banyan', 34.8103, 31.906, 19, 3.2, 1, 'A huge, evergreen, tropical tree, whose primary identifying feature is the thick aerial roots that grow downwards from its large branches and develop into additional trunks. A mature tree can continue to grow in this manner, eventually turning into an entire grove of trunks. The area covered by such a tree can reach more than a kilometer, and it may provide shade to thousands of people. The bark on the trunks and branches is fairly smooth. The green leaves are large and thick with yellow veins. New leaves appear in a bronze color. The flowers are small figs that ripen into beautiful red fruit growing in pairs among the leaves. The Indian banyan is the national tree of India and is considered holy there. Because of its size, the Indian banyan has garnered much interest as an ornamental tree in warm regions throughout the world. It has been grown in Israel for a long time. A large, famous example presides over the garden at Mikveh Israel, while others can be found in Ein Gedi and in kibbutz landscaping in the Beit She’an Valley.'),
(6, 4, 'King and Queen', 34.8068, 31.9072, 39, 4.2, 1, 'King and Queen belongs to Sorel Etrog\'s “Screws and Bolts” series. The figures of the king and queen are made up of basic modular components assembled on their axes and give the illusion that they can be opened and closed, even though in reality they cannot move. The crowns of the royal couple resemble horns, hinting at Etrog’s interest in Native American culture, while their mechanical shape suggests technological robots. Etrog uses a complex visual vocabulary to explore the forces shaping our time, such as the tension between technology and the living world. The artist donated the sculpture to the Weizmann Institute in memory of Samuel J. Zacks’s widow Ayala. Sorel Etrog was born in Romania in 1933 and immigrated to Israel with his family in 1950. He studied at the Avni Institute under Yehezkel Streichman, Marcel Janco, Moshe Mokady, and Moshe Sternschuss, among others, and has created projects in collaboration with Eugène Ionesco, Samuel Beckett, Marshall McLuhan and John Cage. His works are exhibited in modern art museums in New York and Paris, in important galleries in London, and in numerous private collections. Etrog lives in Canada.'),
(7, 6, 'Maurice and Gabriela Goldschleger Life Sciences Library', 34.8089, 31.9069, 65, 4.3, 1, 'The Maurice and Gabriela Goldschleger Life Sciences Library, designed by the architect Yakov Rechter in 1991, attracts immediate attention by its unusual conical shape. This building is typical of Rechter, who always sought new ways and means of expression, while staying faithful to such veteran heavy materials as stone and concrete. Examples of his work include the Mivtahim Inn in Zichron Ya’akov built on a cliff in 1968, the Performing Arts Center built in Tel Aviv in 1994 and the enormous Holiday Inn dome on Ashkelon beach built in 1998. Here, too, Rechter was able to give free expression to his creative style, as this is a library rather than a research building with complicated engineering requirements. The smooth white concrete roof is supported by exposed concrete columns and beams that create a conical frame, gray and prominent. In contrast, slender, round, white steel columns on the front façade support the ceiling of the reading hall and the floor of the inner gallery, thus preserving the integrity of the glass front wall. To stress its uniqueness and secure the quiet appropriate to a library, the building is separated from the road by a protective moat, one floor deep, spanned by a bridge leading to the entrance door. The impressive exterior of the slanted roof, highlighted by its protruding concrete beams, is continued inside the library in the form of air-conditioning pipes, illuminated by hidden lights in the low ceiling, that follow the lines of the beams. The library’s conical form creates an interesting internal space, in which the entrance floor serves mainly as an archive with seating areas along the transparent front wall, while the tall space in the center is taken up by an overlooking gallery floor that serves mainly as a reading area. The space in the center is filled with ceilingless rooms with round windows, used for meetings and study. The upper gallery is accessed by a concrete staircase with a transparent roof. An additional glass wall in the center of the cone faces a small internal garden. This garden and the planted moat together enfold the building in a swathe of vegetation that serves to somewhat soften the harshness of Rechter’s favored concrete.'),
(9, 2, 'Olive', 34.8095, 31.9043, 24, 3.9, 1, 'A tree with deep roots in human civilization, the olive tree is a small- to medium-sized evergreen. Its trunk is gray and smooth, and as it ages, it gains its characteristic knots and twists. Very old trunks may lose their heartwood, becoming hollow. The stiff, elongated leaves are dark gray on top and silver on the underside, so that the tree changes color with every gust of wind. Clusters of small white flowers appear on the tree in spring, and the oil-filled fruits that replace them are what have assured the tree its place in history. The Oleaceae family includes a number of plants that are not at all similar to the olive, including such flowering shrubs as lilac and jasmine. The genus Olea includes approximately 20 species, almost all of them native to Africa, Asia and Australia. The olive tree is the only one of these whose native region abuts Europe, hence its scientific name. The tree grows wild in the eastern Mediterranean and western Asia. The domesticated growth of the olive in this region began thousands of years ago and spread throughout the world. The olive is one of the seven species of the Land of Israel mentioned in the Bible, and was one of the three economic bases of biblical Israel: “grain, wine, and oil” (olive oil). The tree is often mentioned in the Bible as being beneficial, honored and valued. In Israel, there are olive trees known to be hundreds of years old or more, and some are claimed to be 2,000 years old. The olive tree also has a prominent place in other cultures and religions that have developed in this region. The olive branch has become a universal symbol of peace and appears in the United Nations emblem as well as in the emblem of the State of Israel, where it is the national tree.'),
(10, 4, 'Semaphore', 34.8178, 31.9081, 35, 3.5, 1, 'Semaphore belongs to the artist’s “Totems” series. The upward-thrusting sculpture is made of forged iron treated with a heavy industrial hammer. The sculpture’s title is derived from the signaling system used by navigators at sea and by train drivers. Columns have always formed the basis of architecture. At the outset they were linked to nature, to vegetation, and always to landscape. Here, the column is industrial and man-made, rebelling against divine nature. An additional contrast embodied in the sculpture sums up the Israeli experience: on the one hand closely tied to the West, on the other hand striving to be part of its immediate context, the Middle East. Igael Tumarkin, born in Germany in 1933, immigrated to Israel as a two-year-old. He was a student of Rudi Lehmann in 1954, and in the following year studied and worked with Bertolt Brecht in the Berliner Ensemble in East Berlin. Renowned as a sculptor, painter, writer, intellectual and rebel, Tumarkin fought for a break from the lyrical abstract and is known for his groundbreaking use of new materials. He has represented Israel at the Venice Biennale and the São Paulo Biennale. His works are exhibited in various cities in Israel, Germany, France, Spain, the former Czechoslovakia, Japan and the United States.'),
(11, 4, 'In Suspense', 34.8085, 31.905, 37, 4.6, 1, 'In Suspense is related to the artist’s series of geometric-minimalist sculptures of the 1960 whose theme was dramatic tension. The sculpture, made of corten steel, looks like an open triangle standing on its head; a thin plate, to which a massive rectangular box is attached, extends from its apex. The work creates a disturbing feeling that at any moment the delicate, free-floating balance will be disrupted. This sculpture is connected to Kadishman’s 15-meter-high Elevation (1967), better known as “The Three Circles,” in front of Tel Aviv’s Mann Auditorium. Both sculptures are tilted at an impossible angle from which they threaten to collapse. The sculpture was donated to the Weizmann Institute of Science by Ephraim Ilin. Menashe Kadishman was born in Tel Aviv in 1937. He studied with sculptor Moshe Sternschuss, worked as a shepherd on two kibbutzim, then resumed the study of sculpture with Rudi Lehmann and at the St. Martin’s School of Art and the Slade School in London. His works are exhibited in numerous museums in Israel and abroad and he has represented Israel at many international exhibitions, including the Venice Biennale, the Kassel Documenta, and the Sao Paulo Biennale. Kadishman lives in Tel Aviv.'),
(12, 4, 'Ritual', 34.814, 31.9081, 22, 4, 1, 'Ritual is dedicated to the memory of Amos de-Shalit, a prominent nuclear physicist and former Director-General of the Weizmann Institute. The sculpture consists of two unusually large pieces of white Carrara marble whose combined weight is seven tons. The two pieces lean against each other, like two people sharing a secret. Giorgi treats empty space like a structural element, equal in worth to massive material shapes. The sculpture’s placement in the middle of a pool provides a reflection that doubles its presence in the environment. The sculpture was donated to the Weizmann Institute by Adolfo Bloch, Brazil. Bruno Giorgi was born in Sao Paulo in 1905. In his youth he was arrested for participating in an anti-fascist movement. In the 1930s he had a studio in Paris, where he studied and worked with Aristide Maillol. In 1936 he joined the Spanish republican forces and took part in the Spanish Civil War. After Franco’s victory Giorgi returned to Brazil and devoted himself to sculpture. In the 1960s he created two large sculptural monuments of Carrara marble that were a milestone in the development and design of the city of Brasilia. Giorgi died in Rio de Janeiro in 1993.'),
(14, 7, 'Hermann and Dan Mayer Campus Guesthouse - Maison de France', 34.8106, 31.9065, 0, 3.9, 1, 'The San Martin Faculty Clubhouse and the Hermann Mayer Campus Guesthouse – Maison de France (which was built later) were designed by the architects Arieh Sharon and Benjamin Idelson in 1959 as a two-story building. One of its floors temporarily housed the offices of the Institute’s administration. In 1966, when the administration moved to the Stone Building, the building was redesigned for use as a guesthouse by the architects Benjamin Idelson and Gershon Zippor, with interior design by Rafi Blumenfeld and Lazar Hizkiya. The redesign involved changes in the interior, the addition of a third floor to match the existing ones and, at a later stage, the opening of a second entrance on the northern side.   It is obvious from its appearance that the building was intended not for research or study but as a clubhouse and guesthouse. Its style, typical of guesthouses built during that period throughout Israel, reflects the socialist and communal spirit prevalent in the country at the time. The guest rooms are at the front of the building and have long, deep balconies that connect all the rooms on each floor and are separated by tall, prefabricated partitions. Helping to bear the weight of the balconies are slender, round steel columns that match the balconies’ iron balustrades. The entrance area has unusual concrete structures: round columns scrubbed to accentuate the large aggregate from which they were derived and hexagon-shaped outer tiles, whose net pattern matches that of the concrete entrance staircase.   The ground floor provides access from one side of the building to the other. At its center, a wide staircase leads up to the clubhouse, with a wide, double-height window through which southern light filters past climbing plants into the central space. Additional light enters the stairwell from the roof through a greenish glass elevator shaft that was constructed in 2002 by the architects Gershon and Barak Zippor. The building also houses one of the staff’s restaurants.'),
(15, 2, 'Smooth-Shell Macadamia Nut, Queensland Nut', 34.8085, 31.9063, 18, 3.4, 1, 'An evergreen tree that yields rich nuts. The leaves are usually arranged in whorls of three growing from a single point on the branch. The mature leaves are long and stiff, with edges that are only slightly serrated or not serrated (hence the scientific name, integrifolia: intact leaves). In spring, attractive inflorescences (clusters) of small white flowers develop, some of which are fertilized to produce globular fruits with a green husk that splits when ripe. Inside is a nut with a particularly hard shell and a seed or two. Prized for their buttery taste, macadamias have a high nutritional value; their oils are often used in cosmetics. There are nine species in the genus Macadamia, most of them from Australia, but only the fruits of the Macadamia integrifolia and the Macadamia tetraphylla are edible – the rest are poisonous. Commercial agricultural production of the macadamia began in the 19th century, and it is thought to be the only agricultural crop that originated in Australia. The macadamia was introduced into Israel in the 1950s; some of the first trees were planted in the experimental plot on the grounds of the Weizmann Institute.'),
(16, 4, 'Three Fledglings', 34.8104, 31.9056, 38, 4.6, 1, 'Three Fledglings, made of metal, depicts tall, thin fledglings, amusing in their shape, stretching to their full height while ostentatiously opening wide their exaggeratedly large beaks to demand food. Their thin necks with a few perky feathers add a further humorous touch to the sculpture. Sternschuss was one of the first Israeli sculptors to turn to the abstract. Since the mid-1950s, like his friends Dov Feigin and Yehiel Shemi in the avant-garde New Horizons Group, he has experimented with the motif of birds and the nest. These works are mostly built from industrial iron parts; but even when relying on clean geometrical structures like cylinders, spheres, and cones, a legacy of Cubism, his works retain a strong link to human beings and the living world. Moshe Sternschuss was born in Poland in 1903 and immigrated to Israel in 1926. He studied at the Bezalel Academy of Art and Design in Jerusalem, then at the Ecole des Beaux-Arts in Paris. In 1948 he was among the founders of the New Horizons Group. He headed the sculpture department of the Avni Institute in Tel Aviv and was a senior lecturer on sculpture at the university of Haifa. His sculptures are exhibited in numerous public institutions in Israel, and in useums in Israel and abroad. Sternschuss died in Tel Aviv in 1992.'),
(17, 2, 'Royal Poinciana, Flamboyant', 34.8097, 31.9057, 26, 3.6, 1, 'One of the most beautiful trees in Israel. It is prized for its lush red and orange bloom in summer; at its height, the tree appears to “burn” like a flame, hence the common name, flamboyant. The tree has a wide canopied shape, reminiscent of the acacia tree of the Negev; hence the tree’s Hebrew name comes from tze’ela, the biblical name for acacia. The royal poinciana’s trunk and primary branches have an impressive structure, which is apparent when it is bare in winter. Its root system is shallow and sometimes protrudes above ground. Its large bipinnate (twice-compound) leaves have very small, deep green leaflets. The foliage is usually shed in winter, with new leaf growth occurring late, at the end of spring. After the spectacular bloom, large dark, flat woody pods develop. The royal poinciana is native to Madagascar, where it is endangered; but as an ornamental tree it thrives in warm, tropical countries. It was introduced into Israel in the 1920s. It grows most successfully in the Jordan Valley and the Arava, where it blooms in flaming red. In other valleys and on the coastal plain, its success depends on local conditions.'),
(18, 2, 'Mexican Rose', 34.8108, 31.9066, 30, 3.4, 1, 'A large, wide, evergreen, tropical shrub noted for its large leaves and winter blooms. Numerous dense branches with brown bark grow from the base of the trunk. The round, wide crown is made up of very large, round leaves, each with several pointed lobes. The leaves are somewhat hairy and have a “rumpled” look. In winter, huge, showy, ball-like inflorescences (flower clusters) made up of numerous bright pink flowers hang among the leaves. The tree stays in bloom well into the spring. The clusters continue to hang, even when the flowers have wilted and turned brown. As far as is known, the plant does not produce fruit in Israel. The genus Dombeya belongs to the Sterculiaceae family, and includes over 200 species from southern and eastern Africa, and Madagascar. The derivation of the Mexican rose that is generally found in Israel is unclear. It is known by various names in different sources, and it may possibly be a cross between a few similar species. In Israel, the Mexican rose is primarily found in older gardens.'),
(19, 2, 'Canary Island Pine', 34.8097, 31.9055, 27, 4.9, 1, 'A tall, narrow pine known for its foliage of long, soft needles. Its axial trunk extends all the way up to its crown, with secondary branches branching out horizontally. The needles, arranged in bundles of three, hang downwards. The contrast between its upright profile and its soft, drooping foliage distinguishes the Canary Island pine from other pine species and gives it its characteristic shape. The Canary Island pine is exclusively endemic to the Canary Islands, where it is uniquely adapted to a climate with variable precipitation patterns. It traps moist ocean air in its foliage, and its drooping needles direct the drops of condensation to the ground below. Hence, it plays a significant role in maintaining the water balance of its habitat. The Canary Island pine is valued in carpentry, and, due to its ability to grow quickly and its tolerance to heat and drought, it has become a preferred species for afforestation in many countries. This tree is one of the few pines that can regenerate after a fire or being cut down. Due to its vulnerability to caterpillars of the pine processionary moth, however, it is not widely used in Israel.'),
(20, 4, 'Continum', 34.8114, 31.9071, 23, 3.5, 1, 'Continuum is comprised of giant steel sheets with pieces excised to create silhouettes of archetypical trees. The observer is seemingly invited to “enter” the sculpture, to define the absent trees each time anew, and to create a continuum in the process. The silhouettes express the artist’s involvement with nature in delicate, reflective touches. The metal forest rests in the midst of living trees, whose warmth contrasts with the cold of the metal. The sculpture was donated by a group of friends of the Institute headed by Norman D. Cohen and was dedicated to Harry Levine, one of the founders of the American Committee for the Weizmann Institute of Science. Menashe Kadishman was born in Tel Aviv in 1937. He studied with sculptor Moshe Sternschuss, worked as a shepherd on two kibbutzim, then resumed the study of sculpture with Rudi Lehmann and at the St. Martin’s School of Art and the Slade School in London. His works are exhibited in numerous museums in Israel and abroad and he has represented Israel at many international exhibitions, including the Venice Biennale, the Kassel Documenta, and the Sao Paulo Biennale. Kadishman lives in Tel Aviv.'),
(21, 7, 'Cafe Bkikar', 34.8114, 31.9086, 0, 3.8, 1, 'A cafe operated by Karnaf. The menu includes ready-made salads, pasta dishes, pizza, toasted panini sandwiches, soups, quiches, muesli and a daily chef’s special.'),
(22, 1, 'Jacob Ziskind Building', 34.8097, 31.9074, 50, 3.3, 1, 'The decision to establish The Weizmann Institute of Science was made in 1944 when Weizmann’s 70th birthday drew near, and he made a wish to his friends and relatives to expand the Sieff Institute. Meyer Weisgal, Weizmann’s assistant concentrated on raising the funds for the soon-to-be Weizmann Institute of Science which would also include the Daniel Sieff research Institute. In the same year the American Committee for the Weizmann Institute of Science was established in order to support Chaim Weizmann’s research and eventually, it was the members of this committee who assisted in raising the funds for the establishment of the Institute.                        So it was decided in the year of 1949 and with the agreement of the Sieff family to establish the Weizmann Institute of Science. At the time of its foundation the building included the departments of biophysics, polymeric research, isotopes research, applied mathematics, optics and the Institute’s Administration. In here the first electronic department in Israel was established. Some Title For Test At the entrance of the building the giant computer “Weizac” is placed. The WEIZAC (Weizmann Automatic Computer) was the first computer in Israel, and one of the first large-scale, stored-program, electronic computers in the world.                                                                      The building was designed by the architects Arieh Elhanani, Israel Dicker and Uriel Schiller in 1947; a new wing was added to the back of the building in 1960. Planned according to a sketch by Erich Mendelsohn, the building’s general structure is monumental and official looking, while its repeating office windows project a no-nonsense functionality.                                                                                        The accentuated entrance, the wide staircase and the barrel-vaulted ceiling covering the entire lobby create a feeling of majestic splendor. This entrance served as the stage from which Dr. Chaim Weizmann, David Ben-Gurion, Golda Meir and others delivered speeches at the dedication of the Weizmann Institute of Science. In contrast to the flat, functional façade modestly faced with light-colored plaster, the entrance is accentuated by a stone handrail, with glass-and-iron Modernist lamps on either side and an impressive stone frame around the entrance door. The door itself has been artistically crafted as a network of double iron grills with iron protrusions at their intersections. The inner doors, leading from the entrance lobby to corridors with rooms on both sides, are similarly fashioned and are framed in the same brown marble as that used for the floor tiles. Incorporated in the ceiling are glass bricks to admit natural light, and embedded on the underside of the upper-floor balconies are large round lamps.          The double-rod balustrade and handrail lining the wide staircase to the upper floor are of copper rather than plain iron. Even the baseboard is of 20-cm high brown marble tiles, almost three times the standard height.                                                                                                 The air-conditioning system, designed when the building was constructed, it was renown as the first air-conditioned building in the Middle East.  '),
(24, 2, 'White Stinkwood', 34.8071, 31.9072, 17, 4.1, 1, 'A deciduous tree with a straight trunk and long, arching branches. Its round shape is somewhat open in younger trees and becomes denser as the tree matures. The branches curve downwards; numerous leaves with non-symmetrical bases grow intermittently along the branches, a typical arrangement in the genus Celtis. The leaves are egg-shaped and their lobes contain three main veins, joined by a network of non-parallel veins. In spring, as new leaves sprout, small greenish male and female flowers develop on the same tree in groups; these flowers are ollinated by bees. The tree’s small round fruits, which turn black when ripe, are a favorite food of various birds. The genus Celtis contains approximately 60 different species distributed among all the continents, mostly in the northern hemisphere. The white stinkwood grows wild in eastern and southern Africa. In the forests there, the tree grows to a considerable height, while in open areas its size is limited.'),
(25, 2, 'Cabbage Palm, Cabbage Palmetto', 34.808, 31.9063, 16, 3.6, 1, 'A slow-growing palm tree with large fan-shaped, thornless fronds. The trunk is covered by a characteristic basketweave of the crisscrossed remnants of petiole (leafstalk) bases. Most specimens remain short for a long time, while a few develop a tall trunk and shed these petiole remnants. Branched inflorescences (clusters) of small yellowish-white flowers grow out from among the leaves. Each black berry contains a single seed. The cabbage palm is one of approximately 15 Sabal species that grow on both sides of the Caribbean. The cabbage palm is native to Cuba, the Bahamas and also the southeastern United States, where it grows in swamplands and along the coast. It is the state tree of both South Carolina and Florida.                                                                          The tree is resilient to cold, heat and salty coastal winds, and is also considered to be hurricane-resistant. The heart of the upper part of the cabbage palm trunk is edible, and it is one of the species grown for heart-of-palm production. In many parts of the world, including Israel, the cabbage palm is grown as an ornamental tree.'),
(26, 2, 'Cockspur Coral Tree', 34.8112, 31.9091, 17, 4.7, 1, 'A small and unusual tree, with a wide, rounded crown and a prominent bloom. The trunk is brown and fissured, and leaves are medium-sized, composed of three oval leaflets. It sometimes has thorns growing from its trunk, branches and the petioles (leafstalks) of its leaves. Clusters of deep red flowers develop in waves from the beginning to the end of the summer. The flowers are papilionaceous (butterfly-like) and their parts resemble boats: a large “sail” that looks like a cockscomb, out of which grows a narrow, horn-shaped “keel,” with small, barely visible “oars” on the sides. The flowers are followed by bean-like pods with dark seeds inside. The cockspur coral tree grows wild near streams and in boggy soils in South America. Its flower is the national flower of both Argentina and Uruguay. In its native region, it is an evergreen, but in Israel, it sheds its leaves in winter and sprouts new growth in the spring. New branches grow in groups that look like straw brooms from the tips of the main branches in the spring. The yearly cycle of drying out and renewal limits the tree’s size.'),
(27, 2, 'Oriental Plane Tree', 34.8128, 31.9088, 21, 3.6, 1, 'A large, impressive deciduous tree – one of the most magnificent trees in Israel. Its trunk is tall, and when mature, the smooth bark thickens and forms fissures. Its crown is tall and expands as the tree matures. The large leaves are divided into narrow, serrated lobes, and their light green color changes to golden brown before they fall. The tree is impressive adorned in its autumn finery and all the more so when bare in winter. The small flowers form round clusters; male and female flowers grow separately on the same tree. The female flowers develop into globular, fuzzy fruits that hang from stems in strings of three to six. The number of fruits in a string is one of the identifying marks of the various Platanus species. The genus Platanus, composed of 10 species, is the only genus of the Platanaceae family, and it is native to the northern hemisphere.                                                                   The Oriental plane tree grows naturally near water, from southern Europe to northern India. The tree has great importance in many cultures; in Kashmir, for example, all Oriental plane trees are protected by law and considered state property. The Oriental plane tree is very common as a shade tree on boulevards and in gardens all around the world. In Israel, where it grows wild, the tree is typical of northern landscapes with flowing water. The Oriental plane tree is also very popular in gardening.'),
(28, 2, 'Sausage Tree', 34.8122, 31.9074, 22, 4.9, 1, 'A tree with a thick, upright trunk. The sausage tree has smooth gray bark, an oval or round shape, and pinnate leaves with large dark leaflets. It is semi-deciduous: It sheds its leaves only during very dry summers or unusually harsh winters. In the spring and summer, large flowers develop on long, hanging stems that can be several meters in length. The flowers grow out perpendicular to the stems; their shape is characteristic of the Bignoniaceae family – tubular and funnel-like. The flowers open only at night, when they attract insects and bats. The fruits are immense and unusual: Light brown and shaped like loaves of bread or large sausages, they too are suspended from the long stems. The sausage tree is the only species in its genus. It grows throughout tropical and subtropical Africa, where it provides food for elephants, giraffes, monkeys and pigs. Native Africans also benefit from the tree – canoe-like boats are made from the trunks, a beer-like beverage is prepared from the fruit, and other parts of the tree are used in folk medicine.'),
(29, 2, 'Florida Fiddlewood, Jamaica Fiddlewood', 34.8108, 31.9066, 20, 4.7, 1, 'A medium-sized tree, usually evergreen, with exceptionally brilliant foliage. It grows on several upright trunks covered in fissured gray bark. The Florida fiddlewood has an elliptical shape that may be covered top-to-bottom in dense foliage. The glossy, deep green leaves are large and pointed. The tree is native to tropical America, where the leaves drop a short time before the cold season, but in Israel, it generally only changes its leaves in spring. The scientific name of the genus, as well as the tree’s common and Hebrew names, refer to the primary use of its wood – making such stringed instruments as lyres and violins. In late summer and autumn, long, curving, hanging inflorescences (flower clusters) bear small white flowers shaped like nails, which emit a strong fragrance that intensifies at night. The red round fruits turn black when ripe, but in Israel the tree rarely bears fruit. This tree was introduced to Israel prior to the establishment of the state. In the right conditions, it thrives on the coastal plain and in the valleys.'),
(30, 2, 'Pride of Bolivia, Rosewood', 34.8103, 31.9091, 18, 3.8, 1, 'A large shade tree with a wide crown. Its foliage is moderately dense, making for mild, pleasant shade. The pride of Bolivia is semi-deciduous; in warm climates it does not shed its leaves at all. In late spring or early summer, groups of slightly wrinkled flowers develop on the tree for a brief period. The flowers do not stand out when on the tree, but when they fall to the ground en masse, they color it bright yellow. Each fruit that develops after the tree blooms is actually a single seed attached to a large wing. The pride of Bolivia is native to Bolivia and Argentina, where it grows in a variety of conditions. Its timber is valued in the furniture industry and is known in the industry as rosewood (similar to the timber of the Dalbergia sissoo) or Brazilian rosewood. Because it grows quickly, and is strong and hardy, it has become a common ornamental tree around the world. In Israel, its use as an ornamental tree began in the 1970s and 80s, when it was often planted as a shade tree for boulevards, gardens and groves throughout the country.'),
(31, 7, 'Pi Squared', 34.8085, 31.9088, 0, 3.8, 1, 'A dairy restaurant operated by the “Karnaf” company. The menu includes a salad bar, pastas, pizzas, grilled sandwiches, soups, quiches, Meusli and a daily chef dish.'),
(32, 3, 'Main Gate', 34.8081, 31.9038, 0, 4.9, 1, NULL),
(33, 1, 'Michael and Anna Wix Auditorium', 34.8095, 31.905, 45, 3.9, 1, 'The Michael and Anna Wix Auditorium, designed by the architects Arieh Sharon and Benjamin Idelson in 1955 is the largest performance hall (620 seats) on Campus. True to Modernism, it lacks decoration; its majestic splendor is inherent in the building itself. Ten, double-height columns support the building’s massive roof – a modern interpretation of the Hellenistic temples and public buildings that were fronted by rows of columns supporting a triangular pediment such as the famous Temple of Nika or the Parthenon in Athens. Here, the classic columns and triangular pediment have given way to plaster-coated rectangular columns, which support a massive straight gable. At night, lighting installed above the narrow space between the columns and the building’s glass façade adds to the dramatic impact of the tall columns, with their narrow sides facing outward. Much attention has been paid to the design of the entrance canopy. Light-colored plaster connects the canopy to the building itself, behind supporting dark columns. The nine lamps of the canopy’s underside illuminate and mark the entrance. The sign above it projects modesty with its black letters, in a font characteristic of the period, held up by two white lines. '),
(34, 1, 'Sussman Building for Environmental Sciences', 34.8107, 31.9071, 55, 3.9, 1, 'The Sussman Family Building for Environmental Sciences was designed by Raphael Lerman and Dror Sdomi in 1995, in collaboration with Prof. Edna Shaviv – all three architects. The design was dictated by the building’s function: the study of the environment. This is a “green” building; it embodies the principle of sustainability: preserving a balance between society and the environment, to the detriment of neither, while taking heed of the future. Green construction standards now exist throughout the world, the most famous being the U.S. Leadership in Energy and Environmental Design (LEED) system, which served as a guide for the 2005 Israeli standard for green buildings. That standard defines a variety of criteria: the use of environmentally friendly materials (recycled or stemming from renewable resources), energy-saving measures and waste management. A number of green components are readily apparent on the exterior of the Sussman Building: the vegetation that surrounds the building, sun-deflecting grids for keeping the glass cool and planted areas in the central patio of the building and on the roofs, including a flat roof with greenhouses for absorbing hot air and channeling it into the air-conditioning ducts that also heat the rooms in winter. About a dozen different technologies for saving electricity were implemented in the building. The seminar room has ceiling fans that reduce the need for air-conditioning; the labs have pale-colored windowsills that reflect light into the interior. Electricity circuits for areas close to the windows have been separated from those situated in the depths of the building, where illumination is not aided by sunlight.  The architect Dagan Mochly was responsible for the interior design of the building, including the labs. These labs have fume hoods, the first of their kind in Israel, that slow down when there is no movement in the room and work in coordination with the air-conditioning system to prevent cooled air from leaking through the hood. A cylindrical chimney makes it possible to release fumes to the atmosphere safely, at a relatively great height. Finally, all the furniture and materials used for interior decoration are environmentally friendly.  The building consumes 50% less energy compared with regular labs. In the wake of its construction and in line with the world trend, green construction began to develop in Israel.'),
(35, 2, 'Surinam Cherry', 34.8091, 31.9073, 29, 4.6, 1, 'A small tree or a large evergreen shrub, notable for its foliage and fruit. The relatively thin trunk branches from its base; mature trees have a mottled bark. The leaves are opposite – they emerge from the branches in pairs – and they are glossy and egg-shaped with pointed tips. The tree sprouts new growth mainly in spring, in shades of red or reddish brown. This is when the plant is at the height of its beauty. In the spring, beautiful white flowers bloom among the leaves, similar in appearance to myrtle flowers. Round, flattened fruits develop from the flowers in the summer, and these turn dark red when ripe. Each fruit is a juicy berry with eight prominent ribs, containing one to three seeds. The ripe fruit is sweet-sour and has an unusual aftertaste. The genus Eugenia has approximately 1,000 tropical species, mostly on the American continent. Botanists are still discovering new species. The Surinam cherry grows wild in Brazil and nearby countries, where it is also grown as a commercial agricultural crop. The tree was introduced into Israel in the 1920s where it is known by the name pitango.'),
(36, 4, 'Menorah/Tree of Knowledge', 34.8093, 31.9068, 23, 4.3, 1, 'Menorah/Tree of Knowledge conveys multiple meanings via its shape. From the front, it looks like a menorah with six branches extending to the sides, while the seventh, central branch is at a diagonal. From a different angle, the sculpture resembles a tree with oranges interspersed among its branches. From the side, it evokes a dove spreading its wings in mid-flight, or a hand extended to the heavens in prayer; and from a different front view, it looks like a human figure bent backward – its legs supporting the mass above, its arms doubled or tripled and spread to the sides, and its waist encircled by electrons or satellites. Menorah/Tree of Knowledge was dedicated to Israel Sieff, Lord Sieff of Brimpton, on the occasion of his 80th birthday. Nathan Rapoport was born in Poland in 1911. He studied sculpture from age 16 in Warsaw. From 1936 he studied and worked in Italy and France, where he met Auguste Rodin, Aristide Maillol, and Jacques Lipchitz, and dedicated himself to creating monumental memorials like the 1948 Warsaw Ghetto Uprising Monument in Warsaw. Rapoport came to Israel in 1950 and created several well-known memorials, including the one to the leader of the Warsaw Ghetto Uprising in Yad Mordechai (1951) and the memorial to the fallen defenders of Kibbutz Negba (1953). Rapoport died in New York in 1987.'),
(37, 7, 'Charlies Place', 34.8061, 31.9074, 0, 5, 1, 'A daily restaurant operated by "Karnaf". The menu includes a salad bar, pasta made to order, fish, a variety of hot main and side dishes, soups, coffee, sandwiches and muesli'),
(38, 2, 'Jacaranda', 34.8123, 31.908, 16, 4.8, 1, 'A large tree that blooms abundantly in shades of blue and purple. The crown is round, wide and open, with medium-green foliage. The leaves are bipinnate (twice-compound) with pointed tips. The jacaranda is a semi-deciduous tree – in warm climates or during moderate winters it keeps its leaves or only partially sheds them. In spring the jacaranda blooms opulently at the branch ends, and if the tree is shedding its leaves, the display is especially outstanding. A second bloom may also occur in mid- to late summer. The flowers are tubular and asymmetrical, and they resemble shofars (rams’ horns). When they fall en masse, they carpet the ground in deep purple. After the tree blooms, fruits shaped like round disks develop on the tree, which are used as castanets. The jacaranda was introduced to Israel from the mountainous regions of Peru and Brazil during the British Mandate period and has been widely planted in gardens and groves.  A strong, quick-growing tree, the jacaranda is resilient to extreme heat and moderate cold, but sensitive to strong winds and salty or calcareous soils.'),
(39, 2, 'Golden Shower Tree, Indian Laburnum, Pudding Pipe Tree', 34.8072, 31.9077, 23, 4.2, 1, 'A fairly long-time resident of Israel. Mediumsized, its appearance is quite disheveled, with foliage that appears rich and tropical. The tree blooms profusely in summer. When in full bloom, it displays numerous bright yellow inflorescences (flower clusters) hanging downwards. After the tree has bloomed, long, distinctive pods develop, green at first and then brown. The pods look like pipes or oboes. The tree is native to India, where medicinal properties are attributed to the “pudding” inside the pods. In Israel, the tree sheds its leaves, which are pinnate with large down-turned leaflets. Between the end of winter and summer – as it begins to grow new leaves while in full bloom – the tree is partially or completely bare. The tree suffers in cold weather but responds well to heat and drought. It tends to be planted alone or in small groups to provide gardens with a colorful accent of bloom.'),
(40, 1, 'Daniel Wolf Building', 34.8098, 31.9077, 41, 3.4, 1, 'The Daniel Wolf Building, designed by the architect Erich Mendelsohn in 1939, was for many years neglected and divided up into numerous partitions, until in 1998 a decision was taken for its conservation. Architect Dagan Mochly had all the partitions removed to expose the building’s reverse-parabola inner space. This is one of the most interesting structures built by Mendelsohn in Israel – or anywhere else – and it is unique in every respect as a research/industrial building. Its tiled, pointed-arch roof is one of a kind at the Weizmann Institute and among Mendelsohn’s works. It resembles the barns and factories that were widespread in Europe in the early twentieth century. One such is Peter Behrens’s 1910 AEG turbine factory, famous for its simple shape and barrel vaulted roof, which has become an icon and a harbinger of Modernism in its early German version, the Jugendstil (“youth style”). In designing the Wolf Building 30 years after Behrens’s turbine factory, Mendelsohn gave a new meaning, in the spirit of the International Style, to the vaults familiar to him from Germany. As in the Weizmann House, whose round windows were nautically inspired, Mendelsohn turned this entire building into a large upside-down ship; its hull serves as the roof while its portholes appear on the façade. The building is named after Daniel Wolf, a Jewish Dutch businessman who disappeared during the Holocaust. Nowadays the building hosts an MRI (magnetic resonance imaging) facility that is mostly used for cancer research. Several research projects using MRI machines are carried out at the Institute. One example is the development of a noninvasive method for the early detection of breast cancer. This method could decrease the number of biopsies and might be used for diagnosing additional types of cancer as well. The MRI facility is used in other Institute studies dealing with various types of cancer.'),
(41, 2, 'Mediterranean Fan Palm', 34.8113, 31.9087, 24, 3.3, 1, 'A short palm tree with multiple trunks and an impressive sculptural shape. Several trunks covered in brown fibers grow from the base of the tree to a height of 1.5 to 5 meters. When mature, the group of trunks comes to resemble a candelabrum. Small- to medium-sized, rounded, fan-shaped fronds, which are split into narrow, stiff lobes, grow from the tops of the trunks. The petioles (leafstalks) are armed with sharp thorns that protect the young leaves from grazing animals. In spring, yellow inflorescences (clusters) of male and female flowers develop on separate trees. The pollen is carried by the wind and, in the plant’s native region, it is also transferred by a unique species of beetle. On female trees, clusters of small, round green fruits develop that turn purple-brown when ripe. The Mediterranean fan palm is the only species in its genus. It is the only palm that grows wild in Europe. The tree is native to the Iberian Peninsula and North Africa, where its leaves are used for weaving baskets and mats, and for making brooms.'),
(42, 2, 'Queensland Umbrella Tree, Octopus Tree ', 34.8096, 31.9067, 21, 3.4, 1, 'A tropical forest tree with rich foliage and a unique bloom. The Queensland umbrella tree usually grows on multiple thin, curved trunks. When young, its large leaves grow out of the top of a single trunk; when the tree matures, this trunk splits into branches and the tree’s shape broadens. Its palmate leaves (multiple leaflets growing from a single point) are composed of large glossy leaflets, with a long petiole (leafstalk). The circle of leaves may resemble an umbrella – hence one of the tree’s common names. In late summer, unusual long inflorescences (flower clusters) resembling horns or tentacles (hence the other common name) grow out of the treetop. Small red flowers containing nectar are borne on the stems of the inflorescences. The tree blooms for several months, and the flowers are replaced by globular purple fruits that are eaten in the tree’s native Australia by bats, tree kangaroos, other marsupials and birds. The Queensland umbrella tree is quite common as an ornamental plant worldwide. As it is a forest tree, it is very suitable for shade or indoor growing.');
INSERT INTO `point_of_interest` (`point_id`, `category_id`, `name`, `longitude`, `latitude`, `average_time_minutes`, `average_ranking`, `is_accessible`, `point_description`) VALUES
(44, 2, 'Rusty Fig, Port Jackson Fig', 34.8093, 31.9038, 17, 4.3, 1, 'A large evergreen tree, notable for its dense, dark foliage. Its trunk is robust, smooth and pale. Its leaves are oval and medium-sized; their undersides are rust colored, while their tops are smooth and green, so that the dark foliage stands out in contrast to the pale trunk. The rusty fig is native to eastern Australia, where tiny wasps pollinate the figs that develop in pairs among the leaves. This pollination softens them and turns them brown. The rusty fig is similar to the small-leaved fig, Ficus obliqua, and intermediate forms exist that blur the istinction among them. Within the Ficus genus, the rusty fig is relatively slow-growing and among the least aggressive. In the past, before the pollinating wasps reached Israel, its unripe fruit remained small and dry, and it was often planted along streets. Today, it is primarily used as an ornamental tree in parks and larger gardens – for shade, screening and as barriers.'),
(45, 1, 'The David Lopatie Conference Centre', 34.8095, 31.9047, 41, 3.6, 1, 'The David Lopatie Conference Centre, which includes the evinson Visitors Center, is located in the building that in the past housed the Edith and Abraham Wix Central Library, which was rendered redundant as a result of switching to on-line resources now available to scientists via the Institute’s internal computer network.   The original building, designed by the architect Arieh Elhanani in 1958 in the Modernist-Brutalist Style, included an exposed concrete framework hovering above ground, with precast vertical shading panels. The roof has pyramid-shaped structures that provide both height and strength. The façade is supported by four asymmetrically placed round columns: three on the western side and one in the eastern corner of the building. The concrete load-bearing wall between the columns is faced with a bluish mosaic that matches the door and window frames on the façade.   The side wall, as well as the underside of the ceiling on the façade, has exposed concrete panels characteristic of the Brutalist Style. The main difficulty in casting such panels is a lack of precision in the casting beds due to problems of size, causing variations in the consistency of the slabs. The solution is to create permanent seams between the panels in advance, to stress that the casting was done peacemeal. In addition, temporary wooden surrounds shaping the panels during casting are placed alternately horizontally and vertically; when the surrounds are removed, the concrete slabs “remember” their positioning. The quality of the casting will determine the ability of the building to withstand the test of time.   Supervising the adaptation of the building to its new function is the architect Amir Kolker. Nowadays it hosts dozens of International conferences a year, which are organized by the Institute’s scientists.'),
(46, 2, 'River Red Gum', 34.8069, 31.9079, 22, 4.1, 1, 'A very large tree, common and familiar to most Israelis. The upright trunk is wide and impressive. Its bark is smooth, pale and mottled, and it peels off in strips. The big branches point upwards, and they have a tendency to break off unexpectedly. The dull-olive-green leaves have a characteristic, myrtle-like smell; they are stiff, narrow and slightly bowed. Before opening, the white flowers are hidden in an operculum with a pointed cover that resembles a beak.                                       The flowers give way to bunches of woody, spherical fruits bearing triangular tooth-like valves that open to release the seeds. The river red gum is the most common of the hundreds of eucalyptus species growing in Australia and its environs. Often found in the continent’s interior, it grows primarily along river channels with seasonal flooding patterns. The river red gum is an iconic tree in Australia and even appears on some of the country’s postage stamps. A fast-growing and easily adaptable tree, the river red gum has become one of the most common trees of its kind, used in afforestation and as an ornamental tree around the world. In Israel, the river red gum is associated with the early settlement of the country; the pioneers originally planted it to drain the swamps and, later, as a fast-growing forest tree across the entire country, including in arid regions.'),
(47, 7, 'Cafe Mada', 34.8097, 31.9043, 0, 4.6, 1, 'A dairy restaurant, located next to the Visitors Center, with a veranda facing a unique Japanese garden. There are picnic benches in the adjacent area for boxed lunches and quiet time.'),
(48, 1, 'Koffler Accelerator of the Canada Centre of Nuclear Physics', 34.8126, 31.908, 60, 3.8, 1, 'The Koffler Accelerator of the Canada Centre of Nuclear Physics, designed by the architect Moshe Harel in 1975, has become the undisputed architectural symbol of the Weizmann Institute. The unique structure combines two towers. One, shaped like a corkscrew, is 57 meters high; the other, 53 meters high, is topped by an egg-shaped structure 22 meters long and 14 meters across at its widest point. This design belongs to a period influenced by the first achievements in space, by pop music and by the props of science fiction films (such as the futuristic but real home in which Woody Allen’s Sleeper was filmed in 1973). At the time, architectural groups and movements were searching for new ways of expression that would diverge from straightforward, “dry” Modernism. Most famous among these was the Archigram Group, which designed structures so futuristic and radical they were never built. These included transportable buildings with legs and a city whose parts could be removed or added. The accelerator at the Weizmann Institute of Science is clearly related to the Einstein Tower, a solar observatory in Potsdam, Germany, built in the early 1920s by Erich Mendelsohn, the famous architect whose name is inextricably linked with the Weizmann Institute.  In the 1970s, the accelerator enabled Weizmann Institute scientists to work at the forefront of world science. With time, however, its experiments reached their completion, and recently it was decided to end its operation. The Koffler building is made of exposed concrete cast under pressure in industrial steel beds, as evidenced by signs of holes in the concrete, and is painted white. One of the concrete towers looks like a mushroom stalk, bulging somewhat in the middle, atop which is the “egg.” The other, the “corkscrew,” is the service tower. The towers are connected by a joint ground-floor structure as well as by three bridges at different levels. The monumental but simple geometry of the accelerator building is a striking example of Formalism in architecture, which can also be seen in such new buildings as the CCTV tower designed by Rem Koolhaas in Beijing and the “antenna towers” designed by Santiago Calatrava in various places around the world, including Berlin, Shanghai and Barcelona.'),
(49, 4, 'Tree of life', 34.809, 31.9072, 26, 4, 1, 'Tree of Life rests on a wide trunk that gives rise to numerous branches, some of them shaped like women whose legs, arms, and garments appear to emerge from the sprawling branches. A closer observation reveals that these women are “giving birth” to a multitude of smaller creatures. These figures evoke a dynamic and upbeat legendary world nurtured by Reder’s memories of his hometown of Czernowitz, one of the birthplaces of the Hassidic movement. The complex work also hints at Greek mythology and French culture. A combination of the human body with the world of fauna and flora evokes a novel experience, fantastic and surrealistic, combined with theatrical and mystical elements and imbued with poetic atmosphere. Bernard Reder was born in Czernowitz (Austria, today Ukraine) in 1887. He studied at the Academy of Fine Arts in Prague, and worked and exhibited his sculptures together with Aristide Maillol in Paris. With the conquest of Europe by the Nazis he was forced to flee to Spain, and then went on to Portugal, Cuba, and the United States. His sculptures are on display in modern art museums in Paris, New York, and other cities. Reder died in New York in 1964.'),
(50, 2, 'Rosewood', 34.8142, 31.9078, 28, 3.9, 1, 'An erect tree that, under favorable conditions, attains considerable dimensions. The rosewood has a tall trunk and wrinkled gray bark. The dark, exquisite heartwood is in great demand for high-quality, high-end carpentry, and the industry name for the wood – rosewood – is also the name of the tree. The tree is native to northern India where, in winter, the tree sheds its leaves. These are pinnate with three to five leaflets that are round with a prominent sharp point. In Israel, only during especially cold winters does the tree shed all of its leaves; otherwise only some or none of the leaves fall. In spring, its small, fragrant yellowish-cream flowers attract honeybees. After the tree blooms, small, flat pods develop. In the past, rosewood was planted in groves and boulevards throughout Israel, but due to improper care and over-pruning, many of the trees withered or became twisted. In contrast, rosewood trees that have grown undisturbed have established themselves, becoming large and impressive trees. At the Weizmann Institute, rosewood trees grow along the length of Marcus Sieff Boulevard.'),
(52, 1, 'Sidney Musher Building for Science Teaching', 34.8112, 31.9078, 57, 4.3, 1, 'The Sidney Musher Building for Science Teaching was designed by the architect Gershon Zippor in 1990. Erected where a pine grove once stood, the building’s presence was minimized by being designed as a glass box growing out of the surrounding lawn and vegetation which are reflected in its mirror walls. The dark-shaded glass not only conceals what is happening indoors; it also hides the divisions and levels of the building. The entrances to the building, accentuated by striking yellow and red paint, stand out from the simple black glass box. At the main entrance, a yellow metal pyramid directs visitors to the Department of Science Teaching and to the side entrance of the Feinberg Graduate School. Red paint covers the aluminum jamb of the entrance door and the round column in the “missing” corner on the ground floor of the building, which creates a roofed entrance space and breaks up the perfect box. The Department of Science Teaching at the Weizmann Institute was created in 1968 by Professor Amos De Shalit. It is a full-fledged academic department whose main mission is to advance the field of science and mathematics education at large, and to impact science and mathematics education in Israel. A central goal of the department is to develop academic and practical leadership in mathematics and science education.'),
(53, 2, 'Yellow Poinciana, Yellow Flame', 34.8093, 31.9051, 30, 4.1, 1, 'A large tree whose crown turns bright yellow when it is in bloom. The gray trunk is fissured at its base and smooth farther up. The branches grow out horizontally to form a wide, round shape. Its bipinnate (twice-compound) leaves are composed of small deep green leaflets that resemble the leaves of its relative – the royal poinciana. The yellow poinciana is a semi-deciduous tree. In its native South America it is evergreen, but in colder regions (including most of Israel), it sheds its leaves. In summer, when it blooms in deep yellow, its radiant beauty is irresistible. Its flower petals are wrinkled. After it blooms, the tree becomes covered with a multitude of flat brown pods. The yellow poinciana is strong and grows quickly; due to its striking bloom and the shade it provides, it is a common ornamental tree on boulevards and in gardens. In Israel, it was extensively used along boulevards and streets in the 1970s and 80s but, because its shallow roots can become aggressive when mature, today it is planted primarily in large gardens and parks.'),
(54, 2, 'Nyasaland Mahogany', 34.8063, 31.9072, 19, 4.3, 1, 'A very large, tropical evergreen with a thick, tall, straight trunk; the branches only begin high up. The foliage has a rich appearance, and the leaves are even pinnate (composed of even numbers of leaflets) with large green leaflets. The tree has small, fragrant white flowers arranged in sparse clusters, which are barely visible as they are so high up. Its globe-shaped fruits open into four valves, and the seeds germinate easily. The genus Khaya includes a number of species – all hardwoods like mahogany, which is in constant demand for lumber. The Nyasaland mahogany’s characteristic red wood has also been used in the past for drums and for canoes called makoro. Though this tree grows from the Ivory Coast to Mozambique, it is, nonetheless, named after Lake Nyasa in Malawi. Today, the tree is endangered due to deforestation in Africa. The only group of mature trees of this species in Israel is located at the Weizmann Institute of Science. They were planted here experimentally by Dr. Israel Gindel as part of the work of the JNF’s Forestry Research Lab.'),
(55, 6, 'Helen and Milton A. Kimmelman Building', 34.8099, 31.9063, 16, 4.5, 1, 'The Helen and Milton A. Kimmelman Building is, in essence, an extension of the Ernst David Bergmann Institute, a four-story concrete structure designed by the architect Moshe Harel in 1963. In 1994, two floors were added to it, becoming the Kimmelman Building, jointly designed by the architects Gershon and Barak Zippor, Zadok Sherman and Shmuel Potash. Its façades were refaced with a large, modern screen wall of bluish greenish glass that covers the entire side facing the street, except the ground floor. The glass used in this wall is reflective rather than transparent, and its relative opacity turns it into a one way mirror on the outside, making it possible to cover the entire building – from the windows to such solid parts as the walls and the concrete floor – in a uniform manner. The resultant appearance is misleading: Rather than revealing to the outside observer what is happening inside the building during the day, the glass turns into a mirror, keeping the building’s interior a mystery. At night, the mirror is reversed: a person inside the building can hardly see the outdoors, while those on the outside can see everything that is happening within the lit rooms. The building, however, is used mainly during the day, preserving the workers’ privacy, while the bushes and the tall cypress trees in the garden are reflected and duplicated in the glass.   This innovative technology immediately became a great hit; buildings of this type can be seen in office areas and high-tech industrial parks throughout Israel. In the Kimmelman Building, the architects, for practical and design reasons, have used granite and granite porcelain tiles to cover the concrete protrusions of the extension cables that reinforced the existing building, making it possible to add the two floors. In the entrance lobby, the designers have also used glass – here as a covering to the building’s frame; but this time the glass is transparent, with turquoise inscriptions matching the color of the glass outside. Molded to a rounded shape, the glass serves as a plaque covering the building’s two main columns at the entrance. The reddish floor tiles of the lobby are reminiscent of the exterior stone facing, while the delicate shades of turquoise in the wall painting by David Kedem and Amiram Shamir echo the greenish screen wall.'),
(56, 2, 'Royal Poinciana, Flamboyant', 34.8086, 31.9041, 23, 4.4, 1, 'One of the most beautiful trees in Israel. It is prized for its lush red and orange bloom in summer; at its height, the tree appears to “burn” like a flame, hence the common name, flamboyant. The tree has a wide canopied shape, reminiscent of the acacia tree of the Negev; hence the tree’s Hebrew name comes from tze’ela, the biblical name for acacia. The royal poinciana’s trunk and primary branches have an impressive structure, which is apparent when it is bare in winter. Its root system is shallow and sometimes protrudes above ground. Its large bipinnate (twice-compound) leaves have very small, deep green leaflets. The foliage is usually shed in winter, with new leaf growth occurring late, at the end of spring. After the spectacular bloom, large dark, flat woody pods develop. The royal poinciana is native to Madagascar, where it is endangered; but as an ornamental tree it thrives in warm, tropical countries. It was introduced into Israel in the 1920s. It grows most successfully in the Jordan Valley and the Arava, where it blooms in flaming red. In other valleys and on the coastal plain, its success depends on local conditions.'),
(57, 2, 'Indian Laurel Fig, Chinese banyan', 34.8071, 31.9061, 25, 3.4, 1, 'A wide evergreen tree, one of the most common ornamental trees in Israel. When allowed to grow without interference, it develops a wide trunk from which numerous large branches grow diagonally upwards to create a dense shape. Aerial roots may grow downwards from the primary branches and along the trunk. When the tree matures, a weave of surface roots develops at the base of the trunk. This contributes to the tree’s beauty, but also endangers nearby paving and foundations. The bark is quite smooth and pale gray. The leaves are small, oval and glossy (one of its earlier names in Hebrew was Ficus notzetz, shiny ficus). The leaves are dark green; new, pale green leaves stand out against the dark green background, giving the tree a youthful look.  When the tree blooms, small green figs develop on the branches. Tiny wasps particular to this Ficus species pollinate them so that they ripen and soften. These wasps arrived in Israel only in the last few decades of the 20th century. The ripe figs attract birds and fruit bats, leading to a decrease in the use of the tree in recent years. The Indian laurel fig has a wide natural distribution: India, Sri Lanka, southern China, Malaysia, Indonesia, northern Australia and New Caledonia. The Ficus genus includes over 800 species of trees, shrubs and climbers, including two well-known species in our region: Ficus carica – the common fig, and Ficus sycomorus – the sycamore fig.'),
(59, 1, 'Weisgal Square', 34.8091, 31.9075, 46, 4, 1, 'Named after Meyer Weisgal, who served as the personal assistant of Chaim Weizmann and was the Institute’s 3rd president (between 1967-1970). The square was designed by Erich Mendelsohn and consists of many research buildings in the field of life sciences. This proximity contributes to scientific collaborations between scientists from various fields of research. For example: The Personalized Nutrition Project: (biology + mathematics) which wants to understand how our personal mix of gut bacteria contributes to our body’s response to food? Does it affect, for example, sugar levels in the blood – particularly the elevated levels that lead to metabolic syndrome and diabetes? And can understanding our own, personal nutrition profile ultimately help us to make healthier eating choices?'),
(60, 4, 'Ensemble', 34.8107, 31.9068, 21, 3.9, 1, 'Semaphore belongs to the artist’s “Totems” series. The upward-thrusting sculpture is made of forged iron treated with a heavy industrial hammer. The sculpture’s title is derived from the signaling system used by navigators at sea and by train drivers. Columns have always formed the basis of architecture. At the outset they were linked to nature, to vegetation, and always to landscape. Here, the column is industrial and man-made, rebelling against divine nature. An additional contrast embodied in the sculpture sums up the Israeli experience: on the one hand closely tied to the West, on the other hand striving to be part of its immediate context, the Middle East. Igael Tumarkin, born in Germany in 1933, immigrated to Israel as a two-year-old. He was a student of Rudi Lehmann in 1954, and in the following year studied and worked with Bertolt Brecht in the Berliner Ensemble in East Berlin. Renowned as a sculptor, painter, writer, intellectual and rebel, Tumarkin fought for a break from the lyrical abstract and is known for his groundbreaking use of new materials. He has represented Israel at the Venice Biennale and the São Paulo Biennale. His works are exhibited in various cities in Israel, Germany, France, Spain, the former Czechoslovakia, Japan and the United States.'),
(61, 1, 'Memorial Plaza', 34.819, 31.9078, 60, 4.3, 1, 'The Square was built in the early 1950”s. After Weizmann’s death, it was used for memorial ceremonies in his memory, and for cultural activities of “Yad Chaim Weizmann”. Cultural events including concerts and performances were held here. Today, the Feinberg Graduate School holds its annual presentation of degrees ceremony at the Square. In 1972 the sculpture before you, designed by Dani Karavan, was erected. This monument to victims of the Holocaust has a Torah Scroll placed on top of a block of stone. (The stone was quarried in Israel and the Scroll  made of brass was cast in Italy. The height of the Scroll is one meter and it weighs three tons). Engraved on the stone is a section from Dr. Weizmann’s eulogy In memory of the victims of the Holocaust, which he gave in 1946 at the Zionist Congress. In order to read the eulogy, which he presented in Yiddish, you must walk around the stone six times in memory of the six million Jews who perished in the Holocaust. This was the first Zionist Congress held after WWII, and the last one that Weizmann attended as President of the World Zionist Organization. The monument the Torah Scroll rests upon but does not rest, is made of bronze, and has engraved upon it the numbers that were burned on the arms of the Jews interned in the concentration camps, as well as the names of communities, towns and the extermination camps. Leading to the sculpture is a narrow metal rail which represents the train tracks for the trains which brought Jews to the death camps. The words inscribed on the memorial are from a poem by Avraham Shlonsky, “To Remember and Not Forget.” North of the sculpture is a Memorial Garden in memory of the Jews of France who perished in the Holocaust as well as to Simone Weil  a minister in the French government and a French Jewish leader. The garden, planted in 2002, was inaugurated by Simone Weil herself. Every summer for 14 years, Dr. Vera Weizmann, a qualified pediatrician, offered this land for use as a summer camp for the  “ILANSHIL” Foundation, a Hebrew acronym denoting "Israeli Organization on Behalf of Polio Victims" (today called “Ilan” the Israel Foundation for the Handicapped). In the early fifties there was a terrible epidemic and many children suffered from the disease. Tents were erected on the site and the children benefited from activities, meals and special physiotherapy treatments held in the swimming pool. To your West – is the modest grave of Meyer Weisgal and his wife Shirley, who requested to be buried at the foot of his “Chief” Chaim Weizmann, (he addressed Weizmann in his letters as “Dear Chief”).   Weisgal actually established the Weizmann Institute and served as its President in the years 1967-1970. In addition to running the Weizmann institute, Weisgal was active in numerous public activities, inter alia, the establishment of the Israel branch of “Variety”, as well as in political and defense activities. He helped in in the production of the film “Exodus”, and even appeared in the movie. He portrayed “David Ben Gurion” in the scene involving the declaration of the State of Israel.  Meir Weisgal died in 1977.'),
(63, 2, 'Southern Magnolia, Bull Bayv', 34.8114, 31.9088, 27, 3.3, 1, 'A very impressive tree with huge white flowers. In its native regions in the east and south of the United States, the southern magnolia reaches great heights, but in Israel, it does not fulfill its potential. Its large, glossy leaves are brownish on the underside; and its unique flowers are very large, firm and fragrant. The fruits resemble fuzzy cones with bright red seeds protruding from them. The genus Magnolia belongs to one of the first families of flowering plants to appear on Earth; this can be seen in the structure of the flower and fruit. There are a number of additional Magnolia species, all of which have elegant flowers and most of which are deciduous. Due to its lavish appearance and wide distribution in its native region, it is often used as a symbol of the American South, especially in books and films. The southern magnolia is resilient in cold weather but suffers in excessive heat and drought, so it is mainly suitable for the cooler regions of Israel.'),
(64, 2, 'Red Silk cotton Tree, Kapok', 34.8109, 31.9084, 24, 4.5, 1, 'A magnificent, large, tropical tree native to South Asia. Its trunk is upright, rising conically to the top of the tree, and its branches grow either horizontally or somewhat diagonally in “split levels.” Its unique, pagoda-like silhouette is especially noticeable in winter, when it sheds some or all of its hand-shaped leaves. At the end of winter and in spring, the tree’s bare branches display buds that blossom into enormous orange or orange-red flowers with a plastic appearance. Its fruits open into five valves, releasing seeds wrapped in silky cotton that is blown away by the wind. The fruit’s fibers are harvested as kapok, which is used to fill pillows and blankets. In China and India the red silk cotton tree has been grown as an ornamental tree for centuries. In Israel it has been grown for some time; its popularity has increased in recent years.'),
(65, 2, 'Common Screwpine', 34.8097, 31.9043, 22, 3.3, 1, 'A sculptural plant with an upright, cylindrical trunk that is “scarred” with signs of leaves that have fallen off. Prop roots grow out of the trunk, creating a wreath of “crutches” that help the tree support its weight. Its branches, which normally grow in opposite pairs, create a andelabrum-like structure. At the top of the trunk is a dense crown of leaves arranged in a kind of spiral. Male and female flowers develop on separate trees. Large, tough, edible fruits that resemble pineapples or large pinecones develop from the female flowers. These woody fruits remain on the tree for a long time before dropping, and they can easily float from island to island. The genus Pandanus includes several hundred species. The common screwpine grows wild on the islands of Madagascar, Mauritius, Reunion and the Seychelles – all east of Africa. There, natives use the leaves for roofing, weaving ropes and fishing nets, mats, baskets and hats. Thus the species name utilis: useful. The common screwpine is resilient in the face of wind and ocean spray. There are only a few specimens in Israel, but they attract attention. The well-developed common screwpine growing in the Weizmann Institute’s garden is one of the most magnificent examples in the country.'),
(66, 6, 'The Levinson Visitors Center', 34.8098, 31.9048, 76, 3.9, 1, 'Visits to the Levinson Visitors Center are free of charge but must be coordinated in advance. The state-of-the-art Levinson Visitors Center is the gateway to the Institute, giving visitors a window into the unique nature of scientific investigation and discovery at the Institute, Here, visitors will learn about the Weizmann Institute’s central role in Israeli science and technology. The Center contains technologically advanced exhibits and a state-of-the-art multi-media presentation that take the visitor on a journey of knowledge and discovery, where one can learn about the fascinating world of scientists who uncover the secrets of nature and decipher the codes of the universe. The Center also has a small souvenir shop with a selection of items.'),
(67, 2, 'White Floss Silk Tree', 34.8093, 31.905, 23, 4.9, 1, 'A semi-deciduous tree; the appearance of its trunk and flowers is striking. The bottle-shaped gray trunk is the most distinctive part of the tree and the source of its popular name “drunken tree” (in Spanish: palo borracho, literally “drunken stick”). The trunk and the branches that extend from it horizontally are covered in sizable thorns. The leaves are palmate, composed of five to seven leaflets that grow out of a single point and resemble a hand. Individual white floss silk trees can bloom in different periods: The yellowish-white flowers, composed of five narrow petals, may appear any time from summer to early winter. After the tree has blossomed, fruits in the shape of green capsules develop on the tree; the seeds inside are wrapped in a cocoon of silky white fiber. These fibers are used to stuff pillows and mattresses, as well as for rope-making. The tree’s sap is used as an ingredient in a hallucinogenic drink. The white floss silk tree is native to the subtropical regions of Peru and Argentina.'),
(68, 2, 'Mango', 34.8089, 31.9074, 18, 3.6, 1, 'An evergreen fruit tree with an impressively large, dense crown. The mango grows to enormous dimensions in its native India, and it is considered to be the largest fruit tree in the world. The trunk is dark, and the dark green leaves are glossy, thick, elongated and pointed. The color of the new leaves varies from red to bronze. In spring, the flowers develop in large terminal panicles (branched clusters that grow on the branch tips) with a great number of small, pinkish white flowers. Most of the flowers are female; a few are male. In most mango varieties, the tree self-fertilizes. In summer, large fruits develop on the flowering branches. The shape, color, taste and texture are particular to each variety of mango. The genus Mangifera includes several dozen species, about 30 of which produce edible fruit. The Indian mango is the only one grown commercially. It was domesticated in India approximately 4,000 years ago, and over 2,000 different varieties have been developed. The mango was introduced to Israel from Egypt in the early 20th century and was planted for agriculture beginning in the 1930s. Since then, a number of local, Israeli varieties have been developed; the most well-known is the Maya mango.'),
(70, 6, 'Clore Garden of Science', 34.8125, 31.9098, 105, 3.3, 1, 'All visits to the Clore Garden of Science must be coordinated in advance. The Clore Garden of Science, with its 800 square meters of green lawns, is home to nearly 90 hands-on exhibits large and small. The exhibits demonstrate the laws of physics, solar energy, water, power and other natural phenomena that we often take for granted. These hands-on exhibits come to life in the encounter with a curious visitor who physically interacts with them in a way that elicits curiosity and excitement among children and adults alike.  '),
(71, 1, 'Daniel Sieff Research Institute', 34.8095, 31.9068, 41, 5, 1, 'The Daniel Sieff Research Institute building continues to serve its original purpose as the home of the Department of Organic Chemistry, Dr. Chaim Weizmann\'s original field of study. The Institute, which gave rise to the Weizmann Institute of Science, was established in 1934 on the initiative of Dr. Chaim Weizmann. It was built with a donation from Israel and Rebecca Sieff, among the founders of the Marks & Spencer chain of Department stores, who wished to commemorate their son Daniel. The inscription in three languages – English, Hebrew and Arabic – on the front of the building testifies to Weizmann’s vision of peace, comradeship and joint enterprise between Jews and Arabs. The building was designed by Benjamin Chaikin. The logo on the building is the work of the noted Jewish architect Erich Mendelsohn and, to the best of our knowledge, typographer Francesca Baruch. Among the first scientists were a number of scientists who were forced to flee Nazi Germany. The main scientific activity was based on the pure scientific research and the research relating to the immediate needs of the evolving community in Israel. The scientific staff’s research efforts bore fruit to meaningful achievements in a national and global rate. The well-preserved building and its entrance are characteristic of the period, combining the International Style with typical Mediterranean elements. A striking example is the cornice of the building’s roof, pointed toward the center like a classical Greek pediment. A complicated system of protrusions and depressions emphasizes the cornice, the position of the entrance and the line of the upper and lower windows. The latter resemble the famous ribbon windows by the French architect Le Corbusier, one of the hallmarks of the International Style. Yet Chaikin, an Eretz-Israel architect, chose not to disconnect the columns from the wall, creating a ribbon window using depressions only. While the original wooden roll-down shades have not survived, the building’s central staircase is exceptionally well preserved and deserves to be an object of pilgrimage by historians, conservation architects and all nostalgia aficionados. Here one finds materials and decorations of a rare quality: light-gray Carrera marble for the floor with two black stripes running along the sides of the corridor; iron balustrades with geometrical straight lines and barred iron newel posts at the corners; and a stylized wooden handrail.                                 The iron entrance door is also the work of a master craftsman. Each of its heavy wings is 2.5 meters high. On the second floor is the lab in which Dr. Weizmann conducted his numerous research projects, preserved as if the scientist had just stepped out to lunch and will be returning shortly. Displays include various research installations and original wooden furniture.  '),
(74, 6, 'Weizmann House', 34.8186, 31.9065, 107, 4, 1, 'The Weizmann House was designed by the noted architect Erich Mendelsohn in 1936 to serve as the private residence of Dr. Chaim Weizmann and his wife Dr. Vera Weizmann. They chose to build their house on a hill near the Daniel Sieff Research Institute, founded by Chaim Weizmann in 1934. It was the first building designed by Mendelsohn in Israel, constructed in the Modernist International Style and referred to in popular parlance as “the palace,” due to its hilltop location and its size: It covers an area of 1,000 square meters and is surrounded by a 10-acre garden. The design of the house, influenced by Le Corbusier’s Villa Savoye, combines a number of International Style principles with design elements and materials that, at Weizmann’s request, were local, such as the Hebron-stone floors. The U-shaped structure is designed to surround a west-facing swimming pool, such that the sea breeze ripples the pool’s water and helps lower the temperature, as do the fountains and decorative pools of traditional Arab and Mediterranean construction. Traditional elongated doors lead to the swimming pool, which is flanked by two arcades of four columns each. Two of these columns on the western side support a flat roof. The building incorporates several naval motifs, including porthole windows on the side and, centered between the building’s two wings, a cylindrical structure, the stairwell of an imposing spiral staircase, which stands out like a captain’s command post. The building’s two wings also include a guest room on the northern side and a library recessed into the particularly thick southern wall, home to 1,200 books in six languages: Hebrew, English, Russian, German, French and Yiddish. Though the unique western façade has become the most recognizable hallmark of the Weizmann House, it is the southern side that contains the official entrance, projecting functional modesty and masking the splendor of the interior.            This modesty also characterizes the grave of Chaim and Vera Weizmann in the garden. The double tombstone was fashioned after the tombstones of missing soldiers in Great Britain, in memory of their son Michael, a Royal Air Force pilot whose plane was shot down over the Bay of Biscay in World War II. In 1999, the Weizmann House was renovated according to the design of architect Hillel Schocken. In 2016 the House underwent yet another restoration project which focused primarily on the house’s exterior and lasted 1 year. The House was Chaim and Vera Weizmann’s private residence until 1949, when Weizmann was elected first president of the State of Israel and then the home became the official presidential home until Weizmann passed away in 1952. Weizmann House is open to the public Sundays-Thursdays between 9:00 AM – 4:00 PM. It is recommended to coordinate the visit in advance. For further information: 08-9343230.  '),
(75, 2, 'White Mulberry, Silkworm Mulberry', 34.8139, 31.9081, 27, 3.7, 1, 'A deciduous tree with a broad silhouette and a short trunk. Its large leaves are smooth on both sides; they are the preferred food of silkworms. The white mulberry is dioecious (and is thus differentiated from the black mulberry) – its male and female flowers grow on separate trees. The male flowers catapult their pollen at the tremendous velocity of about half the speed of sound, and it is carried on the wind to the female flowers. After fertilization, the petals of the female flowers swell and grow together to form a compound fruit, consisting of many small, individual fruitlets, or drupes; it is considered a pseudo-berry. Despite the name, the fruit can be white, red or almost black. The white mulberry was cultivated in China. Its ancient Hebrew name is identical to the tree’s Persian name and is similar to its names in India (tuta, tuti). It was first introduced into Israel in the 16th century, and again in the 19th century, with the intention of establishing a silk industry here, but the attempts were unsuccessful.');

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `tour_id` int(10) UNSIGNED NOT NULL,
  `planned_date_and_time_tour` datetime NOT NULL,
  `tour_duration` int(3) UNSIGNED NOT NULL,
  `is_acccessible_only` tinyint(1) NOT NULL,
  `is_cafeteria` tinyint(1) NOT NULL,
  `cafeteria_time` int(3) UNSIGNED NOT NULL,
  `participants` int(3) DEFAULT NULL,
  `tour_type` int(1) UNSIGNED NOT NULL,
  `has_started` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`tour_id`, `planned_date_and_time_tour`, `tour_duration`, `is_acccessible_only`, `is_cafeteria`, `cafeteria_time`, `participants`, `tour_type`, `has_started`) VALUES
(2, '2019-05-25 10:00:00', 125, 1, 1, 25, 0, 2, 0),
(21, '2019-05-28 11:58:00', 80, 1, 0, 0, 1, 1, 1),
(22, '2019-05-31 13:11:00', 80, 1, 0, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tour_categories`
--

CREATE TABLE `tour_categories` (
  `tour_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tour_categories`
--

INSERT INTO `tour_categories` (`tour_id`, `category_id`) VALUES
(21, 1),
(21, 3),
(22, 2),
(22, 3),
(22, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tour_points_of_interest`
--

CREATE TABLE `tour_points_of_interest` (
  `point_id` int(10) UNSIGNED NOT NULL,
  `tour_id` int(10) UNSIGNED NOT NULL,
  `point_position` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tour_points_of_interest`
--

INSERT INTO `tour_points_of_interest` (`point_id`, `tour_id`, `point_position`) VALUES
(32, 21, 0),
(32, 22, 0),
(25, 22, 1),
(71, 21, 1),
(36, 22, 2),
(38, 22, 3),
(12, 22, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(10) NOT NULL,
  `street_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `house_number` int(3) NOT NULL,
  `city` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` int(1) NOT NULL,
  `registration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `gender`, `date_of_birth`, `email`, `password`, `phone`, `street_name`, `house_number`, `city`, `user_type`, `registration_date`) VALUES
(1, 'Guy', 'Cohen', 'Male', '1992-05-20', 'guycohen@gmail.com', '12345678', 522555462, 'Dizingof', 20, 'Tel Aviv', 1, '2019-05-02'),
(2, 'Nadav', 'Golan', 'Male', '1980-02-01', 'nadavgolan27@gmail.com', '123456', 503213211, 'Neve Yehosua', 19, 'Ramat Gan', 2, '2019-04-01'),
(3, 'Beni', 'Levi', 'Male', '1992-02-11', 'benilevi@gmail.com', '11223344', 501234567, 'Arlozorov', 22, 'Tel Aviv', 1, '2019-03-04'),
(4, 'Shahaf', 'Doron', 'Male', '1991-03-05', 'shahaf1doron@gmail.com', '12345', 500001112, 'hagefen', 9, 'Ramt Gan', 3, '2019-05-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `tour_ID` (`tour_id`),
  ADD KEY `user_ID` (`user_id`);

--
-- Indexes for table `guide`
--
ALTER TABLE `guide`
  ADD PRIMARY KEY (`guide_id`);

--
-- Indexes for table `guided_tour`
--
ALTER TABLE `guided_tour`
  ADD PRIMARY KEY (`guided_tour_id`),
  ADD KEY `guide_ID` (`guide_id`),
  ADD KEY `group_size` (`group_size`),
  ADD KEY `tour_cost` (`tour_cost`);

--
-- Indexes for table `guided_tour_registration`
--
ALTER TABLE `guided_tour_registration`
  ADD PRIMARY KEY (`guided_tour_id`,`registered_tourist_id`),
  ADD KEY `guided_tour_ID` (`guided_tour_id`),
  ADD KEY `registered_tourist_ID` (`registered_tourist_id`);

--
-- Indexes for table `independent_tour`
--
ALTER TABLE `independent_tour`
  ADD PRIMARY KEY (`independent_tour_id`),
  ADD KEY `independent_tourist_ID` (`independent_tourist_id`);

--
-- Indexes for table `point_feedback`
--
ALTER TABLE `point_feedback`
  ADD PRIMARY KEY (`feedback_id`,`point_id`),
  ADD KEY `feedback_ID` (`feedback_id`),
  ADD KEY `point_ID` (`point_id`),
  ADD KEY `point_ranking` (`point_ranking`);

--
-- Indexes for table `point_of_interest`
--
ALTER TABLE `point_of_interest`
  ADD PRIMARY KEY (`point_id`),
  ADD KEY `category_ID` (`category_id`),
  ADD KEY `average_time_minutes` (`average_time_minutes`),
  ADD KEY `average_ranking` (`average_ranking`);

--
-- Indexes for table `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`tour_id`),
  ADD KEY `tour_duration` (`tour_duration`),
  ADD KEY `cafeteria_time` (`cafeteria_time`);

--
-- Indexes for table `tour_categories`
--
ALTER TABLE `tour_categories`
  ADD PRIMARY KEY (`tour_id`,`category_id`),
  ADD KEY `tour_ID` (`tour_id`),
  ADD KEY `category_ID` (`category_id`);

--
-- Indexes for table `tour_points_of_interest`
--
ALTER TABLE `tour_points_of_interest`
  ADD PRIMARY KEY (`point_id`,`tour_id`),
  ADD KEY `point_ID` (`point_id`),
  ADD KEY `tour_ID` (`tour_id`),
  ADD KEY `point_position` (`point_position`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `guided_tour`
--
ALTER TABLE `guided_tour`
  MODIFY `guided_tour_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `independent_tour`
--
ALTER TABLE `independent_tour`
  MODIFY `independent_tour_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `point_of_interest`
--
ALTER TABLE `point_of_interest`
  MODIFY `point_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `tour`
--
ALTER TABLE `tour`
  MODIFY `tour_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `point_of_interest`
--
ALTER TABLE `point_of_interest`
  ADD CONSTRAINT `point_of_interest_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;