<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE PROCEDURE category_not_null_in_expenses(NEW_is_income BOOLEAN, NEW_name VARCHAR(50), NEW_category VARCHAR(50))
            BEGIN
                -- Si es un gasto se comprueba que la categoría no sea nula o no sea una de las permitidas
                IF NOT NEW_is_income THEN
                    IF NEW_name = 'ahorro' AND (NEW_category != 'ahorro' OR NEW_category IS NULL) THEN
                        -- Si es un gasto de tipo ahorro se comprueba que la categoría sea ahorro
                        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El gasto de tipo ahorro no permite una categoría diferente a ahorro.';
                    ELSEIF NEW_category IS NULL AND NOT (NEW_name = 'ahorro' AND NEW_category = 'ahorro') THEN
                        -- Si no es un gasto de tipo ahorro se comprueba que la categoría no sea nula y que sea una de las permitidas
                        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Los gastos no pueden tener una categoría nula, siendo las categorías permitidas otros, alimentación, vivienda, transporte, comunicaciones, ocio, salud y educación.';
                    END IF;
                ELSE
                    IF NEW_name = 'ahorro' THEN
                        -- Si es un ingreso de tipo ahorro se comprueba que la categoría sea nula
                        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El ingreso de tipo ahorro no es permitido.';
                    END IF;
                END IF;
            END
        ");

        DB::unprepared("
            CREATE PROCEDURE last_user_household(OLD_id_household INT)
            BEGIN
                DECLARE count INT;
                SELECT COUNT(*) INTO count FROM users NATURAL JOIN households WHERE id_household = OLD_id_household;
                IF count = 0 THEN
                    DELETE FROM households WHERE id_household = OLD_id_household;
                END IF;
            END
        ");

        DB::unprepared("
            CREATE PROCEDURE update_last_login(IN query VARCHAR(10), IN id_user VARCHAR(50))
            BEGIN
                IF query = 'UPDATE' THEN
                    UPDATE users SET last_login = NOW() WHERE id = id_user;
                ELSEIF query = 'INSERT' THEN
                    UPDATE users SET last_login = NOW() WHERE id = id_user;
                ELSEIF query = 'DELETE' THEN
                    UPDATE users SET last_login = NOW() WHERE id = id_user;
                END IF;
            END
        ");

        DB::unprepared("
            CREATE PROCEDURE household_max_users(IN household INT)
            BEGIN
                DECLARE count INT;
                SELECT COUNT(*) INTO count FROM users NATURAL JOIN households WHERE id_household = household;
                IF count >= 5 THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La unidad familiar no puede tener más de 5 usuarios.';
                END IF;
            END
        ");

        DB::unprepared("
            CREATE PROCEDURE user_max_purchases(IN user VARCHAR(50))
            BEGIN
                DECLARE count INT;
                SELECT COUNT(*) INTO count FROM purchases WHERE id_user = user;
                IF count >= 5 THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El usuario no puede tener más de 5 compras grandes.';
                END IF;
            END
        ");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE `category_not_null_in_expenses`');
        DB::unprepared('DROP PROCEDURE `last_user_household`');
        DB::unprepared('DROP PROCEDURE `update_last_login`');
        DB::unprepared('DROP PROCEDURE `household_max_users`');
        DB::unprepared('DROP PROCEDURE `user_max_purchases`');
    }
};
