

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `place`, `created_at`, `updated_at`) VALUES
(1, 'Main Nav', 'main-nav', 'header', '2022-04-28 15:06:09', '2022-04-28 15:06:09');

-- --------------------------------------------------------

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `label`, `link`, `type`, `parent`, `sort`, `class`, `menu`, `depth`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Tracking\",\"ger\":\"Verfolgung\",\"fr\":\"Suivie\",\"tr\":\"izleme\",\"pt\":\"Rastreamento\",\"ar\":\"\\u0627\\u0644\\u062a\\u062a\\u0628\\u0639\",\"bn\":\"\\u099f\\u09cd\\u09b0\\u09cd\\u09af\\u09be\\u0995\\u09bf\\u0982\",\"ru\":\"\\u041e\\u0442\\u0441\\u043b\\u0435\\u0436\\u0438\\u0432\\u0430\\u043d\\u0438\\u0435\",\"es\":\"Seguimiento\",\"zh\":\"\\u8ffd\\u8e2a\"}', '/shipments/tracking/view', 'static', 0, 0, NULL, 1, 0, '2022-04-28 13:07:07', '2022-06-13 15:13:20'),
(3, '{\"en\":\"Shipment Calculator\",\"ger\":\"Versandrechner\",\"fr\":\"Calculateur d\'exp\\u00e9dition\",\"tr\":\"G\\u00f6nderi Hesaplay\\u0131c\\u0131\",\"pt\":\"Calculadora de Remessa\",\"ar\":\"\\u062d\\u0627\\u0633\\u0628\\u0629 \\u0627\\u0644\\u0634\\u062d\\u0646\",\"bn\":\"\\u099a\\u09be\\u09b2\\u09be\\u09a8 \\u0995\\u09cd\\u09af\\u09be\\u09b2\\u0995\\u09c1\\u09b2\\u09c7\\u099f\\u09b0\",\"ru\":\"\\u041a\\u0430\\u043b\\u044c\\u043a\\u0443\\u043b\\u044f\\u0442\\u043e\\u0440 \\u0434\\u043e\\u0441\\u0442\\u0430\\u0432\\u043a\\u0438\",\"es\":\"Calculadora de env\\u00edo\",\"zh\":\"\\u88c5\\u8fd0\\u8ba1\\u7b97\\u5668\"}', '/shipments/calculator', 'static', 0, 1, NULL, 1, 0, '2022-04-28 13:07:32', '2022-06-13 15:13:20'),
(4, '{\"en\":\"General\",\"ger\":\"Allgemein\",\"fr\":\"G\\u00e9n\\u00e9rale\",\"tr\":\"Genel\",\"pt\":\"Em geral\",\"ar\":\"\\u0639\\u0627\\u0645\",\"bn\":\"\\u09b8\\u09be\\u09a7\\u09be\\u09b0\\u09a3\",\"ru\":\"\\u041e\\u0431\\u0449\\u0438\\u0439\",\"es\":\"General\",\"zh\":\"\\u4e00\\u822c\\u7684\"}', 'news', 'category', 10, 4, NULL, 1, 1, '2022-04-28 13:17:49', '2022-06-13 15:13:20'),
(5, '{\"en\":\"Sample Page\",\"ger\":\"Beispielseite\",\"fr\":\"Page d\'exemple\",\"tr\":\"\\u00d6rnek Sayfa\",\"pt\":\"P\\u00e1gina de exemplo\",\"ar\":\"\\u0635\\u0641\\u062d\\u0629\",\"bn\":\"\\u09a8\\u09ae\\u09c1\\u09a8\\u09be \\u09aa\\u09c3\\u09b7\\u09cd\\u09a0\\u09be\",\"ru\":\"\\u041e\\u0431\\u0440\\u0430\\u0437\\u0435\\u0446 \\u0441\\u0442\\u0440\\u0430\\u043d\\u0438\\u0446\\u044b\",\"es\":\"P\\u00e1gina de Ejemplo\",\"zh\":\"\\u793a\\u4f8b\\u9875\\u9762\"}', 'sample-page', 'page', 0, 2, NULL, 1, 0, '2022-04-28 20:26:25', '2022-06-13 15:13:20'),
(10, '{\"en\":\"News\",\"ger\":\"Nachrichten\",\"fr\":\"Nouvelles\",\"tr\":\"Haberler\",\"pt\":\"Not\\u00edcia\",\"ar\":\"\\u0627\\u062e\\u0628\\u0627\\u0631\",\"bn\":\"\\u0996\\u09ac\\u09b0\",\"ru\":\"\\u041d\\u043e\\u0432\\u043e\\u0441\\u0442\\u0438\",\"es\":\"Noticias\",\"zh\":\"\\u6d88\\u606f\"}', '/blog', 'static', 0, 3, NULL, 1, 0, '2022-04-28 23:13:33', '2022-06-13 15:13:20');

COMMIT;