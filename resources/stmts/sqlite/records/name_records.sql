-- #!sqlite
-- #  {name_records

-- #    {init
CREATE TABLE IF NOT EXISTS name_records (
    id VARCHAR(100) PRIMARY KEY,
    uuid VARCHAR(36),
    display_name VARCHAR(16),
    FOREIGN KEY (uuid) REFERENCES records(uuid) ON DELETE CASCADE
);
-- #    }

-- #    {update
-- #      :id string
-- #      :uuid string
-- #      :display_name string
INSERT OR REPLACE INTO name_records (
    id, uuid, display_name
)
VALUES (
    :id, :uuid, :display_name
);
-- #    }

-- #    {get
-- #      {via-uuid
-- #        :uuid string
SELECT display_name FROM name_records WHERE uuid = :uuid;
-- #      }
-- #      {via-display_name
-- #        :display_name string
SELECT name_records.display_name, records.username
FROM name_records, records
WHERE name_records.uuid = records.uuid AND name_records.display_name = :display_name;
-- #      }
-- #      {via-username
-- #        :username string
SELECT display_name
FROM name_records
WHERE uuid = (SELECT uuid FROM records WHERE username = LOWER(:username));
-- #      }
-- #    }

-- #  }