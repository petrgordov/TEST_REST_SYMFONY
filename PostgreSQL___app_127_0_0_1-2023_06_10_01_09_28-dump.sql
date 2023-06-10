--
-- PostgreSQL database dump
--

-- Dumped from database version 15.3
-- Dumped by pg_dump version 15.3

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: symfoni_test; Type: SCHEMA; Schema: -; Owner: app
--

CREATE SCHEMA symfoni_test;


ALTER SCHEMA symfoni_test OWNER TO app;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: cart; Type: TABLE; Schema: public; Owner: app
--

CREATE TABLE public.cart (
    id integer NOT NULL,
    id_product integer NOT NULL,
    price double precision,
    quantity integer,
    taxnumber character varying(255),
    coupon_code character varying(255),
    id_order integer NOT NULL,
    price_base double precision,
    price_tax double precision
);


ALTER TABLE public.cart OWNER TO app;

--
-- Name: cart_id_seq; Type: SEQUENCE; Schema: public; Owner: app
--

CREATE SEQUENCE public.cart_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cart_id_seq OWNER TO app;

--
-- Name: cart_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: app
--

ALTER SEQUENCE public.cart_id_seq OWNED BY public.cart.id;


--
-- Name: coupons; Type: TABLE; Schema: public; Owner: app
--

CREATE TABLE public.coupons (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    typecoupon integer NOT NULL,
    val integer,
    descr text
);


ALTER TABLE public.coupons OWNER TO app;

--
-- Name: coupons_id_seq; Type: SEQUENCE; Schema: public; Owner: app
--

CREATE SEQUENCE public.coupons_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.coupons_id_seq OWNER TO app;

--
-- Name: coupons_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: app
--

ALTER SEQUENCE public.coupons_id_seq OWNED BY public.coupons.id;


--
-- Name: deposits; Type: TABLE; Schema: public; Owner: app
--

CREATE TABLE public.deposits (
    id integer NOT NULL,
    id_product integer NOT NULL,
    val integer
);


ALTER TABLE public.deposits OWNER TO app;

--
-- Name: deposits_id_seq; Type: SEQUENCE; Schema: public; Owner: app
--

CREATE SEQUENCE public.deposits_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.deposits_id_seq OWNER TO app;

--
-- Name: deposits_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: app
--

ALTER SEQUENCE public.deposits_id_seq OWNED BY public.deposits.id;


--
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: app
--

CREATE TABLE public.doctrine_migration_versions (
    version character varying(191) NOT NULL,
    executed_at timestamp(0) without time zone,
    execution_time integer
);


ALTER TABLE public.doctrine_migration_versions OWNER TO app;

--
-- Name: order; Type: TABLE; Schema: public; Owner: app
--

CREATE TABLE public."order" (
    id integer NOT NULL,
    id_user integer,
    payment_processor character varying(255),
    date timestamp(0) without time zone NOT NULL,
    country character varying(20) NOT NULL,
    tax_number character varying(255),
    date_pay timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    pay_info text,
    is_pay integer,
    coupon_code character varying(255) DEFAULT NULL::character varying,
    coupone_discount integer,
    type_discount integer,
    hash character varying(255) NOT NULL,
    tax integer
);


ALTER TABLE public."order" OWNER TO app;

--
-- Name: order_id_seq; Type: SEQUENCE; Schema: public; Owner: app
--

CREATE SEQUENCE public.order_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.order_id_seq OWNER TO app;

--
-- Name: order_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: app
--

ALTER SEQUENCE public.order_id_seq OWNED BY public."order".id;


--
-- Name: prices; Type: TABLE; Schema: public; Owner: app
--

CREATE TABLE public.prices (
    id integer NOT NULL,
    id_product integer NOT NULL,
    price double precision,
    price_group integer NOT NULL
);


ALTER TABLE public.prices OWNER TO app;

--
-- Name: prices_id_seq; Type: SEQUENCE; Schema: public; Owner: app
--

CREATE SEQUENCE public.prices_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.prices_id_seq OWNER TO app;

--
-- Name: prices_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: app
--

ALTER SEQUENCE public.prices_id_seq OWNED BY public.prices.id;


--
-- Name: products; Type: TABLE; Schema: public; Owner: app
--

CREATE TABLE public.products (
    id integer NOT NULL,
    name text NOT NULL,
    marking character varying(255) NOT NULL,
    description text
);


ALTER TABLE public.products OWNER TO app;

--
-- Name: products_id_seq; Type: SEQUENCE; Schema: public; Owner: app
--

CREATE SEQUENCE public.products_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.products_id_seq OWNER TO app;

