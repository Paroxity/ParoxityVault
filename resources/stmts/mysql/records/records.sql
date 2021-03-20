-- #!mysql
-- # {records
-- #    {init
CREATE TABLE IF NOT EXISTS records (
    uuid VARCHAR(36) NOT NULL UNIQUE PRIMARY KEY,
    xuid VARCHAR(36),
    username VARCHAR(16),
    display_name VARCHAR(16),
    ip VARCHAR(20) NOT NULL,
    first_join INT(15) UNSIGNED NOT NULL,
    last_join INT(15) UNSIGNED NOT NULL
);
-- #    }

-- #    {update
-- #      :uuid string
-- #      :xuid string
-- #      :username string
-- #      :display_name string
-- #      :ip string
INSERT INTO records (
    uuid, xuid, username, display_name, ip, first_join, last_join
)
VALUES (
    :uuid, :xuid, LOWER(:username), :display_name, :ip, UNIX_TIMESTAMP(), UNIX_TIMESTAMP()
)
ON DUPLICATE KEY UPDATE
    xuid = :xuid,
    username = LOWER(:username),
    display_name = :display_name,
    ip = :ip,
    last_join = UNIX_TIMESTAMP();
-- #    }

-- #    {get
-- #      {via-uuid
-- #        :uuid string
SELECT * FROM records WHERE uuid = :uuid;
-- #      }
-- #      {via-username
-- #        :username string
SELECT * FROM records WHERE username = LOWER(:username);
-- #      }
-- #    }

-- # }