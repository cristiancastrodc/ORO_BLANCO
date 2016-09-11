-- General
TRUNCATE customers;
-- TRUNCATE products;
-- Ventas
TRUNCATE sale_amounts;
TRUNCATE sale_details;
TRUNCATE sale_sessions;
TRUNCATE sales;
-- Vouchers
UPDATE voucher_configs SET numero_actual = '00000000'