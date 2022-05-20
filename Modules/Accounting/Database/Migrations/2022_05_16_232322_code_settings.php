<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CodeSettings extends Migration
{

    protected $connection = 'mysql';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::create('code_settings',function (Blueprint $table)
            {
                $table->id();
                $table->string('name', 45);
                $table->string('code', 10);
                $table->enum('type', ['EXPEN', 'REVEN', 'ACC']);
                $table->addColumn(
                    'tinyInteger', 'level',
                    [
                        'length'   => 2,
                        'autoIncrement' => false,
                        'zerofill' => true,
                        'null'=>false
                    ]
                );
                $table->addColumn(
                    'tinyInteger', 'in_level_identifier',
                    [
                        'length'   => 2,
                        'autoIncrement' => false,
                        'zerofill' => true,
                        'null'=>false
                    ]
                );
                $table->enum('is_main', ['0','1']);
                $table->timestamps();
                $table->string('email')->unique();
                $table->unique(['type','code']);
                $table->unique(['code_settings_id','name']);
                $table->foreign('code_settings_id')->references('id')->on('code_settings');

            } 
        
        );

        


     */


        $sqlQuery=<<<'EOT'

        CREATE TABLE IF NOT EXISTS `code_settings` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(45) NOT NULL COMMENT 'The name of the code',
            `code` VARCHAR(10) NOT NULL COMMENT 'The Code of is auto generated unique identifier for the same (Type -> Level -> Node -> In/Same Level ID).',
            `type` ENUM('EXPEN', 'REVEN', 'ACC') NOT NULL COMMENT 'The type of the Code Expernses, Revenue, Accounts\nnable strict mode to prevent empty string  values',
            `code_settings_id` INT NULL DEFAULT NULL COMMENT 'The parent Node (NULL -> Level 1 / has no parent) ',
            `level` TINYINT(2) ZEROFILL NOT NULL COMMENT 'The current Level (01 -> 05) Auto calulated',
            `in_level_identifier` TINYINT(2) ZEROFILL NOT NULL COMMENT 'The in level identifier of the same type and parent node (01->99) Auto calculated and will be recycled  if it have vacancies.',
            `is_main` ENUM('0', '1') NOT NULL COMMENT 'The code is a main code and will only work as a parent node and no transactions will be done using such code (1-> is main - 0-> not main).',
            `created_at` TIMESTAMP NOT NULL DEFAULT NOW(),
            `updated_at` TIMESTAMP NOT NULL DEFAULT NOW(),
            PRIMARY KEY (`id`),
            UNIQUE INDEX `Code_Settings_U_Code_idx` (`type` ASC, `code` ASC) COMMENT 'Every Type has set of uniqe codes' VISIBLE,
            UNIQUE INDEX `Code_Settings_U_IN_L_idx` (`code_settings_id` ASC, `name` ASC) COMMENT 'Every Node of each type level of the same parent node is unique in its own level.' INVISIBLE,
            INDEX `FK_Code_Settings_Self_idx` (`code_settings_id` ASC) VISIBLE,
            CONSTRAINT `FK_Code_Settings_Self`
              FOREIGN KEY (`code_settings_id`)
              REFERENCES `code_settings` (`id`)
              ON DELETE CASCADE
              ON UPDATE RESTRICT)
          ENGINE = InnoDB;

        EOT;
        DB::unprepared($sqlQuery);         

        $sqlQuery=<<<'EOT'
          CREATE FUNCTION getCodeSettingBC (settingID INT )
          RETURNS text
          deterministic
          BEGIN
          
              SET @currentParentCode = (SELECT CS.code_settings_id FROM code_settings AS CS WHERE CS.id=settingID), @codeName=(SELECT CS.name FROM code_settings AS CS WHERE CS.id=settingID);
              
              While @currentParentCode IS NOT NULL DO 
               SET @codeName=CONCAT((SELECT CS.name FROM code_settings AS CS WHERE CS.id=@currentParentCode),' / ',@codeName),@currentParentCode = (SELECT CS.code_settings_id FROM code_settings AS CS WHERE CS.id=@currentParentCode);
             END WHILE;
             
             RETURN @codeName; 
          
          END
          EOT;
          DB::unprepared($sqlQuery);         

          
        
          
            $sqlQuery=<<<'EOT'
          CREATE DEFINER = CURRENT_USER TRIGGER `code_settings_BEFORE_INSERT` BEFORE INSERT ON `code_settings` FOR EACH ROW
          BEGIN
          
              -- Validate father is a main code and of the same type
              IF (NEW.code_settings_id IS NOT NULL) AND (SELECT CS.is_main FROM code_settings AS CS WHERE CS.id=NEW.code_settings_id) <> '1' THEN
                      SIGNAL SQLSTATE '99999'
                      SET MESSAGE_TEXT = 'Can\'t have children to a non main code!';
              END IF;
          
              -- Validating name duplications for first level (Parent IS NULL)
              IF (NEW.code_settings_id IS NULL) AND (SELECT CS.id FROM code_settings AS CS WHERE code_settings_id IS NULL AND CS.type=NEW.type AND CS.name=NEW.name) IS NOT NULL THEN
                          SIGNAL SQLSTATE '99999'
                      SET MESSAGE_TEXT = 'There Already Exist a code with the same name';
              END IF;
          
              
              -- Validating Tree Depth and making sure it doesn't exceed 5 levels and set the level
              SET @currentDepth=1,@currentParentCode=NEW.code_settings_id;
                 
              While @currentParentCode IS NOT NULL DO 
               SET @currentParentCode = (SELECT CS.code_settings_id FROM code_settings AS CS WHERE CS.id=@currentParentCode),@currentDepth=@currentDepth+1;
             END WHILE;
             
             IF (@currentDepth>5) THEN
                         SIGNAL SQLSTATE '99999'
                      SET MESSAGE_TEXT = 'Code Can\'t Exceed 5 Levels Of depth';
              ELSE
                  SET NEW.level=@currentDepth;
              END IF;
              
              -- Prevent adding a Main code at the 5th level
              IF (NEW.is_main = '1' AND NEW.level=5 ) THEN
                         SIGNAL SQLSTATE '99999'
                      SET MESSAGE_TEXT = 'Can\'t add a main code at the 5th level!';
              END IF;
              
               -- Validating codes at the same level of the same parent and same type doesn't exceed 99
              IF CASE WHEN NEW.code_settings_id IS NOT NULL 
                  THEN 
                      (SELECT COUNT(CS.id) FROM code_settings AS CS WHERE CS.type=NEW.type AND CS.level = NEW.level AND CS.code_settings_id = NEW.code_settings_id ) >=99 
                  ELSE
                       (SELECT COUNT(CS.id) FROM code_settings AS CS WHERE CS.type=NEW.type AND CS.level = NEW.level AND CS.code_settings_id IS NULL ) >=99 
                  END
              THEN
                  SIGNAL SQLSTATE '99999'
                  SET MESSAGE_TEXT = 'Codes at the same level can\'t exceed 99';
              END IF;
              
              -- Generating in level identifier and Code  
               SET @in_level_id=1;
               WHILE
                   CASE WHEN NEW.code_settings_id IS NOT NULL 
                       THEN 
                          ((SELECT CS.in_level_identifier FROM code_settings AS CS WHERE CS.in_level_identifier=@in_level_id AND CS.type=NEW.type AND  CS.level=NEW.level AND CS.code_settings_id = NEW.code_settings_id) IS NOT NULL) 
                       ELSE
                          ((SELECT CS.in_level_identifier FROM code_settings AS CS WHERE CS.in_level_identifier=@in_level_id AND CS.type=NEW.type AND  CS.level=NEW.level AND CS.code_settings_id IS NULL) IS NOT NULL)
                    END
               DO
                  SET @in_level_id= @in_level_id+1;
              END WHILE;
              
              SET @in_level_id=LPAD(@in_level_id,2,'0');
              
              SET NEW.in_level_identifier=@in_level_id;
              
              SET @currentParentCode=NEW.code_settings_id,@code_gen=LPAD(NEW.in_level_identifier,2,'0');
              While @currentParentCode IS NOT NULL DO 
                  SET @code_gen=CONCAT(LPAD((SELECT CS.in_level_identifier FROM code_settings AS CS WHERE CS.id=@currentParentCode),2,'0'),@code_gen),@currentParentCode = (SELECT CS.code_settings_id FROM code_settings AS CS WHERE CS.id=@currentParentCode);
              END WHILE;
               
              SET @code_gen=RPAD(@code_gen,10,'0');
              
              SET NEW.code=@code_gen;
             
          END
          EOT;
          DB::unprepared($sqlQuery);         

          
          
          
            $sqlQuery=<<<'EOT'
          CREATE DEFINER = CURRENT_USER TRIGGER `code_settings_BEFORE_UPDATE` BEFORE UPDATE ON `code_settings` FOR EACH ROW
          BEGIN
              -- Prevent Changing code settings
                      SIGNAL SQLSTATE '99999'
                          SET MESSAGE_TEXT = 'Changing Code Settings is not possible!';
          END
          EOT;

          DB::unprepared($sqlQuery);         
          $sqlQuery=<<<'EOT'
          CREATE  OR REPLACE VIEW `code_settings_view` AS
          SELECT 
          id,
          code,
          type,
          level,
          is_main,
          getCodeSettingBC(CS.id) AS 'breadcrumb',
          (CASE WHEN CS.is_main='1' THEN 'isMain' ELSE 'notMain'  END) AS 'isMain'
          FROM
          code_settings AS CS;
          
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
            Schema::drop('code_settings');
            DB::unprepared('DROP TABLE IF EXISTS `code_settings_view`;DROP VIEW IF EXISTS `code_settings_view` ;');         
            DB::unprepared('DROP function IF EXISTS `getCodeSettingBC`;');  
        Schema::enableForeignKeyConstraints();
       
    }
}
