-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-08-2024 a las 18:08:41
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `login`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `set_dispositivos`
--

CREATE TABLE `set_dispositivos` (
  `ip` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nav` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  `pin` int(11) NOT NULL,
  `valid` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sesion` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actual` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `set_dispositivos`
--

INSERT INTO `set_dispositivos` (`ip`, `so`, `nav`, `user`, `pin`, `valid`, `sesion`, `fecha`, `actual`, `token`) VALUES
('::1', 'Windows 10', 'Chrome', 1234, 9788, 'Si', 'No', '2024-08-01', 'No', 664477539),
('127.0.0.1', 'Windows 10', 'Firefox', 1234, 5506, 'Si', 'No', '2024-08-01', 'No', 406616211);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `set_imagenes`
--

CREATE TABLE `set_imagenes` (
  `id` int(11) NOT NULL,
  `imagen` longblob NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `set_imagenes`
--

INSERT INTO `set_imagenes` (`id`, `imagen`, `tipo`, `nombre`) VALUES
(1234, 0x89504e470d0a1a0a0000000d4948445200000200000002000803000000c3a624c80000000373424954080808dbe14fe000000009704859730000143f0000143f01cf293a910000001974455874536f667477617265007777772e696e6b73636170652e6f72679bee3c1a000002fd504c5445ffffff00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000032d923f0000000fe74524e53000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f202122232425262728292a2b2c2d2e2f303132333435363738393a3b3c3d3e3f404142434445464748494b4c4d4e4f505152535455565758595a5b5c5d5e5f606162636465666768696a6b6c6d6e6f707172737475767778797a7b7c7d7e7f808182838485868788898a8b8c8d8e8f909192939495969798999a9b9c9d9e9fa0a1a2a3a4a5a6a7a8a9aaabacadaeafb0b1b2b3b4b5b6b7b8b9babbbcbdbebfc0c1c2c3c4c5c6c7c8c9cacbcccdcecfd0d1d2d3d4d5d6d7d8d9dadbdcdddedfe0e1e2e3e4e5e6e7e8e9eaebecedeeeff0f1f2f3f4f5f6f7f8f9fafbfcfdfedfe8959c000011bb494441541819edc1099c5675bd06f067866166181009941024704141140c81d434010908cdc10d45475054b0544c71ad5822dc45d12b18221888044a4ce2c51db9c8682e38682e884108822c2303c836cbfb3e9f5bf7736fddca85f3bee79cdffffce7f97e813aa5c5f7cfbb74c4cdbfbe77ca63f39f5f5abe727d657575e5fa95e54b9f9fffd8947b7f7df3884bcffb7e0b887f0a3bf4bfeabea7dedbc57db0ebbda7eebbaa7f8742880f8a7affe2d125ebd30c2cbd7ec9a3bfe85d0449ae867dc69755332bd565e3fb3484244fa37eb7bd56c350d4bc765bbf46900439f98ed76b18aa9ad7ef38199208ad6ef99891f8f8965610c7e59fbdb09691a95d78763ec45d9d2756306215133b439cd4f8a7cb188b653f6d0c714dfe35158c4dc535f91097e49cbf9ab15a7d7e0ec419bdde62ecdeea0571c331cfd0c433c740ecb59e9ea291d4f4d61063c377d3d0eee1104b8de7d0d89cc610335dfe4c737fee023172e55e3a60ef95100bfb3f49473cb93f2476dd56d319abbb416236b88a0ea91a0c89d590149d921a0289d1e0141d931a0c89cd45293a277511242625293a2855028945498a4e4a95406270618a8e4a5d0889dc39b57456ed39908875d84987edec008954d17b74da7b4590284da7e3a643223498ce1b0c894cc75d74deae8e9088347c9f09f07e4348347ecb44f82d2412839910832111d87f0b1362cbfe90f0ddcdc4b81b12bac3ab9818558743c2369f09321f12b29e4c949e9050e5963351ca7321611aca84190a09d17e1b99301bf78384671c13671c24340d2a9838150d2061b984097409242ce54ca07248484e62229d0409c71c26d21c48285ad530916a5a41c2308e09350e1282fc4d4ca84df990ec9530b14a20d95bccc45a0cc95ab35a26566d3348b68630c18640b2359f09361f92a506bb9860bb1a40b2730613ed0c4876a631d1a641b2526f0b136d4b3d48367ec084fb01241bf730e1ee8164e36326dcc7902cb460e2b580646e00136f0024737731f1ee8264ae8c895706c958fe5e26dede7c48a68ea7078e8764ea5a7ae05a48a69ea4079e84646a033db00192a1b6f4425b486606d20b03219919432f8c81646636bd301b9299b7e985b72199d9492fec8464a4153d71302413bde8895e904c5c414f5c01c9c47df4c47d904c3c434f3c03c9c46a7a6235240385297a22550809ae1dbdd10e12dcc9f4c6c990e0cea537ce85043782de180109ee367ae33648708fd21b8f42827b8ede780e12dc3bf4c63b90e036d31b9b2181e5a5e98d741e24a856f4482b48505de991ae90a07ad323bd21419d4e8f9c0609ea1c7ae46c485017d1232590a02ea7472e830435821eb90a12d48df4c8f590a0c6d023a32041dd418fdc0a096a223d320112d4147a641224a819f4c87448504fd023b321412da047e643827a911e79061254193db21812d4327ae48f90a03ea0479643825a4d8fac8004f5193df20924a84a7a641324a8bdf4c876484039f4491524a006f44a2e2498a6f44a11249803e8954690608ae8955c483039697a640f24a89df4480524a8cdf4c85a48507fa1473e8404f51e3df21624a837e8912590a05ea6479e8104f59ff4c83c485073e9911990a0a6d3239321413d488fdc03096a343d722324a8c1f4c8404850a7d023df8304d5861ef93624a87a35f4c66e48707fa1373e8404b788de5808096e1abd310912dc287ae306487017d11be74282fb01bdd11d12dc77e88de690e0eaeda127b6433251464f2c8264e25e7ae2764826cea327ce8464e2107ae260484636d30b1b2099799a5e288564e697f4c22d90ccf4a5177a4332f3ad343d906e02c9d047f4c00a48a666d203332099ba821e180ec9d477e881ef4032b69c89b71c92b9714cbc7190cc7567e27587642ee73326dc6739902c3ccc847b18928d1f33e17e0cc946d11e26da9e2248569e66a23d0dc9ce3026dae590ecb44c33c1d22d21595ac4045b04c9d6f94cb0f321d92aa86062551440b2760f13eb1e48f6da33b1da4342b08409b50412860b99501742c250b89589b4b510128a894ca48990701ccd443a1a129232265019242cc54ca062485872ca9938e53990d01433718a21e1c92967c294e7404254cc8429868429a79c89529e0309553113a51812ae9c722648790e2464c54c906248d872ca9918e53990d0f56162f48144600e13620e240a2db73311b6b78444e26a26c2d59068d45bc60458560f1291ee293a2fd51d12994974de2448749a6ca4e336368144e8023aee0248a45ea2d35e8244ab75051d56d11a12b1fe693a2bdd1f12b93be9ac3b21d1cb2ba3a3caf22031685d412755b486c4a27f9a0e4af787c4e44e3ae84e485cf2cae89cb23c486c5a6fa163b6b486c4a8fb4e3a65677748acfad5d02135fd20312b49d319e91248ecaea733ae87189840474c8058c8994527ccca8198a8ff1c1df05c7d8891466fd0dc1b8d20661abf4c632f3786182a984753f30a20a6721fa2a1877221d6c6d2cc5888037e92a289d44f204e38a78a06aace8138e2d41d8cdd8e5321cee8f02e63f66e0788430a2733560f1542dc72762563537936c4396d5f634c5e6b0b7150deed69c6207d7b1ec44d7d3631729bfa409cf5ed598cd8ac6f435c76523923547e12c471b9c32b18918ae1b910f7357db09611a8fd8fa69064e8b498a15bdc09921c033f60a83e180849949c1fbdc0d0bcf0a31c48e2749a5ec510544def0449a616e32a98a58a712d20c9d560d8bbccc2bbc31a4012eeb0eb96a49881d492eb0e8378e1808b4b773390dda5171f00f1488333a67dca7df4e9b4338a20fe39b0f7c8997faae1d7a8f9d3cc91bd0f8478aca0cb25135f5abe665b9aff4f7adb9ae52f4dbca44b01a4aec86dd2f6d81ec5438614f738b66d935c88888888888888888888dbf2bb5c3af98dd587235687af7e7df2a5dfad0f3155d075d894b7aaf8376bdb20466dd6f26ff6bef9d0655df221060abff793a9e5d5fc8755ad109b56abf80f556f4d19d6b500129ba213af9cfe6e0dffd58a4311934357f05f55bffdf0f06e0590a8b53a7ff29f6af9e52a4e412c4ea9e097ab2e7f70e04190a81c3264da9ff975aa2f470c2eafe6d75939f5a23690b0b5bf7cd63a7eb3fbf310b1bcfbf9cd3e9979d9919090e476beea894ddc476f7742a43abdcd7db471ee959d7220d9c9396ee4535b1944f5a8fa884cfd51d50c62eb1faeeb960bc950e169bfd9c0e0ca3b23229dcb19dce669c54590c09a5f52ba8b99a91e5d8008148cae6666f62cb8ac0524808e37bd9a6216d60dcf47c8f287af6316d2afdf7234645fe4f5bc7715b3b6e6d23c8428efd235ccdaeafb7ae641be56e381b32a198e5543ea2124f586ac62382a670d6c0cf92a3ff8ed2e8668654901425050b29221aa9ad32717f2ef0eba6925c35639b5572eb292db6b6a25c3b666546bc83fc93be3a95a4662fd84e390b1e326ac6724520bcfac0ff93f47deb19111fa68743b64a0dde88f18a14d771e09f9ab86172f65e4de7ea0e4c81cecb39c234b1e789b915b725111eabaa31edec19854be30fe8c83f08d5a16dffae236c664dbe463519775fc5d8af15af7e40da79dd8a14501fe4de141479d78da4dbfff94317baa0beaaaa3e7a66965cf86f7972e9871ffd86bae197bffcc054bdfdfb087664a8f455d74cc1369caff48cfeb84baa6d39369cadfa59f381a7549e77969ca3f49ffee28d415c7ce4f53fe4deaf1f6a80b1a3d90a67ca9d4d426f05ebf4f285f69fde9f05bd31994af35b3293c76ee26ca37f8ac18be6a594ad907b30f80972edd46d9279bce867f0e7b89b2cfe61e08cf0cd8450960cb99f0cab5294a20e99be08f7a932881fd260f9ed86f2125030b1bc10b072fa764a4bc253cf0ddf5940cad3d1a89d7ff0b4ac6b6f546c25d594bc942f51024da2f29591a83041b42c9da4d48acded594aca5cf44421db39d12825d5d9148add65142b1e16024d07ecb2921296f88c4c97b96129a3fe42269a65242743712e61794505d864419400957752f24c8b73ea3846c6b0b24c72394d0cd46629c4a89405f2444d12a4a0456354032dc4d89c4ad4884aeb5944854774402e42da74464690edc770b253297c17947eca144666b73b86e312542b3e0b81e94489d0ab73d4389d47fc1699d2811eb06973d4689d8efe0b0b6359488d5b481bbeea7446e029c75c02e4ae4763486abc6506230128e6a584189c1da3cb8e96a4a2c06c149799f5062b10c4e3a8312931e70d14c4a4c7e0f07e56fa7c4644f23b8e7344a6cce817b1ea5c4e67138a77e252536dbf3e19a1f5162d40fae798412a329704cdee794186dcc855bfa50627512dc328512ab7be0947a5b28b15a0da79c4a89d9b170c9ed94988d854b5ea1c46c391c92bf8712b35463b8e3784aec7ac31dd75262f773b8e3494aec16c01d1b28b1db0c671c423170185c7101c5c00570c5248a81fbe18ae514036fc011fba52806aa0be1861f524c9c08378ca698b8166e58403131076ef89862e2133821bf9662a3195cd08162e478b8a09862e442b8e0468a91b170c1348a91c7e182328a9137e0820a8a914a38a019c54c33d83b9162e678d8bb9862a604f66ea798190b7bf329661e87bd0f2866de84b97a55143395307730c5d001b0d68d62e804583b9d626810ac5d4e31742dac8da218ba03d626510c4d87b5f914430b61ed358aa165b0f6178aa14f616d0fc550358c35a198fa166cb5a7986a0f5b3d29a64e81adf329a6ce85ad9f514c5d095b77524c8d83ad1914535360eb398aa93fc0d66b14537f84ad0f28a656c3d6a714533b606b07c5543a079672d3145bfbc152638ab196b0d49a62ec4858ea4831d615964ea018eb094b7d29c67e0c4be7508c5d004b4329c686c3d2b51463d7c3d2188ab15fc1d2048ab17b61692ac5d854589a4b313607969ea5185b084baf528cbd024be51463cb61e9038ab155b0b49a626c332cada718fb02963ea718ab86a55d146bb0544bb1960f3b7914738d60a721c55c33d86946317710ecb4a2986b033b8752cc1d013b4751cc1d0d3b5d28e6bac0ce09147327c04e4f8ab95360a71fc5dc0f61a79862ae3fec9c47317726ec0ca6983b0f768651cc5d043b2328e62e839d1b29e67e0a3ba329e67e063bb751ccdd043bf752cc8d829dc91473e361673ac5dcddb0339b62ee7ed8f93dc5dc6f60a79462ee51d829a5987b1c764a29e6e6c14e29c55c29ec9452cc95c24e29c55c29ec9452cc95c24e29c55c29ec9452cc95c24e29c55c29ec9452cc95c24e29c55c29ec8ca6981b0d3b852b29c65616c250af34c554ba174cdd403175038c3d4231f408acd57f9962e6e5fa30d77425c5c8caa67040bbcf29263e6f0727f4a8a618a8ee01470caca1c4ae66209c71fa5e4accf69e0e87f4da4989d5ce5e70ca09959418559e00c774de4089cd86ce70ce41659498941d0407d59f4c89c5e4fa70d3257b2991db7b099cd57d1d2562ebbac361cd9fa744eaf9e670dbf02f2891f962389c77c8624a44161f8204c819b19b1281dd2372900c47bc4a09ddab472031eaddb09b12aadd37d443921c3c334d094d7ae6c1489aee659490947547120d5c4309c19a8148a8c29bbfa064e98b9b0b915c2da6a62859484d6d8164eb38b38692a19a991d917c6d1ed84dc9c0ee07dac00f078edb4a0968ebb803e18f46d77d4a09e0d3eb1ac12ff9435750f6d18aa1f9f04fee992fa529df28fdd299b9f0d421bf5a4bf95a6b7f75087c96db776e15e52b54cded9b0bef351bf10ee54bbc33a219ea88ae93b651fec9b6495d519734b8e0851acaffaa79e18206a8739a0c9ab39dc2ed730635411d95dfe7c175acd3d63dd8271f75db716397b38e5a3ef638c85fb5b9fac51ad631352f5edd06f2774d063db69675c6dac7063581fcabb6255356d07b2ba694b4857c95e667ddb7ac969eaa5d76df59cd21dfa471bff1afeca567f6be32be5f63c8be2a38f9e7cfeea027763cfbf3930b2041e51c3660d4131fa59860a98f9e1835e0b01c48e61a1c3764c20b1b99381b5f9830e4b8069070343ff59a47dedcc544d8f5e623d79cda1c12badc76678d99fbe6663a6bf39b73c79cd52e1712a9a2f67d87dd3a6be9ba141d915ab774d6adc3fab62f82c4a9fea13d878c9ebe6855358d54af5a347df4909e87d68758ca6d75e2a09b27ce78baecc38dd58c5cf5c60fcb9e9e31f1e64127b6ca85b8a661eb4e3d060c1d79ebe439cfbfb5aa32cd10a42b57bdf5fc9cc9b78e1c3aa047a7d60d21c991dbf4f06e7dcf2d197ac5d5236f193dfeae8993a6ce983d6fc1b38b96be5efefec76b36546cdf934aedd95eb161cdc7ef97bfbe74d1b30be6cd9e3175d2c4bbc68fb965e4d5570c2d39b76fb7c39be6c267ff0d4c0b4c55ef251ed60000000049454e44ae426082, 'image/png', 'usuario1234.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `set_usuarios`
--

CREATE TABLE `set_usuarios` (
  `id` int(11) NOT NULL,
  `pw` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apPaterno` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apMaterno` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` int(10) DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `set_usuarios`
--

INSERT INTO `set_usuarios` (`id`, `pw`, `nombre`, `apPaterno`, `apMaterno`, `telefono`, `email`) VALUES
(1111, 'qwer', NULL, '', '', 0, ''),
(1122, 'qwqw', NULL, '', '', 0, ''),
(1234, 'asdf', 'Luis', 'Beltran', 'Arroyo', 1234567891, 'mail@correo.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `set_imagenes`
--
ALTER TABLE `set_imagenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `set_usuarios`
--
ALTER TABLE `set_usuarios`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
