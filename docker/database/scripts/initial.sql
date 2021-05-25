SET @start_time := now();

DROP SCHEMA IF EXISTS `kanban`;

CREATE SCHEMA IF NOT EXISTS `kanban` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `kanban`;

# ==================================================
# ==================================================
# ==================================================

CREATE TABLE `users`
(
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `uuid`       CHAR(36)     NOT NULL,
    `updated_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_by` INT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_by` INT UNSIGNED NOT NULL,
    `deleted_at` TIMESTAMP    NULL,
    `name`       VARCHAR(255) NOT NULL,
    `surname`    VARCHAR(255) NOT NULL,
    `email`      VARCHAR(255) NOT NULL,
    `password`   VARCHAR(255) NOT NULL,
    `role`       VARCHAR(45)  NOT NULL,
    CONSTRAINT `users_id_pk` PRIMARY KEY (`id`),
    CONSTRAINT `users_id_uq` UNIQUE (`id`),
    CONSTRAINT `users_uuid_uq` UNIQUE (`uuid`),
    CONSTRAINT `users_email_uq` UNIQUE (`email`),
    INDEX `users_name_idx` (`name`),
    INDEX `users_surname_idx` (`surname`),
    CONSTRAINT `users_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
        ON DELETE NO ACTION
        ON UPDATE CASCADE,
    CONSTRAINT `users_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
        ON DELETE NO ACTION
        ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

# noinspection SpellCheckingInspection

INSERT INTO `users`(`uuid`, `updated_by`, `created_by`, `name`, `surname`, `email`, `password`, `role`)
VALUES (UUID(), 1, 1, 'ALEKSANDAR', 'RAKIĆ', 'aleksandar.rakic@yahoo.com', 'Admin123$%!!', 'ADMIN');

# ==================================================
# ==================================================
# ==================================================

CREATE TABLE `leans`
(
    `id`          TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `uuid`        CHAR(36)         NOT NULL,
    `updated_at`  TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_by`  INT UNSIGNED     NOT NULL,
    `created_at`  TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_by`  INT UNSIGNED     NOT NULL,
    `deleted_at`  TIMESTAMP        NULL,
    `description` VARCHAR(45)      NOT NULL,
    CONSTRAINT `leans_id_pk` PRIMARY KEY (`id`),
    CONSTRAINT `leans_id_uq` UNIQUE (`id`),
    CONSTRAINT `leans_uuid_uq` UNIQUE (`uuid`),
    CONSTRAINT `leans_description_uq` UNIQUE (`description`),
    CONSTRAINT `leans_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
        ON DELETE NO ACTION
        ON UPDATE CASCADE,
    CONSTRAINT `leans_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
        ON DELETE NO ACTION
        ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

INSERT INTO `leans` (`uuid`, `updated_by`, `created_by`, `description`)
VALUES (UUID(), 1, 1, 'TO DO'),
       (UUID(), 1, 1, 'IN PROGRESS'),
       (UUID(), 1, 1, 'DONE');

# ==================================================
# ==================================================
# ==================================================

CREATE TABLE `tickets`
(
    `id`          BIGINT UNSIGNED  NOT NULL AUTO_INCREMENT,
    `uuid`        CHAR(36)         NOT NULL,
    `updated_at`  TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_by`  INT UNSIGNED     NOT NULL,
    `created_at`  TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_by`  INT UNSIGNED     NOT NULL,
    `deleted_at`  TIMESTAMP        NULL,
    `title`       VARCHAR(45)      NOT NULL,
    `description` TEXT             NULL,
    `lean_id`     TINYINT UNSIGNED NOT NULL,
    `priority`    INT UNSIGNED     NOT NULL,
    `assigned_to` INT UNSIGNED     NOT NULL,
    CONSTRAINT `tickets_id_pk` PRIMARY KEY (`id`),
    CONSTRAINT `tickets_id_uq` UNIQUE (`id`),
    INDEX `tickets_uuid_idx` (`uuid`),
    INDEX `tickets_title_idx` (`title`),
    CONSTRAINT `tickets_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
        ON DELETE NO ACTION
        ON UPDATE CASCADE,
    CONSTRAINT `tickets_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
        ON DELETE NO ACTION
        ON UPDATE CASCADE,
    CONSTRAINT `tickets_lean_id_fk` FOREIGN KEY (`lean_id`) REFERENCES `leans` (`id`)
        ON DELETE NO ACTION
        ON UPDATE CASCADE,
    CONSTRAINT `tickets_assigned_to_fk` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`)
        ON DELETE NO ACTION
        ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

# ==================================================
# ========= FINISH AND SHOW EXECUTION TIME =========
# ==================================================

SELECT timediff(now(), @start_time) AS FINISHED FROM DUAL;
