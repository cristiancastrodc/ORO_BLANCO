-- Correr las migraciones hasta antes de 2016_10_11_225228_set_default_value_to_category_id.php
-- Crear la categoría 'sin categoría'
INSERT INTO categories(nombre) VALUES ('sin categoria');
-- Actualizar la categoría para todos los productos
UPDATE products SET id_categoria = 1;
/** Luego de estas consultas, realizar la migración set_default_value_to_category_id **/