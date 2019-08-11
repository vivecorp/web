-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-06-2019 a las 17:59:05
-- Versión del servidor: 10.1.26-MariaDB-0+deb9u1
-- Versión de PHP: 5.6.37-1+0~20180910100434.3+stretch~1.gbp606419

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vivecorp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividadeconomica`
--

CREATE TABLE `actividadeconomica` (
  `codActividadEconomica` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividadeconomica`
--

INSERT INTO `actividadeconomica` (`codActividadEconomica`, `codigo`, `descripcion`) VALUES
(1, '60206', 'Venta al por menor de otros productos en almacenes especializados (Articulos de limpieza, papel tapiz, articulo de joyeria, articulos de deporte, juegos juguetes, flores, plantas, artesania y articulos de recuerdo)'),
(2, '50405', 'Venta al por mayor de maquinaria, equipo y materiales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `codAlmacen` int(11) NOT NULL,
  `almacen` varchar(500) NOT NULL,
  `ubicacion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`codAlmacen`, `almacen`, `ubicacion`) VALUES
(1, 'Principal', 'Av dorbigni sn'),
(2, 'Cliza', 'caretera cliza toco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

CREATE TABLE `asignacion` (
  `codAsignacion` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `codUsuario` int(11) NOT NULL,
  `codDosificacion` int(11) NOT NULL,
  `codPuntoVenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asignacion`
--

INSERT INTO `asignacion` (`codAsignacion`, `fecha`, `estado`, `codUsuario`, `codDosificacion`, `codPuntoVenta`) VALUES
(1, '2019-02-06', 2, 1, 1, 1),
(2, '2019-05-29', 2, 2, 2, 1),
(3, '2019-05-29', 2, 3, 1, 1),
(4, '2019-05-29', 2, 1, 2, 1),
(5, '2019-02-14', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacionalmacen`
--

CREATE TABLE `asignacionalmacen` (
  `codAsignacionAlmacen` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `codUsuario` int(11) NOT NULL,
  `codAlmacen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacionlinea`
--

CREATE TABLE `asignacionlinea` (
  `codAsignacionLinea` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL,
  `codLineaEmpresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE `bancos` (
  `codBancos` int(11) NOT NULL,
  `banco` varchar(500) NOT NULL,
  `fono` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bancos`
--

INSERT INTO `bancos` (`codBancos`, `banco`, `fono`, `email`) VALUES
(0, 'ninguno', NULL, NULL),
(1, 'Banco Union', NULL, NULL),
(2, 'Banco Nacional de Bolivia', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `codCliente` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `ci` varchar(50) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `direccion` varchar(500) DEFAULT NULL,
  `telf` varchar(50) DEFAULT NULL,
  `cel` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `razonSocial` varchar(500) DEFAULT NULL,
  `nit` varchar(50) DEFAULT NULL,
  `descuento` float DEFAULT NULL,
  `plazoCredito` int(11) DEFAULT NULL,
  `limiteCredito` float DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`codCliente`, `nombre`, `ci`, `fechaNacimiento`, `direccion`, `telf`, `cel`, `email`, `razonSocial`, `nit`, `descuento`, `plazoCredito`, `limiteCredito`, `estado`) VALUES
(0, 'CLIENTE VARIOS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobros`
--

CREATE TABLE `cobros` (
  `codCobros` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `monto` float DEFAULT NULL,
  `comprobante` varchar(100) DEFAULT NULL,
  `concepto` varchar(500) DEFAULT NULL,
  `codTipoPago` int(11) NOT NULL,
  `codBancos` int(11) NOT NULL,
  `codVentas` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `codCompras` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `observacion` varchar(500) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `codProveedor` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL,
  `codEstadoPago` int(11) NOT NULL,
  `codEstadoInventario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompras`
--

CREATE TABLE `detallecompras` (
  `codDetalleCompras` int(11) NOT NULL,
  `precio` float NOT NULL,
  `cantidad` float NOT NULL,
  `descuento` float DEFAULT NULL,
  `subTotal` float DEFAULT NULL,
  `codEstadoInventario` int(11) NOT NULL,
  `codCompras` int(11) NOT NULL,
  `codProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `codDetalleFactura` int(11) NOT NULL,
  `precio` float DEFAULT NULL,
  `cantidad` float DEFAULT NULL,
  `descuento` float DEFAULT NULL,
  `subTotal` float DEFAULT NULL,
  `codFactura` int(11) NOT NULL,
  `codProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventas`
--

CREATE TABLE `detalleventas` (
  `codDetalleVentas` int(11) NOT NULL,
  `precio` float DEFAULT NULL,
  `cantidad` float DEFAULT NULL,
  `descuento` float DEFAULT NULL,
  `subTotal` float DEFAULT NULL,
  `codVentas` int(11) NOT NULL,
  `codProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dosificacion`
--

CREATE TABLE `dosificacion` (
  `codDosificacion` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `nit` varchar(500) DEFAULT NULL,
  `llave` varchar(500) DEFAULT NULL,
  `nroAutorizacion` varchar(500) DEFAULT NULL,
  `fechaLimite` date DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `codActividadEconomica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dosificacion`
--

INSERT INTO `dosificacion` (`codDosificacion`, `fecha`, `nit`, `llave`, `nroAutorizacion`, `fechaLimite`, `estado`, `codActividadEconomica`) VALUES
(1, '2019-05-01 08:00:00', '367946023', 'PNRU4cgz7if)[tr#J69j=yCS57i=uVZ$n@nv6wxaRFP+AUf*L7Adiq3TT[Hw-@wt', '8004005263848', '2019-06-08', 1, 1),
(2, '2019-05-09 16:17:13', '432432', 'efasdfas', '432', '2019-05-24', 1, 2),
(3, '2019-05-09 16:19:12', '1111', '11112ll', '3333', '2019-05-23', 2, 2),
(4, '2019-05-09 21:49:19', '4324', 'fsdfsa', '321312', '2019-05-16', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoinventario`
--

CREATE TABLE `estadoinventario` (
  `codEstadoInventario` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadoinventario`
--

INSERT INTO `estadoinventario` (`codEstadoInventario`, `estado`) VALUES
(1, 'pendiente'),
(2, 'completo'),
(3, 'excedido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadomaterial`
--

CREATE TABLE `estadomaterial` (
  `codEstadoMaterial` int(11) NOT NULL,
  `estado` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadomaterial`
--

INSERT INTO `estadomaterial` (`codEstadoMaterial`, `estado`) VALUES
(1, 'bueno'),
(2, 'regular'),
(3, 'malo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadopago`
--

CREATE TABLE `estadopago` (
  `codEstadoPago` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadopago`
--

INSERT INTO `estadopago` (`codEstadoPago`, `estado`) VALUES
(1, 'pendiente'),
(2, 'pagado'),
(3, 'sobrepagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `codFactura` int(11) NOT NULL,
  `nroFactura` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `razonSocial` varchar(500) DEFAULT NULL,
  `nit` int(11) DEFAULT NULL,
  `descuento` float DEFAULT NULL,
  `flete` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `codControl` varchar(50) DEFAULT NULL,
  `qr` varchar(500) DEFAULT NULL,
  `codVentas` int(11) NOT NULL,
  `codAsignacion` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formapago`
--

CREATE TABLE `formapago` (
  `codFormaPago` int(11) NOT NULL,
  `formaPago` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `formapago`
--

INSERT INTO `formapago` (`codFormaPago`, `formaPago`) VALUES
(1, 'CONTADO'),
(2, 'CREDITO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `codInventario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `cantidad` float NOT NULL,
  `codDetalleCompras` int(11) DEFAULT NULL,
  `codDetalleVentas` int(11) DEFAULT NULL,
  `codProducto` int(11) NOT NULL,
  `codAlmacen` int(11) NOT NULL,
  `codTipoMovimiento` int(11) NOT NULL,
  `codEstadoMaterial` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaempresa`
--

CREATE TABLE `lineaempresa` (
  `codLineaEmpresa` int(11) NOT NULL,
  `linea` varchar(500) NOT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lineaempresa`
--

INSERT INTO `lineaempresa` (`codLineaEmpresa`, `linea`, `logo`, `estado`) VALUES
(1, 'Joyeria Bella', '11logo.jpg', 1),
(2, 'Rhino', '2rosa.jpg', 1),
(3, 'VyV Technology', '3logo V&V 384px.bmp', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `codPagos` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `monto` float NOT NULL,
  `destinatario` varchar(500) DEFAULT NULL,
  `comprobante` varchar(100) NOT NULL,
  `glosa` varchar(500) DEFAULT NULL,
  `codTipoPago` int(11) NOT NULL,
  `codBancos` int(11) NOT NULL,
  `codCompras` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `codParametro` int(11) NOT NULL,
  `empresa` varchar(500) DEFAULT NULL,
  `sigla` varchar(50) DEFAULT NULL,
  `logo` varchar(500) DEFAULT NULL,
  `nit` varchar(50) DEFAULT NULL,
  `direccion` varchar(500) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `tipoCambio` float DEFAULT NULL,
  `leyendaConsumidor` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`codParametro`, `empresa`, `sigla`, `logo`, `nit`, `direccion`, `telefono`, `celular`, `email`, `ciudad`, `pais`, `tipoCambio`, `leyendaConsumidor`) VALUES
(1, 'Vivecorp SRL', 'Vivecorp', 'logo.jpg', '367946023', 'Av. Dorbigni sn', '4294425', '76411102', 'villarroel.v.andrea@gmail.com', 'Cochabamba', 'Bolivia', 6.96, 'Ley Nro. 453 TIENES DERECHO A UN TRATO EQUITATIVO SIN DISCRIMINACION EN LA OFERTA DE PRODUCTOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametrosimpresion`
--

CREATE TABLE `parametrosimpresion` (
  `codParametro` int(11) NOT NULL,
  `parametro` varchar(500) DEFAULT NULL,
  `direccion` varchar(500) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `parametrosimpresion`
--

INSERT INTO `parametrosimpresion` (`codParametro`, `parametro`, `direccion`, `estado`) VALUES
(1, 'RawBt', 'rawbt.css', 1),
(2, 'printer+', 'printer+.css', 2),
(3, 'prueba', 'prueba.css', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precioventa`
--

CREATE TABLE `precioventa` (
  `codPrecioVenta` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `observacion` varchar(500) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `codUsuario` int(11) NOT NULL,
  `codProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codProducto` int(11) NOT NULL,
  `articulo` varchar(50) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `codigoBarra` varchar(50) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `codUnidadMedida` int(11) NOT NULL,
  `codLineaEmpresa` int(11) NOT NULL,
  `codActividadEconomica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `codProveedor` int(11) NOT NULL,
  `empresa` varchar(50) NOT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `contacto` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `cel` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntoventa`
--

CREATE TABLE `puntoventa` (
  `codPuntoVenta` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` varchar(500) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `mapa` varchar(500) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puntoventa`
--

INSERT INTO `puntoventa` (`codPuntoVenta`, `nombre`, `direccion`, `celular`, `telefono`, `mapa`, `estado`) VALUES
(1, 'Casa Matriz', 'Av. Dorbigni s/n (zona coña coña) Entre Av. Franz Tamayo y Pasaje Innominado', '76420670', '4294425', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `codRole` int(11) NOT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`codRole`, `role`) VALUES
(0, 'Configuracion'),
(1, 'Administrador'),
(3, 'Gerente de Ventas'),
(4, 'Gerente de Compras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomovimiento`
--

CREATE TABLE `tipomovimiento` (
  `codTipoMovimiento` int(11) NOT NULL,
  `tipoMovimiento` varchar(500) NOT NULL,
  `signo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipomovimiento`
--

INSERT INTO `tipomovimiento` (`codTipoMovimiento`, `tipoMovimiento`, `signo`) VALUES
(1, 'ingreso material compra', '+'),
(2, 'salida material venta', '-'),
(3, 'ingreso material cambio almacen', '+'),
(4, 'salida material cambio almacen', '-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopago`
--

CREATE TABLE `tipopago` (
  `codTipoPago` int(11) NOT NULL,
  `tipoPago` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipopago`
--

INSERT INTO `tipopago` (`codTipoPago`, `tipoPago`) VALUES
(1, 'Efectivo'),
(2, 'Cheque'),
(3, 'Transferencia Bancaria'),
(4, 'Transferencia al Exterior'),
(5, 'Tarjeta credito/debito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidadmedida`
--

CREATE TABLE `unidadmedida` (
  `codUnidadMedida` int(11) NOT NULL,
  `unidad` varchar(50) NOT NULL,
  `sigla` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `unidadmedida`
--

INSERT INTO `unidadmedida` (`codUnidadMedida`, `unidad`, `sigla`) VALUES
(1, 'Pieza', 'Pza'),
(2, 'Kilogramo', 'Kg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codUsuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `ci` varchar(50) DEFAULT NULL,
  `cel` varchar(50) DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `foto` varchar(500) DEFAULT NULL,
  `codRole` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codUsuario`, `nombre`, `ci`, `cel`, `direccion`, `usuario`, `password`, `estado`, `fechaNacimiento`, `foto`, `codRole`) VALUES
(0, 'Gonzalo Veizaga', '4309729', '76420670', 'Av dorbigni', 'config', 'config', 1, '1983-09-20', 'defecto.jpg', 0),
(1, 'gonzalo veizaga', '43097290', '76420670', 'av dorbigni sn', 'gon', 'gon', 1, '1983-09-21', 'gonzalo.jpg', 1),
(2, 'andrea villarroel', '8038262', '70354223', 'Av. Oquendo No 0914', 'andy', 'andy', 1, '1991-01-09', NULL, 1),
(3, 'efrain veizaga', '80376', '848948', 'av cliza', 'efra', 'efra', 1, '2018-09-01', NULL, 4),
(4, 'juan perez', '898', '787', 'hj', 'ventas', 'ventas', 1, '0000-00-00', '4.jpg', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `codVentas` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `total` float DEFAULT NULL,
  `descuento` float DEFAULT NULL,
  `flete` float DEFAULT NULL,
  `codCliente` int(11) NOT NULL,
  `razonSocial` varchar(500) DEFAULT NULL,
  `nit` varchar(50) DEFAULT NULL,
  `numImpresion` int(11) DEFAULT NULL,
  `codEstadoPago` int(11) NOT NULL,
  `codFormaPago` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividadeconomica`
--
ALTER TABLE `actividadeconomica`
  ADD PRIMARY KEY (`codActividadEconomica`);

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`codAlmacen`);

--
-- Indices de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD PRIMARY KEY (`codAsignacion`),
  ADD KEY `fk_usuario8_idx` (`codUsuario`),
  ADD KEY `fk_dosificacion1_idx` (`codDosificacion`),
  ADD KEY `fk_puntoventa1_idx` (`codPuntoVenta`);

--
-- Indices de la tabla `asignacionalmacen`
--
ALTER TABLE `asignacionalmacen`
  ADD PRIMARY KEY (`codAsignacionAlmacen`),
  ADD KEY `fk_usuario6_idx` (`codUsuario`),
  ADD KEY `fk_almacen2_idx` (`codAlmacen`);

--
-- Indices de la tabla `asignacionlinea`
--
ALTER TABLE `asignacionlinea`
  ADD PRIMARY KEY (`codAsignacionLinea`),
  ADD KEY `fk_usuario7_idx` (`codUsuario`),
  ADD KEY `fk_lineaempresa2_idx` (`codLineaEmpresa`);

--
-- Indices de la tabla `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`codBancos`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codCliente`);

--
-- Indices de la tabla `cobros`
--
ALTER TABLE `cobros`
  ADD PRIMARY KEY (`codCobros`),
  ADD KEY `fk_tipopago2_idx` (`codTipoPago`),
  ADD KEY `fk_bancos2_idx` (`codBancos`),
  ADD KEY `fk_ventas2_idx` (`codVentas`),
  ADD KEY `fk_usuario5_idx` (`codUsuario`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`codCompras`),
  ADD KEY `fk_proveedor1_idx` (`codProveedor`),
  ADD KEY `fk_usuario1_idx` (`codUsuario`),
  ADD KEY `fk_estadopago1_idx` (`codEstadoPago`),
  ADD KEY `fk_estadoinventario1_idx` (`codEstadoInventario`);

--
-- Indices de la tabla `detallecompras`
--
ALTER TABLE `detallecompras`
  ADD PRIMARY KEY (`codDetalleCompras`),
  ADD KEY `fk_estadoinventario2_idx` (`codEstadoInventario`),
  ADD KEY `fk_compras1_idx` (`codCompras`),
  ADD KEY `fk_producto1_idx` (`codProducto`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`codDetalleFactura`),
  ADD KEY `fk_factura1_idx` (`codFactura`),
  ADD KEY `fk_producto5_idx` (`codProducto`);

--
-- Indices de la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  ADD PRIMARY KEY (`codDetalleVentas`),
  ADD KEY `fk_ventas1_idx` (`codVentas`),
  ADD KEY `fk_producto4_idx` (`codProducto`);

--
-- Indices de la tabla `dosificacion`
--
ALTER TABLE `dosificacion`
  ADD PRIMARY KEY (`codDosificacion`),
  ADD KEY `fk_actividadeconomica2_idx` (`codActividadEconomica`);

--
-- Indices de la tabla `estadoinventario`
--
ALTER TABLE `estadoinventario`
  ADD PRIMARY KEY (`codEstadoInventario`);

--
-- Indices de la tabla `estadomaterial`
--
ALTER TABLE `estadomaterial`
  ADD PRIMARY KEY (`codEstadoMaterial`);

--
-- Indices de la tabla `estadopago`
--
ALTER TABLE `estadopago`
  ADD PRIMARY KEY (`codEstadoPago`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`codFactura`),
  ADD KEY `fk_ventas3_idx` (`codVentas`),
  ADD KEY `fk_asignacion1_idx` (`codAsignacion`);

--
-- Indices de la tabla `formapago`
--
ALTER TABLE `formapago`
  ADD PRIMARY KEY (`codFormaPago`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`codInventario`),
  ADD KEY `fk_producto2_idx` (`codProducto`),
  ADD KEY `fk_almacen1_idx` (`codAlmacen`),
  ADD KEY `fk_tipomovimiento1_idx` (`codTipoMovimiento`),
  ADD KEY `fk_estadomaterial1_idx` (`codEstadoMaterial`),
  ADD KEY `fk_usuario3_idx` (`codUsuario`);

--
-- Indices de la tabla `lineaempresa`
--
ALTER TABLE `lineaempresa`
  ADD PRIMARY KEY (`codLineaEmpresa`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`codPagos`),
  ADD KEY `fk_tipopago1_idx` (`codTipoPago`),
  ADD KEY `fk_bancos1_idx` (`codBancos`),
  ADD KEY `fk_compras2_idx` (`codCompras`),
  ADD KEY `fk_usuario2_idx` (`codUsuario`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`codParametro`);

--
-- Indices de la tabla `parametrosimpresion`
--
ALTER TABLE `parametrosimpresion`
  ADD PRIMARY KEY (`codParametro`);

--
-- Indices de la tabla `precioventa`
--
ALTER TABLE `precioventa`
  ADD PRIMARY KEY (`codPrecioVenta`),
  ADD KEY `fk_usuario4_idx` (`codUsuario`),
  ADD KEY `fk_producto3_idx` (`codProducto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codProducto`),
  ADD KEY `fk_lineaempresa1_idx` (`codLineaEmpresa`),
  ADD KEY `fk_unidadmedida1_idx` (`codUnidadMedida`),
  ADD KEY `fk_actividadeconomica1_idx` (`codActividadEconomica`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`codProveedor`);

--
-- Indices de la tabla `puntoventa`
--
ALTER TABLE `puntoventa`
  ADD PRIMARY KEY (`codPuntoVenta`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`codRole`);

--
-- Indices de la tabla `tipomovimiento`
--
ALTER TABLE `tipomovimiento`
  ADD PRIMARY KEY (`codTipoMovimiento`);

--
-- Indices de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  ADD PRIMARY KEY (`codTipoPago`);

--
-- Indices de la tabla `unidadmedida`
--
ALTER TABLE `unidadmedida`
  ADD PRIMARY KEY (`codUnidadMedida`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codUsuario`),
  ADD KEY `R_2` (`codRole`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`codVentas`),
  ADD KEY `fk_cliente1_idx` (`codCliente`),
  ADD KEY `fk_estadopago2_idx` (`codEstadoPago`),
  ADD KEY `fk_formapago1_idx` (`codFormaPago`),
  ADD KEY `fk_usuario9_idx` (`codUsuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD CONSTRAINT `fk_dosificacion1` FOREIGN KEY (`codDosificacion`) REFERENCES `dosificacion` (`codDosificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_puntoventa1` FOREIGN KEY (`codPuntoVenta`) REFERENCES `puntoventa` (`codPuntoVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario8` FOREIGN KEY (`codUsuario`) REFERENCES `usuario` (`codUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asignacionalmacen`
--
ALTER TABLE `asignacionalmacen`
  ADD CONSTRAINT `fk_almacen2` FOREIGN KEY (`codAlmacen`) REFERENCES `almacen` (`codAlmacen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario6` FOREIGN KEY (`codUsuario`) REFERENCES `usuario` (`codUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asignacionlinea`
--
ALTER TABLE `asignacionlinea`
  ADD CONSTRAINT `fk_lineaempresa2` FOREIGN KEY (`codLineaEmpresa`) REFERENCES `lineaempresa` (`codLineaEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario7` FOREIGN KEY (`codUsuario`) REFERENCES `usuario` (`codUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cobros`
--
ALTER TABLE `cobros`
  ADD CONSTRAINT `fk_bancos2` FOREIGN KEY (`codBancos`) REFERENCES `bancos` (`codBancos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipopago2` FOREIGN KEY (`codTipoPago`) REFERENCES `tipopago` (`codTipoPago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario5` FOREIGN KEY (`codUsuario`) REFERENCES `usuario` (`codUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ventas2` FOREIGN KEY (`codVentas`) REFERENCES `ventas` (`codVentas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_estadoinventario1` FOREIGN KEY (`codEstadoInventario`) REFERENCES `estadoinventario` (`codEstadoInventario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_estadopago1` FOREIGN KEY (`codEstadoPago`) REFERENCES `estadopago` (`codEstadoPago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_proveedor1` FOREIGN KEY (`codProveedor`) REFERENCES `proveedor` (`codProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario1` FOREIGN KEY (`codUsuario`) REFERENCES `usuario` (`codUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detallecompras`
--
ALTER TABLE `detallecompras`
  ADD CONSTRAINT `fk_compras1` FOREIGN KEY (`codCompras`) REFERENCES `compras` (`codCompras`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_estadoinventario2` FOREIGN KEY (`codEstadoInventario`) REFERENCES `estadoinventario` (`codEstadoInventario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto1` FOREIGN KEY (`codProducto`) REFERENCES `producto` (`codProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `fk_factura1` FOREIGN KEY (`codFactura`) REFERENCES `factura` (`codFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto5` FOREIGN KEY (`codProducto`) REFERENCES `producto` (`codProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  ADD CONSTRAINT `fk_producto4` FOREIGN KEY (`codProducto`) REFERENCES `producto` (`codProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ventas1` FOREIGN KEY (`codVentas`) REFERENCES `ventas` (`codVentas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dosificacion`
--
ALTER TABLE `dosificacion`
  ADD CONSTRAINT `fk_actividadeconomica2` FOREIGN KEY (`codActividadEconomica`) REFERENCES `actividadeconomica` (`codActividadEconomica`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_asignacion1` FOREIGN KEY (`codAsignacion`) REFERENCES `asignacion` (`codAsignacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ventas3` FOREIGN KEY (`codVentas`) REFERENCES `ventas` (`codVentas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `fk_almacen1` FOREIGN KEY (`codAlmacen`) REFERENCES `almacen` (`codAlmacen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_estadomaterial1` FOREIGN KEY (`codEstadoMaterial`) REFERENCES `estadomaterial` (`codEstadoMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto2` FOREIGN KEY (`codProducto`) REFERENCES `producto` (`codProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipomovimiento1` FOREIGN KEY (`codTipoMovimiento`) REFERENCES `tipomovimiento` (`codTipoMovimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario3` FOREIGN KEY (`codUsuario`) REFERENCES `usuario` (`codUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_bancos1` FOREIGN KEY (`codBancos`) REFERENCES `bancos` (`codBancos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compras2` FOREIGN KEY (`codCompras`) REFERENCES `compras` (`codCompras`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipopago1` FOREIGN KEY (`codTipoPago`) REFERENCES `tipopago` (`codTipoPago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario2` FOREIGN KEY (`codUsuario`) REFERENCES `usuario` (`codUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `precioventa`
--
ALTER TABLE `precioventa`
  ADD CONSTRAINT `fk_producto3` FOREIGN KEY (`codProducto`) REFERENCES `producto` (`codProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario4` FOREIGN KEY (`codUsuario`) REFERENCES `usuario` (`codUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_actividadeconomica1` FOREIGN KEY (`codActividadEconomica`) REFERENCES `actividadeconomica` (`codActividadEconomica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lineaempresa1` FOREIGN KEY (`codLineaEmpresa`) REFERENCES `lineaempresa` (`codLineaEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_unidadmedida1` FOREIGN KEY (`codUnidadMedida`) REFERENCES `unidadmedida` (`codUnidadMedida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`codRole`) REFERENCES `role` (`codRole`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_cliente1` FOREIGN KEY (`codCliente`) REFERENCES `cliente` (`codCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_estadopago2` FOREIGN KEY (`codEstadoPago`) REFERENCES `estadopago` (`codEstadoPago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_formapago1` FOREIGN KEY (`codFormaPago`) REFERENCES `formapago` (`codFormaPago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario9` FOREIGN KEY (`codUsuario`) REFERENCES `usuario` (`codUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
