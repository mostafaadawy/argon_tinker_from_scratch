<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DailyRecords extends Migration
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

            CREATE TABLE IF NOT EXISTS `daily_records` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `type` ENUM('EXPEN', 'REVEN') NOT NULL,
            `date` DATE NOT NULL,
            `description` TEXT NULL,
            `reviewer_assign` TINYINT NOT NULL DEFAULT 0,
            `financial_accountant_assign` TINYINT NOT NULL DEFAULT 0,
            `financial_director_assign` TINYINT NOT NULL DEFAULT 0,
            `director_assign` TINYINT NOT NULL DEFAULT 0,
            `created_at` TIMESTAMP NOT NULL DEFAULT NOW(),
            `updated_at` TIMESTAMP NOT NULL DEFAULT NOW(),
            PRIMARY KEY (`id`),
            UNIQUE INDEX `UN_D_R` (`date` ASC, `type` ASC) VISIBLE)
          ENGINE = InnoDB;
          
            CREATE TABLE IF NOT EXISTS `daily_records_entries` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `daily_records_id` INT NOT NULL,
            `code_settings_id` INT NOT NULL,
            `account_id` INT NOT NULL,
            `credit` FLOAT(10,2) NOT NULL DEFAULT 0.00,
            `dept` FLOAT(10,2) NOT NULL DEFAULT 0.00,
            `created_at` TIMESTAMP NOT NULL DEFAULT NOW(),
            `updated_at` TIMESTAMP NOT NULL DEFAULT NOW(),
            PRIMARY KEY (`id`),
            INDEX `FK_Daily_Records_Entries_idx` (`daily_records_id` ASC) VISIBLE,
            INDEX `FK_Daily_Records_Entries_Code_idx` (`code_settings_id` ASC) VISIBLE,
            INDEX `FK_Daily_Records_Entries_Account_idx` (`account_id` ASC) VISIBLE,
            CONSTRAINT `FK_Daily_Records_Entries`
              FOREIGN KEY (`daily_records_id`)
              REFERENCES `daily_records` (`id`)
              ON DELETE CASCADE
              ON UPDATE RESTRICT,
            CONSTRAINT `FK_Daily_Records_Entries_Code`
              FOREIGN KEY (`code_settings_id`)
              REFERENCES `code_settings` (`id`)
              ON DELETE CASCADE
              ON UPDATE RESTRICT,
            CONSTRAINT `FK_Daily_Records_Entries_Account`
              FOREIGN KEY (`account_id`)
              REFERENCES `code_settings` (`id`)
              ON DELETE CASCADE
              ON UPDATE RESTRICT)
          ENGINE = InnoDB;
          
          CREATE  OR REPLACE VIEW `daily_records_view` AS
          SELECT 
          id ,
          date,
          type,
          description,
          CONCAT(LEFT(description, 80),' ...') AS excerpt,
          reviewer_assign,
          financial_accountant_assign,
          financial_director_assign,
          director_assign,
          (SELECT CASE WHEN SUM(DRE.dept) IS NULL THEN 0 ELSE SUM(DRE.dept) END  FROM daily_records_entries AS DRE WHERE DRE.daily_records_id=DR.id  ) AS dept,
          (SELECT CASE WHEN SUM(DRE.credit) IS NULL THEN 0 ELSE SUM(DRE.credit) END FROM daily_records_entries AS DRE WHERE DRE.daily_records_id=DR.id  ) AS credit,
          (SELECT credit-dept) AS 'total'
          FROM
          daily_records AS DR
          ORDER BY date DESC;
          
                    
          EOT;

          DB::unprepared($sqlQuery);         
  
          $sqlQuery=<<<'EOT'

          CREATE PROCEDURE getCodeEntries(IN codeID INT,IN startDate TIMESTAMP,IN endDate TIMESTAMP)
          BEGIN
          
              SELECT
                  SUM(IF((recs.created_at BETWEEN startDate AND endDate), recs.credit, 0)) as totalCredit,
                  SUM(IF((recs.created_at BETWEEN startDate AND endDate), recs.dept, 0)) as totalDept,
                  (SUM(IF((recs.created_at BETWEEN startDate AND endDate), recs.credit, 0)) - SUM(IF((recs.created_at BETWEEN startDate AND endDate), recs.dept, 0))) as total
              FROM  daily_records_entries AS recs 
              WHERE
                  recs.code_settings_id = codeID
              GROUP BY 
                  recs.code_settings_id;
              
          END
          EOT;

          DB::unprepared($sqlQuery);         
  
          $sqlQuery=<<<'EOT'
          
          CREATE DEFINER = CURRENT_USER TRIGGER `daily_records_BEFORE_INSERT` BEFORE INSERT ON `daily_records` FOR EACH ROW
          BEGIN
                  -- Creating futuristic records is not allowed
                  IF NEW.date > curdate() THEN
                      SIGNAL SQLSTATE '99999'
                      SET MESSAGE_TEXT = 'Can\'t have futuristic records!';
                  END IF;
                          
          END
                    
          EOT;

          DB::unprepared($sqlQuery);         
  
          $sqlQuery=<<<'EOT'

          CREATE DEFINER = CURRENT_USER TRIGGER `daily_records_entries_BEFORE_INSERT` BEFORE INSERT ON `daily_records_entries` FOR EACH ROW
          BEGIN
                  -- Making Sure code of the same type of daily record 
                  IF (SELECT CS.type FROM code_settings AS CS where CS.id = NEW.code_settings_id) <> (SELECT DR.type FROM daily_records AS DR where DR.id = NEW.daily_records_id)
                  THEN
                          SIGNAL SQLSTATE '99999'
                          SET MESSAGE_TEXT = 'Code and Record is not of the same type';
                  END IF;
                  
                  -- Making Sure code is not a main code 
                  IF (SELECT CS.is_main FROM code_settings AS CS where CS.id = NEW.code_settings_id) = '1'
                  THEN
                          SIGNAL SQLSTATE '99999'
                          SET MESSAGE_TEXT = 'Code is a main code';
                  END IF;
                  
                  -- Making Sure Account is not a main Account 
                  IF (SELECT CS.is_main FROM code_settings AS CS where CS.id = NEW.account_id) = '1'
                  THEN
                          SIGNAL SQLSTATE '99999'
                          SET MESSAGE_TEXT = 'Code is a main code';
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
            Schema::drop('daily_records');
            Schema::drop('daily_records_entries');
            DB::statement('DROP TABLE IF EXISTS `daily_records_view`;DROP VIEW IF EXISTS `daily_records_view` ;');         
            DB::statement('DROP PROCEDURE IF EXISTS `getCodeEntries`;');   
        Schema::enableForeignKeyConstraints();
      
    }
}
