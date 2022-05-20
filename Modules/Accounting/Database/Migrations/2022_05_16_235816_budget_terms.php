<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BudgetTerms extends Migration
{

  protected $connection = 'mysql';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $sqlQuery=<<<'EOT'

        CREATE TABLE IF NOT EXISTS `budget_terms` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(120) NOT NULL,
            `type` ENUM('EXPEN', 'REVEN') NOT NULL,
            `created_at` TIMESTAMP NOT NULL,
            `updated_at` TIMESTAMP NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE INDEX `index2` (`name` ASC, `type` ASC) VISIBLE)
          ENGINE = InnoDB;
          
          CREATE TABLE IF NOT EXISTS `term_items` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `code_setting_id` INT NOT NULL,
            `budget_term_id` INT NOT NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT NOW(),
            `updated_at` TIMESTAMP NOT NULL DEFAULT NOW(),
            PRIMARY KEY (`id`),
            INDEX `FK_TERM_ITEMS_idx` (`budget_term_id` ASC) VISIBLE,
            INDEX `FK_CODE_ITEM_idx` (`code_setting_id` ASC) VISIBLE,
            UNIQUE INDEX `index4` (`code_setting_id` ASC, `budget_term_id` ASC) VISIBLE,
            UNIQUE INDEX `code_setting_id_UNIQUE` (`code_setting_id` ASC) VISIBLE,
            CONSTRAINT `FK_TERM_ITEM`
              FOREIGN KEY (`budget_term_id`)
              REFERENCES `budget_terms` (`id`)
              ON DELETE CASCADE
              ON UPDATE NO ACTION,
            CONSTRAINT `FK_CODE_ITEM`
              FOREIGN KEY (`code_setting_id`)
              REFERENCES `code_settings` (`id`)
              ON DELETE CASCADE
              ON UPDATE NO ACTION)
          ENGINE = InnoDB;
        EOT;

        DB::unprepared($sqlQuery);         

        $sqlQuery=<<<'EOT'
          CREATE DEFINER = CURRENT_USER TRIGGER `term_items_BEFORE_INSERT` BEFORE INSERT ON `term_items` FOR EACH ROW
          BEGIN
              -- Validating term and code of the same type
              IF (SELECT type FROM code_settings AS CS WHERE CS.id=NEW.code_setting_id ) <> (SELECT type FROM code_settings AS CS WHERE CS.id=NEW.code_setting_id )  THEN
                      SIGNAL SQLSTATE '99999'
                      SET MESSAGE_TEXT = 'Can\'t have children to a non main code!';
              END IF;
          END
          EOT;

          DB::unprepared($sqlQuery);         
    

    }   

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::disableForeignKeyConstraints();
        Schema::drop('budget_terms');
        Schema::drop('term_items');       
      Schema::enableForeignKeyConstraints();
    }
}