--
-- Name: products_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: app
--

ALTER SEQUENCE public.products_id_seq OWNED BY public.products.id;


--
-- Name: doctrine_migration_versions; Type: TABLE; Schema: symfoni_test; Owner: app
--

CREATE TABLE symfoni_test.doctrine_migration_versions (
    version character varying(191) NOT NULL,
    executed_at timestamp with time zone,
    execution_time bigint
);


ALTER TABLE symfoni_test.doctrine_migration_versions OWNER TO app;

--
-- Data for Name: cart; Type: TABLE DATA; Schema: public; Owner: app
--

COPY public.cart (id, id_product, price, quantity, taxnumber, coupon_code, id_order, price_base, price_tax) FROM stdin;
9	1	101.15	1	\N	D15	29	100	119
10	1	95.2	1	\N	D20	30	100	119
11	1	95.2	1	\N	D20	31	100	119
12	1	95.2	1	\N	D20	32	100	119
13	1	95.2	1	\N	D20	33	100	119
14	1	95.2	1	\N	D20	34	100	119
15	1	101.15	1	\N	D15	35	100	119
16	1	95.2	1	\N	D20	36	100	119
17	1	95.2	1	\N	D20	37	100	119
18	1	95.2	\N	\N	D20	38	100	119
19	1	95.2	1	\N	D20	39	100	119
20	1	95.2	2	\N	D20	40	100	119
21	1	95.2	2	\N	D20	41	100	119
22	1	95.2	1	\N	D20	42	100	119
23	1	113.288	1	\N	D20	43	100	119
\.


--
-- Data for Name: coupons; Type: TABLE DATA; Schema: public; Owner: app
--

COPY public.coupons (id, title, typecoupon, val, descr) FROM stdin;
1	D15	1	15	\N
2	D20	1	20	\N
3	F30	2	30	фиксированная скидка 30 евро\n
\.


--
-- Data for Name: deposits; Type: TABLE DATA; Schema: public; Owner: app
--

COPY public.deposits (id, id_product, val) FROM stdin;
1	1	10
2	2	20
3	3	40
\.


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: app
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20230607102942	2023-06-07 10:30:24	295
DoctrineMigrations\\Version20230607104347	2023-06-07 10:44:10	9
DoctrineMigrations\\Version20230607110442	2023-06-07 11:04:47	9
DoctrineMigrations\\Version20230607111758	2023-06-07 11:18:10	9
DoctrineMigrations\\Version20230607113328	2023-06-07 11:33:33	3
DoctrineMigrations\\Version20230607114816	2023-06-07 11:48:21	7
DoctrineMigrations\\Version20230607145120	2023-06-07 14:51:39	9
DoctrineMigrations\\Version20230607145332	2023-06-07 14:55:06	3
DoctrineMigrations\\Version20230607145438	2023-06-07 14:55:06	0
DoctrineMigrations\\Version20230607145447	2023-06-07 14:55:06	0
DoctrineMigrations\\Version20230608021522	2023-06-08 02:15:29	17
\.


--
-- Data for Name: order; Type: TABLE DATA; Schema: public; Owner: app
--

COPY public."order" (id, id_user, payment_processor, date, country, tax_number, date_pay, pay_info, is_pay, coupon_code, coupone_discount, type_discount, hash, tax) FROM stdin;
33	1	paypal	2023-06-08 03:28:22	DE	DE1234567891232	2023-06-08 03:47:31	\N	1	D20	20	1	8fa226fe-5bfc-4334-8c5f-6c5749bd6070	19
34	1	paypal	2023-06-08 03:48:24	DE	DE1234567891232	\N	\N	0	D20	20	1	b4228d6c-515b-4ab2-bb91-3f6e14a2ccd7	19
35	1	paypal	2023-06-09 01:10:40	DE	DE1234567891232	\N	\N	0	D15	15	1	dd7693dc-1ba3-403a-85be-69d7c1c5bb05	19
36	1	paypal	2023-06-09 01:46:55	DE	DE1234567891232	2023-06-09 01:48:01	\N	1	D20	20	1	738a89a7-8a2a-490c-8ed9-17183a298a35	19
37	1	paypal	2023-06-09 03:00:48	DE	DE1234567891232	\N	\N	0	D20	20	1	f73ac214-b1db-42f4-8050-3ecb2087909a	19
38	1	paypal	2023-06-09 03:01:59	DE	DE1234567891232	\N	\N	0	D20	20	1	5a214451-375c-4509-bb6b-e72c6aa691de	19
39	1	paypal	2023-06-09 03:05:48	DE	DE1234567891232	\N	\N	0	D20	20	1	7ac889dc-48d3-46a4-8fde-85aef743bee9	19
40	1	paypal	2023-06-09 03:05:52	DE	DE1234567891232	\N	\N	0	D20	20	1	5c8d24cf-e595-4049-8541-0c46628e3e7e	19
41	1	paypal	2023-06-09 03:36:36	DE	DE1234567891232	\N	\N	0	D20	20	1	e8cb7e9e-30f1-4e30-90c4-b1c8cc31c03f	19
42	1	paypal	2023-06-09 03:57:14	DE	DE12345678912	\N	\N	0	D20	20	1	b8ef6999-5472-4b82-81ca-a9a45d2def16	19
43	1	paypal	2023-06-09 08:07:05	DE	DE12345678912	\N	\N	0	D20	20	1	4b01b4a7-29ce-4433-8637-1711c1d8c6a6	19
\.


