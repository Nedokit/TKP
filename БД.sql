-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Сен 27 2022 г., 11:02
-- Версия сервера: 5.6.36-log
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u0538747_realto`
--

-- --------------------------------------------------------

--
-- Структура таблицы `back_order`
--

CREATE TABLE `back_order` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `back_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `back_order`
--

INSERT INTO `back_order` (`id`, `order_id`, `user_id`, `price`, `back_info`) VALUES
(1, 63, 9, 120000, 'dgadgasdgadsgadgadg'),
(2, 64, 9, 120000, 'dgadgasdgadsgadgadg'),
(3, 0, 0, 123412, 'Не следует, однако забывать, что рамки и место обучения кадров способствует подготовки и реализации соответствующий условий активизации. С другой стороны сложившаяся структура организации представляет собой интересный эксперимент проверки соответствующий условий активизации. Таким образом постоянный количественный рост и сфера нашей активности в значительной степени обуславливает создание соответствующий условий активизации. Таким образом консультация с широким активом позволяет выполнять важные задания по разработке направлений прогрессивного развития. Таким образом постоянный количественный рост и сфера нашей активности способствует подготовки и реализации системы обучения кадров, соответствует насущным потребностям.'),
(4, 0, 0, 123412, 'Не следует, однако забывать, что рамки и место обучения кадров способствует подготовки и реализации соответствующий условий активизации. С другой стороны сложившаяся структура организации представляет собой интересный эксперимент проверки соответствующий условий активизации. Таким образом постоянный количественный рост и сфера нашей активности в значительной степени обуславливает создание соответствующий условий активизации. Таким образом консультация с широким активом позволяет выполнять важные задания по разработке направлений прогрессивного развития. Таким образом постоянный количественный рост и сфера нашей активности способствует подготовки и реализации системы обучения кадров, соответствует насущным потребностям.'),
(5, 67, 9, 123, 'Не следует, однако забывать, что рамки и место обучения кадров способствует подготовки и реализации соответствующий условий активизации. С другой стороны сложившаяся структура организации представляет собой интересный эксперимент проверки соответствующий условий активизации. Таким образом постоянный количественный рост и сфера нашей активности в значительной степени обуславливает создание соответствующий условий активизации. Таким образом консультация с широким активом позволяет выполнять важные задания по разработке направлений прогрессивного развития. Таким образом постоянный количественный рост и сфера нашей активности способствует подготовки и реализации системы обучения кадров, соответствует насущным потребностям.'),
(6, 66, 9, 123, 'Не следует, однако забывать, что рамки и место обучения кадров способствует подготовки и реализации соответствующий условий активизации. С другой стороны сложившаяся структура организации представляет собой интересный эксперимент проверки соответствующий условий активизации. Таким образом постоянный количественный рост и сфера нашей активности в значительной степени обуславливает создание соответствующий условий активизации. Таким образом консультация с широким активом позволяет выполнять важные задания по разработке направлений прогрессивного развития. Таким образом постоянный количественный рост и сфера нашей активности способствует подготовки и реализации системы обучения кадров, соответствует насущным потребностям.'),
(7, 68, 25, 1000, 'Могу выполнить ваш заказ по мебели оролрпрвраоп ролроварполрваопрв рврпвло пварв алпв вр ов авпвл вр ва'),
(8, 69, 9, 231, 'temptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemptemp'),
(9, 70, 9, 100000, 'Не следует, однако забывать, что рамки и место обучения кадров способствует подготовки и реализации соответствующий условий активизации. С другой стороны сложившаяся структура организации представляет собой интересный эксперимент проверки соответствующий условий активизации. Таким образом постоянный количественный рост и сфера нашей активности в значительной степени обуславливает создание соответствующий условий активизации. Таким образом консультация с широким активом позволяет выполнять важные задания по разработке направлений прогрессивного развития. Таким образом постоянный количественный рост и сфера нашей активности способствует подготовки и реализации системы обучения кадров, соответствует насущным потребностям.'),
(10, 71, 9, 50000, 'Добрый день, могу выполнить ваш заказ. Срок выполнения зависит от ваших пожеланий, но рассчитывать стоит примерно на 7-14 дней. Работа будет выполнена в лучшем качестве. Готов обговорить заказ по телефону. Могу предложить примерную цену в 50 000 руб.'),
(11, 72, 9, 123, 'ывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывп');

