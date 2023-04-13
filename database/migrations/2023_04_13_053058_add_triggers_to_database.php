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
        DB::unprepared('
            CREATE TRIGGER category_not_null_in_expenses_insert
            BEFORE INSERT ON finances
            FOR EACH ROW
            BEGIN
                IF NEW.is_income THEN
                    SET NEW.category = NULL;
                END IF;
                CALL category_not_null_in_expenses(NEW.is_income, NEW.name, NEW.category);
            END
        ');

        DB::unprepared('
            CREATE TRIGGER category_not_null_in_expenses_update
            BEFORE UPDATE ON finances
            FOR EACH ROW
            BEGIN
                IF NEW.is_income THEN
                    SET NEW.category = NULL;
                END IF;
                CALL category_not_null_in_expenses(NEW.is_income, NEW.name, NEW.category);
            END
        ');

        DB::unprepared('
            CREATE TRIGGER last_user_household_update
            AFTER UPDATE ON users
            FOR EACH ROW
            BEGIN
                IF OLD.id_household != NEW.id_household OR NEW.id_household IS NULL THEN
                    CALL last_user_household(OLD.id_household);
                END IF;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER last_user_household_delete
            AFTER DELETE ON users
            FOR EACH ROW
            BEGIN
                CALL last_user_household(OLD.id_household);
            END
        ');

        DB::unprepared("
            CREATE TRIGGER period_finances_insert
            BEFORE INSERT ON finances
            FOR EACH ROW
            BEGIN
                SET NEW.period = DATE_FORMAT(NEW.period, '%Y-%m-01');
            END
        ");

        DB::unprepared("
            CREATE TRIGGER period_finances_update
            BEFORE UPDATE ON finances
            FOR EACH ROW
            BEGIN
                SET NEW.period = DATE_FORMAT(NEW.period, '%Y-%m-01');
            END
        ");

        DB::unprepared("
            CREATE TRIGGER period_purchases_insert
            BEFORE INSERT ON purchases
            FOR EACH ROW
            BEGIN
                SET NEW.period = DATE_FORMAT(NEW.period, '%Y-%m-01');
            END
        ");

        DB::unprepared("
            CREATE TRIGGER period_purchases_update
            BEFORE UPDATE ON purchases
            FOR EACH ROW
            BEGIN
                SET NEW.period = DATE_FORMAT(NEW.period, '%Y-%m-01');
            END
        ");

        DB::unprepared("
            CREATE TRIGGER users_last_login_update
            BEFORE UPDATE ON users
            FOR EACH ROW
            BEGIN
                IF OLD.last_login = NEW.last_login THEN
                    SET NEW.last_login = NOW();
                END IF;
            END
        ");

        DB::unprepared("
            CREATE TRIGGER finances_last_login_update
            BEFORE UPDATE ON finances
            FOR EACH ROW
            BEGIN
                CALL update_last_login('UPDATE', NEW.id_user);
            END
        ");

        DB::unprepared("
            CREATE TRIGGER finances_last_login_insert
            BEFORE INSERT ON finances
            FOR EACH ROW
            BEGIN
                CALL update_last_login('INSERT', NEW.id_user);
            END
        ");

        DB::unprepared("
            CREATE TRIGGER finances_last_login_delete
            BEFORE DELETE ON finances
            FOR EACH ROW
            BEGIN
                CALL update_last_login('DELETE', OLD.id_user);
            END
        ");

        DB::unprepared("
            CREATE TRIGGER purchase_last_login_update
            BEFORE UPDATE ON purchases
            FOR EACH ROW
            BEGIN
                CALL update_last_login('UPDATE', NEW.id_user);
            END
        ");

        DB::unprepared("
            CREATE TRIGGER purchase_last_login_insert
            BEFORE INSERT ON purchases
            FOR EACH ROW
            BEGIN
                CALL update_last_login('INSERT', NEW.id_user);
            END
        ");

        DB::unprepared("
            CREATE TRIGGER purchase_last_login_delete
            BEFORE DELETE ON purchases
            FOR EACH ROW
            BEGIN
                CALL update_last_login('DELETE', OLD.id_user);
            END
        ");

        DB::unprepared("
            CREATE TRIGGER household_max_users_insert
            BEFORE INSERT ON users
            FOR EACH ROW
            BEGIN
                CALL household_max_users(NEW.id_household);
            END
        ");

        DB::unprepared("
            CREATE TRIGGER household_max_users_update
            BEFORE UPDATE ON users
            FOR EACH ROW
            BEGIN
                CALL household_max_users(NEW.id_household);
            END
        ");

        DB::unprepared("
            CREATE TRIGGER user_max_purchases_insert
            BEFORE INSERT ON purchases
            FOR EACH ROW
            BEGIN
                CALL user_max_purchases(NEW.id_user);
            END
        ");

        DB::unprepared("
            CREATE TRIGGER user_max_purchases_update
            BEFORE UPDATE ON purchases
            FOR EACH ROW
            BEGIN
                CALL user_max_purchases(NEW.id_user);
            END
        ");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER category_not_null_on_expenses_insert');
        DB::unprepared('DROP TRIGGER category_not_null_on_expenses_update');
        DB::unprepared('DROP TRIGGER last_user_household_update');
        DB::unprepared('DROP TRIGGER last_user_household_delete');
        DB::unprepared('DROP TRIGGER period_finances_insert');
        DB::unprepared('DROP TRIGGER period_finances_update');
        DB::unprepared('DROP TRIGGER period_purchases_insert');
        DB::unprepared('DROP TRIGGER period_purchases_update');
        DB::unprepared('DROP TRIGGER users_last_login_update');
        DB::unprepared('DROP TRIGGER finances_last_login_update');
        DB::unprepared('DROP TRIGGER finances_last_login_insert');
        DB::unprepared('DROP TRIGGER finances_last_login_delete');
        DB::unprepared('DROP TRIGGER purchase_last_login_update');
        DB::unprepared('DROP TRIGGER purchase_last_login_insert');
        DB::unprepared('DROP TRIGGER purchase_last_login_delete');
        DB::unprepared('DROP TRIGGER household_max_users_insert');
        DB::unprepared('DROP TRIGGER household_max_users_update');
        DB::unprepared('DROP TRIGGER user_max_purchases_insert');
        DB::unprepared('DROP TRIGGER user_max_purchases_update');
    }
};