--
-- Data for Name: prices; Type: TABLE DATA; Schema: public; Owner: app
--

COPY public.prices (id, id_product, price, price_group) FROM stdin;
1	1	100	1
2	2	20	1
3	3	10	1
\.


--
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: app
--

COPY public.products (id, name, marking, description) FROM stdin;
2	Наушники	phones	Наушники Наушники
3	Чехол	cover	Чехол v Чехол\n
1	Iphone	Iphone12	Iphone Iphone Iphone
\.


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: symfoni_test; Owner: app
--

COPY symfoni_test.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20230602113827	2023-06-02 11:38:45+00	51
DoctrineMigrations\\Version20230603014132	2023-06-03 01:41:55+00	96
DoctrineMigrations\\Version20230603014946	2023-06-03 01:50:20+00	52
DoctrineMigrations\\Version20230603015129	2023-06-03 01:51:37+00	38
DoctrineMigrations\\Version20230603094508	2023-06-03 09:45:32+00	34
DoctrineMigrations\\Version20230603095129	2023-06-03 09:51:35+00	31
DoctrineMigrations\\Version20230603095533	2023-06-03 09:55:38+00	36
\.


--
-- Name: cart_id_seq; Type: SEQUENCE SET; Schema: public; Owner: app
--

SELECT pg_catalog.setval('public.cart_id_seq', 23, true);


--
-- Name: coupons_id_seq; Type: SEQUENCE SET; Schema: public; Owner: app
--

SELECT pg_catalog.setval('public.coupons_id_seq', 1, false);


--
-- Name: deposits_id_seq; Type: SEQUENCE SET; Schema: public; Owner: app
--

SELECT pg_catalog.setval('public.deposits_id_seq', 1, false);


--
-- Name: order_id_seq; Type: SEQUENCE SET; Schema: public; Owner: app
--

SELECT pg_catalog.setval('public.order_id_seq', 43, true);


--
-- Name: prices_id_seq; Type: SEQUENCE SET; Schema: public; Owner: app
--

SELECT pg_catalog.setval('public.prices_id_seq', 1, false);


--
-- Name: products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: app
--

SELECT pg_catalog.setval('public.products_id_seq', 1, false);


--
-- Name: cart cart_pkey; Type: CONSTRAINT; Schema: public; Owner: app
--

ALTER TABLE ONLY public.cart
    ADD CONSTRAINT cart_pkey PRIMARY KEY (id);


--
-- Name: coupons coupons_pkey; Type: CONSTRAINT; Schema: public; Owner: app
--

ALTER TABLE ONLY public.coupons
    ADD CONSTRAINT coupons_pkey PRIMARY KEY (id);


--
-- Name: deposits deposits_pkey; Type: CONSTRAINT; Schema: public; Owner: app
--

ALTER TABLE ONLY public.deposits
    ADD CONSTRAINT deposits_pkey PRIMARY KEY (id);


--
-- Name: order order_pkey; Type: CONSTRAINT; Schema: public; Owner: app
--

ALTER TABLE ONLY public."order"
    ADD CONSTRAINT order_pkey PRIMARY KEY (id);


--
-- Name: prices prices_pkey; Type: CONSTRAINT; Schema: public; Owner: app
--

ALTER TABLE ONLY public.prices
    ADD CONSTRAINT prices_pkey PRIMARY KEY (id);


--
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: app
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);


--
-- Name: doctrine_migration_versions idx_16409_primary; Type: CONSTRAINT; Schema: symfoni_test; Owner: app
--

ALTER TABLE ONLY symfoni_test.doctrine_migration_versions
    ADD CONSTRAINT idx_16409_primary PRIMARY KEY (version);


--
-- PostgreSQL database dump complete
--