-- --------------------------------------------------------

--
-- Структура таблицы `base_settings`
--

CREATE TABLE `base_settings` (
  `id` int(11) NOT NULL,
  `rules` text NOT NULL,
  `categories` text NOT NULL,
  `towns` text NOT NULL,
  `price_list` text,
  `shop_price` text NOT NULL,
  `select_note` text NOT NULL,
  `admin_mail` text NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `contact_mail` text NOT NULL,
  `contact_phone` text NOT NULL,
  `soc_1` text NOT NULL,
  `soc_2` text NOT NULL,
  `soc_3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `base_settings`
--

INSERT INTO `base_settings` (`id`, `rules`, `categories`, `towns`, `price_list`, `shop_price`, `select_note`, `admin_mail`, `description`, `keywords`, `contact_mail`, `contact_phone`, `soc_1`, `soc_2`, `soc_3`) VALUES
(1, 'Задача организации, в особенности же консультация с широким активом способствует подготовки и реализации системы обучения кадров, соответствует насущным потребностям. Равным образом постоянное информационно-пропагандистское обеспечение нашей деятельности влечет за собой процесс внедрения и модернизации новых предложений. Повседневная практика показывает, что сложившаяся структура организации в значительной степени обуславливает создание модели развития. Товарищи! дальнейшее развитие различных форм деятельности влечет за собой процесс внедрения и модернизации направлений прогрессивного развития. Повседневная практика показывает, что постоянное информационно-пропагандистское обеспечение нашей деятельности обеспечивает широкому кругу (специалистов) участие в формировании модели развития. Таким образом реализация намеченных плановых заданий обеспечивает широкому кругу (специалистов) участие в формировании направлений прогрессивного развития.\n\nРазнообразный и богатый опыт постоянное информационно-пропагандистское обеспечение нашей деятельности влечет за собой процесс внедрения и модернизации соответствующий условий активизации. Разнообразный и богатый опыт дальнейшее развитие различных форм деятельности требуют определения и уточнения дальнейших направлений развития. Товарищи! рамки и место обучения кадров представляет собой интересный эксперимент проверки новых предложений.\n\nТоварищи! начало повседневной работы по формированию позиции позволяет выполнять важные задания по разработке форм развития. Товарищи! дальнейшее развитие различных форм деятельности позволяет выполнять важные задания по разработке направлений прогрессивного развития. Таким образом постоянный количественный рост и сфера нашей активности требуют от нас анализа существенных финансовых и административных условий. Идейные соображения высшего порядка, а также сложившаяся структура организации позволяет оценить значение форм развития.\n\nПовседневная практика показывает, что сложившаяся структура организации позволяет оценить значение позиций, занимаемых участниками в отношении поставленных задач. Повседневная практика показывает, что постоянное информационно-пропагандистское обеспечение нашей деятельности в значительной степени обуславливает создание направлений прогрессивного развития.\n\nРазнообразный и богатый опыт новая модель организационной деятельности влечет за собой процесс внедрения и модернизации систем массового участия. Таким образом новая модель организационной деятельности играет важную роль в формировании позиций, занимаемых участниками в отношении поставленных задач. Значимость этих проблем настолько очевидна, что рамки и место обучения кадров обеспечивает широкому кругу (специалистов) участие в формировании позиций, занимаемых участниками в отношении поставленных задач. Таким образом рамки и место обучения кадров способствует подготовки и реализации позиций, занимаемых участниками в отношении поставленных задач. Значимость этих проблем настолько очевидна, что начало повседневной работы по формированию позиции представляет собой интересный эксперимент проверки форм развития.', 'Кухонная мебель;Гостинная мебель;Шкафы;Стулья;Столы;Шифанеры;Кухонные гарнитуры', 'Москва;Новосибирск;Уфа;Южно-Сахалинск;Якутск;Владивосток;Санкт-Петербург', 'Один месяц/400/2592000;\nТри месяца/1000/7884000;\nШесть месяцев/1800/15768000;\nОдин год/3200/31536000', '150;50', 'Вас выбрали в качестве исполнителя. Начните чат с заказчиком. ', 'vitalikis.kisel@gmail.com', 'Описание сайта', 'Ключевые слова', 'support@mebelrialto.ru', '8(985)968-60-81', 'https://vk.com/', 'https://vk.com/', 'https://vk.com/');

-- --------------------------------------------------------

--
-- Структура таблицы `call_back`
--

CREATE TABLE `call_back` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `forget_pass`
--

CREATE TABLE `forget_pass` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` text NOT NULL,
  `time` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `history_orders`
--

CREATE TABLE `history_orders` (
  `id` int(11) NOT NULL,
  `categories` tinyint(4) NOT NULL,
  `towns` int(11) NOT NULL,
  `date` text NOT NULL,
  `description` text NOT NULL,
  `set_time` bigint(20) NOT NULL,
  `out_time` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exe_id` int(11) NOT NULL,
  `viewes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `history_orders`
--

INSERT INTO `history_orders` (`id`, `categories`, `towns`, `date`, `description`, `set_time`, `out_time`, `user_id`, `exe_id`, `viewes`) VALUES
(69, 1, 4, '22.08.2022 в 22:08', 'background-color: #00A2DA;\r\n    background: linear-gradient(to top, #00A2DA, #0AACE4);background-color: #00A2DA;\r\n    background: linear-gradient(to top, #00A2DA, #0AACE4);background-color: #00A2DA;\r\n    background: linear-gradient(to top, #00A2DA, #0AACE4);background-color: #00A2DA;\r\n    background: linear-gradient(to top, #00A2DA, #0AACE4);background-color: #00A2DA;\r\n    background: linear-gradient(to top, #00A2DA, #0AACE4);background-color: #00A2DA;\r\n    background: linear-gradient(to top, #00A2DA, #0AACE4);background-color: #00A2DA;\r\n    background: linear-gradient(to top, #00A2DA, #0AACE4);background-color: #00A2DA;\r\n    background: linear-gradient(to top, #00A2DA, #0AACE4);', 1534964929, 0, 7, 9, 0),
(70, 2, 3, '22.08.2022 в 22:59', 'Не следует, однако забывать, что рамки и место обучения кадров способствует подготовки и реализации соответствующий условий активизации. С другой стороны сложившаяся структура организации представляет собой интересный эксперимент проверки соответствующий условий активизации. Таким образом постоянный количественный рост и сфера нашей активности в значительной степени обуславливает создание соответствующий условий активизации. Таким образом консультация с широким активом позволяет выполнять важные задания по разработке направлений прогрессивного развития. Таким образом постоянный количественный рост и сфера нашей активности способствует подготовки и реализации системы обучения кадров, соответствует насущным потребностям.', 1534967950, 1535054350, 7, 9, 0),
(71, 3, 5, '25.08.2022 в 02:51', 'Равным образом реализация намеченных плановых заданий требуют определения и уточнения систем массового участия. Значимость этих проблем настолько очевидна, что консультация с широким активом позволяет оценить значение позиций, занимаемых участниками в отношении поставленных задач. Товарищи! укрепление и развитие структуры в значительной степени обуславливает создание новых предложений. Значимость этих проблем настолько очевидна, что начало повседневной работы по формированию позиции влечет за собой процесс внедрения и модернизации дальнейших направлений развития. Задача организации, в особенности же консультация с широким активом в значительной степени обуславливает создание направлений прогрессивного развития.', 1535154713, 1535198513, 7, 9, 0),
(72, 1, 1, '25.08.2022 в 15:34', 'ывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывпывпфывпфывп', 1535200460, 0, 7, 9, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `order_id`, `user_id`, `text`) VALUES
(1, 66, 7, 'dfgjdfjyf'),
(2, 66, 7, 'dfgjdfgujdfj'),
(3, 66, 7, 'dfgjhdfj'),
(4, 63, 9, 'dfghdfghdfh'),
(5, 66, 7, 'dfghdfh'),
(6, 66, 7, 'dfgydfghdfg'),
(7, 66, 7, 'dfgydfghdfg'),
(8, 63, 9, 'dfghdfghdfh'),
(9, 66, 7, 'dfghdfghdfgh'),
(10, 66, 7, 'dfgdhfh'),
(11, 66, 7, 'dfgdhfh'),
(12, 66, 7, 'dfhjj'),
(13, 66, 9, 'dfgdfjd'),
(14, 66, 7, 'dfhjj'),
(15, 66, 9, '12351235'),
(16, 66, 7, 'dfhjj'),
(17, 66, 7, 'куку'),
(18, 66, 9, 'кпривет'),
(19, 66, 9, 'куку<a style=\"color: #FF0B85;\" download href=\"uploads/hhgzwtbsuzyhbop_9.jpeg\">файл</a>'),
(20, 66, 7, 'Прикрепляю файл<br><a style=\"color: #FF0B85;\" download href=\"uploads/mkclvthjcijiks_7.png\">[FILE]</a>'),
(21, 66, 7, 'Напишите мне +79851906081'),
(22, 66, 9, 'куку<br><a style=\"color: #FF0B85;\" download href=\"uploads/imjzezgkhtdkg_9.jpeg\">[FILE]</a>'),
(23, 66, 9, 'куку<br><a style=\"color: #FF0B85;\" download href=\"uploads/bwlnamvcosanbs_9.jpeg\">[FILE]</a>'),
(24, 67, 7, 'Добрый день, давайте обговорим заказ подробнее в skype\r\nВот мой скайп - vit200012'),
(25, 67, 9, 'Добрый день, да хорошо, можете пока посмотреть этот файл<br><a style=\"color: #FF0B85;\" download href=\"uploads/zflhkuwfmixyhbm_9.jpeg\">[FILE]</a>'),
(26, 67, 7, 'Хорошо, позвоните мне в скайпе'),
(27, 67, 9, 'Хорошо, сейчас позвоню'),
(28, 68, 25, 'привет'),
(29, 68, 24, 'привет'),
(30, 68, 24, 'вот файл<br><a style=\"color: #FF0B85;\" download href=\"uploads/pfjdeejrgsmozax_24.png\">[FILE]</a>'),
(31, 63, 9, 'паывап<br><a style=\"color: #FF0B85;\" download href=\"uploads/hlplppldbjrtm_9.png\">[FILE]</a>'),
(32, 70, 9, 'привет'),
(33, 70, 9, 'ппривет\r\n'),
(34, 70, 7, 'привет\r\n<br><a style=\"color: #FF0B85;\" download href=\"uploads/imbthsrnuunxsv_7.jpeg\">[FILE]</a>'),
(35, 71, 7, 'Добрый день! Давайте обговорим все моменты по телефону? Позвоните мне.'),
(36, 71, 9, 'Добрый день, позвоните мне по телефону +79851906081'),
(37, 71, 7, 'Звоню'),
(38, 71, 9, 'Вот прайс<br><img style=\"width: 100%;\" src=\"uploads/nbnskhktlnflra_9.jpeg\"/><br><a style=\"color: #FF0B85;\" download href=\"uploads/nbnskhktlnflra_9.jpeg\">[FILE]</a>'),
(39, 71, 7, 'Прайст<br><img style=\"width: 100%; border-radius: 10px; margin: 10px 0;\" src=\"uploads/ynuonrsjrsxengr_7.jpeg\"/><br><a style=\"color: #FF0B85;\" download href=\"uploads/ynuonrsjrsxengr_7.jpeg\">[FILE]</a>');

-- --------------------------------------------------------

--
-- Структура таблицы `new_reviewes`
--

CREATE TABLE `new_reviewes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `points` float NOT NULL,
  `time` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `categories` tinyint(4) NOT NULL,
  `towns` int(11) DEFAULT NULL,
  `date` text NOT NULL,
  `description` text NOT NULL,
  `set_time` bigint(11) NOT NULL,
  `out_time` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exe_id` int(11) NOT NULL DEFAULT '-1',
  `viewes` int(11) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `categories`, `towns`, `date`, `description`, `set_time`, `out_time`, `user_id`, `exe_id`, `viewes`, `file`) VALUES
(68, 3, 4, '22.08.2022 в 21:24', ' jhvhjvhjbvjhbhbbhbjbhbnbhbjvjvvjhhhjvvhk;kkdffpoklhuigyt7y89uikolm,mllb jhvhjvhjbvjhbhbbhbjbhbnbhbjvjvvjhhhjvvhk;kkdffpoklhuigyt7y89uikolm,mllb jhvhjvhjbvjhbhbbhbjbhbnbhbjvjvvjhhhjvvhk;kkdffpoklhuigyt7y89uikolm,mllb', 1534962281, 0, 24, 25, 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `points` float NOT NULL,
  `time` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `text`, `points`, `time`) VALUES
(8, 9, 'Всё отлично)) Лучший сервис. Подобрал исполнителя буквально за день. Все исполнители порядочные, сразу видно, что есть какой-то отбор.', 4.5, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `shop_items`
--

CREATE TABLE `shop_items` (
  `id` int(11) NOT NULL,
  `time` bigint(20) NOT NULL,
  `item_name` text NOT NULL,
  `price` int(11) NOT NULL,
  `preview_photo` text NOT NULL,
  `photos` text NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `viewes` int(11) NOT NULL,
  `date` text NOT NULL,
  `categories` tinyint(4) NOT NULL,
  `towns` int(11) NOT NULL,
  `adv` tinyint(1) NOT NULL DEFAULT '0',
  `adv_time` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_items`
--

INSERT INTO `shop_items` (`id`, `time`, `item_name`, `price`, `preview_photo`, `photos`, `description`, `user_id`, `viewes`, `date`, `categories`, `towns`, `adv`, `adv_time`) VALUES
(97, 1534794694, 'Кухня', 123000, 'uploads/orwtwsrdlriape_23.jpeg', 'uploads/kwkruwgxapyer_23.jpeg', 'Идейные соображения высшего порядка, а также новая модель организационной деятельности влечет за собой процесс внедрения и модернизации системы обучения кадров, соответствует насущным потребностям. Идейные соображения высшего порядка, а также сложившаяся структура организации требуют определения и уточнения дальнейших направлений развития. ', 23, 20, 'Размещено 20.08.2022 в 22:51', 7, 5, 0, 0),
(105, 1534940886, 'Ydfcasdfdasgfasdgadsg', 123656, 'uploads/kyraruvejxhetn_9.jpeg', 'uploads/nwaygmdyiljenzo_9.jpeg', 'Не следует, однако забывать, что рамки и место обучения кадров способствует подготовки и реализации соответствующий условий активизации. С другой стороны сложившаяся структура организации представляет собой интересный эксперимент проверки соответствующий условий активизации. Таким образом постоянный количественный рост и сфера нашей активности в значительной степени обуславливает создание соответствующий условий активизации. Таким образом консультация с широким активом позволяет выполнять важные задания по разработке направлений прогрессивного развития. Таким образом постоянный количественный рост и сфера нашей активности способствует подготовки и реализации системы обучения кадров, соответствует насущным потребностям.', 9, 58, 'Размещено 22.08.2022 в 15:28', 3, 2, 1, 1536079175),
(106, 1535024473, 'Стул во владивостоке', 12000, 'uploads/mondpkcgkbopf_9.jpeg', 'uploads/oeavrsgozieahkr_9.jpeg', 'Идейные соображения высшего порядка, а также новая модель организационной деятельности влечет за собой процесс внедрения и модернизации систем массового участия. Товарищи! постоянный количественный рост и сфера нашей активности влечет за собой процесс внедрения и модернизации форм развития. Не следует, однако забывать, что начало повседневной работы по формированию позиции представляет собой интересный эксперимент проверки систем массового участия. Разнообразный и богатый опыт постоянный количественный рост и сфера нашей активности обеспечивает широкому кругу (специалистов) участие в формировании систем массового участия. Не следует, однако забывать, что сложившаяся структура организации требуют определения и уточнения форм развития. Идейные соображения высшего порядка, а также укрепление и развитие структуры влечет за собой процесс внедрения и модернизации систем массового участия.', 9, 35, 'Размещено 23.08.2022 в 14:41', 4, 6, 1, 1535629319);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fio` text NOT NULL,
  `mail` text NOT NULL,
  `phone` text NOT NULL,
  `login` text NOT NULL,
  `pass` text NOT NULL,
  `user_info` text,
  `profile_photo` text,
  `user_type` tinyint(4) NOT NULL DEFAULT '0',
  `reputation` tinyint(4) NOT NULL DEFAULT '2',
  `rule_accept` tinyint(1) NOT NULL DEFAULT '0',
  `active` bigint(1) NOT NULL DEFAULT '0',
  `time_last_move` bigint(20) NOT NULL,
  `ballance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `fio`, `mail`, `phone`, `login`, `pass`, `user_info`, `profile_photo`, `user_type`, `reputation`, `rule_accept`, `active`, `time_last_move`, `ballance`) VALUES
(1, 'Алексей Дмитриевич', '', '+79851906081', 'CheburekGena', 'cdd8413958f7b6db71fc83c85707c040', NULL, NULL, 0, 3, 1, 0, 0, 0),
(2, 'Алексей Дмитриевич', '', '89851906081', 'CheburekGena', 'd2f13fe2509fae1bf85440621723bc40', NULL, NULL, 0, 3, 1, 0, 0, 0),
(3, 'Алексей Дмитриевич', '', '89851906082', 'CheburekGena', '1f8ac5c227e8de5540610977bac60899', NULL, NULL, 0, 3, 1, 0, 0, 0),
(4, 'Алексей Дмитриевич', '', '89851906080', 'CheburekGena2', 'd2f13fe2509fae1bf85440621723bc40', NULL, NULL, 0, 3, 1, 0, 0, 0),
(5, 'Алексей Дмитриевич', 'eeatat@', '98519776081', 'CheburekGena23', 'd2f13fe2509fae1bf85440621723bc40', NULL, NULL, 0, 3, 1, 0, 0, 0),
(6, 'Алексей Дмитриевич', 'eeatat@2', '98519206081', 'CheburekGena21', 'd2f13fe2509fae1bf85440621723bc40', NULL, NULL, 0, 3, 1, 0, 0, 0),
(7, 'Кисель Виталий', 'vitalikis.kisel@gmail.ru', '98519060581', 'CheburekGena231', 'd2f13fe2509fae1bf85440621723bc40', NULL, NULL, 0, 3, 1, 0, 1535200460, 0),
(9, 'Виталий (Zuizberg.ru)', 'vitalikis.kisel@gmail.com', '92851906081', 'zuizberg_admin', 'd2f13fe2509fae1bf85440621723bc40', 'Создатель этого сервиса) <br>привет', 'uploads/cnkxrnfypnghtsw_9.png', 3, 3, 1, 1567105867, 1535024473, 50000),
(10, 'Алексей Дмитриевич', 'eeatat@12312', '98529206081', 'BFG_CHEBUREK', 'd2f13fe2509fae1bf85440621723bc40', NULL, NULL, 1, 3, 1, 0, 0, 0),
(11, 'Алексей Дмитриевич', 'eeatat@2123', '98512906081', 'CheburekGena2031', 'd2f13fe2509fae1bf85440621723bc40', NULL, NULL, 1, 3, 1, 0, 0, 0),
(12, 'Алексей Дмитриевич', 'eeatat@1123123', '11111111111', 'HardBIT_VIT', '1f8ac5c227e8de5540610977bac60899', NULL, NULL, 1, 3, 1, 0, 0, 0),
(13, 'Алексей Дмитриевич', 'fghdfhdfghdf@', '98519706081', 'zuizberg_adminedy', 'd2f13fe2509fae1bf85440621723bc40', NULL, NULL, 0, 3, 1, 0, 0, 0),
(14, 'Rrer', 'clikgASD@', '89851776081', 'фыувф', 'd2f13fe2509fae1bf85440621723bc40', NULL, NULL, 0, 3, 1, 0, 0, 0),
(15, 'Кав', 'avASdfg@f', '89851906022', 'vasdfsd', 'd2f13fe2509fae1bf85440621723bc40', NULL, NULL, 1, 3, 1, 0, 0, 0),
(16, 'Кисель Виталий', 'click4money.pw@gmail.com', '59851906081', 'admin', 'd2f13fe2509fae1bf85440621723bc40', 'Продавец мягкой мебели<br>\r\nЗвоните или пишите', 'uploads/yxuts_16.png', 3, 3, 1, 1538233367, 0, 1),
(17, 'Алексей Дмитриевич', 'vitalikis.kisel@gma22il.com', '99851006081', 'zuizberg_admin1234234', 'd2f13fe2509fae1bf85440621723bc40', NULL, NULL, 0, 3, 1, 0, 0, 0),
(18, 'Михаил', 'mixail@mail.ru', '89961906708', 'mixail', 'd2f13fe2509fae1bf85440621723bc40', NULL, NULL, 0, 3, 1, 0, 0, 0),
(19, 'Алексей Дмитриевич', 'eeatat@213123`1241234', '29851906081', 'zuizberg_admin213123', 'd2f13fe2509fae1bf85440621723bc40', NULL, NULL, 0, 3, 1, 0, 0, 0),
(20, 'Тест', 'test_mail@mail.ru', '81111111111', 'test_login', 'd2f13fe2509fae1bf85440621723bc40', NULL, NULL, 0, 3, 1, 0, 0, 0),
(21, 'Никита', 'oprel@mail.ru', '68678', 'oprel', 'd2f13fe2509fae1bf85440621723bc40', 'Обычный челбас', 'uploads/vasji_21.png', 0, 2, 1, 0, 1534458656, 0),
(22, 'Тестовый аккаунт', 'cslick4Money.pw@gmail.com', '89851112244', 'sdasdgsdhgsdhads', 'd2f13fe2509fae1bf85440621723bc40', 'Тестовый аккаунт', 'uploads/ocxct_22.png', 1, 2, 1, 0, 0, 0),
(23, 'Пфвафв', 'dgadsg@gdgd.ru', '89871906081', 'zadsgadsg', 'd2f13fe2509fae1bf85440621723bc40', 'Это я', 'uploads/xmbmjfikdaaus_23.jpeg', 1, 2, 1, 1542052137, 1534794694, 0),
(24, 'Виталий', 'test@', '8965976878888', 'uplay', 'd2f13fe2509fae1bf85440621723bc40', NULL, NULL, 0, 2, 1, 0, 1534962281, 0),
(25, 'Галина', '2222@list.ru', '22222222222', 'Галина', '323ae9f1ccbd28415e9c7039dfe65c52', NULL, NULL, 1, 2, 1, 1537381414, 0, 3600),
(29, 'Алексей Дмитриевич', 'vitalik.kisel@mail.ru', '92222851906081', 'fagot22814', 'd2f13fe2509fae1bf85440621723bc40', NULL, NULL, 0, 2, 1, 0, 0, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `back_order`
--
ALTER TABLE `back_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `base_settings`
--
ALTER TABLE `base_settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `call_back`
--
ALTER TABLE `call_back`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forget_pass`
--
ALTER TABLE `forget_pass`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `history_orders`
--
ALTER TABLE `history_orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `new_reviewes`
--
ALTER TABLE `new_reviewes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shop_items`
--
ALTER TABLE `shop_items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `back_order`
--
ALTER TABLE `back_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `base_settings`
--
ALTER TABLE `base_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `call_back`
--
ALTER TABLE `call_back`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `forget_pass`
--
ALTER TABLE `forget_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `history_orders`
--
ALTER TABLE `history_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT для таблицы `new_reviewes`
--
ALTER TABLE `new_reviewes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `shop_items`
--
ALTER TABLE `shop_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
