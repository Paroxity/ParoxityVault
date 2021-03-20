-- #!sqlite
-- # {records
-- #    {init
CREATE TABLE IF NOT EXISTS records (
    uuid VARCHAR(36) PRIMARY KEY,
    xuid VARCHAR(36),
    username VARCHAR(16),
    display_name VARCHAR(16),
    ip VARCHAR(20),
    first_join INTEGER UNSIGNED,
    last_join INTEGER UNSIGNED
);
-- #    }

-- #    {update
-- #      :uuid string
-- #      :xuid string
-- #      :username string
-- #      :display_name string
-- #      :ip string
INSERT OR REPLACE INTO records (
    uuid, xuid, username, display_name, ip, first_join, last_join
)
VALUES (
    :uuid, :xuid, LOWER(:username), :display_name, :ip,
    (CASE WHEN EXISTS (SELECT 1 FROM records WHERE uuid = :uuid) THEN (SELECT r.first_join FROM records r WHERE r.uuid = :uuid)
    ELSE (SELECT strftime('%s', 'now')) END),
    (SELECT strftime('%s', 'now'))
);
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